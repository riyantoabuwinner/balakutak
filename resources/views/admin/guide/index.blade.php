@extends('adminlte::page')

@section('title', 'Dokumentasi & Panduan Sistem BalaKutaK CMS')

@section('content_header')
    <div class="d-flex flex-wrap justify-content-between align-items-center bg-white p-3 rounded shadow-sm border-left-navy">
        <div>
            <h1 class="m-0 font-weight-bold text-dark" style="font-size: 1.5rem;">
                <i class="fas fa-book-open mr-2 text-primary"></i>Pusat Dokumentasi & Panduan Resmi BalaKutaK CMS
            </h1>
            <small class="text-muted">Spesifikasi Arsitektur, Proses Bisnis, Regulasi, Keunggulan & Panduan Operasional Step-by-Step Semua Role User</small>
        </div>
        <div class="mt-2 mt-md-0">
            <a href="{{ route('admin.guide.pdf') }}" class="btn btn-danger btn-sm shadow-sm mr-2 px-3 py-2 font-weight-bold">
                <i class="fas fa-file-pdf mr-1"></i> Download PDF Lengkap
            </a>
            <button onclick="window.print()" class="btn btn-outline-primary btn-sm shadow-sm px-3 py-2 font-weight-bold">
                <i class="fas fa-print mr-1"></i> Cetak Panduan
            </button>
        </div>
    </div>
@stop

@section('content')
<div class="row">
    <!-- Left Sidebar Navigation -->
    <div class="col-lg-3 col-md-4">
        <div class="card card-primary card-outline sticky-top shadow-sm" style="top: 20px; z-index: 1000; border-radius: 10px; overflow: hidden;">
            <div class="card-header bg-navy text-white py-3">
                <h3 class="card-title font-weight-bold mb-0"><i class="fas fa-compass mr-2 text-warning"></i>Menu Dokumentasi</h3>
            </div>
            <div class="card-body p-0">
                <ul class="nav nav-pills flex-column guide-nav" id="guideTab" role="tablist">
                    <li class="nav-item">
                        <a href="#tab-deskripsi" class="nav-link active" data-toggle="tab" role="tab">
                            <i class="fas fa-info-circle mr-2 text-primary"></i> 1. Deskripsi Aplikasi
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#tab-arsitektur" class="nav-link" data-toggle="tab" role="tab">
                            <i class="fas fa-sitemap mr-2 text-indigo"></i> 2. Arsitektur & Teknologi
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#tab-bisnis" class="nav-link" data-toggle="tab" role="tab">
                            <i class="fas fa-project-diagram mr-2 text-success"></i> 3. Proses Bisnis
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#tab-regulasi" class="nav-link" data-toggle="tab" role="tab">
                            <i class="fas fa-balance-scale mr-2 text-danger"></i> 4. Regulasi & Hak Akses
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#tab-keunggulan" class="nav-link" data-toggle="tab" role="tab">
                            <i class="fas fa-trophy mr-2 text-warning"></i> 5. Keunggulan Aplikasi
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#tab-panduan-role" class="nav-link" data-toggle="tab" role="tab">
                            <i class="fas fa-users-cog mr-2 text-info"></i> 6. Panduan Per Role (Step-by-Step)
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#tab-screenshots" class="nav-link" data-toggle="tab" role="tab">
                            <i class="fas fa-camera-retro mr-2 text-maroon"></i> 7. Galeri Screenshot Lengkap
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-footer bg-light p-3 text-center">
                <p class="text-xs text-muted mb-2">Butuh salinan offline buku manual untuk dibagikan ke tim?</p>
                <a href="{{ route('admin.guide.pdf') }}" class="btn btn-danger btn-block btn-sm font-weight-bold shadow-sm">
                    <i class="fas fa-download mr-1"></i> Unduh Buku Manual (PDF)
                </a>
            </div>
        </div>
    </div>

    <!-- Right Content Area -->
    <div class="col-lg-9 col-md-8">
        <div class="tab-content" id="guideTabContent">

            <!-- =========================================================
                 TAB 1: DESKRIPSI APLIKASI
                 ========================================================= -->
            <div class="tab-pane fade show active" id="tab-deskripsi" role="tabpanel">
                <div class="card shadow-sm border-0 rounded-lg overflow-hidden">
                    <div class="guide-hero p-5 text-white text-center">
                        <img src="{{ asset('images/logo.png') }}" alt="BalaKutaK Logo" class="mb-3 bg-white p-2 rounded-circle shadow" style="height: 85px; width: 85px; object-fit: contain;">
                        <h2 class="font-weight-bold mb-1">BalaKutaK CMS</h2>
                        <p class="mb-3 text-warning font-weight-bold letter-spacing-1">ENTERPRISE & ACADEMIC CONTENT MANAGEMENT SYSTEM</p>
                        <div class="mb-3">
                            <span class="badge badge-light px-3 py-1 mr-1"><i class="fas fa-code-branch mr-1 text-primary"></i>Versi 2.1.0 Stable</span>
                            <span class="badge badge-warning px-3 py-1 mr-1"><i class="fab fa-laravel mr-1"></i>Laravel 11.x</span>
                            <span class="badge badge-success px-3 py-1"><i class="fas fa-check-circle mr-1"></i>Open-Source MIT</span>
                        </div>
                        <p class="lead mx-auto mb-0 text-light" style="max-width: 780px; font-size: 1rem;">
                            Platform manajemen konten open-source generasi baru yang dirancang khusus untuk menyederhanakan pembuatan, kustomisasi visual, dan tata kelola portal web institusional dengan filosofi <strong>"Ringan, Cerdas & Adaptif"</strong>.
                        </p>
                    </div>

                    <div class="card-body p-4">
                        <div class="callout callout-info bg-light border-left-primary mb-4">
                            <h5 class="font-weight-bold text-primary"><i class="fas fa-water mr-2"></i>Filosofi Nama "BalaKutaK"</h5>
                            <p class="mb-0 text-secondary">
                                <strong>BalaKutaK</strong> (Sotong/Cumi-cumi dalam bahasa Sunda) dipilih sebagai simbol <strong>fleksibilitas, kecerdasan navigasi, dan kemampuan beradaptasi tinggi</strong> di berbagai ekosistem digital—sebagaimana sotong yang dapat mengubah warna dan bentuk tubuhnya secara instan mengikuti lingkungan. Hal ini diwujudkan melalui fitur <em>Dynamic Multi-Theme Engine</em> dan arsitektur modular yang lincah namun kokoh.
                            </p>
                        </div>

                        <h4 class="font-weight-bold text-dark mb-3"><i class="fas fa-bullseye mr-2 text-primary"></i>Target Sektor & Penggunaan Multi-Purpose</h4>
                        <div class="row mb-4">
                            <div class="col-md-6 mb-3">
                                <div class="p-3 border rounded bg-white h-100 shadow-xs">
                                    <h6 class="font-weight-bold text-primary"><i class="fas fa-university mr-2"></i>Perguruan Tinggi & Program Studi</h6>
                                    <p class="text-sm text-muted mb-0">Mengelola profil prodi, direktori dosen ber-NIDN, struktur kurikulum per semester, repositori riset & pengabdian masyarakat, kalender akademik, layanan mahasiswa, hingga sertifikat akreditasi interaktif.</p>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="p-3 border rounded bg-white h-100 shadow-xs">
                                    <h6 class="font-weight-bold text-success"><i class="fas fa-school mr-2"></i>Sekolah & Lembaga Pendidikan</h6>
                                    <p class="text-sm text-muted mb-0">Mempermudah pengelolaan profil sekolah, pengumuman kelulusan/PPDB, portal berita siswa, agenda kegiatan akademik, dan galeri dokumentasi.</p>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="p-3 border rounded bg-white h-100 shadow-xs">
                                    <h6 class="font-weight-bold text-warning"><i class="fas fa-landmark mr-2"></i>Instansi Pemerintahan, Organisasi & LSM</h6>
                                    <p class="text-sm text-muted mb-0">Platform ideal untuk publikasi laporan kegiatan, transparansi dokumen regulasi publik, sosialisasi program, dan layanan kontak masyarakat.</p>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="p-3 border rounded bg-white h-100 shadow-xs">
                                    <h6 class="font-weight-bold text-info"><i class="fas fa-building mr-2"></i>Perusahaan & Komunitas Digital</h6>
                                    <p class="text-sm text-muted mb-0">Membangun <em>company profile</em> berkelas dengan <em>Page Builder</em>, manajemen mitra kerjasama, sponsor, testimoni klien/alumni, dan blog dwibahasa.</p>
                                </div>
                            </div>
                        </div>

                        <h4 class="font-weight-bold text-dark mb-3"><i class="fas fa-cubes mr-2 text-primary"></i>Ruang Lingkup 6 Domain Ekosistem</h4>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover text-sm">
                                <thead class="bg-navy text-white">
                                    <tr>
                                        <th style="width: 28%;">Domain Ekosistem</th>
                                        <th>Cakupan Modul & Kapabilitas Utama</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="font-weight-bold"><i class="fas fa-palette text-primary mr-2"></i>Immersive UI & Theme Engine</td>
                                        <td>20+ Palet Tema Warna Premium (<em>Aurora Glass, Oxford Luxury, Stanford Grow, NavyBlue, GreenGold</em>, dll), <em>Smart Dark Mode</em>, animasi AOS, dan efek Glassmorphism.</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold"><i class="fas fa-newspaper text-info mr-2"></i>Editorial & Publikasi</td>
                                        <td>Berita & Artikel Bilingual (ID/EN), Kategori, Tag, Pengumuman Prioritas, Agenda & Event (Countdown & Link Pendaftaran), Halaman Statis, dan FAQs.</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold"><i class="fas fa-graduation-cap text-success mr-2"></i>Academic & Tridharma Suite</td>
                                        <td>Direktori Dosen/SDM, Kurikulum Semester, Kalender Akademik, Layanan Akademik, Penelitian & Pengabdian (seluruhnya mendukung <em>Export/Import Excel</em>), serta Pusat Dokumen & Sertifikat Akreditasi.</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold"><i class="fas fa-tools text-warning mr-2"></i>Visual Site & Page Builder</td>
                                        <td><em>Drag-and-Drop Menu Builder</em> (Header/Footer bertingkat), <em>Visual Page Builder</em> tanpa coding, <em>Media Library</em> terpusat, Galeri Album, Slider, Infografis, Mitra, dan Sponsor.</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold"><i class="fas fa-robot text-purple mr-2"></i>Smart Chatbot & Aksesibilitas</td>
                                        <td>Widget <em>Smart Chatbot</em> interaktif dan <em>Accessibility Toolbar</em> ramah disabilitas (<em>Text-to-Speech</em> Bahasa Indonesia, Kontras Tinggi, Grayscale, Perbesar Huruf) yang adaptif dengan warna tema.</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold"><i class="fas fa-shield-alt text-danger mr-2"></i>System Security &amp; YantoSedunia Protection Guard</td>
                                        <td><strong>YantoSedunia Protection Guard</strong> (Intelligent WAF SQLi/XSS/LFI/RCE, IP Reputation &amp; Auto-Ban, Brute Force Protection, Real-Time Threat Monitoring, Security Audit &amp; Cleanup), Spatie RBAC, <em>User Impersonation</em>, Backup (<code>.zip</code>), SEO &amp; Audit Log.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- =========================================================
                 TAB 2: ARSITEKTUR & TEKNOLOGI
                 ========================================================= -->
            <div class="tab-pane fade" id="tab-arsitektur" role="tabpanel">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-navy text-white py-3">
                        <h4 class="mb-0 font-weight-bold"><i class="fas fa-sitemap mr-2 text-warning"></i>2. Arsitektur Aplikasi & Stack Teknologi</h4>
                    </div>
                    <div class="card-body p-4">
                        <p class="text-secondary">
                            Secara teknis, <strong>BalaKutaK CMS</strong> menerapkan pola arsitektur <strong>Multi-Tier Layered MVC (Model-View-Controller)</strong> di atas fondasi <strong>Laravel 11.x (PHP 8.2+)</strong>. Pemisahan tanggung jawab antar lapisan memastikan aplikasi tetap ringan, aman dari serangan siber, serta mudah dikembangkan.
                        </p>

                        <!-- Visual Layered Architecture Diagram -->
                        <div class="p-4 bg-light rounded border mb-4">
                            <h5 class="text-center font-weight-bold text-dark mb-4"><i class="fas fa-layer-group mr-2 text-primary"></i>Diagram Arsitektur Berlapis BalaKutaK CMS</h5>
                            
                            <div class="arch-layer bg-white border-left-primary p-3 rounded shadow-xs mb-3">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <span class="font-weight-bold text-primary"><i class="fas fa-desktop mr-2"></i>LAYER 1: PRESENTATION & CLIENT LAYER (FRONTEND & ADMIN UI)</span>
                                    <span class="badge badge-primary">User Interface</span>
                                </div>
                                <p class="text-xs text-muted mb-2">Menangani interaksi visual pengunjung publik dan administrator melalui antarmuka responsif dan widget interaktif.</p>
                                <div>
                                    <span class="badge badge-light border mr-1">Blade Templating</span>
                                    <span class="badge badge-light border mr-1">Tailwind CSS 3</span>
                                    <span class="badge badge-light border mr-1">Bootstrap 5</span>
                                    <span class="badge badge-light border mr-1">AdminLTE 3.15</span>
                                    <span class="badge badge-light border mr-1">Alpine.js</span>
                                    <span class="badge badge-light border mr-1">Dynamic CSS Theme Engine</span>
                                    <span class="badge badge-light border mr-1">Smart Chatbot & Accessibility Widget</span>
                                </div>
                            </div>

                            <div class="text-center my-1 text-muted"><i class="fas fa-arrow-down"></i></div>

                            <div class="arch-layer bg-white border-left-warning p-3 rounded shadow-xs mb-3">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <span class="font-weight-bold text-warning"><i class="fas fa-shield-virus mr-2"></i>LAYER 2: ROUTING, LOCALIZATION & SECURITY MIDDLEWARE LAYER</span>
                                    <span class="badge badge-warning">Security & Guard</span>
                                </div>
                                <p class="text-xs text-muted mb-2">Menyaring setiap HTTP Request, mengatur lokalisasi bahasa (ID/EN), autentikasi sesi, dan otorisasi izin berbasis role (RBAC).</p>
                                <div>
                                    <span class="badge badge-light border mr-1">LaravelLocalization (ID/EN)</span>
                                    <span class="badge badge-light border mr-1">AdminLocale Middleware</span>
                                    <span class="badge badge-light border mr-1">Spatie Role & Permission Guard</span>
                                    <span class="badge badge-light border mr-1">CSRF Token Verification</span>
                                    <span class="badge badge-light border mr-1">XSS Sanitization & Captcha Guard</span>
                                </div>
                            </div>

                            <div class="text-center my-1 text-muted"><i class="fas fa-arrow-down"></i></div>

                            <div class="arch-layer bg-white border-left-success p-3 rounded shadow-xs mb-3">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <span class="font-weight-bold text-success"><i class="fas fa-cogs mr-2"></i>LAYER 3: APPLICATION & BUSINESS LOGIC LAYER (CONTROLLERS & SERVICES)</span>
                                    <span class="badge badge-success">Core Engine</span>
                                </div>
                                <p class="text-xs text-muted mb-2">Memproses logika bisnis publikasi, akademik, konversi data Excel, manipulasi gambar, pencetakan PDF, dan simulasi user.</p>
                                <div>
                                    <span class="badge badge-light border mr-1">25+ Admin Controllers</span>
                                    <span class="badge badge-light border mr-1">Frontend Controllers</span>
                                    <span class="badge badge-light border mr-1">Maatwebsite Excel Import/Export</span>
                                    <span class="badge badge-light border mr-1">Barryvdh DomPDF</span>
                                    <span class="badge badge-light border mr-1">Intervention Image 3</span>
                                    <span class="badge badge-light border mr-1">Lab404 Impersonate</span>
                                    <span class="badge badge-light border mr-1">Spatie Sitemap Generator</span>
                                </div>
                            </div>

                            <div class="text-center my-1 text-muted"><i class="fas fa-arrow-down"></i></div>

                            <div class="arch-layer bg-white border-left-danger p-3 rounded shadow-xs">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <span class="font-weight-bold text-danger"><i class="fas fa-database mr-2"></i>LAYER 4: DATA ACCESS, PERSISTENCE & STORAGE LAYER</span>
                                    <span class="badge badge-danger">Database & Storage</span>
                                </div>
                                <p class="text-xs text-muted mb-2">Menyimpan data relasional secara aman, mencatat log aktivitas, mengelola file media, serta memproduksi arsip backup sistem.</p>
                                <div>
                                    <span class="badge badge-light border mr-1">Eloquent ORM</span>
                                    <span class="badge badge-light border mr-1">MySQL / MariaDB</span>
                                    <span class="badge badge-light border mr-1">Spatie Activitylog</span>
                                    <span class="badge badge-light border mr-1">Spatie Laravel Backup (.zip)</span>
                                    <span class="badge badge-light border mr-1">Public & Local Storage Disk</span>
                                </div>
                            </div>
                        </div>

                        <h5 class="font-weight-bold text-dark mb-3"><i class="fas fa-microchip mr-2 text-primary"></i>Spesifikasi Stack Teknologi Lengkap</h5>
                        <div class="table-responsive">
                            <table class="table table-sm table-striped table-bordered">
                                <thead class="bg-light">
                                    <tr>
                                        <th>Komponen</th>
                                        <th>Teknologi / Library</th>
                                        <th>Fungsi dalam Ekosistem BalaKutaK CMS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><strong>Backend Framework</strong></td>
                                        <td><code>laravel/framework ^11.0</code> (PHP 8.2+)</td>
                                        <td>Fondasi inti sistem, routing, ORM, autentikasi, dan manajemen keamanan.</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Role & Permission</strong></td>
                                        <td><code>spatie/laravel-permission 6.24</code></td>
                                        <td>Otorisasi multi-role (Super Admin, Admin Prodi, Editor, Dosen, Operator).</td>
                                    </tr>
                                    <tr>
                                        <td><strong>User Impersonation</strong></td>
                                        <td><code>lab404/laravel-impersonate ^1.7</code></td>
                                        <td>Fitur masuk ke akun pengguna lain dalam 1 klik untuk <em>troubleshooting</em>.</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Localization (ID/EN)</strong></td>
                                        <td><code>mcamara/laravel-localization ^2.3</code></td>
                                        <td>Perpindahan bahasa antarmuka & konten secara mulus (Indonesia & Inggris).</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Excel Processing</strong></td>
                                        <td><code>maatwebsite/excel ^3.1</code></td>
                                        <td>Fitur Export/Import Excel (<code>.xlsx</code>) pada modul Dosen, Kurikulum, Riset, & Post.</td>
                                    </tr>
                                    <tr>
                                        <td><strong>PDF & Image Engine</strong></td>
                                        <td><code>barryvdh/laravel-dompdf ^3.1</code> & <code>intervention/image ^3.11</code></td>
                                        <td>Generasi dokumen PDF dinamis dan optimasi gambar unggahan.</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Backup & Audit</strong></td>
                                        <td><code>spatie/laravel-backup ^9.3</code> & <code>spatie/laravel-activitylog ^4.11</code></td>
                                        <td>Pencadangan sistem ke <code>.zip</code> otomatis dan pencatatan riwayat perubahan data.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- =========================================================
                 TAB 3: PROSES BISNIS
                 ========================================================= -->
            <div class="tab-pane fade" id="tab-bisnis" role="tabpanel">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-navy text-white py-3">
                        <h4 class="mb-0 font-weight-bold"><i class="fas fa-project-diagram mr-2 text-warning"></i>3. Proses Bisnis Aplikasi (Business Workflows)</h4>
                    </div>
                    <div class="card-body p-4">
                        <p class="text-secondary">
                            Proses bisnis dalam <strong>BalaKutaK CMS</strong> dirancang untuk mengintegrasikan alur kerja antara tim redaksi, dosen, staf akademik, pimpinan prodi, hingga pengunjung publik secara terstruktur dan efisien:
                        </p>

                        <div class="timeline mt-4">
                            <!-- Workflow 1 -->
                            <div class="time-label">
                                <span class="bg-primary px-3 py-1">ALUR 1: PUBLIKASI & EDITORIAL KONTEN</span>
                            </div>
                            <div>
                                <i class="fas fa-pen-nib bg-primary"></i>
                                <div class="timeline-item shadow-xs border">
                                    <h3 class="timeline-header font-weight-bold text-primary">1. Penulisan Draft & Kurasi Redaksi</h3>
                                    <div class="timeline-body text-sm">
                                        <ol class="mb-0 pl-3">
                                            <li><strong>Inisiasi Konten:</strong> <em>Dosen</em> atau <em>Editor Konten</em> membuat artikel baru di modul <strong>Berita & Artikel</strong> dalam dua bahasa (ID & EN), memilih kategori/tag, dan mengunggah gambar melalui <em>Media Library</em>.</li>
                                            <li><strong>Review & Optimasi SEO:</strong> <em>Editor Konten</em> atau <em>Admin Prodi</em> meninjau draft, melengkapi <em>Meta Title & Description</em>, lalu mengubah status menjadi <strong>Published</strong>.</li>
                                            <li><strong>Distribusi Otomatis:</strong> Konten tayang secara <em>real-time</em> di Beranda dan Portal Berita, sekaligus memperbarui <code>/sitemap.xml</code> untuk indeksasi Google.</li>
                                        </ol>
                                    </div>
                                </div>
                            </div>

                            <!-- Workflow 2 -->
                            <div class="time-label">
                                <span class="bg-success px-3 py-1">ALUR 2: PENGELOLAAN AKADEMIK, TRIDHARMA & BULK EXCEL</span>
                            </div>
                            <div>
                                <i class="fas fa-graduation-cap bg-success"></i>
                                <div class="timeline-item shadow-xs border">
                                    <h3 class="timeline-header font-weight-bold text-success">2. Administrasi Data Akademik & Akselerasi Excel</h3>
                                    <div class="timeline-body text-sm">
                                        <ol class="mb-0 pl-3">
                                            <li><strong>Pengelolaan Master Akademik:</strong> <em>Admin Prodi</em> mengelola data Dosen/SDM serta Penelitian & Pengabdian, sementara <em>Operator Akademik</em> mengelola struktur Kurikulum Semester, Kalender Akademik, dan Layanan Akademik.</li>
                                            <li><strong>Siklus Bulk Import/Export Excel:</strong> Pengguna mengunduh <em>Template Excel Resmi</em> &rarr; mengisi ratusan baris data di Excel &rarr; mengunggah kembali lewat fitur <strong>Import Excel</strong> (sistem otomatis memperbarui data lama atau menambah data baru).</li>
                                            <li><strong>Publikasi Dokumen & Akreditasi:</strong> Dokumen resmi (SK, SOP, Panduan) dan Sertifikat Akreditasi diunggah ke sistem agar dapat dilihat langsung (<em>live preview</em>) atau diunduh oleh mahasiswa dan asesor.</li>
                                        </ol>
                                    </div>
                                </div>
                            </div>

                            <!-- Workflow 3 -->
                            <div class="time-label">
                                <span class="bg-info px-3 py-1">ALUR 3: INTERAKSI PUBLIK, CHATBOT & LAYANAN KONTAK</span>
                            </div>
                            <div>
                                <i class="fas fa-comments bg-info"></i>
                                <div class="timeline-item shadow-xs border">
                                    <h3 class="timeline-header font-weight-bold text-info">3. Engagement Pengunjung & Disposisi Pesan</h3>
                                    <div class="timeline-body text-sm">
                                        <ol class="mb-0 pl-3">
                                            <li><strong>Akses Inklusif:</strong> Pengunjung membuka website, memilih bahasa (ID/EN), mode gelap, atau mengaktifkan fitur <em>Accessibility</em> (Text-to-Speech, Kontras Tinggi, Perbesar Huruf).</li>
                                            <li><strong>Asistensi 24/7:</strong> Pengunjung berinteraksi dengan <strong>Smart Chatbot</strong> untuk memperoleh informasi cepat terkait profil, dosen, kurikulum, dan layanan.</li>
                                            <li><strong>Pendaftaran Event & Pesan Kontak:</strong> Pengunjung mendaftar acara melalui tombol registrasi pada modul <strong>Agenda & Event</strong>, atau mengirim pesan lewat <strong>Formulir Kontak</strong> (berproteksi Captcha) yang kemudian ditindaklanjuti dan dibalas oleh <em>Admin Prodi</em> melalui menu <strong>Pesan Kontak</strong>.</li>
                                        </ol>
                                    </div>
                                </div>
                            </div>

                            <!-- Workflow 4 -->
                            <div class="time-label">
                                <span class="bg-danger px-3 py-1">ALUR 4: TATA KELOLA SISTEM & DISASTER RECOVERY</span>
                            </div>
                            <div>
                                <i class="fas fa-shield-alt bg-danger"></i>
                                <div class="timeline-item shadow-xs border">
                                    <h3 class="timeline-header font-weight-bold text-danger">4. Kustomisasi Sistem, Audit Log & Pencadangan</h3>
                                    <div class="timeline-body text-sm">
                                        <ol class="mb-0 pl-3">
                                            <li><strong>Kustomisasi Tanpa Koding:</strong> <em>Super Admin</em> / <em>Admin Prodi</em> mengatur identitas situs, mengganti palet warna di <strong>Dynamic Theme Engine</strong>, serta menyusun navigasi di <strong>Menu Builder</strong> dan halaman di <strong>Page Builder</strong>.</li>
                                            <li><strong>Audit & Pencadangan Berkala:</strong> Seluruh aktivitas pengguna terekam di <strong>Log Aktivitas</strong>. <em>Super Admin</em> menjadwalkan <strong>Automated Backup</strong> atau membuat backup manual (<code>.zip</code>) secara berkala.</li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <i class="fas fa-check bg-secondary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- =========================================================
                 TAB 4: REGULASI & HAK AKSES
                 ========================================================= -->
            <div class="tab-pane fade" id="tab-regulasi" role="tabpanel">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-navy text-white py-3">
                        <h4 class="mb-0 font-weight-bold"><i class="fas fa-balance-scale mr-2 text-warning"></i>4. Regulasi, Kebijakan & Standar Aplikasi</h4>
                    </div>
                    <div class="card-body p-4">
                        <h5 class="font-weight-bold text-dark mb-2"><i class="fas fa-user-lock mr-2 text-primary"></i>4.1 Regulasi Hak Akses & Otorisasi Berbasis Peran (Matriks RBAC)</h5>
                        <p class="text-sm text-secondary">
                            Sistem menerapkan kebijakan <strong>Least Privilege Principle</strong> menggunakan <em>Spatie Permission</em>. Setiap role hanya dapat mengakses menu dan melakukan aksi sesuai otoritas yang ditetapkan:
                        </p>

                        <div class="table-responsive mb-4">
                            <table class="table table-sm table-bordered table-hover text-xs">
                                <thead class="bg-navy text-white text-center">
                                    <tr>
                                        <th class="text-left">Modul / Kapabilitas Sistem</th>
                                        <th>Super Admin</th>
                                        <th>Admin Prodi</th>
                                        <th>Editor Konten</th>
                                        <th>Dosen</th>
                                        <th>Operator Akademik</th>
                                        <th>Publik</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <tr>
                                        <td class="text-left font-weight-bold">Dashboard & Statistik</td>
                                        <td><span class="badge badge-success">Full</span></td>
                                        <td><span class="badge badge-success">Full</span></td>
                                        <td><span class="badge badge-info">View</span></td>
                                        <td><span class="badge badge-info">View</span></td>
                                        <td><span class="badge badge-info">View</span></td>
                                        <td>-</td>
                                    </tr>
                                    <tr>
                                        <td class="text-left font-weight-bold">Berita & Artikel (Posts)</td>
                                        <td><span class="badge badge-success">CRUD + Publish</span></td>
                                        <td><span class="badge badge-success">CRUD + Publish</span></td>
                                        <td><span class="badge badge-primary">Create/Edit/Publish</span></td>
                                        <td><span class="badge badge-warning">Create/Edit</span></td>
                                        <td>-</td>
                                        <td><span class="badge badge-light border">Read</span></td>
                                    </tr>
                                    <tr>
                                        <td class="text-left font-weight-bold">Kategori & Tag Artikel</td>
                                        <td><span class="badge badge-success">CRUD</span></td>
                                        <td><span class="badge badge-primary">Create/Edit</span></td>
                                        <td><span class="badge badge-info">View</span></td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td><span class="badge badge-light border">Read</span></td>
                                    </tr>
                                    <tr>
                                        <td class="text-left font-weight-bold">Pengumuman & Agenda Event</td>
                                        <td><span class="badge badge-success">CRUD</span></td>
                                        <td><span class="badge badge-success">CRUD</span></td>
                                        <td><span class="badge badge-primary">Create/Edit</span></td>
                                        <td>-</td>
                                        <td><span class="badge badge-primary">Create/Edit</span></td>
                                        <td><span class="badge badge-light border">Read & Daftar</span></td>
                                    </tr>
                                    <tr>
                                        <td class="text-left font-weight-bold">Halaman Statis, FAQ & Galeri</td>
                                        <td><span class="badge badge-success">CRUD</span></td>
                                        <td><span class="badge badge-success">CRUD</span></td>
                                        <td><span class="badge badge-primary">Create/Edit</span></td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td><span class="badge badge-light border">Read</span></td>
                                    </tr>
                                    <tr>
                                        <td class="text-left font-weight-bold">Media Library (File Manager)</td>
                                        <td><span class="badge badge-success">Upload/Delete</span></td>
                                        <td><span class="badge badge-success">Upload/Delete</span></td>
                                        <td><span class="badge badge-primary">Upload/View</span></td>
                                        <td><span class="badge badge-primary">Upload/View</span></td>
                                        <td><span class="badge badge-primary">Upload/View</span></td>
                                        <td>-</td>
                                    </tr>
                                    <tr>
                                        <td class="text-left font-weight-bold">SDM / Dosen (Import/Export)</td>
                                        <td><span class="badge badge-success">CRUD</span></td>
                                        <td><span class="badge badge-success">CRUD</span></td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td><span class="badge badge-light border">View Profil</span></td>
                                    </tr>
                                    <tr>
                                        <td class="text-left font-weight-bold">Kurikulum & Dokumen Resmi</td>
                                        <td><span class="badge badge-success">CRUD</span></td>
                                        <td><span class="badge badge-success">CRUD</span></td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td><span class="badge badge-primary">Create/Edit</span></td>
                                        <td><span class="badge badge-light border">View/Download</span></td>
                                    </tr>
                                    <tr>
                                        <td class="text-left font-weight-bold">Slider, Mitra, Sponsor & Testimoni</td>
                                        <td><span class="badge badge-success">CRUD</span></td>
                                        <td><span class="badge badge-success">CRUD / Approve</span></td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td><span class="badge badge-light border">View</span></td>
                                    </tr>
                                    <tr>
                                        <td class="text-left font-weight-bold">Pengaturan Situs, Tema & Menu</td>
                                        <td><span class="badge badge-success">Full Access</span></td>
                                        <td><span class="badge badge-success">Full Access</span></td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                    </tr>
                                    <tr>
                                        <td class="text-left font-weight-bold">Kelola User, Impersonate & Backup</td>
                                        <td><span class="badge badge-danger"><i class="fas fa-lock mr-1"></i>Exclusive</span></td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="card h-100 border-left-danger shadow-xs">
                                    <div class="card-body p-3">
                                        <h6 class="font-weight-bold text-danger"><i class="fas fa-shield-alt mr-2"></i>4.2 Regulasi Keamanan & Pelindungan Data</h6>
                                        <ul class="text-sm text-secondary pl-3 mb-0">
                                            <li><strong>Kebijakan Sandi:</strong> Seluruh password di-hash dengan Bcrypt. Wajib mengganti password default seeder saat diunggah ke server produksi.</li>
                                            <li><strong>Anti-CSRF & Anti-Spam:</strong> Seluruh form wajib menyertakan CSRF Token, dan form kontak publik wajib melewati verifikasi Captcha.</li>
                                            <li><strong>Validasi MIME File:</strong> Hanya format gambar, PDF, Office, dan Excel resmi yang diizinkan diunggah ke server.</li>
                                            <li><strong>Audit Trail:</strong> Setiap perubahan data terekam beserta nama pengguna dan waktu di Log Aktivitas.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="card h-100 border-left-success shadow-xs">
                                    <div class="card-body p-3">
                                        <h6 class="font-weight-bold text-success"><i class="fas fa-universal-access mr-2"></i>4.3 Regulasi Konten, Aksesibilitas & Backup</h6>
                                        <ul class="text-sm text-secondary pl-3 mb-0">
                                            <li><strong>Standar Dwibahasa:</strong> Konten utama disarankan diisi lengkap pada tab Bahasa Indonesia (ID) dan Bahasa Inggris (EN).</li>
                                            <li><strong>Standar Inklusivitas Disabilitas:</strong> Fitur aksesibilitas (Text-to-Speech, Kontras Tinggi, Ukuran Font) wajib tetap aktif bagi pengunjung berkebutuhan khusus.</li>
                                            <li><strong>Kebijakan Disaster Recovery:</strong> Super Admin wajib melakukan backup minimal 1x seminggu dan menyimpan file <code>.zip</code> di luar server.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- =========================================================
                 TAB 5: KEUNGGULAN APLIKASI
                 ========================================================= -->
            <div class="tab-pane fade" id="tab-keunggulan" role="tabpanel">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-navy text-white py-3">
                        <h4 class="mb-0 font-weight-bold"><i class="fas fa-trophy mr-2 text-warning"></i>5. Delapan Keunggulan Utama BalaKutaK CMS</h4>
                    </div>
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="p-3 border rounded h-100 bg-white shadow-xs">
                                    <div class="d-flex align-items-center mb-2">
                                        <span class="badge badge-primary p-2 mr-2"><i class="fas fa-palette fa-lg"></i></span>
                                        <h6 class="font-weight-bold mb-0">1. Dynamic Multi-Theme Engine (20+ Tema)</h6>
                                    </div>
                                    <p class="text-sm text-secondary mb-0">Ganti suasana dan estetika website secara instan tanpa koding. Dilengkapi tema futuristik <strong>Aurora Glass</strong> (glassmorphism), <strong>Oxford Luxury</strong>, dan <strong>Stanford Grow</strong>.</p>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="p-3 border rounded h-100 bg-white shadow-xs">
                                    <div class="d-flex align-items-center mb-2">
                                        <span class="badge badge-success p-2 mr-2"><i class="fas fa-award fa-lg"></i></span>
                                        <h6 class="font-weight-bold mb-0">2. All-in-One Academic & Accreditation Suite</h6>
                                    </div>
                                    <p class="text-sm text-secondary mb-0">Siap mendukung akreditasi BAN-PT / LAM dengan modul SDM Dosen, Kurikulum, Kalender, Layanan, Riset & Pengabdian, serta <em>Interactive Certificate Viewer</em>.</p>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="p-3 border rounded h-100 bg-white shadow-xs">
                                    <div class="d-flex align-items-center mb-2">
                                        <span class="badge badge-warning p-2 mr-2"><i class="fas fa-mouse-pointer fa-lg"></i></span>
                                        <h6 class="font-weight-bold mb-0">3. Visual Drag & Drop Menu & Page Builder</h6>
                                    </div>
                                    <p class="text-sm text-secondary mb-0">Susun navigasi Header/Footer bertingkat secara drag-and-drop dan rancang halaman <em>Landing Page</em> kustom blok demi blok tanpa menyentuh kode pemrograman.</p>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="p-3 border rounded h-100 bg-white shadow-xs">
                                    <div class="d-flex align-items-center mb-2">
                                        <span class="badge badge-info p-2 mr-2"><i class="fas fa-robot fa-lg"></i></span>
                                        <h6 class="font-weight-bold mb-0">4. Smart Chatbot & Inclusive Accessibility</h6>
                                    </div>
                                    <p class="text-sm text-secondary mb-0">Dilengkapi widget Chatbot pintar dan panel ramah disabilitas (<em>Text-to-Speech</em>, Kontras Tinggi, Grayscale) dengan posisi anti-bentrok & warna adaptif mengikuti tema.</p>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="p-3 border rounded h-100 bg-white shadow-xs">
                                    <div class="d-flex align-items-center mb-2">
                                        <span class="badge badge-success p-2 mr-2"><i class="fas fa-file-excel fa-lg"></i></span>
                                        <h6 class="font-weight-bold mb-0">5. High-Speed Bulk Excel Import & Export</h6>
                                    </div>
                                    <p class="text-sm text-secondary mb-0">Hemat waktu input data hingga 90% dengan fitur <em>Download Template</em>, <em>Bulk Import</em>, dan <em>Export Excel (<code>.xlsx</code>)</em> pada modul Dosen, Kurikulum, Riset, dan Artikel.</p>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="p-3 border rounded h-100 bg-white shadow-xs">
                                    <div class="d-flex align-items-center mb-2">
                                        <span class="badge badge-danger p-2 mr-2"><i class="fas fa-user-secret fa-lg"></i></span>
                                        <h6 class="font-weight-bold mb-0">6. One-Click User Impersonation</h6>
                                    </div>
                                    <p class="text-sm text-secondary mb-0">Super Admin dapat menyamar/masuk sebagai user lain (Admin Prodi, Editor, Dosen, Operator) dengan 1 klik untuk simulasi dan bantuan teknis tanpa meminta password.</p>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="p-3 border rounded h-100 bg-white shadow-xs">
                                    <div class="d-flex align-items-center mb-2">
                                        <span class="badge badge-dark p-2 mr-2"><i class="fas fa-hdd fa-lg"></i></span>
                                        <h6 class="font-weight-bold mb-0">7. Integrated One-Click & Scheduled Backup</h6>
                                    </div>
                                    <p class="text-sm text-secondary mb-0">Cadangkan seluruh database dan file aplikasi ke format <code>.zip</code> langsung dari dashboard atau jadwalkan otomatis secara harian, mingguan, maupun bulanan.</p>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="p-3 border rounded h-100 bg-white shadow-xs">
                                    <div class="d-flex align-items-center mb-2">
                                        <span class="badge badge-primary p-2 mr-2"><i class="fas fa-bolt fa-lg"></i></span>
                                        <h6 class="font-weight-bold mb-0">8. Ultra-Lightweight, Bilingual & SEO Ready</h6>
                                    </div>
                                    <p class="text-sm text-secondary mb-0">Performa pemuatan halaman super cepat berbasis Laravel 11, mendukung penuh dua bahasa (ID/EN), Smart Dark Mode, serta pembuatan <code>sitemap.xml</code> otomatis.</p>
                                </div>
                            </div>
                            <div class="col-md-12 mb-0">
                                <div class="p-3 border rounded bg-navy text-white shadow-xs">
                                    <div class="d-flex align-items-center mb-2">
                                        <span class="badge badge-success p-2 mr-2"><i class="fas fa-shield-alt fa-lg"></i></span>
                                        <h6 class="font-weight-bold mb-0 text-white">9. YantoSedunia Protection Guard (Smart Cyber Attack Protection Engine)</h6>
                                    </div>
                                    <p class="text-sm text-light mb-0">Engine keamanan berlapis (<em>Prevent, Detect, Protect, and Monitor</em>) dengan Intelligent WAF (SQLi, XSS, LFI, RCE, Scanner), IP Reputation &amp; Auto-Ban, Brute Force Protection, Security Audit, dan Real-Time Threat Monitoring &mdash; <em>"Detect Early. Defend Smart. Protect Always."</em></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- =========================================================
                 TAB 6: PANDUAN PER ROLE (STEP-BY-STEP)
                 ========================================================= -->
            <div class="tab-pane fade" id="tab-panduan-role" role="tabpanel">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-navy text-white py-3">
                        <h4 class="mb-0 font-weight-bold"><i class="fas fa-users-cog mr-2 text-warning"></i>6. Panduan Operasional Step-by-Step untuk Semua Role User</h4>
                    </div>
                    <div class="card-body p-4">
                        <!-- Default Credentials Box -->
                        <div class="bg-light p-3 rounded border mb-4">
                            <h6 class="font-weight-bold text-dark mb-2"><i class="fas fa-key mr-2 text-warning"></i>Tabel Akun Default (Seeder Credentials)</h6>
                            <div class="table-responsive">
                                <table class="table table-sm table-bordered bg-white mb-0 text-xs">
                                    <thead class="bg-navy text-white">
                                        <tr>
                                            <th>No</th>
                                            <th>Role User</th>
                                            <th>Email Default</th>
                                            <th>Password</th>
                                            <th>Fokus Utama</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td><strong>Super Admin</strong></td>
                                            <td><code>superadmin@prodi.ac.id</code></td>
                                            <td><code>password</code></td>
                                            <td>Otoritas penuh, Kelola User, Impersonate, Pengaturan, Tema, Menu & Backup.</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td><strong>Admin Prodi</strong></td>
                                            <td><code>admin@prodi.ac.id</code></td>
                                            <td><code>password</code></td>
                                            <td>Manajemen Akademik, SDM Dosen, Kurikulum, Riset, Profil, Slider, Mitra & Pesan Kontak.</td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td><strong>Editor Konten</strong></td>
                                            <td><code>editor@prodi.ac.id</code></td>
                                            <td><code>password</code></td>
                                            <td>Publikasi Berita & Artikel, Pengumuman, Halaman Statis, Agenda/Event, Galeri & Media.</td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td><strong>Dosen</strong></td>
                                            <td><code>dosen@prodi.ac.id</code></td>
                                            <td><code>password</code></td>
                                            <td>Penulisan artikel ilmiah/populer dosen & pengunggahan media pendukung.</td>
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td><strong>Operator Akademik</strong></td>
                                            <td><code>operator@prodi.ac.id</code></td>
                                            <td><code>password</code></td>
                                            <td>Administrasi Kurikulum Semester, Pusat Dokumen Resmi, Pengumuman & Agenda.</td>
                                        </tr>
                                        <tr>
                                            <td>6</td>
                                            <td><strong>Pengunjung Publik</strong></td>
                                            <td><em>Tanpa Login</em></td>
                                            <td><em>-</em></td>
                                            <td>Akses informasi akademik, berita, unduh dokumen, daftar event, Chatbot & Aksesibilitas.</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Role Sub-Navigation Pills -->
                        <ul class="nav nav-pills mb-3 bg-light p-2 rounded border" id="roleSubTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active font-weight-bold text-xs" data-toggle="pill" href="#role-superadmin">1. Super Admin</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link font-weight-bold text-xs" data-toggle="pill" href="#role-adminprodi">2. Admin Prodi</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link font-weight-bold text-xs" data-toggle="pill" href="#role-editor">3. Editor Konten</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link font-weight-bold text-xs" data-toggle="pill" href="#role-dosen">4. Dosen</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link font-weight-bold text-xs" data-toggle="pill" href="#role-operator">5. Operator Akademik</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link font-weight-bold text-xs" data-toggle="pill" href="#role-publik">6. Pengunjung Publik</a>
                            </li>
                        </ul>

                        <div class="tab-content border rounded p-4 bg-white">
                            <!-- ROLE 1: SUPER ADMIN -->
                            <div class="tab-pane fade show active" id="role-superadmin">
                                <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-3">
                                    <h5 class="font-weight-bold text-primary mb-0"><i class="fas fa-crown mr-2 text-warning"></i>Panduan Role 1: Super Admin (<code>superadmin@prodi.ac.id</code>)</h5>
                                    <span class="badge badge-danger">Full System Authority</span>
                                </div>
                                <ol class="text-sm pl-3">
                                    <li class="mb-3">
                                        <strong>Langkah 1 — Login & Audit Dashboard Utama:</strong>
                                        Buka <code>/login</code>, masukkan email <code>superadmin@prodi.ac.id</code> & password <code>password</code>. Di halaman <strong>Dashboard</strong> (<code>/admin</code>), pantau Info Box ringkasan data, grafik <em>Statistik Pengunjung</em>, dan tabel <em>Log Aktivitas Terbaru</em>.
                                        <div class="my-2 text-center">
                                            <img src="{{ asset('images/screenshots/admin-dashboard.png') }}" alt="Dashboard" class="img-fluid rounded border shadow-xs" style="max-height: 260px;">
                                        </div>
                                    </li>
                                    <li class="mb-3">
                                        <strong>Langkah 2 — Manajemen Pengguna & Role (Kelola User):</strong>
                                        Buka menu <strong>SISTEM &rarr; Kelola User</strong> (<code>/admin/users</code>). Klik <strong>+ Tambah User</strong>, isi Nama, Email, Password, Status Active, dan pilih Role (<em>Super Admin, Admin Prodi, Editor Konten, Dosen, atau Operator Akademik</em>), lalu klik <strong>Simpan</strong>.
                                    </li>
                                    <li class="mb-3">
                                        <strong>Langkah 3 — Simulasi Akun dengan Fitur Impersonate:</strong>
                                        Pada tabel <strong>Kelola User</strong>, klik tombol kuning <strong>Impersonate (Ikon Kunci)</strong> pada baris user mana pun untuk langsung masuk sebagai user tersebut tanpa password. Klik <strong>Leave Impersonation</strong> di bagian atas layar untuk kembali ke Super Admin.
                                    </li>
                                    <li class="mb-3">
                                        <strong>Langkah 4 — Mengganti Tema Website (Dynamic Theme Engine):</strong>
                                        Buka <strong>SISTEM &rarr; Pengaturan &rarr; Tema</strong> (<code>/admin/settings/appearance</code>). Pilih salah satu dari 20+ tema warna premium (misal: <em>Aurora Glass</em> atau <em>Oxford Luxury</em>), lalu klik <strong>Simpan Pengaturan</strong>.
                                        <div class="my-2 text-center">
                                            <img src="{{ asset('images/screenshots/admin-themes.png') }}" alt="Pengaturan Tema" class="img-fluid rounded border shadow-xs" style="max-height: 260px;">
                                        </div>
                                    </li>
                                    <li class="mb-3">
                                        <strong>Langkah 5 — Menyusun Menu Builder & Page Builder:</strong>
                                        Buka <strong>SISTEM &rarr; Menu Builder</strong> (<code>/admin/menus</code>), tambahkan item halaman, lalu seret & lepas (<em>drag-and-drop</em>) untuk mengatur urutan atau membuat sub-menu dropdown. Gunakan <strong>SISTEM &rarr; Page Builder</strong> untuk merancang halaman kustom visual.
                                        <div class="my-2 text-center">
                                            <img src="{{ asset('images/screenshots/admin_menus_v2.png') }}" alt="Menu Builder" class="img-fluid rounded border shadow-xs" style="max-height: 260px;">
                                        </div>
                                    </li>
                                    <li class="mb-0">
                                        <strong>Langkah 6 — Manajemen Backup Database & File Sistem (<code>.zip</code>):</strong>
                                        Buka <strong>SISTEM &rarr; Backup</strong> (<code>/admin/backups</code>). Klik <strong>Buat Backup Baru</strong> untuk membuat cadangan instan, atur jadwal otomatis (Harian/Mingguan/Bulanan), dan unduh file <code>.zip</code> ke komputer lokal Anda.
                                        <div class="my-2 text-center">
                                            <img src="{{ asset('images/screenshots/admin-backups.png') }}" alt="Backup Sistem" class="img-fluid rounded border shadow-xs" style="max-height: 260px;">
                                        </div>
                                    </li>
                                </ol>
                            </div>

                            <!-- ROLE 2: ADMIN PRODI -->
                            <div class="tab-pane fade" id="role-adminprodi">
                                <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-3">
                                    <h5 class="font-weight-bold text-success mb-0"><i class="fas fa-user-graduate mr-2"></i>Panduan Role 2: Admin Prodi (<code>admin@prodi.ac.id</code>)</h5>
                                    <span class="badge badge-success">Academic & Operations Manager</span>
                                </div>
                                <ol class="text-sm pl-3">
                                    <li class="mb-3">
                                        <strong>Langkah 1 — Mengelola Profil Institusi & Sertifikat Akreditasi:</strong>
                                        Buka <strong>MODUL HALAMAN &rarr; Manajemen Profil</strong> (<code>/admin/settings/profile</code>) untuk memperbarui Sejarah, Visi & Misi, Sambutan Kaprodi/Dekan, dan URL Video Profil YouTube. Buka <strong>Pengaturan &rarr; Akademik</strong> (<code>/admin/settings/academic</code>) untuk mengunggah file <strong>Sertifikat Akreditasi (PDF/Gambar)</strong>.
                                    </li>
                                    <li class="mb-3">
                                        <strong>Langkah 2 — Mengelola SDM / Dosen (Manual & Import/Export Excel):</strong>
                                        Buka <strong>MODUL HALAMAN &rarr; Sumber Daya Manusia</strong> (<code>/admin/lecturers</code>). Klik <strong>+ Tambah Dosen</strong> untuk input manual (Nama, NIDN, Jabatan, Keahlian, Foto), atau klik <strong>Download Template</strong> &rarr; isi di Excel &rarr; klik <strong>Import Excel</strong> untuk unggah massal.
                                    </li>
                                    <li class="mb-3">
                                        <strong>Langkah 3 — Mengelola Kurikulum, Kalender & Layanan Akademik:</strong>
                                        Kelola struktur mata kuliah per semester di menu <strong>Kurikulum</strong> (<code>/admin/curriculums</code> — mendukung Import/Export Excel), jadwal kegiatan di <strong>Kalender Akademik</strong> (<code>/admin/academic-calendars</code>), dan tautan layanan mahasiswa di <strong>Layanan Akademik</strong> (<code>/admin/academic-services</code>).
                                    </li>
                                    <li class="mb-3">
                                        <strong>Langkah 4 — Mengelola Penelitian & Pengabdian Masyarakat:</strong>
                                        Buka <strong>Penelitian & Pengabdian</strong> (<code>/admin/research-services</code>). Input data riset/pengabdian dosen atau gunakan fitur <strong>Import/Export Excel</strong> untuk sinkronisasi cepat.
                                    </li>
                                    <li class="mb-3">
                                        <strong>Langkah 5 — Mengelola Slider, Info Grafis, Mitra, Sponsor & Testimoni:</strong>
                                        Atur banner utama di <strong>Slider/Banner</strong> (<code>/admin/sliders</code>), statistik capaian di <strong>Info Grafis</strong> (<code>/admin/infographics</code>), logo kerjasama di <strong>Mitra Kerjasama</strong> & <strong>Sponsor</strong>, serta setujui kutipan alumni di <strong>Testimoni Alumni</strong> (<code>/admin/testimonials</code>).
                                    </li>
                                    <li class="mb-0">
                                        <strong>Langkah 6 — Membalas Pesan Kontak Pengunjung:</strong>
                                        Buka <strong>SISTEM &rarr; Pesan Kontak</strong> (<code>/admin/contact-messages</code>), buka pesan masuk dari pengunjung, ketik tanggapan resmi, lalu klik <strong>Kirim Balasan</strong>.
                                    </li>
                                </ol>
                            </div>

                            <!-- ROLE 3: EDITOR KONTEN -->
                            <div class="tab-pane fade" id="role-editor">
                                <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-3">
                                    <h5 class="font-weight-bold text-info mb-0"><i class="fas fa-edit mr-2"></i>Panduan Role 3: Editor Konten (<code>editor@prodi.ac.id</code>)</h5>
                                    <span class="badge badge-info">Editorial & Media Specialist</span>
                                </div>
                                <ol class="text-sm pl-3">
                                    <li class="mb-3">
                                        <strong>Langkah 1 — Membuat & Mempublikasikan Berita / Artikel Bilingual:</strong>
                                        Buka <strong>KONTEN WEBSITE &rarr; Berita & Artikel &rarr; Tambah Artikel</strong> (<code>/admin/posts/create</code>). Isi Judul dan Konten pada tab Bahasa Indonesia & Bahasa Inggris, pilih Kategori & Tag, unggah Gambar Unggulan, lengkapi Meta SEO, pilih status <strong>Published</strong>, lalu klik <strong>Simpan</strong>.
                                        <div class="my-2 text-center">
                                            <img src="{{ asset('images/screenshots/admin-posts.png') }}" alt="Manajemen Artikel" class="img-fluid rounded border shadow-xs" style="max-height: 260px;">
                                        </div>
                                    </li>
                                    <li class="mb-3">
                                        <strong>Langkah 2 — Mengelola Pengumuman Penting:</strong>
                                        Buka <strong>KONTEN WEBSITE &rarr; Pengumuman</strong> (<code>/admin/announcements</code>), tambahkan informasi pengumuman beserta lampiran PDF agar muncul pada bilah pengumuman halaman utama.
                                    </li>
                                    <li class="mb-3">
                                        <strong>Langkah 3 — Mengelola Agenda & Event (Countdown & Link Pendaftaran):</strong>
                                        Buka <strong>KONTEN WEBSITE &rarr; Agenda & Event</strong> (<code>/admin/events</code>). Isi Judul, Deskripsi, Waktu Mulai & Selesai, Lokasi, Poster, serta <strong>URL Pendaftaran</strong> agar tombol registrasi aktif di halaman publik.
                                    </li>
                                    <li class="mb-3">
                                        <strong>Langkah 4 — Mengelola Halaman Statis & FAQs:</strong>
                                        Buka <strong>Halaman Statis</strong> (<code>/admin/pages</code>) untuk menyunting halaman informasi tetap dan menu <strong>FAQs</strong> (<code>/admin/faqs</code>) untuk daftar tanya-jawab umum.
                                    </li>
                                    <li class="mb-0">
                                        <strong>Langkah 5 — Mengelola Galeri Dokumentasi & Media Library:</strong>
                                        Unggah foto/video dokumentasi kegiatan di menu <strong>Galeri</strong> (<code>/admin/gallery</code>) dan kelola aset file di <strong>Media Library</strong> (<code>/admin/media</code>).
                                        <div class="my-2 text-center">
                                            <img src="{{ asset('images/screenshots/admin-gallery.png') }}" alt="Manajemen Galeri" class="img-fluid rounded border shadow-xs" style="max-height: 260px;">
                                        </div>
                                    </li>
                                </ol>
                            </div>

                            <!-- ROLE 4: DOSEN -->
                            <div class="tab-pane fade" id="role-dosen">
                                <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-3">
                                    <h5 class="font-weight-bold text-warning mb-0"><i class="fas fa-chalkboard-teacher mr-2"></i>Panduan Role 4: Dosen (<code>dosen@prodi.ac.id</code>)</h5>
                                    <span class="badge badge-warning">Academic Contributor</span>
                                </div>
                                <ol class="text-sm pl-3">
                                    <li class="mb-3">
                                        <strong>Langkah 1 — Login & Akses Dashboard Dosen:</strong>
                                        Masuk melalui <code>/login</code> menggunakan akun <code>dosen@prodi.ac.id</code> (password: <code>password</code>). Pantau ringkasan publikasi dan aktivitas terbaru pada Dashboard.
                                    </li>
                                    <li class="mb-3">
                                        <strong>Langkah 2 — Mengunggah Ilustrasi & Media Riset:</strong>
                                        Buka menu <strong>SISTEM &rarr; Media Library</strong> (<code>/admin/media</code>), klik <strong>Upload File</strong> untuk mengunggah foto kegiatan riset, pengabdian, atau diagram pendukung artikel.
                                    </li>
                                    <li class="mb-0">
                                        <strong>Langkah 3 — Menulis & Menyunting Artikel Ilmiah Populer / Berita Dosen:</strong>
                                        Buka <strong>KONTEN WEBSITE &rarr; Berita & Artikel &rarr; Tambah Artikel</strong> (<code>/admin/posts/create</code>). Tulis artikel dalam Bahasa Indonesia/Inggris, lampirkan gambar dari Media Library, lalu klik <strong>Simpan</strong> untuk ditinjau dan dipublikasikan bersama tim redaksi.
                                    </li>
                                </ol>
                            </div>

                            <!-- ROLE 5: OPERATOR AKADEMIK -->
                            <div class="tab-pane fade" id="role-operator">
                                <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-3">
                                    <h5 class="font-weight-bold text-indigo mb-0"><i class="fas fa-Clipboard-list mr-2"></i>Panduan Role 5: Operator Akademik (<code>operator@prodi.ac.id</code>)</h5>
                                    <span class="badge badge-secondary">Academic & Document Administrator</span>
                                </div>
                                <ol class="text-sm pl-3">
                                    <li class="mb-3">
                                        <strong>Langkah 1 — Login & Pemantauan Dashboard Operasional:</strong>
                                        Masuk melalui <code>/login</code> menggunakan akun <code>operator@prodi.ac.id</code> (password: <code>password</code>).
                                    </li>
                                    <li class="mb-3">
                                        <strong>Langkah 2 — Memperbarui Data Kurikulum Semester (Manual & Import Excel):</strong>
                                        Buka <strong>MODUL HALAMAN &rarr; Kurikulum</strong> (<code>/admin/curriculums</code>). Tambah/edit mata kuliah per semester, atau gunakan fitur <strong>Download Template</strong> & <strong>Import Excel</strong> untuk pembaruan massal mata kuliah.
                                    </li>
                                    <li class="mb-3">
                                        <strong>Langkah 3 — Mengelola Pusat Dokumen Resmi (SK, Panduan, Formulir, SOP):</strong>
                                        Buka <strong>MODUL HALAMAN &rarr; Dokumen</strong> (<code>/admin/documents</code>). Klik <strong>+ Tambah Dokumen</strong>, isi Judul, pilih Kategori Dokumen, dan unggah file (PDF/DOCX/XLSX) agar langsung dapat diunduh mahasiswa di halaman <code>/dokumen</code>.
                                    </li>
                                    <li class="mb-0">
                                        <strong>Langkah 4 — Publikasi Pengumuman & Jadwal Agenda Akademik:</strong>
                                        Kelola pengumuman akademik (jadwal KRS, UTS/UAS, Yudisium) di menu <strong>Pengumuman</strong> (<code>/admin/announcements</code>) dan jadwal seminar/kegiatan di menu <strong>Agenda & Event</strong> (<code>/admin/events</code>).
                                    </li>
                                </ol>
                            </div>

                            <!-- ROLE 6: PENGUNJUNG PUBLIK -->
                            <div class="tab-pane fade" id="role-publik">
                                <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-3">
                                    <h5 class="font-weight-bold text-dark mb-0"><i class="fas fa-globe mr-2 text-primary"></i>Panduan Role 6: Pengunjung Publik / Mahasiswa (Frontend User)</h5>
                                    <span class="badge badge-primary">Public Portal Visitor</span>
                                </div>
                                <ol class="text-sm pl-3">
                                    <li class="mb-3">
                                        <strong>Langkah 1 — Eksplorasi Beranda, Bahasa (ID/EN) & Smart Dark Mode:</strong>
                                        Buka halaman utama (<code>/</code>). Gunakan tombol <strong>ID / EN</strong> di navbar atas untuk mengganti bahasa situs, tombol <strong>Dark Mode</strong> untuk mode gelap, dan kolom <strong>Pencarian Global</strong> untuk mencari konten.
                                        <div class="my-2 text-center">
                                            <img src="{{ asset('images/screenshots/home_v2.png') }}" alt="Beranda Publik" class="img-fluid rounded border shadow-xs" style="max-height: 260px;">
                                        </div>
                                    </li>
                                    <li class="mb-3">
                                        <strong>Langkah 2 — Mengakses Informasi Akademik, Dosen & Sertifikat Akreditasi:</strong>
                                        Telusuri menu <strong>Tentang/Profil</strong> (termasuk viewer Sertifikat Akreditasi interaktif), <strong>Dosen</strong> (<code>/dosen</code>), <strong>Kurikulum</strong> (<code>/kurikulum</code>), <strong>Kalender Akademik</strong> (<code>/kalender-akademik</code>), <strong>Penelitian & Pengabdian</strong>, serta <strong>Layanan Akademik</strong>.
                                    </li>
                                    <li class="mb-3">
                                        <strong>Langkah 3 — Membaca Berita, Mendaftar Event & Mengunduh Dokumen:</strong>
                                        Baca artikel terbaru di <strong>Berita</strong> (<code>/berita</code>), lihat hitung mundur kegiatan dan klik tombol registrasi di <strong>Agenda</strong> (<code>/agenda</code>), serta unduh berkas resmi di <strong>Dokumen</strong> (<code>/dokumen</code>).
                                    </li>
                                    <li class="mb-0">
                                        <strong>Langkah 4 — Menggunakan Smart Chatbot, Aksesibilitas Disabilitas & Kontak:</strong>
                                        Klik ikon <strong>Chatbot</strong> di pojok kanan bawah untuk tanya-jawab instan, klik ikon <strong>Aksesibilitas</strong> untuk fitur <em>Text-to-Speech</em> / Kontras Tinggi / Perbesar Font, atau kirim pesan melalui halaman <strong>Kontak</strong> (<code>/kontak</code>).
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- =========================================================
                 TAB 7: GALERI SCREENSHOT LENGKAP
                 ========================================================= -->
            <div class="tab-pane fade" id="tab-screenshots" role="tabpanel">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-navy text-white py-3">
                        <h4 class="mb-0 font-weight-bold"><i class="fas fa-camera-retro mr-2 text-warning"></i>7. Galeri Screenshot Aplikasi Lengkap</h4>
                    </div>
                    <div class="card-body p-4">
                        <p class="text-secondary mb-4">Berikut adalah tangkapan layar lengkap antarmuka Frontend (Portal Publik) dan Backend (Admin Panel) pada <strong>BalaKutaK CMS v2.1.0 Stable</strong>:</p>
                        <div class="row">
                            @php
                                $screenshots = [
                                    ['file' => 'home_v2.png', 'title' => '1. Halaman Utama (Frontend Home)', 'desc' => 'Tampilan beranda modern dengan Hero Slider dinamis, statistik infografis, berita, agenda, chatbot, dan aksesibilitas.'],
                                    ['file' => 'login_v2.png', 'title' => '2. Halaman Login Resmi', 'desc' => 'Antarmuka autentikasi elegan dengan branding BalaKutaK dan fitur Show/Hide Password.'],
                                    ['file' => 'frontend-berita.png', 'title' => '3. Portal Berita & Artikel Publik', 'desc' => 'Halaman direktori berita publik dengan filter kategori, pencarian, dan dukungan dwibahasa.'],
                                    ['file' => 'frontend-agenda.png', 'title' => '4. Portal Agenda & Event Publik', 'desc' => 'Daftar jadwal kegiatan lengkap dengan informasi lokasi, waktu, dan tautan pendaftaran.'],
                                    ['file' => 'admin-dashboard.png', 'title' => '5. Admin Dashboard & Statistik', 'desc' => 'Pusat kendali admin menampilkan Info Box, grafik kunjungan harian, dan audit log aktivitas.'],
                                    ['file' => 'admin-posts.png', 'title' => '6. Manajemen Berita & Artikel (Posts)', 'desc' => 'Pengelolaan artikel dengan fitur filter status, pencarian instan, import, dan aksi massal.'],
                                    ['file' => 'admin-gallery.png', 'title' => '7. Manajemen Galeri & Dokumentasi', 'desc' => 'Pengelolaan dokumentasi visual foto dan video kegiatan yang terorganisir per album.'],
                                    ['file' => 'admin_menus_v2.png', 'title' => '8. Visual Drag & Drop Menu Builder', 'desc' => 'Penyusunan navigasi menu Header dan Footer bertingkat tanpa perlu menyentuh kode.'],
                                    ['file' => 'admin-themes.png', 'title' => '9. Dynamic Theme Engine (20+ Tema)', 'desc' => 'Pemilihan palet tema warna website secara instan (Aurora Glass, Oxford Luxury, dll).'],
                                    ['file' => 'admin-backups.png', 'title' => '10. Sistem Backup Database & File (.zip)', 'desc' => 'Pencadangan penuh sistem secara manual maupun terjadwal otomatis langsung dari panel admin.'],
                                ];
                            @endphp
                            @foreach($screenshots as $ss)
                                <div class="col-md-6 mb-4">
                                    <div class="card h-100 border shadow-xs">
                                        <img src="{{ asset('images/screenshots/' . $ss['file']) }}" class="card-img-top border-bottom" alt="{{ $ss['title'] }}" style="height: 210px; object-fit: cover; object-position: top;">
                                        <div class="card-body p-3">
                                            <h6 class="font-weight-bold text-dark mb-1">{{ $ss['title'] }}</h6>
                                            <p class="text-xs text-muted mb-0">{{ $ss['desc'] }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@stop

@section('css')
<style>
    .border-left-navy { border-left: 5px solid #001f3f !important; }
    .border-left-primary { border-left: 4px solid #007bff !important; }
    .border-left-success { border-left: 4px solid #28a745 !important; }
    .border-left-warning { border-left: 4px solid #ffc107 !important; }
    .border-left-danger { border-left: 4px solid #dc3545 !important; }
    .guide-hero {
        background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 60%, #1d4ed8 100%);
    }
    .guide-nav .nav-link {
        border-radius: 0;
        border-left: 4px solid transparent;
        padding: 13px 18px;
        font-weight: 600;
        font-size: 0.9rem;
        color: #334155;
        border-bottom: 1px solid #f1f5f9;
        transition: all 0.2s ease;
    }
    .guide-nav .nav-link:hover {
        background-color: #f8fafc;
        color: #1d4ed8;
    }
    .guide-nav .nav-link.active {
        border-left-color: #1d4ed8;
        color: #1d4ed8 !important;
        background: #eff6ff !important;
    }
    .shadow-xs { box-shadow: 0 1px 3px rgba(0,0,0,0.06); }
    .letter-spacing-1 { letter-spacing: 1px; }
    @media print {
        .col-lg-3, .btn, .main-header, .main-footer, #roleSubTab { display: none !important; }
        .col-lg-9 { width: 100% !important; flex: 0 0 100% !important; max-width: 100% !important; }
        .tab-pane { display: block !important; opacity: 1 !important; visibility: visible !important; margin-bottom: 30px; page-break-after: always; }
        .card { border: none !important; box-shadow: none !important; }
    }
</style>
@endsection

@section('js')
<script>
    $(document).ready(function() {
        $('.guide-nav a').on('shown.bs.tab', function () {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    });
</script>
@stop
