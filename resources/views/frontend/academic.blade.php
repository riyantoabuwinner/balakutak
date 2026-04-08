@extends('layouts.frontend')

@push('title')
{{ __('Pendidikan') }} -
@endpush

@section('content')
<div class="page-header-premium py-5 text-white position-relative overflow-hidden mb-5">
    <div class="page-header-pattern"></div>
    <div class="container py-4 position-relative z-1">
        <div class="row align-items-center">
            <div class="col-lg-8" data-aos="fade-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-2 text-white-50">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white-50 text-decoration-none">{{ __('Beranda') }}</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">{{ __('Pendidikan') }}</li>
                    </ol>
                </nav>
                <h1 class="display-4 fw-bold mb-0">{{ __('Pendidikan') }}</h1>
            </div>
        </div>
    </div>
    <div class="page-header-logo">
        @php $logo = \App\Models\Setting::get('site_logo') @endphp
        @if($logo)
            <img src="{{ asset('storage/'.$logo) }}" alt="Logo">
        @endif
    </div>
</div>

<section class="py-5 bg-white">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4" data-aos="fade-up">
                <div class="card border-0 shadow-sm rounded-4 h-100 p-4 bg-light">
                    <div class="card-body text-center">
                        <div class="icon-box bg-white text-primary p-3 rounded-circle d-inline-block mb-3 shadow-sm">
                            <i class="fas fa-book-open fa-2x"></i>
                        </div>
                        <h4 class="fw-bold mb-3">{{ __('Kurikulum') }}</h4>
                        <p class="text-secondary mb-4">{{ __('Kurikulum yang disusun berdasarkan standar kompetensi industri dan kebutuhan pasar global.') }}</p>
                        <a href="{{ route('curriculum') }}" class="btn btn-outline-primary rounded-pill px-4">{{ __('Lihat Detail') }}</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                <div class="card border-0 shadow-sm rounded-4 h-100 p-4 bg-light">
                    <div class="card-body text-center">
                        <div class="icon-box bg-white text-primary p-3 rounded-circle d-inline-block mb-3 shadow-sm">
                            <i class="fas fa-calendar-alt fa-2x"></i>
                        </div>
                        <h4 class="fw-bold mb-3">{{ __('Kalender Akademik') }}</h4>
                        <p class="text-secondary mb-4">{{ __('Informasi mengenai jadwal perkuliahan, ujian, dan kegiatan akademik lainnya.') }}</p>
                        <a href="{{ route('calendar') }}" class="btn btn-outline-primary rounded-pill px-4">{{ __('Lihat Detail') }}</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
                <div class="card border-0 shadow-sm rounded-4 h-100 p-4 bg-light">
                    <div class="card-body text-center">
                        <div class="icon-box bg-white text-primary p-3 rounded-circle d-inline-block mb-3 shadow-sm">
                            <i class="fas fa-file-signature fa-2x"></i>
                        </div>
                        <h4 class="fw-bold mb-3">{{ __('Prosedur & Form') }}</h4>
                        <p class="text-secondary mb-4">{{ __('Akses Dokumen dan prosedur pengajuan surat keterangan, skripsi, dan layanan lainnya.') }}</p>
                        <a href="{{ route('academic-services') }}" class="btn btn-outline-primary rounded-pill px-4">{{ __('Lihat Detail') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
    .rotate-n-15 { transform: rotate(-15deg); }
    .transition-hover { transition: all 0.3s ease; }
    .transition-hover:hover { transform: translateY(-5px); box-shadow: 0 0.5rem 1.5rem rgba(0,0,0,0.1) !important; }
</style>
@endpush
