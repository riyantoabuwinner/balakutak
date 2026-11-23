<?php

namespace App\Http\Middleware;

use App\Models\BlockedIp;
use App\Models\SecurityLog;
use App\Models\Setting;
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
        if (!$this->isSettingEnabled('yspg_enabled', true)) {
            return $next($request);
        }

        $ip = $request->ip() ?? 'unknown';

        // 1. Check active IP ban (Cache + BlockedIp table)
        if ($this->isIpBlocked($ip)) {
            return $this->blockResponse($request, $ip, 'IP Reputation Block: Alamat IP masuk daftar blokir aktif');
        }

        if (!$this->isSettingEnabled('yspg_waf_enabled', true)) {
            return $next($request);
        }

        // 2. Check known vulnerability scanner User-Agents
        $ua = strtolower((string) $request->userAgent());
        foreach (self::SCANNER_AGENTS as $scanner) {
            if ($ua !== '' && str_contains($ua, $scanner)) {
                return $this->recordAndBlock($request, $ip, 'Malicious Scanner', 'high', "Malicious scanner User-Agent: {$scanner}");
            }
        }

        // 3. Check dangerous paths / probing / traversal in URI
        $rawUri = urldecode($request->getRequestUri());
        if (preg_match('/(\.\.[\/\\\\]|\x00|\/\.env\b|\/\.git\b|wp-login\.php|wp-admin|xmlrpc\.php|phpmyadmin|vendor\/phpunit|eval-stdin\.php|\/etc\/passwd|win\.ini)/i', $rawUri)) {
            return $this->recordAndBlock($request, $ip, 'Path Traversal / Probing', 'high', "Suspicious URI/probing: {$rawUri}");
        }

        // 4. Inspect uploaded files for dangerous extensions
        foreach ($this->flattenFiles($request->allFiles()) as $file) {
            $ext = strtolower($file->getClientOriginalExtension());
            if (in_array($ext, self::BLOCKED_EXTENSIONS, true)) {
                return $this->recordAndBlock($request, $ip, 'Dangerous File Upload', 'critical', "Dangerous file upload attempt: .{$ext}");
            }
        }

        // 5. Inspect request inputs (excluding passwords & CSRF token so legitimate users are never blocked)
        $ignoredKeys = ['_token', '_method', 'password', 'password_confirmation', 'current_password'];
        $finding = $this->inspectInputs($request->except($ignoredKeys));
        if ($finding !== null) {
            return $this->recordAndBlock($request, $ip, $finding['type'], $finding['severity'], $finding['reason']);
        }

        return $next($request);
    }

    private function inspectInputs(array $inputs, string $prefix = ''): ?array
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

            if (preg_match('/<\?php|<\?=|\b(eval|shell_exec|passthru|proc_open|popen|pcntl_exec)\s*\(/i', $value)) {
                return [
                    'type' => 'PHP / Command Injection',
                    'severity' => 'critical',
                    'reason' => "PHP/Command injection pattern in [{$fieldName}]",
                ];
            }

            if (preg_match('/(\.\.[\/\\\\]|\x00|\/etc\/passwd|\/etc\/shadow|c:[\/\\\\]windows[\/\\\\]|win\.ini|boot\.ini)/i', $value)) {
                return [
                    'type' => 'LFI / Path Traversal',
                    'severity' => 'high',
                    'reason' => "Path traversal/LFI pattern in [{$fieldName}]",
                ];
            }

            if (preg_match('/(\bunion\s+(all\s+)?select\b|\binformation_schema\b|\binto\s+(outfile|dumpfile)\b|\b(sleep|benchmark|waitfor\s+delay)\s*\(|\bload_file\s*\(|(\'|\"|%27|%22)\s*(or|and)\s+[\w\'\"=]+\s*(--|#))/i', $value)) {
                return [
                    'type' => 'SQL Injection',
                    'severity' => 'critical',
                    'reason' => "SQL injection pattern in [{$fieldName}]",
                ];
            }

            if (preg_match('/<\s*script\b|javascript\s*:|vbscript\s*:|\bon(error|load|mouseover|focus|click|submit|mouseenter)\s*=/i', $value)) {
                return [
                    'type' => 'Cross-Site Scripting (XSS)',
                    'severity' => 'high',
                    'reason' => "XSS script/event injection pattern in [{$fieldName}]",
                ];
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

    private function isIpBlocked(string $ip): bool
    {
        if (Cache::has("waf_ban:{$ip}")) {
            return true;
        }

        try {
            $blocked = BlockedIp::active()->where('ip_address', $ip)->first();
            if ($blocked) {
                $blocked->increment('hit_count');
                return true;
            }
        } catch (\Throwable $e) {
            // DB may not be migrated yet
        }

        return false;
    }

    private function recordAndBlock(Request $request, string $ip, string $threatType, string $severity, string $reason): Response
    {
        $maxStrikes = max(1, (int) $this->getSettingValue('yspg_max_strikes', 5));
        $banMinutes = max(1, (int) $this->getSettingValue('yspg_ban_minutes', 30));
        $autoBan = $this->isSettingEnabled('yspg_auto_ban_enabled', true);

        $strikeKey = "waf_strikes:{$ip}";
        $strikes = (int) Cache::get($strikeKey, 0) + 1;
        Cache::put($strikeKey, $strikes, now()->addMinutes(10));

        $actionTaken = 'blocked';
        if ($autoBan && $strikes >= $maxStrikes) {
            $actionTaken = 'auto_banned';
            Cache::put("waf_ban:{$ip}", true, now()->addMinutes($banMinutes));
            try {
                BlockedIp::updateOrCreate(
                    ['ip_address' => $ip],
                    [
                        'reason' => "Auto-ban ({$threatType}): {$reason}",
                        'source' => 'auto',
                        'is_permanent' => false,
                        'expires_at' => now()->addMinutes($banMinutes),
                    ]
                );
            } catch (\Throwable $e) {
                // Ignore if DB not ready
            }
        }

        $incidentId = strtoupper(substr(hash('sha256', $ip . microtime(true)), 0, 12));

        try {
            SecurityLog::create([
                'incident_id' => $incidentId,
                'ip_address' => $ip,
                'threat_type' => $threatType,
                'severity' => $severity,
                'method' => $request->method(),
                'url' => mb_substr($request->fullUrl(), 0, 2000),
                'user_agent' => mb_substr((string) $request->userAgent(), 0, 500),
                'reason' => $reason,
                'action_taken' => $actionTaken,
                'user_id' => auth()->id(),
            ]);
        } catch (\Throwable $e) {
            // Ignore if DB not ready
        }

        try {
            Log::build([
                'driver' => 'single',
                'path' => storage_path('logs/security.log'),
            ])->warning('YSPG BLOCKED ATTACK', [
                'incident_id' => $incidentId,
                'ip' => $ip,
                'threat_type' => $threatType,
                'severity' => $severity,
                'strikes' => $strikes,
                'action' => $actionTaken,
                'reason' => $reason,
                'method' => $request->method(),
                'url' => $request->fullUrl(),
                'user_agent' => $request->userAgent(),
                'user_id' => auth()->id(),
            ]);
        } catch (\Throwable $e) {
            // Ignore log write failure
        }

        return $this->blockResponse($request, $ip, $reason, $incidentId);
    }

    private function blockResponse(Request $request, string $ip, string $reason, ?string $incidentId = null): Response
    {
        $incidentId = $incidentId ?? strtoupper(substr(hash('sha256', $ip . now()->format('YmdHi')), 0, 12));

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'error' => true,
                'guard' => 'YantoSedunia Protection Guard',
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

    private function isSettingEnabled(string $key, bool $default): bool
    {
        return filter_var($this->getSettingValue($key, $default ? '1' : '0'), FILTER_VALIDATE_BOOLEAN);
    }

    private function getSettingValue(string $key, mixed $default): mixed
    {
        try {
            return Setting::get($key, $default);
        } catch (\Throwable $e) {
            return $default;
        }
    }
}
