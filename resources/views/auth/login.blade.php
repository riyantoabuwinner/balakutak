<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'BalaKutaK CMS') }} - Login</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Outfit:400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        * { box-sizing: border-box; }
        html, body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            width: 100%;
            overflow-x: hidden;
            font-family: 'Outfit', -apple-system, BlinkMacSystemFont, sans-serif;
            color: #0f172a;
        }

        .goog-te-banner-frame, #goog-gt-tt, .goog-te-balloon-frame { display: none !important; }
        iframe.skiptranslate { display: none !important; }
        .goog-text-highlight { background: none !important; box-shadow: none !important; }

        body {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px 16px 76px 16px;
            position: relative;
        }

        body::before {
            content: "";
            position: fixed;
            inset: 0;
            background:
                linear-gradient(135deg, rgba(15, 23, 42, 0.58), rgba(30, 27, 75, 0.52)),
                url('{{ asset('images/login-bg-balakutak.jpg') }}?v={{ time() }}') no-repeat center center fixed;
            background-size: cover;
            z-index: -1;
        }

        .login-wrapper {
            width: 100%;
            max-width: 820px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .login-card {
            width: 100%;
            display: flex;
            flex-direction: row;
            background: #ffffff;
            border-radius: 28px;
            overflow: hidden;
            box-shadow: 0 25px 70px rgba(15, 23, 42, 0.45);
            border: 1px solid rgba(255, 255, 255, 0.25);
        }

        .login-brand {
            width: 46%;
            background: linear-gradient(145deg, #1e1b4b 0%, #312e81 55%, #4338ca 100%);
            color: #ffffff;
            padding: 44px 36px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .login-brand-grid {
            position: absolute;
            inset: 0;
            opacity: 0.08;
            pointer-events: none;
        }

        .login-brand-content {
            position: relative;
            z-index: 2;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .login-brand-logo {
            height: 84px;
            width: auto;
            margin-bottom: 22px;
            filter: brightness(0) invert(1);
            opacity: 0.95;
        }

        .login-brand-title {
            font-size: 20px;
            font-weight: 700;
            line-height: 1.3;
            margin: 0 0 8px 0;
            letter-spacing: -0.01em;
        }

        .login-brand-sub {
            font-size: 10px;
            font-weight: 500;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: rgba(224, 231, 255, 0.75);
            max-width: 220px;
            line-height: 1.6;
            margin: 0;
        }

        .login-form-panel {
            width: 54%;
            padding: 42px 44px;
            background: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-form-inner {
            width: 100%;
            max-width: 340px;
        }

        .login-header {
            text-align: center;
            margin-bottom: 26px;
        }

        .login-header h1 {
            font-size: 24px;
            font-weight: 700;
            color: #0f172a;
            margin: 0 0 4px 0;
        }

        .login-header p {
            font-size: 13px;
            color: #94a3b8;
            margin: 0;
        }

        .field-group {
            margin-bottom: 16px;
        }

        .field-label-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 6px;
        }

        .field-label {
            display: block;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.16em;
            color: #64748b;
            margin-bottom: 6px;
        }

        .field-label-row .field-label {
            margin-bottom: 0;
        }

        .forgot-link {
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #4f46e5;
            text-decoration: none;
        }

        .forgot-link:hover {
            color: #3730a3;
        }

        .input-wrap {
            position: relative;
        }

        .form-input {
            width: 100%;
            padding: 11px 14px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            font-size: 14px;
            color: #1e293b;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s, background-color 0.2s;
            font-family: inherit;
        }

        .form-input:focus {
            background: #ffffff;
            border-color: #4f46e5;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.12);
        }

        .form-input-pw {
            padding-right: 42px;
        }

        .pw-toggle {
            position: absolute;
            top: 50%;
            right: 12px;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #94a3b8;
            cursor: pointer;
            padding: 4px;
            display: flex;
            align-items: center;
        }

        .pw-toggle:hover {
            color: #4f46e5;
        }

        .captcha-row {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 10px;
        }

        .captcha-box {
            flex: 1;
            height: 56px;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            background: #f8fafc;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .captcha-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .captcha-refresh {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            border: 1px solid #e0e7ff;
            background: #eef2ff;
            color: #4f46e5;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s;
            flex-shrink: 0;
        }

        .captcha-refresh:hover {
            background: #4f46e5;
            color: #ffffff;
        }

        .btn-signin {
            width: 100%;
            margin-top: 6px;
            padding: 13px 20px;
            border: none;
            border-radius: 12px;
            background: linear-gradient(135deg, #4f46e5 0%, #4338ca 100%);
            color: #ffffff;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 0.16em;
            text-transform: uppercase;
            cursor: pointer;
            box-shadow: 0 10px 24px rgba(79, 70, 229, 0.28);
            transition: transform 0.15s, box-shadow 0.2s;
            font-family: inherit;
        }

        .btn-signin:hover {
            transform: translateY(-1px);
            box-shadow: 0 14px 28px rgba(79, 70, 229, 0.35);
        }

        .login-footer-brand {
            margin-top: 22px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            opacity: 0.8;
        }

        .login-footer-brand img {
            height: 34px;
            width: auto;
        }

        .version-pill {
            padding: 4px 12px;
            border-radius: 999px;
            background: rgba(15, 23, 42, 0.55);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.18);
            color: rgba(255, 255, 255, 0.85);
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 0.2em;
            text-transform: uppercase;
        }

        /* Unique Bottom-Left Security Logo (Pure CSS) */
        .yanto-guard-logo-wrap {
            position: fixed;
            bottom: 18px;
            left: 18px;
            z-index: 9999;
            display: inline-block;
            user-select: none;
            transition: transform 0.25s ease, filter 0.25s ease;
        }

        .yanto-guard-logo-wrap:hover {
            transform: scale(1.06) translateY(-2px);
        }

        .yanto-guard-logo-wrap img {
            height: 82px;
            width: auto;
            display: block;
            filter: drop-shadow(0 8px 18px rgba(2, 6, 23, 0.55));
        }

        @media (max-width: 768px) {
            .login-card { flex-direction: column; border-radius: 22px; }
            .login-brand { display: none; }
            .login-form-panel { width: 100%; padding: 32px 24px; }
            .yanto-guard-logo-wrap { left: 12px; bottom: 12px; }
            .yanto-guard-logo-wrap img { height: 60px; }
        }
    </style>
</head>
<body>

    <div class="login-wrapper">
        <div class="login-card">
            <!-- Left Side - Clean Branding -->
            <div class="login-brand">
                <div class="login-brand-grid">
                    <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <pattern id="grid" width="36" height="36" patternUnits="userSpaceOnUse">
                                <path d="M 36 0 L 0 0 0 36" fill="none" stroke="white" stroke-width="1"/>
                            </pattern>
                        </defs>
                        <rect width="100%" height="100%" fill="url(#grid)" />
                    </svg>
                </div>

                <div class="login-brand-content">
                    @php $siteLogo = \App\Models\Setting::get('site_logo') @endphp
                    @if($siteLogo)
                        <img src="{{ asset('storage/'.$siteLogo) }}?v={{ time() }}" alt="Site Logo" class="login-brand-logo">
                    @else
                        <img src="{{ asset('images/balakutak-logo-official.png') }}" alt="Default Logo" class="login-brand-logo">
                    @endif

                    <h2 class="login-brand-title">{{ \App\Models\Setting::get('site_name', 'Your Website Name') }}</h2>
                    <p class="login-brand-sub">{{ \App\Models\Setting::get('site_sub_name', 'Your Website Subname') }}</p>
                </div>
            </div>

            <!-- Right Side - Clean Login Form -->
            <div class="login-form-panel">
                <div class="login-form-inner">
                    <div class="login-header">
                        <h1>Welcome Back</h1>
                        <p>Please sign in to your account</p>
                    </div>

                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="field-group">
                            <label for="email" class="field-label">Email Address</label>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                                class="form-input" placeholder="you@example.com">
                            <x-input-error :messages="$errors->get('email')" class="mt-1" />
                        </div>

                        <div class="field-group">
                            <div class="field-label-row">
                                <label for="password" class="field-label">Password</label>
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="forgot-link">Forgot?</a>
                                @endif
                            </div>
                            <div class="input-wrap">
                                <input id="password" type="password" name="password" required autocomplete="current-password"
                                    class="form-input form-input-pw" placeholder="••••••••">
                                <button type="button" onclick="togglePassword()" class="pw-toggle" aria-label="Toggle password">
                                    <svg id="eye-open" width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    <svg id="eye-closed" width="18" height="18" style="display:none;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18"></path>
                                    </svg>
                                </button>
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-1" />
                        </div>

                        <div class="field-group">
                            <label class="field-label">Human Verification</label>
                            <div class="captcha-row">
                                <div class="captcha-box">
                                    <img src="{{ route('captcha.generate', [], false) }}?v={{ time() }}" id="captcha-img" alt="Captcha">
                                </div>
                                <button type="button" onclick="refreshCaptcha()" title="Muat Ulang Captcha" class="captcha-refresh">
                                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                    </svg>
                                </button>
                            </div>
                            <input id="captcha" type="text" name="captcha" required autocomplete="off"
                                class="form-input" placeholder="Type the code above">
                            <x-input-error :messages="$errors->get('captcha')" class="mt-1" />
                        </div>

                        <button type="submit" class="btn-signin">Sign In</button>
                    </form>
                </div>
            </div>
        </div>

        {{-- Minimal Footer Branding --}}
        <div class="login-footer-brand">
            @php
                $logoWhite = \App\Models\Setting::get('site_logo_white');
                $logoMain = \App\Models\Setting::get('site_logo');
                $siteLogoFooter = (!$logoWhite || $logoWhite == 'images/logo_white.png') ? $logoMain : $logoWhite;
            @endphp
            <img src="{{ $siteLogoFooter ? asset('storage/'.$siteLogoFooter) : asset('images/balakutak-logo-official.png') }}"
                 alt="Logo"
                 style="{{ $siteLogoFooter ? '' : 'filter: grayscale(1) contrast(1.25) brightness(2);' }}">
            <span class="version-pill">V.2.1.0</span>
        </div>
    </div>

    {{-- Unique Protection Logo at Bottom-Left Corner --}}
    <div class="yanto-guard-logo-wrap" title="Aplikasi ini dilengkapi Yanto Sedunia Protection Guard">
        <img src="{{ asset('images/yanto-sedunia-guard.png') }}" alt="Yanto Sedunia Protection Guard">
    </div>

    <script>
        function refreshCaptcha() {
            const img = document.getElementById('captcha-img');
            img.src = "{{ route('captcha.generate', [], false) }}?id=" + Math.random();
        }

        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeOpen = document.getElementById('eye-open');
            const eyeClosed = document.getElementById('eye-closed');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeOpen.style.display = 'none';
                eyeClosed.style.display = 'block';
            } else {
                passwordInput.type = 'password';
                eyeOpen.style.display = 'block';
                eyeClosed.style.display = 'none';
            }
        }
    </script>

</body>
</html>
