<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlockedIp;
use App\Models\SecurityLog;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

class SecurityGuardController extends Controller
{
    public function index(Request $request)
    {
        $totalThreats = SecurityLog::count();
        $threatsToday = SecurityLog::whereDate('created_at', today())->count();
        $activeBlocks = BlockedIp::active()->count();
        $bruteForceCount = SecurityLog::whereIn('threat_type', ['Brute Force Attack', 'Failed Login Attempt'])->count();

        // Threat breakdown for Chart.js
        $threatBreakdown = SecurityLog::selectRaw('threat_type, COUNT(*) as total')
            ->groupBy('threat_type')
            ->orderByDesc('total')
            ->get();

        // 7-day trend
        $trendLabels = [];
        $trendData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $trendLabels[] = $date->format('d M');
            $trendData[] = SecurityLog::whereDate('created_at', $date->toDateString())->count();
        }

        // Security Logs query
        $logsQuery = SecurityLog::query()
            ->when($request->search, fn($q) => $q->where(function ($sub) use ($request) {
                $sub->where('ip_address', 'like', "%{$request->search}%")
                    ->orWhere('incident_id', 'like', "%{$request->search}%")
                    ->orWhere('reason', 'like', "%{$request->search}%")
                    ->orWhere('url', 'like', "%{$request->search}%");
            }))
            ->when($request->threat_type, fn($q) => $q->where('threat_type', $request->threat_type))
            ->when($request->severity, fn($q) => $q->where('severity', $request->severity))
            ->latest();

        $logs = $logsQuery->paginate(15)->withQueryString();
        $threatTypes = SecurityLog::select('threat_type')->distinct()->pluck('threat_type');

        // Blocked IPs
        $blockedIps = BlockedIp::with('blocker')->latest()->get();

        // Security Audit & Integrity Checks
        $weakPasswordUsers = User::where('status', 'active')->get()->filter(fn($u) => Hash::check('password', $u->password));
        $auditChecks = [
            [
                'label' => 'Public Registration Disabled (/register)',
                'passed' => !\Illuminate\Support\Facades\Route::has('register'),
                'detail' => \Illuminate\Support\Facades\Route::has('register') ? 'Rute /register masih aktif!' : 'Rute registrasi publik dinonaktifkan.',
            ],
            [
                'label' => 'Storage Upload Script Blocker (.htaccess)',
                'passed' => file_exists(storage_path('app/public/.htaccess')) || str_contains(@file_get_contents(public_path('.htaccess')) ?: '', 'storage/'),
                'detail' => 'Eksekusi PHP/HTML/SVG di folder upload diblokir.',
            ],
            [
                'label' => 'APP_DEBUG Production Check',
                'passed' => !config('app.debug') || app()->environment('local'),
                'detail' => config('app.debug') ? 'APP_DEBUG=true (disarankan false di production).' : 'APP_DEBUG=false (Aman).',
            ],
            [
                'label' => 'Default Seeder Password Check ("password")',
                'passed' => $weakPasswordUsers->isEmpty(),
                'detail' => $weakPasswordUsers->isEmpty()
                    ? 'Tidak ada akun aktif yang memakai password default.'
                    : $weakPasswordUsers->count() . ' akun masih memakai password default ("password"): ' . $weakPasswordUsers->pluck('email')->implode(', '),
            ],
            [
                'label' => 'PHP GD / Image Verification Extension',
                'passed' => function_exists('imagecreatetruecolor') && function_exists('getimagesize'),
                'detail' => function_exists('imagecreatetruecolor') ? 'Ekstensi PHP GD aktif untuk validasi gambar & Captcha.' : 'PHP GD tidak aktif (menggunakan fallback Pure-PHP PNG).',
            ],
        ];

        $settings = [
            'yspg_enabled' => Setting::get('yspg_enabled', '1'),
            'yspg_waf_enabled' => Setting::get('yspg_waf_enabled', '1'),
            'yspg_auto_ban_enabled' => Setting::get('yspg_auto_ban_enabled', '1'),
            'yspg_max_strikes' => Setting::get('yspg_max_strikes', '5'),
            'yspg_ban_minutes' => Setting::get('yspg_ban_minutes', '30'),
        ];

        return view('admin.security_guard.index', compact(
            'totalThreats',
            'threatsToday',
            'activeBlocks',
            'bruteForceCount',
            'threatBreakdown',
            'trendLabels',
            'trendData',
            'logs',
            'threatTypes',
            'blockedIps',
            'auditChecks',
            'settings'
        ));
    }

    public function blockIp(Request $request)
    {
        $validated = $request->validate([
            'ip_address' => 'required|ip',
            'reason' => 'nullable|string|max:255',
            'duration_minutes' => 'nullable|integer|min:1|max:525600',
            'is_permanent' => 'boolean',
        ]);

        $isPermanent = $request->boolean('is_permanent');
        $minutes = (int) ($validated['duration_minutes'] ?? 60);

        BlockedIp::updateOrCreate(
            ['ip_address' => $validated['ip_address']],
            [
                'reason' => $validated['reason'] ?: 'Diblokir manual oleh Super Admin',
                'source' => 'manual',
                'is_permanent' => $isPermanent,
                'expires_at' => $isPermanent ? null : now()->addMinutes($minutes),
                'blocked_by' => auth()->id(),
            ]
        );

        Cache::put("waf_ban:{$validated['ip_address']}", true, $isPermanent ? now()->addYears(10) : now()->addMinutes($minutes));

        return back()->with('success', "IP {$validated['ip_address']} berhasil diblokir.");
    }

    public function unblockIp(BlockedIp $blockedIp)
    {
        Cache::forget("waf_ban:{$blockedIp->ip_address}");
        Cache::forget("waf_strikes:{$blockedIp->ip_address}");
        $blockedIp->delete();

        return back()->with('success', "Blokir IP {$blockedIp->ip_address} berhasil dibuka.");
    }

    public function updateSettings(Request $request)
    {
        $request->validate([
            'yspg_max_strikes' => 'required|integer|min:1|max:50',
            'yspg_ban_minutes' => 'required|integer|min:1|max:43200',
        ]);

        Setting::set('yspg_enabled', $request->boolean('yspg_enabled') ? '1' : '0');
        Setting::set('yspg_waf_enabled', $request->boolean('yspg_waf_enabled') ? '1' : '0');
        Setting::set('yspg_auto_ban_enabled', $request->boolean('yspg_auto_ban_enabled') ? '1' : '0');
        Setting::set('yspg_max_strikes', (string) $request->yspg_max_strikes);
        Setting::set('yspg_ban_minutes', (string) $request->yspg_ban_minutes);
        Cache::forget('site_settings');

        return back()->with('success', 'Konfigurasi YantoSedunia Protection Guard berhasil disimpan!');
    }

    public function runCleanup()
    {
        Artisan::call('security:cleanup', ['--force' => true]);
        $output = trim(Artisan::output());

        return back()->with('success', 'Pemindaian & pembersihan keamanan selesai. ' . ($output ? str_replace(["\r", "\n"], ' | ', $output) : ''));
    }

    public function clearLogs()
    {
        SecurityLog::truncate();
        return back()->with('success', 'Seluruh catatan insiden keamanan berhasil dibersihkan.');
    }
}
