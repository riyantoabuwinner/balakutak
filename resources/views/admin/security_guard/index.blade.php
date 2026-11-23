@extends('adminlte::page')

@section('title', 'YantoSedunia Protection Guard')

@section('content_header')
    <div class="d-flex flex-wrap justify-content-between align-items-center bg-navy text-white p-4 rounded shadow-sm">
        <div class="d-flex align-items-center">
            <img src="{{ asset('images/yanto-sedunia-guard.png') }}" alt="YantoSedunia Protection Guard" style="height: 62px; width: auto;" class="mr-3">
            <div>
                <div class="d-flex align-items-center">
                    <h1 class="m-0 font-weight-bold text-white" style="font-size: 1.45rem;">YantoSedunia Protection Guard</h1>
                    <span class="badge badge-success ml-2 px-2 py-1"><i class="fas fa-circle text-xs mr-1"></i>{{ $settings['yspg_enabled'] == '1' ? 'ACTIVE SHIELD' : 'PAUSED' }}</span>
                </div>
                <p class="mb-0 text-light opacity-75 text-sm">Smart Website Security &amp; Cyber Attack Protection Engine &mdash; <em>"Detect Early. Defend Smart. Protect Always."</em></p>
            </div>
        </div>
        <div class="mt-3 mt-md-0">
            <form action="{{ route('admin.security-guard.cleanup') }}" method="POST" class="d-inline" onsubmit="return confirm('Jalankan pembersihan otomatis database dan direktori upload sekarang?')">
                @csrf
                <button type="submit" class="btn btn-warning btn-sm font-weight-bold shadow-sm px-3 py-2">
                    <i class="fas fa-broom mr-1"></i> Jalankan Security Cleanup
                </button>
            </form>
        </div>
    </div>
@stop

@section('content')
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show shadow-sm">
        <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
        <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
@endif

{{-- 4 KPI Boxes --}}
<div class="row">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-gradient-danger shadow-sm">
            <div class="inner">
                <h3>{{ number_format($totalThreats) }}</h3>
                <p>Total Ancaman Terdeteksi</p>
            </div>
            <div class="icon"><i class="fas fa-biohazard"></i></div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-gradient-warning shadow-sm">
            <div class="inner">
                <h3>{{ number_format($threatsToday) }}</h3>
                <p>Insiden Hari Ini</p>
            </div>
            <div class="icon"><i class="fas fa-bolt"></i></div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-gradient-navy shadow-sm">
            <div class="inner">
                <h3>{{ number_format($activeBlocks) }}</h3>
                <p>IP Sedang Diblokir</p>
            </div>
            <div class="icon"><i class="fas fa-ban"></i></div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-gradient-info shadow-sm">
            <div class="inner">
                <h3>{{ number_format($bruteForceCount) }}</h3>
                <p>Percobaan Brute Force</p>
            </div>
            <div class="icon"><i class="fas fa-user-lock"></i></div>
        </div>
    </div>
</div>

{{-- Navigation Tabs --}}
<div class="card card-primary card-outline card-outline-tabs shadow-sm">
    <div class="card-header p-0 border-bottom-0">
        <ul class="nav nav-tabs" id="yspgTabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active font-weight-bold" data-toggle="pill" href="#tab-monitoring" role="tab">
                    <i class="fas fa-chart-area mr-1 text-primary"></i> Real-Time Threat Monitoring
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link font-weight-bold" data-toggle="pill" href="#tab-incidents" role="tab">
                    <i class="fas fa-exclamation-triangle mr-1 text-danger"></i> Security Alerts &amp; Logs ({{ $logs->total() }})
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link font-weight-bold" data-toggle="pill" href="#tab-ipblock" role="tab">
                    <i class="fas fa-shield-alt mr-1 text-warning"></i> IP Reputation &amp; Blocking ({{ $blockedIps->count() }})
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link font-weight-bold" data-toggle="pill" href="#tab-audit" role="tab">
                    <i class="fas fa-clipboard-check mr-1 text-success"></i> Security Audit &amp; Integrity
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link font-weight-bold" data-toggle="pill" href="#tab-settings" role="tab">
                    <i class="fas fa-sliders-h mr-1 text-secondary"></i> Engine Settings
                </a>
            </li>
        </ul>
    </div>

    <div class="card-body">
        <div class="tab-content">
            {{-- TAB 1: MONITORING & ENGINE OVERVIEW --}}
            <div class="tab-pane fade show active" id="tab-monitoring" role="tabpanel">
                <div class="row mb-4">
                    <div class="col-md-8 mb-3">
                        <div class="card border shadow-none h-100">
                            <div class="card-header bg-light font-weight-bold">
                                <i class="fas fa-chart-line mr-2 text-primary"></i>Tren Aktivitas Ancaman 7 Hari Terakhir
                            </div>
                            <div class="card-body">
                                <canvas id="threatTrendChart" style="height: 240px;"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card border shadow-none h-100">
                            <div class="card-header bg-light font-weight-bold">
                                <i class="fas fa-chart-pie mr-2 text-danger"></i>Distribusi Jenis Serangan
                            </div>
                            <div class="card-body">
                                @if($threatBreakdown->isEmpty())
                                    <div class="text-center text-muted py-5">
                                        <i class="fas fa-shield-alt fa-3x text-success mb-2"></i>
                                        <p class="mb-0">Belum ada serangan yang tercatat. Sistem aman!</p>
                                    </div>
                                @else
                                    <ul class="list-group list-group-flush">
                                        @foreach($threatBreakdown as $tb)
                                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                                <span class="font-weight-600 text-sm">{{ $tb->threat_type }}</span>
                                                <span class="badge badge-danger badge-pill">{{ $tb->total }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                {{-- 4 Core Pillars --}}
                <div class="row">
                    <div class="col-md-3 mb-2">
                        <div class="p-3 bg-light rounded border-left border-primary h-100" style="border-left-width: 4px !important;">
                            <h6 class="font-weight-bold text-primary mb-1"><i class="fas fa-filter mr-1"></i> PREVENT</h6>
                            <p class="text-xs text-muted mb-0">Intelligent WAF menyaring SQLi, XSS, LFI, RCE &amp; upload berbahaya sebelum menyentuh aplikasi.</p>
                        </div>
                    </div>
                    <div class="col-md-3 mb-2">
                        <div class="p-3 bg-light rounded border-left border-warning h-100" style="border-left-width: 4px !important;">
                            <h6 class="font-weight-bold text-warning mb-1"><i class="fas fa-radar mr-1"></i> DETECT</h6>
                            <p class="text-xs text-muted mb-0">Mendeteksi scanner otomatis, pola eksploitasi, serta percobaan brute force login.</p>
                        </div>
                    </div>
                    <div class="col-md-3 mb-2">
                        <div class="p-3 bg-light rounded border-left border-danger h-100" style="border-left-width: 4px !important;">
                            <h6 class="font-weight-bold text-danger mb-1"><i class="fas fa-user-shield mr-1"></i> PROTECT</h6>
                            <p class="text-xs text-muted mb-0">Automated Threat Response memblokir IP penyerang &amp; menampilkan peringatan hukum.</p>
                        </div>
                    </div>
                    <div class="col-md-3 mb-2">
                        <div class="p-3 bg-light rounded border-left border-success h-100" style="border-left-width: 4px !important;">
                            <h6 class="font-weight-bold text-success mb-1"><i class="fas fa-desktop mr-1"></i> MONITOR</h6>
                            <p class="text-xs text-muted mb-0">Audit integritas file, deteksi password lemah, dan pelaporan insiden secara real-time.</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- TAB 2: SECURITY ALERTS & INCIDENT LOGS --}}
            <div class="tab-pane fade" id="tab-incidents" role="tabpanel">
                <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
                    <form method="GET" action="{{ route('admin.security-guard.index') }}" class="form-inline">
                        <input type="text" name="search" value="{{ request('search') }}" class="form-control form-control-sm mr-2 mb-2" placeholder="Cari IP / ID / URL...">
                        <select name="threat_type" class="form-control form-control-sm mr-2 mb-2">
                            <option value="">Semua Jenis Ancaman</option>
                            @foreach($threatTypes as $tt)
                                <option value="{{ $tt }}" {{ request('threat_type') == $tt ? 'selected' : '' }}>{{ $tt }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-primary btn-sm mb-2 mr-2"><i class="fas fa-search"></i> Filter</button>
                        <a href="{{ route('admin.security-guard.index') }}" class="btn btn-default btn-sm mb-2">Reset</a>
                    </form>
                    <form method="POST" action="{{ route('admin.security-guard.clear-logs') }}" onsubmit="return confirm('Hapus seluruh catatan insiden?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger btn-sm mb-2"><i class="fas fa-trash mr-1"></i> Bersihkan Log</button>
                    </form>
                </div>

                <div class="table-responsive">
                    <table class="table table-sm table-bordered table-hover text-xs">
                        <thead class="bg-navy text-white">
                            <tr>
                                <th>Waktu</th>
                                <th>ID Insiden</th>
                                <th>Alamat IP</th>
                                <th>Jenis Ancaman</th>
                                <th>Severity</th>
                                <th>Method &amp; URL</th>
                                <th>Alasan / Deteksi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($logs as $log)
                                <tr>
                                    <td class="text-nowrap">{{ $log->created_at->format('d M Y H:i:s') }}</td>
                                    <td><code>{{ $log->incident_id }}</code></td>
                                    <td><strong>{{ $log->ip_address }}</strong></td>
                                    <td><span class="badge badge-dark">{{ $log->threat_type }}</span></td>
                                    <td>
                                        @php
                                            $sevColor = match($log->severity) {
                                                'critical' => 'danger',
                                                'high' => 'warning',
                                                'medium' => 'info',
                                                default => 'secondary',
                                            };
                                        @endphp
                                        <span class="badge badge-{{ $sevColor }} text-uppercase">{{ $log->severity }}</span>
                                    </td>
                                    <td style="max-width: 240px; word-break: break-all;">
                                        <span class="badge badge-light border">{{ $log->method }}</span>
                                        {{ \Illuminate\Support\Str::limit($log->url, 80) }}
                                    </td>
                                    <td style="max-width: 220px;">{{ $log->reason }}</td>
                                    <td><span class="badge badge-outline-danger border border-danger text-danger">{{ $log->action_taken }}</span></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-4 text-muted">Belum ada catatan insiden keamanan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-3">{{ $logs->links() }}</div>
            </div>

            {{-- TAB 3: IP REPUTATION & BLOCKING --}}
            <div class="tab-pane fade" id="tab-ipblock" role="tabpanel">
                <div class="card bg-light border mb-4">
                    <div class="card-body">
                        <h6 class="font-weight-bold mb-3"><i class="fas fa-ban mr-2 text-danger"></i>Blokir Alamat IP Secara Manual</h6>
                        <form method="POST" action="{{ route('admin.security-guard.block-ip') }}" class="row">
                            @csrf
                            <div class="col-md-3 mb-2">
                                <input type="text" name="ip_address" class="form-control form-control-sm" placeholder="Contoh: 192.168.1.50" required>
                            </div>
                            <div class="col-md-4 mb-2">
                                <input type="text" name="reason" class="form-control form-control-sm" placeholder="Alasan pemblokiran">
                            </div>
                            <div class="col-md-2 mb-2">
                                <input type="number" name="duration_minutes" class="form-control form-control-sm" value="60" min="1" placeholder="Menit">
                            </div>
                            <div class="col-md-3 mb-2 d-flex align-items-center">
                                <div class="custom-control custom-checkbox mr-3">
                                    <input type="checkbox" class="custom-control-input" id="is_permanent" name="is_permanent" value="1">
                                    <label class="custom-control-label text-xs" for="is_permanent">Permanen</label>
                                </div>
                                <button type="submit" class="btn btn-danger btn-sm font-weight-bold">Blokir IP</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-sm table-bordered table-hover text-sm">
                        <thead class="bg-light">
                            <tr>
                                <th>Alamat IP</th>
                                <th>Sumber</th>
                                <th>Alasan</th>
                                <th>Berakhir Pada</th>
                                <th>Hit Diblokir</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($blockedIps as $bip)
                                <tr>
                                    <td><strong>{{ $bip->ip_address }}</strong></td>
                                    <td><span class="badge badge-{{ $bip->source === 'auto' ? 'warning' : 'danger' }}">{{ strtoupper($bip->source) }}</span></td>
                                    <td>{{ $bip->reason }}</td>
                                    <td>{{ $bip->is_permanent ? 'Permanen' : ($bip->expires_at ? $bip->expires_at->format('d M Y H:i') : '-') }}</td>
                                    <td><span class="badge badge-secondary">{{ $bip->hit_count }}x</span></td>
                                    <td>
                                        <form method="POST" action="{{ route('admin.security-guard.unblock-ip', $bip) }}" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-success btn-xs"><i class="fas fa-unlock mr-1"></i>Buka Blokir</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-muted">Tidak ada IP yang sedang diblokir.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- TAB 4: SECURITY AUDIT & INTEGRITY --}}
            <div class="tab-pane fade" id="tab-audit" role="tabpanel">
                <h6 class="font-weight-bold mb-3"><i class="fas fa-clipboard-check mr-2 text-success"></i>Hasil Pemeriksaan Integritas &amp; Konfigurasi Sistem</h6>
                <div class="list-group mb-4">
                    @foreach($auditChecks as $chk)
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <div class="font-weight-bold text-dark">{{ $chk['label'] }}</div>
                                <small class="text-muted">{{ $chk['detail'] }}</small>
                            </div>
                            @if($chk['passed'])
                                <span class="badge badge-success px-3 py-2"><i class="fas fa-check mr-1"></i> AMAN</span>
                            @else
                                <span class="badge badge-danger px-3 py-2"><i class="fas fa-exclamation-triangle mr-1"></i> PERLU PERHATIAN</span>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- TAB 5: ENGINE SETTINGS --}}
            <div class="tab-pane fade" id="tab-settings" role="tabpanel">
                <form method="POST" action="{{ route('admin.security-guard.settings') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="yspg_enabled" name="yspg_enabled" value="1" {{ $settings['yspg_enabled'] == '1' ? 'checked' : '' }}>
                                    <label class="custom-control-label font-weight-bold" for="yspg_enabled">Aktifkan YantoSedunia Protection Guard</label>
                                </div>
                                <small class="text-muted">Master switch untuk seluruh engine keamanan dan pemblokiran IP.</small>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="yspg_waf_enabled" name="yspg_waf_enabled" value="1" {{ $settings['yspg_waf_enabled'] == '1' ? 'checked' : '' }}>
                                    <label class="custom-control-label font-weight-bold" for="yspg_waf_enabled">Aktifkan Intelligent WAF (SQLi, XSS, LFI, RCE, Scanner)</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="yspg_auto_ban_enabled" name="yspg_auto_ban_enabled" value="1" {{ $settings['yspg_auto_ban_enabled'] == '1' ? 'checked' : '' }}>
                                    <label class="custom-control-label font-weight-bold" for="yspg_auto_ban_enabled">Aktifkan Auto-Ban IP Penyerang Berulang</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">Batas Percobaan Sebelum Auto-Ban (Strikes)</label>
                                <input type="number" name="yspg_max_strikes" class="form-control" value="{{ $settings['yspg_max_strikes'] }}" min="1" max="50" required>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Durasi Auto-Ban (Menit)</label>
                                <input type="number" name="yspg_ban_minutes" class="form-control" value="{{ $settings['yspg_ban_minutes'] }}" min="1" max="43200" required>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary font-weight-bold"><i class="fas fa-save mr-1"></i> Simpan Konfigurasi Engine</button>
                </form>
            </div>
        </div>
    </div>
</div>
@stop

@section('js')
<script>
    $(function () {
        const ctx = document.getElementById('threatTrendChart');
        if (ctx && typeof Chart !== 'undefined') {
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: {!! json_encode($trendLabels) !!},
                    datasets: [{
                        label: 'Ancaman Diblokir',
                        data: {!! json_encode($trendData) !!},
                        borderColor: '#dc3545',
                        backgroundColor: 'rgba(220, 53, 69, 0.12)',
                        borderWidth: 2.5,
                        fill: true,
                        tension: 0.35
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: { y: { beginAtZero: true, ticks: { precision: 0 } } }
                }
            });
        }
    });
</script>
@stop
