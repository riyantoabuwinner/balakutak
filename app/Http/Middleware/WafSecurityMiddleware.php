<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class WafSecurityMiddleware
{
    public const WARNING_MESSAGE = 'Posisi dan Perangkat Anda Sudah Terdeteksi TIM Cyber Security Kami, Jika Tindakan Anda Dilanjutkan Kami Akan Menempuh Jalur Hukum Untuk Menjemput Anda !';

    private const BLOCKED_EXTENSIONS = [
        'php', 'phtml', 'php3', 'php4', 'php5', 'php7', 'phar',
        'pl', 'py', 'rb', 'jsp', 'asp', 'aspx', 'sh', 'bash',
        'cgi', 'exe', 'bat', 'cmd', 'vbs', 'html', 'htm', 'svg',
    ];

    private const SCANNER_AGENTS = [
        'sqlmap', 'nikto', 'nessus', 'acunetix', 'nuclei', 'gobuster',
        'dirbuster', 'wfuzz', 'masscan', 'wpscan', 'havij', 'netsparker',
        'zaproxy', 'burpsuite', 'hydra', 'ffuf',
    ];

    public function handle(Request $request, Closure $next): Response
    {
        $ip = $request->ip() ?? 'unknown';

        // 1. Check active temporary IP ban
        if (Cache::has("waf_ban:{$ip}")) {
            return $this->blockResponse($request, $ip, 'IP temporarily banned due to repeated attack attempts');
        }

        // 2. Check known vulnerability scanner User-Agents
        $ua = strtolower((string) $request->userAgent());
        foreach (self::SCANNER_AGENTS as $scanner) {
            if ($ua !== '' && str_contains($ua, $scanner)) {
                return $this->recordAndBlock($request, $ip, "Malicious scanner User-Agent: {$scanner}");
            }
        }

        // 3. Check dangerous paths / probing / traversal in URI
        $rawUri = urldecode($request->getRequestUri());
        if (preg_match('/(\.\.[\/\\\\]|\x00|\/\.env\b|\/\.git\b|wp-login\.php|wp-admin|xmlrpc\.php|phpmyadmin|vendor\/phpunit|eval-stdin\.php|\/etc\/passwd|win\.ini)/i', $rawUri)) {
            return $this->recordAndBlock($request, $ip, "Suspicious URI/probing: {$rawUri}");
        }

        // 4. Inspect uploaded files for dangerous extensions
        foreach ($this->flattenFiles($request->allFiles()) as $file) {
            $ext = strtolower($file->getClientOriginalExtension());
            if (in_array($ext, self::BLOCKED_EXTENSIONS, true)) {
                return $this->recordAndBlock($request, $ip, "Dangerous file upload attempt: .{$ext}");
            }
        }

        // 5. Inspect request inputs (excluding passwords & CSRF token so legitimate users are never blocked)
        $ignoredKeys = ['_token', '_method', 'password', 'password_confirmation', 'current_password'];
        $reason = $this->inspectInputs($request->except($ignoredKeys));
        if ($reason !== null) {
            return $this->recordAndBlock($request, $ip, $reason);
        }

        return $next($request);
    }

    private function inspectInputs(array $inputs, string $prefix = ''): ?string
    {
        foreach ($inputs as $key => $value) {
            $fieldName = $prefix ? "{$prefix}.{$key}" : (string) $key;

            if (is_array($value)) {
                $nested = $this->inspectInputs($value, $fieldName);
                if ($nested !== null) {
                    return $nested;
                }
                continue;
            }

            if (!is_string($value) || $value === '') {
                continue;
            }

            // PHP / Command Injection
            if (preg_match('/<\?php|<\?=|\b(eval|shell_exec|passthru|proc_open|popen|pcntl_exec)\s*\(/i', $value)) {
                return "PHP/Command injection pattern in [{$fieldName}]";
            }

            // Path Traversal / Local File Inclusion
            if (preg_match('/(\.\.[\/\\\\]|\x00|\/etc\/passwd|\/etc\/shadow|c:[\/\\\\]windows[\/\\\\]|win\.ini|boot\.ini)/i', $value)) {
                return "Path traversal/LFI pattern in [{$fieldName}]";
            }

            // SQL Injection patterns
            if (preg_match('/(\bunion\s+(all\s+)?select\b|\binformation_schema\b|\binto\s+(outfile|dumpfile)\b|\b(sleep|benchmark|waitfor\s+delay)\s*\(|\bload_file\s*\(|(\'|\"|%27|%22)\s*(or|and)\s+[\w\'\"=]+\s*(--|#))/i', $value)) {
                return "SQL injection pattern in [{$fieldName}]";
            }

            // XSS Script / Event Handler / JavaScript URI injection
            if (preg_match('/<\s*script\b|javascript\s*:|vbscript\s*:|\bon(error|load|mouseover|focus|click|submit|mouseenter)\s*=/i', $value)) {
                return "XSS script/event injection pattern in [{$fieldName}]";
            }
        }

        return null;
    }

    private function flattenFiles(array $files): array
    {
        $flat = [];
        foreach ($files as $item) {
            if (is_array($item)) {
                $flat = array_merge($flat, $this->flattenFiles($item));
            } elseif ($item instanceof \Illuminate\Http\UploadedFile) {
                $flat[] = $item;
            }
        }
        return $flat;
    }

    private function recordAndBlock(Request $request, string $ip, string $reason): Response
    {
        $strikeKey = "waf_strikes:{$ip}";
        $strikes = (int) Cache::get($strikeKey, 0) + 1;
        Cache::put($strikeKey, $strikes, now()->addMinutes(10));

        if ($strikes >= 5) {
            Cache::put("waf_ban:{$ip}", true, now()->addMinutes(30));
        }

        try {
            Log::build([
                'driver' => 'single',
                'path' => storage_path('logs/security.log'),
            ])->warning('WAF BLOCKED ATTACK', [
                'ip' => $ip,
                'strikes' => $strikes,
                'reason' => $reason,
                'method' => $request->method(),
                'url' => $request->fullUrl(),
                'user_agent' => $request->userAgent(),
                'user_id' => auth()->id(),
            ]);
        } catch (\Throwable $e) {
            // Never fail response if log file isn't writable
        }

        return $this->blockResponse($request, $ip, $reason);
    }

    private function blockResponse(Request $request, string $ip, string $reason): Response
    {
        $incidentId = strtoupper(substr(hash('sha256', $ip . now()->format('YmdHi')), 0, 12));

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'error' => true,
                'message' => self::WARNING_MESSAGE,
                'incident_id' => $incidentId,
                'ip' => $ip,
            ], 403);
        }

        return response()->view('errors.waf-blocked', [
            'message' => self::WARNING_MESSAGE,
            'ip' => $ip,
            'incidentId' => $incidentId,
            'timestamp' => now()->format('d M Y H:i:s T'),
            'userAgent' => $request->userAgent() ?: 'Unknown Device',
        ], 403);
    }
}
