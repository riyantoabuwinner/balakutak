@extends('layouts.frontend')

@push('title'){{ \App\Models\Setting::get('site_name') }} - @endpush

@section('content')

    {{-- ANNOUNCEMENT BAR (Moved to top above slider) --}}
    @include('frontend.partials.announcement-bar')

    {{-- HERO SLIDER --}}
    <section class="hero-section">
        @if($sliders->count() > 0)
        <div class="swiper hero-swiper">
            <div class="swiper-wrapper">
                @foreach($sliders as $slider)
                <div class="swiper-slide hero-slide" style="background-image: linear-gradient(rgba(0,0,0,0.55), rgba(0,0,0,0.55)), url('{{ asset('storage/'.$slider->image) }}')">
                    <div class="container h-100 d-flex align-items-center">
                        <div class="hero-content text-white" data-aos="fade-up">
                            <h1 class="hero-title">{{ $slider->title }}</h1>
                            @if($slider->subtitle)
                                <p class="hero-subtitle">{{ $slider->subtitle }}</p>
                            @endif
                            @if($slider->button_text)
                                <a href="{{ $slider->button_url ?? '#' }}" class="btn btn-primary btn-lg rounded-pill px-5 mt-3">
                                    {{ $slider->button_text }} <i class="fas fa-arrow-right ms-2"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
        @else
        {{-- Default hero if no sliders --}}
        <div class="default-hero position-relative overflow-hidden d-flex align-items-center">
            <div class="page-header-pattern"></div>
            <div class="container py-5 position-relative z-1 text-center" data-aos="zoom-out">
                {{-- Hero Logo --}}
                @php $logoWhite = \App\Models\Setting::get('site_logo_white'); @endphp
                @if($logoWhite)
                    <div class="mb-4" data-aos="fade-down">
                        <img src="{{ asset('storage/'.$logoWhite) }}" height="100" alt="Logo" class="hero-logo-premium">
                    </div>
                @endif

                <div class="row justify-content-center">
                    <div class="col-lg-10 col-xl-8">
                        @php $siteAbbr = \App\Models\Setting::get('site_abbreviation', 'PRODI'); @endphp
                        <span class="badge-theme-pill mb-4 d-inline-block px-4 py-2 uppercase tracking-widest" data-aos="fade-down" data-aos-delay="200">{{ $siteAbbr }}</span>
                        
                        <h1 class="hero-title display-3 fw-bold text-white mb-4 notranslate" translate="no" data-aos="fade-up" data-aos-delay="300">
                            {{ \App\Models\Setting::get('site_name', __('menu.home_fallback_title')) }}
                        </h1>
                        
                        <div class="hero-divider-premium mx-auto mb-4" data-aos="stretch-width" data-aos-delay="400"></div>

                        <p class="hero-subtitle lead text-white-50 mb-5 px-lg-5 notranslate" translate="no" data-aos="fade-up" data-aos-delay="500">
                            {{ Str::limit(\App\Models\Setting::get('site_tagline', __('Unggul, Inovatif, dan Berdaya Saing Global')), 250) }}
                        </p>
                        
                        <div class="d-flex flex-wrap justify-content-center gap-3" data-aos="fade-up" data-aos-delay="600">
                            <a href="{{ route('about') }}" class="btn btn-primary btn-lg rounded-pill px-5">
                                {{ __('Selengkapnya') }} <i class="fas fa-arrow-right ms-2"></i>
                            </a>
                            <a href="{{ route('contact.index') }}" class="btn btn-outline-light btn-lg rounded-pill px-5">
                                {{ __('Hubungi Kami') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            {{-- Decorative Blobs for depth --}}
            <div class="hero-blob hero-blob-1"></div>
            <div class="hero-blob hero-blob-2"></div>
            <div class="hero-blob hero-blob-3"></div>

            {{-- Floating Icon Decorations --}}
            <div class="floating-icon icon-1"><i class="fas fa-graduation-cap"></i></div>
            <div class="floating-icon icon-2"><i class="fas fa-microscope"></i></div>
            <div class="floating-icon icon-3"><i class="fas fa-globe"></i></div>
        </div>
        @endif

        {{-- Stats Bar --}}
        <div class="stats-bar">
            <!-- Decorative Elements -->
            <div class="stats-bar-decorative">
                <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                        <pattern id="grid-stats" width="40" height="40" patternUnits="userSpaceOnUse">
                            <path d="M 40 0 L 0 0 0 40" fill="none" stroke="white" stroke-width="1"/>
                        </pattern>
                    </defs>
                    <rect width="100%" height="100%" fill="url(#grid-stats)" />
                </svg>
            </div>
            <div class="stats-bar-blob stats-bar-blob-1"></div>
            <div class="stats-bar-blob stats-bar-blob-2"></div>

            <div class="container">
                {{-- @if(isset($activeInfographic) && $activeInfographic)
                <div class="text-center text-white pb-2 pt-3" data-aos="fade-up">
                    <span class="badge bg-white text-primary rounded-pill px-3 py-2 fw-bold" style="font-size: 0.85rem;"><i class="fas fa-chart-pie me-1"></i> Data Info Grafis Tahun Ajaran {{ $activeInfographic->academic_year }}</span>
                </div>
                @endif --}}
                <div class="row text-white text-center py-4 justify-content-center">
                    @php $cols = count($stats) > 4 ? 3 : (12 / max(count($stats), 1)); @endphp
                    @foreach($stats as $index => $stat)
                        <div class="col-6 col-md-{{ $cols }} stat-item mb-4 mb-md-0" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 100 }}">
                            <div class="stat-number fw-bold">{{ number_format($stat['value'] ?? 0) }}</div>
                            <div class="stat-label">{{ $stat['label'] ?? '-' }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>


    {{-- GREETING + VIDEO --}}
    <section class="section-greeting py-5">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6" data-aos="fade-right">
                    <div class="section-badge text-primary fw-semibold mb-3">
                        <i class="fas fa-graduation-cap me-2"></i>{{ __('menu.leader_greeting') }}
                    </div>
                    <h2 class="section-title fw-bold mb-4">{{ \App\Models\Setting::get('greeting_name', __('menu.leader_fallback_name')) }}</h2>
                    <p class="text-muted lh-lg" style="text-align: justify;">{!! \Illuminate\Support\Str::words(strip_tags(\App\Models\Setting::get('greeting_text', __('menu.leader_fallback_text'))), 100, '...') !!}</p>
                    <a href="{{ route('about') }}" class="btn btn-outline-primary rounded-pill px-4 mt-3">
                        <i class="fas fa-arrow-right me-2"></i>{{ __('menu.read_more') }}
                    </a>
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    @php
                        $rawVideo = \App\Models\Setting::get('profile_video_url', '');
                        // Auto-convert any YouTube URL format to embed
                        $videoUrl = '';
                        if ($rawVideo) {
                            if (preg_match('/(?:youtube\.com\/(?:watch\?v=|shorts\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $rawVideo, $m)) {
                                $videoUrl = 'https://www.youtube.com/embed/' . $m[1];
                            } elseif (str_contains($rawVideo, 'youtube.com/embed/')) {
                                $videoUrl = $rawVideo;
                            }
                        }
                    @endphp
                    @if($videoUrl)
                    <div class="ratio ratio-16x9 rounded-4 overflow-hidden shadow-lg">
                        <iframe src="{{ $videoUrl }}" title="Video Profil Prodi" allowfullscreen frameborder="0"></iframe>
                    </div>
                    @else
                    <div class="bg-primary bg-gradient rounded-4 d-flex align-items-center justify-content-center text-white" style="height:300px">
                        <div class="text-center">
                            <i class="fas fa-play-circle fa-4x mb-3 opacity-75"></i>
                            <p>Video Profil Program Studi</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    {{-- LATEST NEWS --}}
    <section class="section-news py-5">
        <div class="container">
            <div class="row align-items-center mb-5" data-aos="fade-up">
                <div class="col-lg-8">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <div class="header-accent-line bg-theme-accent"></div>
                        <span class="text-uppercase tracking-widest small fw-bold text-muted" style="letter-spacing: 3px;">UPDATE TERKINI</span>
                    </div>
                    <h2 class="display-5 fw-bold text-dark mb-0">Berita & Informasi</h2>
                    <h2 class="display-5 fw-bold text-theme-accent mt-n2">Kampus Terkini</h2>
                    <p class="text-muted mt-3 mb-0">Pantau terus perkembangan terbaru, pengumuman, dan berita seputar lingkungan {{ config('app.name') }}.</p>
                </div>
                <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">
                    <a href="{{ route('posts.index') }}" class="btn btn-white shadow-sm rounded-4 px-4 py-3 d-inline-flex align-items-center gap-3 fw-bold border-0 bg-white">
                        <span>Lihat Semua Berita</span>
                        <div class="btn-icon-box bg-theme-dark text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 24px; height: 24px;">
                            <i class="fas fa-external-link-alt" style="font-size: 10px;"></i>
                        </div>
                    </a>
                </div>
            </div>
            <div class="row g-4">
                @forelse($latestNews as $i => $news)
                @php
                    $colClass = 'col-lg-4';
                    if ($i === 0) $colClass = 'col-lg-8';
                    elseif ($i === 1) $colClass = 'col-lg-4';
                @endphp
                <div class="{{ $colClass }} col-md-6 mb-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="news-immersive-card h-100 rounded-5 overflow-hidden position-relative transition-all duration-700 shadow-lg">
                        <!-- Immersive Image -->
                        <div class="news-bg-image-box h-100 w-100">
                             <img src="{{ $news->featured_image_url }}" alt="{{ $news->title }}" class="img-fluid w-100 h-100 object-fit-cover transition-all duration-700 immersion-img">
                        </div>

                        <!-- Gradient Overlay -->
                        <div class="news-immersion-grad"></div>

                        <!-- Content Overlay -->
                        <div class="news-immersion-content p-4 d-flex flex-column justify-content-end h-100 w-100 position-absolute top-0 start-0">
                                <div class="news-meta-row d-flex align-items-center gap-3 mb-3 text-white small">
                                    @if($news->category)
                                        <a href="{{ route('posts.index', ['category' => $news->category->slug]) }}" class="badge-theme-pill text-uppercase fw-bold text-decoration-none transition-all hover-scale position-relative" style="z-index: 10;">
                                            {{ $news->category->name }}
                                        </a>
                                    @endif
                                    <div class="d-flex align-items-center gap-2 opacity-75">
                                        <i class="far fa-calendar-alt"></i>
                                        <span>{{ $news->published_at?->format('d M Y') }}</span>
                                    </div>
                                </div>
                            
                            <h3 class="news-immersive-title text-white fw-bold {{ ($i === 0) ? 'display-6' : 'h4' }} mb-4">
                                <a href="{{ route('posts.show', $news->slug) }}" class="text-white text-decoration-none stretched-link transition-all">
                                    {{ Str::limit($news->title, ($i === 0) ? 100 : 70) }}
                                </a>
                            </h3>

                            <div class="news-immersive-footer d-flex align-items-center gap-2">
                                <span class="text-white text-uppercase small fw-bold tracking-widest letter-spacing-2">SELENGKAPNYA</span>
                                <div class="news-footer-arrow rounded-circle border border-white border-opacity-50 text-white d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                                    <i class="fas fa-chevron-right small"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center text-muted py-5">
                    <i class="fas fa-newspaper fa-4x mb-3 opacity-25"></i>
                    <p>{{ __('menu.no_news') }}</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- UPCOMING EVENTS --}}
    @if($upcomingEvents->count() > 0)
    <section class="section-events py-5">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4" data-aos="fade-up">
                <div>
                    <div class="section-badge text-primary fw-semibold mb-1"><i class="fas fa-calendar-alt me-2"></i>{{ __('menu.agenda') }}</div>
                    <h2 class="fw-bold mb-0">{{ __('menu.events_and_activities') }}</h2>
                </div>
                <a href="{{ route('events.index') }}" class="btn btn-outline-primary rounded-pill">{{ __('menu.see_all_agenda') }}</a>
            </div>
            <div class="row g-4 justify-content-center">
                @foreach($upcomingEvents as $event)
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 80 }}">
                    <div class="card event-card border-0 shadow-sm rounded-4 overflow-hidden h-100">
                        <div class="event-date-banner bg-primary text-white text-center py-3">
                            <div class="fw-bold" style="font-size:2rem">{{ $event->start_date->format('d') }}</div>
                            <div class="text-uppercase" style="font-size:.8rem">{{ $event->start_date->isoFormat('MMMM YYYY') }}</div>
                        </div>
                        <div class="card-body p-3">
                            <h6 class="fw-bold">
                                <a href="{{ route('events.show', $event->slug) }}" class="text-dark text-decoration-none stretched-link">{{ $event->title }}</a>
                            </h6>
                            @if($event->location)
                                <small class="text-muted"><i class="fas fa-map-marker-alt me-1 text-primary"></i>{{ $event->location }}</small>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif


    {{-- TESTIMONIALS --}}
    @if($testimonials->count() > 0)
    <section class="section-testimonials py-5">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <div class="section-badge text-primary fw-semibold mb-2"><i class="fas fa-quote-left me-2"></i>{{ __('menu.testimonial') }}</div>
                <h2 class="fw-bold">{{ __('menu.alumni_says') }}</h2>
            </div>
            <div class="swiper testimonial-swiper" data-aos="fade-up">
                <div class="swiper-wrapper pb-5 justify-content-center">
                    @foreach($testimonials as $testimonial)
                    <div class="swiper-slide">
                        <div class="card border-0 shadow-sm rounded-4 p-4 mx-2">
                            <div class="d-flex align-items-center gap-3 mb-3">
                                @if($testimonial->photo)
                                    <img src="{{ asset('storage/'.$testimonial->photo) }}" class="rounded-circle" style="width:55px;height:55px;object-fit:cover" alt="{{ $testimonial->name }}">
                                @else
                                    <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center fw-bold" style="width:55px;height:55px;font-size:1.3rem">
                                        {{ strtoupper(substr($testimonial->name, 0, 1)) }}
                                    </div>
                                @endif
                                <div>
                                    <div class="fw-bold">{{ $testimonial->name }}</div>
                                    <small class="text-muted">{{ $testimonial->position }} {{ $testimonial->batch_year ? '· Angkatan '.$testimonial->batch_year : '' }}</small>
                                </div>
                            </div>
                            <p class="text-muted fst-italic mb-3">"{{ $testimonial->content }}"</p>
                            <div class="text-warning">
                                @for($i = 0; $i < $testimonial->rating; $i++)
                                    <i class="fas fa-star"></i>
                                @endfor
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>
    @endif

    {{-- PARTNERS MARQUEE --}}
    @if($partners->count() > 0)
    <section class="section-partners py-5 bg-light" data-aos="fade-up">
        <div class="container">
            <div class="text-center mb-4">
                <div class="section-badge text-primary fw-semibold mb-1 justify-content-center"><i class="fas fa-handshake me-2"></i>Mitra & Kerjasama</div>
                <h5 class="fw-bold text-dark mb-0">Institusi Mitra Kami</h5>
            </div>
        </div>
        @if($partners->count() <= 6)
        {{-- Centered layout for few partners --}}
        <div class="container">
            <div class="d-flex flex-wrap justify-content-center align-items-center gap-4 py-3">
                @foreach($partners as $partner)
                <div class="partners-marquee-item">
                    @if($partner->website_url)
                        <a href="{{ $partner->website_url }}" target="_blank" rel="noopener" title="{{ $partner->name }}">
                    @endif
                    @if($partner->logo)
                        <img src="{{ asset('storage/'.$partner->logo) }}" alt="{{ $partner->name }}" loading="lazy">
                    @else
                        <span class="partner-name-text">{{ $partner->name }}</span>
                    @endif
                    @if($partner->website_url)
                        </a>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
        @else
        {{-- Marquee for many partners --}}
        <div class="partners-marquee-wrapper">
            <div class="partners-marquee-track">
                @foreach($partners as $partner)
                    <div class="partners-marquee-item">
                        @if($partner->website_url)
                            <a href="{{ $partner->website_url }}" target="_blank" rel="noopener" title="{{ $partner->name }}">
                        @endif
                        @if($partner->logo)
                            <img src="{{ asset('storage/'.$partner->logo) }}" alt="{{ $partner->name }}" loading="lazy">
                        @else
                            <span class="partner-name-text">{{ $partner->name }}</span>
                        @endif
                        @if($partner->website_url)
                            </a>
                        @endif
                    </div>
                @endforeach
                {{-- Duplicate for seamless loop --}}
                @foreach($partners as $partner)
                    <div class="partners-marquee-item">
                        @if($partner->website_url)
                            <a href="{{ $partner->website_url }}" target="_blank" rel="noopener" title="{{ $partner->name }}">
                        @endif
                        @if($partner->logo)
                            <img src="{{ asset('storage/'.$partner->logo) }}" alt="{{ $partner->name }}" loading="lazy">
                        @else
                            <span class="partner-name-text">{{ $partner->name }}</span>
                        @endif
                        @if($partner->website_url)
                            </a>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
        @endif
    </section>
    @endif

    {{-- CTA Registration --}}
    <section class="section-cta py-5 text-white">
        <!-- Decorative Elements -->
        <div class="section-cta-decorative">
            <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="grid-cta" width="40" height="40" patternUnits="userSpaceOnUse">
                        <path d="M 40 0 L 0 0 0 40" fill="none" stroke="white" stroke-width="1"/>
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#grid-cta)" />
            </svg>
        </div>
        <div class="section-cta-blob section-cta-blob-1"></div>
        <div class="section-cta-blob section-cta-blob-2"></div>

        <div class="container text-center position-relative z-10" data-aos="zoom-in">
            <h2 class="fw-bold mb-3">{{ __('menu.cta_title') }}</h2>
            <p class="lead mb-4 opacity-75">{{ __('menu.cta_subtitle') }}</p>
            <div class="d-flex gap-3 justify-content-center flex-wrap">
                <a href="{{ route('contact.index') }}" class="btn btn-light btn-lg rounded-pill px-5 text-primary fw-semibold">
                    <i class="fas fa-info-circle me-2"></i>{{ __('menu.registration_info') }}
                </a>
                <a href="{{ route('academic') }}" class="btn btn-outline-light btn-lg rounded-pill px-5">
                    <i class="fas fa-book me-2"></i>{{ __('menu.see_curriculum') }}
                </a>
            </div>
        </div>
    </section>

@endsection

@push('scripts')
<script>
// Hero Swiper
new Swiper('.hero-swiper', {
    loop: true,
    speed: 1000,
    autoplay: {
        delay: 5000,
        disableOnInteraction: false,
        reverseDirection: true,
    },
    pagination: { el: '.hero-swiper .swiper-pagination', clickable: true },
    navigation: { nextEl: '.hero-swiper .swiper-button-next', prevEl: '.hero-swiper .swiper-button-prev' },
    effect: 'fade',
    fadeEffect: { crossFade: true }
});

// Testimonial Swiper
new Swiper('.testimonial-swiper', {
    slidesPerView: 1,
    spaceBetween: 20,
    loop: true,
    autoplay: { delay: 4000 },
    pagination: { el: '.testimonial-swiper .swiper-pagination', clickable: true },
    breakpoints: {
        576: { slidesPerView: 2 },
        992: { slidesPerView: 3 }
    }
});

// Partner Swiper
new Swiper('.partner-swiper', {
    slidesPerView: 3,
    spaceBetween: 30,
    loop: true,
    autoplay: { delay: 2500, disableOnInteraction: false },
    breakpoints: {
        576: { slidesPerView: 4 },
        992: { slidesPerView: 6 }
    }
});
</script>
@endpush
