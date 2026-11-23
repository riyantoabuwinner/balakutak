<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peringatan Keamanan Sistem — Akses Diblokir</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            background: radial-gradient(circle at top, #1f0a0a 0%, #090d16 65%);
            color: #f8fafc;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .alert-card {
            max-width: 680px;
            width: 100%;
            background: rgba(15, 23, 42, 0.94);
            border: 2px solid #ef4444;
            border-radius: 18px;
            padding: 36px 32px;
            box-shadow: 0 25px 70px rgba(239, 68, 68, 0.25);
            text-align: center;
        }
        .shield-icon {
            width: 76px;
            height: 76px;
            margin: 0 auto 20px auto;
            border-radius: 50%;
            background: rgba(239, 68, 68, 0.15);
            border: 2px solid #ef4444;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 36px;
            color: #ef4444;
        }
        .badge {
            display: inline-block;
            background: #dc2626;
            color: #ffffff;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            padding: 5px 14px;
            border-radius: 999px;
            margin-bottom: 16px;
        }
        h1 {
            font-size: 20px;
            line-height: 1.55;
            color: #fecaca;
            font-weight: 700;
            margin-bottom: 24px;
        }
        .meta-box {
            background: rgba(2, 6, 23, 0.8);
            border: 1px solid #334155;
            border-radius: 10px;
            padding: 16px;
            text-align: left;
            font-size: 13px;
            color: #cbd5e1;
            line-height: 1.8;
        }
        .meta-box strong { color: #f8fafc; }
        .footer-note {
            margin-top: 18px;
            font-size: 12px;
            color: #94a3b8;
        }
    </style>
</head>
<body>
    <div class="alert-card">
        <div class="shield-icon">&#9888;</div>
        <div class="badge">CYBER SECURITY INTRUSION DETECTION</div>
        <h1>{{ $message }}</h1>
        <div class="meta-box">
            <div><strong>ID Insiden:</strong> {{ $incidentId }}</div>
            <div><strong>Alamat IP Terdeteksi:</strong> {{ $ip }}</div>
            <div><strong>Waktu Kejadian:</strong> {{ $timestamp }}</div>
            <div><strong>Perangkat / User-Agent:</strong> {{ \Illuminate\Support\Str::limit($userAgent, 120) }}</div>
        </div>
        <div class="footer-note">
            Seluruh aktivitas mencurigakan dicatat secara otomatis oleh sistem keamanan jaringan dan aplikasi.
        </div>
    </div>
</body>
</html>
