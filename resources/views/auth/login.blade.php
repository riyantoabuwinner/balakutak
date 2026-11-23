<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'BalaKutaK CMS') }} - Login</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Outfit:400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        * { box-sizing: border-box; }
        body, html {
            margin: 0;
            padding: 0;
            min-height: 100%;
            width: 100%;
            overflow-x: hidden;
            font-family: 'Outfit', sans-serif;
        }
        /* Hide Google Translate top bar/arrow */
        .goog-te-banner-frame, #goog-gt-tt, .goog-te-balloon-frame { display: none !important; }
        iframe.skiptranslate { display: none !important; }
        .goog-text-highlight { background: none !important; box-shadow: none !important; }

        body::before {
            content: "";
            position: fixed;
            inset: 0;
            background:
                radial-gradient(circle at 20% 20%, rgba(79, 70, 229, 0.35), transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(16, 185, 129, 0.2), transparent 50%),
                linear-gradient(135deg, rgba(15, 23, 42, 0.72), rgba(30, 27, 75, 0.65)),
                url('{{ asset('images/login-bg-balakutak.jpg') }}?v={{ time() }}') no-repeat center center fixed;
            background-size: cover;
            z-index: -1;
        }

        @keyframes floatGlow {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-4px); }
        }
        .guard-badge {
            animation: floatGlow 4s ease-in-out infinite;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4 sm:p-6 antialiased relative">

    <div class="relative z-20 w-full flex flex-col items-center justify-center py-4" style="max-width: 860px; margin: 0 auto;">
        {{-- Elegant Glass-Bordered Login Card --}}
        <div class="w-full flex flex-col md:flex-row shadow-[0_30px_90px_rgba(15,23,42,0.55)] bg-white/95 backdrop-blur-xl border border-white/30"
             style="border-radius: 36px; overflow: hidden;">

            <!-- Left Side - Premium Branding -->
            <div class="hidden md:flex md:w-[46%] bg-gradient-to-br from-slate-900 via-indigo-900 to-violet-900 text-white flex-col justify-between p-10 relative overflow-hidden">
                <div class="absolute inset-0 opacity-15 pointer-events-none">
                    <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <pattern id="grid" width="36" height="36" patternUnits="userSpaceOnUse">
                                <path d="M 36 0 L 0 0 0 36" fill="none" stroke="white" stroke-width="0.8"/>
                            </pattern>
                        </defs>
                        <rect width="100%" height="100%" fill="url(#grid)" />
                    </svg>
                </div>

                <div class="relative z-10 flex items-center justify-between">
                    <span class="px-3 py-1 rounded-full bg-white/10 border border-white/15 text-[10px] font-bold tracking-[0.2em] uppercase text-indigo-200">
                        Portal Resmi
                    </span>
                    <span class="px-2.5 py-1 rounded-full bg-emerald-500/20 border border-emerald-400/30 text-[10px] font-bold tracking-wider uppercase text-emerald-300">
                        V.2.1.0
                    </span>
                </div>

                <div class="relative z-10 flex flex-col justify-center items-center text-center my-6">
                    <div class="mb-6 p-4 rounded-3xl bg-white/10 border border-white/15 shadow-2xl backdrop-blur-md">
                        @php $siteLogo = \App\Models\Setting::get('site_logo') @endphp
                        @if($siteLogo)
                            <img src="{{ asset('storage/'.$siteLogo) }}?v={{ time() }}" alt="Site Logo" style="height: 82px !important; width: auto; filter: brightness(0) invert(1);" class="drop-shadow-xl">
                        @else
                            <img src="{{ asset('images/balakutak-logo-official.png') }}" alt="Default Logo" style="height: 82px !important; width: auto; filter: brightness(0) invert(1);" class="drop-shadow-xl">
                        @endif
                    </div>

                    <h2 class="text-xl font-bold mb-2 leading-snug drop-shadow-lg tracking-tight text-white">
                        {{ \App\Models\Setting::get('site_name', 'Your Website Name') }}
                    </h2>
                    <p class="text-indigo-200/80 text-[10px] font-semibold leading-relaxed max-w-[220px] uppercase tracking-[0.22em]">
                        {{ \App\Models\Setting::get('site_sub_name', 'Your Website Subname') }}
                    </p>
                </div>

                <div class="relative z-10 text-center border-t border-white/10 pt-4">
                    <p class="text-[11px] text-indigo-200/70 font-medium">
                        Sistem Manajemen Konten Terpadu &amp; Terproteksi
                    </p>
                </div>

                {{-- Decorative Glows --}}
                <div class="absolute -bottom-24 -left-20 w-72 h-72 bg-indigo-500/25 rounded-full blur-[90px] pointer-events-none"></div>
                <div class="absolute -top-20 -right-20 w-64 h-64 bg-emerald-500/15 rounded-full blur-[80px] pointer-events-none"></div>
            </div>

            <!-- Right Side - Login Form -->
            <div class="w-full md:w-[54%] flex items-center justify-center p-7 sm:p-10 bg-white relative">
                <div class="w-full max-w-sm">
                    <div class="text-center mb-6">
                        <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-indigo-50 border border-indigo-100 text-indigo-600 text-[10px] font-bold uppercase tracking-widest mb-3">
                            <span class="w-1.5 h-1.5 rounded-full bg-indigo-500"></span>
                            Secure Admin Access
                        </div>
                        <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight mb-1">Welcome Back</h1>
                        <p class="text-slate-400 text-xs sm:text-sm">Silakan masuk menggunakan akun resmi Anda</p>
                    </div>

                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <form method="POST" action="{{ route('login') }}" class="space-y-4">
                        @csrf

                        <!-- Email Address -->
                        <div>
                            <label for="email" class="block text-[10px] font-bold text-slate-500 uppercase tracking-[0.18em] mb-1.5 ml-1">Email Address</label>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                                class="block w-full px-4 py-2.5 bg-slate-50/80 border border-slate-200 rounded-xl text-slate-800 text-sm focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all duration-200 outline-none"
                                placeholder="nama@institusi.ac.id">
                            <x-input-error :messages="$errors->get('email')" class="mt-1" />
                        </div>

                        <!-- Password -->
                        <div>
                            <div class="flex items-center justify-between mb-1.5 ml-1">
                                <label for="password" class="block text-[10px] font-bold text-slate-500 uppercase tracking-[0.18em]">Password</label>
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="text-[10px] font-bold text-indigo-600 hover:text-indigo-700 uppercase tracking-wider transition-colors">Forgot?</a>
                                @endif
                            </div>
                            <div class="relative">
                                <input id="password" type="password" name="password" required autocomplete="current-password"
                                    class="block w-full px-4 py-2.5 bg-slate-50/80 border border-slate-200 rounded-xl text-slate-800 text-sm focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all duration-200 outline-none pr-11"
                                    placeholder="••••••••">
                                <div class="absolute inset-y-0 right-0 pr-3.5 flex items-center">
                                    <button type="button" onclick="togglePassword()" class="text-slate-400 hover:text-indigo-600 transition-colors focus:outline-none">
                                        <svg id="eye-open" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        <svg id="eye-closed" class="h-5 w-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-1" />
                        </div>

                        <!-- Image Captcha Block -->
                        <div class="space-y-2 pt-1">
                            <label class="block text-[10px] font-bold text-slate-500 uppercase tracking-[0.18em] ml-1">Human Verification</label>
                            <div class="flex items-center gap-2">
                                <div class="flex-1 h-14 bg-slate-50 rounded-xl border border-slate-200 overflow-hidden flex items-center justify-center p-0.5 relative shadow-inner">
                                    <img src="{{ route('captcha.generate', [], false) }}?v={{ time() }}" id="captcha-img" class="h-full w-full object-cover rounded-lg" alt="Captcha">
                                </div>
                                <button type="button" onclick="refreshCaptcha()" title="Muat Ulang Captcha" class="h-11 w-11 flex items-center justify-center bg-indigo-50 border border-indigo-200 rounded-xl text-indigo-600 hover:text-white hover:bg-indigo-600 transition-all shadow-sm active:scale-95">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                    </svg>
                                </button>
                            </div>
                            <input id="captcha" type="text" name="captcha" required autocomplete="off"
                                class="block w-full px-4 py-2.5 bg-slate-50/80 border border-slate-200 rounded-xl text-slate-800 text-sm tracking-widest font-semibold focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all duration-200 outline-none"
                                placeholder="Ketik kode captcha di atas">
                            <x-input-error :messages="$errors->get('captcha')" class="mt-1" />
                        </div>

                        <!-- Login Button -->
                        <button type="submit" class="w-full relative overflow-hidden group py-3.5 px-6 bg-gradient-to-r from-indigo-600 via-indigo-600 to-violet-600 hover:from-indigo-700 hover:to-violet-700 text-white rounded-xl font-bold text-sm shadow-lg shadow-indigo-600/30 hover:shadow-indigo-600/40 hover:-translate-y-0.5 active:translate-y-0 transition-all duration-200">
                            <span class="relative z-10 tracking-[0.2em] uppercase">Sign In</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        {{-- Compact Exterior Branding Below Card --}}
        <div class="mt-5 flex flex-row items-center justify-center gap-3 opacity-80 hover:opacity-100 transition-opacity duration-300">
            @php
                $logoWhite = \App\Models\Setting::get('site_logo_white');
                $logoMain = \App\Models\Setting::get('site_logo');
                $siteLogoFooter = (!$logoWhite || $logoWhite == 'images/logo_white.png') ? $logoMain : $logoWhite;
            @endphp
            <img src="{{ $siteLogoFooter ? asset('storage/'.$siteLogoFooter) : asset('images/balakutak-logo-official.png') }}"
                 alt="Logo"
                 style="height: 36px !important; width: auto;"
                 class="{{ $siteLogoFooter ? '' : 'grayscale contrast-125 brightness-200' }}">
            <div class="px-3 py-1 bg-slate-900/60 backdrop-blur-md text-indigo-200 rounded-full text-[10px] font-bold tracking-[0.22em] uppercase border border-white/15 whitespace-nowrap shadow">
                BalaKutaK CMS &bull; V.2.1.0
            </div>
        </div>
    </div>

    {{-- Unique Protection Badge at Bottom-Left Corner --}}
    <div class="guard-badge fixed bottom-4 left-4 z-30 flex items-center gap-2.5 px-4 py-2.5 rounded-2xl bg-slate-950/85 backdrop-blur-xl border border-emerald-400/40 shadow-[0_10px_30px_rgba(16,185,129,0.25)] text-white select-none">
        <div class="relative flex items-center justify-center w-8 h-8 rounded-xl bg-gradient-to-br from-emerald-400 to-cyan-500 text-slate-950 shadow-md shrink-0">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.4" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3l7 4v5c0 5-3.5 8.5-7 9.5-3.5-1-7-4.5-7-9.5V7l7-4z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" d="M9.5 12.5l1.75 1.75L15 10.5"></path>
            </svg>
            <span class="absolute -top-1 -right-1 flex h-2.5 w-2.5">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-300 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-emerald-400 border border-slate-950"></span>
            </span>
        </div>
        <div class="leading-tight">
            <div class="text-[9px] uppercase tracking-[0.18em] text-emerald-300 font-bold">Active Security Shield</div>
            <div class="text-[11px] font-semibold text-slate-100">
                Aplikasi ini dilengkapi <span class="text-emerald-300 font-extrabold">"Yanto Sedunia Protection Guard"</span>
            </div>
        </div>
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
                eyeOpen.classList.add('hidden');
                eyeClosed.classList.remove('hidden');
            } else {
                passwordInput.type = 'password';
                eyeOpen.classList.remove('hidden');
                eyeClosed.classList.add('hidden');
            }
        }
    </script>

</body>
</html>
