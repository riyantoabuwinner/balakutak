<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dokumentasi & Panduan Resmi BalaKutaK CMS v2.1.0</title>
    <style>
        @page {
            margin: 24mm 16mm 20mm 16mm;
        }
        body {
            font-family: 'DejaVu Sans', 'Helvetica', 'Arial', sans-serif;
            font-size: 9.5pt;
            line-height: 1.5;
            color: #1e293b;
            margin: 0;
            padding: 0;
        }
        /* Header & Footer fixed on every page */
        header {
            position: fixed;
            top: -16mm;
            left: 0;
            right: 0;
            height: 10mm;
            border-bottom: 1.5px solid #1e3a8a;
            font-size: 7.5pt;
            color: #475569;
            padding-bottom: 2px;
        }
        footer {
            position: fixed;
            bottom: -13mm;
            left: 0;
            right: 0;
            height: 9mm;
            border-top: 1px solid #cbd5e1;
            font-size: 7.5pt;
            color: #64748b;
            padding-top: 3px;
            text-align: center;
        }
        .page-number:after {
            content: counter(page);
        }
        /* Cover Page */
        .cover-page {
            text-align: center;
            padding-top: 10px;
            page-break-after: always;
        }
        .cover-badge {
            display: inline-block;
            background-color: #1e3a8a;
            color: #ffffff;
            padding: 4px 14px;
            border-radius: 16px;
            font-size: 8pt;
            font-weight: bold;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 10px;
        }
        .cover-title {
            font-size: 24pt;
            font-weight: bold;
            color: #0f172a;
            margin: 4px 0;
        }
        .cover-subtitle {
            font-size: 12pt;
            color: #1d4ed8;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .cover-desc {
            font-size: 9.5pt;
            color: #475569;
            width: 90%;
            margin: 0 auto 14px auto;
            line-height: 1.5;
            text-align: center;
        }
        .cover-box {
            background-color: #f8fafc;
            border: 1px solid #cbd5e1;
            border-top: 4px solid #1e3a8a;
            border-radius: 6px;
            padding: 12px 16px;
            margin: 12px auto 0 auto;
            text-align: left;
            width: 92%;
        }
        .cover-meta-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 8.5pt;
        }
        .cover-meta-table td {
            padding: 5px 8px;
            border-bottom: 1px solid #e2e8f0;
        }
        .cover-meta-table tr:last-child td {
            border-bottom: none;
        }
        .cover-meta-table td.label {
            font-weight: bold;
            color: #0f172a;
            width: 32%;
        }
        /* TOC */
        .toc-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 6px;
            font-size: 8.6pt;
        }
        .toc-table td {
            padding: 3.5px 8px;
            border-bottom: 1px dashed #cbd5e1;
        }
        .toc-table tr.toc-chapter td {
            font-weight: bold;
            color: #0f172a;
            background-color: #f1f5f9;
            border-bottom: 1px solid #94a3b8;
            padding: 4.5px 8px;
        }
        /* Typography & Headings */
        h1.chapter-title {
            font-size: 14.5pt;
            color: #0f172a;
            border-bottom: 2.5px solid #1d4ed8;
            padding-bottom: 5px;
            margin-top: 0;
            margin-bottom: 10px;
            text-transform: uppercase;
        }
        h2.section-title {
            font-size: 11.5pt;
            color: #1e3a8a;
            margin-top: 14px;
            margin-bottom: 6px;
            border-left: 4px solid #2563eb;
            padding-left: 8px;
        }
        h3.subsection-title {
            font-size: 10pt;
            color: #0f172a;
            margin-top: 10px;
            margin-bottom: 4px;
        }
        p {
            margin-top: 0;
            margin-bottom: 8px;
            text-align: justify;
        }
        ul, ol {
            margin-top: 3px;
            margin-bottom: 8px;
            padding-left: 20px;
        }
        li {
            margin-bottom: 4px;
        }
        /* Tables */
        table.data-table {
            width: 100%;
            border-collapse: collapse;
            margin: 8px 0 12px 0;
            font-size: 8.2pt;
        }
        table.data-table th {
            background-color: #1e3a8a;
            color: #ffffff;
            font-weight: bold;
            text-align: left;
            padding: 6px 8px;
            border: 1px solid #1e3a8a;
        }
        table.data-table td {
            padding: 5px 8px;
            border: 1px solid #cbd5e1;
            vertical-align: top;
        }
        table.data-table tr:nth-child(even) td {
            background-color: #f8fafc;
        }
        /* Architecture Diagram Box */
        .arch-box {
            border: 1px solid #93c5fd;
            background-color: #eff6ff;
            border-left: 5px solid #1d4ed8;
            border-radius: 4px;
            padding: 7px 10px;
            margin-bottom: 5px;
            font-size: 8.3pt;
        }
        .arch-arrow {
            text-align: center;
            font-weight: bold;
            color: #1d4ed8;
            font-size: 10pt;
            margin: 1px 0;
        }
        /* Callouts */
        .callout {
            background-color: #eff6ff;
            border-left: 4px solid #2563eb;
            padding: 8px 12px;
            margin: 8px 0;
            border-radius: 0 4px 4px 0;
            font-size: 8.8pt;
        }
        .callout-success {
            background-color: #ecfdf5;
            border-left: 4px solid #059669;
            padding: 8px 12px;
            margin: 10px 0;
            border-radius: 0 4px 4px 0;
            font-size: 8.8pt;
        }
        /* Role Header Box */
        .role-card {
            background-color: #f8fafc;
            border: 1px solid #cbd5e1;
            border-top: 3px solid #1d4ed8;
            border-radius: 5px;
            padding: 8px 12px;
            margin-bottom: 8px;
        }
        .badge {
            display: inline-block;
            padding: 2px 7px;
            font-size: 7.5pt;
            font-weight: bold;
            border-radius: 3px;
            background-color: #dbeafe;
            color: #1e40af;
        }
        /* Screenshots */
        .screenshot-box {
            text-align: center;
            margin: 8px 0 12px 0;
            padding: 8px;
            background-color: #f8fafc;
            border: 1px solid #cbd5e1;
            border-radius: 5px;
            page-break-inside: avoid;
        }
        .screenshot-box img {
            max-width: 95%;
            max-height: 195px;
            border: 1px solid #94a3b8;
            border-radius: 3px;
        }
        .screenshot-caption {
            font-size: 7.8pt;
            font-style: italic;
            color: #475569;
            margin-top: 4px;
        }
        .page-break {
            page-break-after: always;
        }
        .step-box {
            margin-bottom: 6px;
            padding-left: 2px;
        }
        .step-num {
            display: inline-block;
            background-color: #1e3a8a;
            color: #fff;
            font-weight: bold;
            font-size: 7.8pt;
            padding: 1px 6px;
            border-radius: 4px;
            margin-right: 5px;
        }
        code {
            font-family: 'DejaVu Sans Mono', 'Courier New', monospace;
            font-size: 8.2pt;
            background-color: #f1f5f9;
            padding: 1px 4px;
            border-radius: 3px;
            color: #0f172a;
        }
    </style>
</head>
<body>
@php
    $encodeImg = function($relPath) {
        $fullPath = base_path($relPath);
        if (file_exists($fullPath)) {
            $ext = pathinfo($fullPath, PATHINFO_EXTENSION);
            $data = file_get_contents($fullPath);
            return 'data:image/' . $ext . ';base64,' . base64_encode($data);
        }
        return '';
    };
    $logoSrc = $encodeImg('database/seeders/assets/images/logo.png');
    $ssHome = $encodeImg('docs/screenshots/home_v2.png');
    $ssLogin = $encodeImg('docs/screenshots/login_v2.png');
    $ssDashboard = $encodeImg('docs/screenshots/admin-dashboard.png');
    $ssPosts = $encodeImg('docs/screenshots/admin-posts.png');
    $ssGallery = $encodeImg('docs/screenshots/admin-gallery.png');
    $ssMenus = $encodeImg('docs/screenshots/admin_menus_v2.png');
    $ssBackups = $encodeImg('docs/screenshots/admin-backups.png');
    $ssThemes = $encodeImg('docs/screenshots/admin-themes.png');
    $ssBerita = $encodeImg('docs/screenshots/frontend-berita.png');
    $ssAgenda = $encodeImg('docs/screenshots/frontend-agenda.png');
@endphp

<header>
    <table style="width: 100%; border-collapse: collapse;">
        <tr>
            <td style="text-align: left; font-weight: bold; color: #0f172a;">BALAKUTAK CMS — DOKUMENTASI & PANDUAN LENGKAP SISTEM</td>
            <td style="text-align: right;">Versi 2.1.0 Stable | Open-Source Enterprise & Academic CMS</td>
        </tr>
    </table>
</header>

<footer>
    Dokumen Resmi Panduan Penggunaan & Arsitektur <strong>BalaKutaK CMS v2.1.0</strong> &bull; Halaman <span class="page-number"></span>
</footer>

<!-- =========================================================
     HALAMAN SAMPUL (COVER PAGE)
     ========================================================= -->
<div class="cover-page">
    @if($logoSrc)
        <img src="{{ $logoSrc }}" alt="BalaKutaK Logo" style="height: 68px; margin-bottom: 8px;">
    @endif
    <div><span class="cover-badge">OFFICIAL SYSTEM DOCUMENTATION & USER MANUAL</span></div>
    <div class="cover-title">BALAKUTAK CMS</div>
    <div class="cover-subtitle">Enterprise & Academic Content Management System (v2.1.0 Stable)</div>
    <p class="cover-desc">
        Dokumen Spesifikasi Teknis, Arsitektur Sistem, Proses Bisnis, Regulasi Tata Kelola, Keunggulan Komparatif, serta Panduan Operasional Step-by-Step untuk Seluruh Role Pengguna.
    </p>

    @if($ssHome)
        <div style="margin: 10px auto; width: 88%;">
            <img src="{{ $ssHome }}" alt="Preview BalaKutaK CMS" style="width: 100%; max-height: 185px; object-fit: cover; border-radius: 5px; border: 1.5px solid #94a3b8;">
        </div>
    @endif

    <div class="cover-box">
        <table class="cover-meta-table">
            <tr>
                <td class="label">Nama Aplikasi</td>
                <td>BalaKutaK CMS (Multi-Purpose Academic & Enterprise Web Platform)</td>
            </tr>
            <tr>
                <td class="label">Versi Rilis</td>
                <td>v2.1.0 Stable (Production Ready)</td>
            </tr>
            <tr>
                <td class="label">Basis Teknologi</td>
                <td>Laravel 11.x (PHP 8.2+), MySQL/MariaDB, Tailwind CSS 3, Bootstrap 5, AdminLTE 3</td>
            </tr>
            <tr>
                <td class="label">Lisensi Aplikasi</td>
                <td>MIT Open-Source License</td>
            </tr>
            <tr>
                <td class="label">Cakupan Role User</td>
                <td>Super Admin, Admin Prodi, Editor Konten, Dosen, Operator Akademik, Pengunjung Publik</td>
            </tr>
            <tr>
                <td class="label">Repositori Resmi</td>
                <td>https://github.com/riyantoabuwinner/balakutak</td>
            </tr>
        </table>
    </div>
</div>

<!-- =========================================================
     DAFTAR ISI (TABLE OF CONTENTS)
     ========================================================= -->
<h1 class="chapter-title">DAFTAR ISI DOKUMENTASI</h1>
<p>Dokumen manual resmi ini disusun secara sistematis sebagai acuan arsitektur, tata kelola, dan operasional penggunaan <strong>BalaKutaK CMS v2.1.0</strong> bagi seluruh pemangku kepentingan:</p>

<table class="toc-table">
    <tr class="toc-chapter">
        <td>BAB 1. DESKRIPSI APLIKASI & FILOSOFI BALAKUTAK CMS</td>
        <td style="text-align:right;">Bagian 1</td>
    </tr>
    <tr>
        <td style="padding-left:22px;">1.1 Pengenalan & Filosofi Nama "BalaKutaK" (Ringan, Cerdas & Adaptif)</td>
        <td style="text-align:right;">Sub-bab 1.1</td>
    </tr>
    <tr>
        <td style="padding-left:22px;">1.2 Solusi Multi-Sektor & Ruang Lingkup 6 Domain Ekosistem Modul</td>
        <td style="text-align:right;">Sub-bab 1.2</td>
    </tr>
    <tr class="toc-chapter">
        <td>BAB 2. ARSITEKTUR SISTEM & STACK TEKNOLOGI</td>
        <td style="text-align:right;">Bagian 2</td>
    </tr>
    <tr>
        <td style="padding-left:22px;">2.1 Diagram & Penjabaran Pola Arsitektur Berlapis (Multi-Tier MVC)</td>
        <td style="text-align:right;">Sub-bab 2.1</td>
    </tr>
    <tr>
        <td style="padding-left:22px;">2.2 Struktur Direktori Proyek & Spesifikasi Stack Teknologi Lengkap</td>
        <td style="text-align:right;">Sub-bab 2.2 - 2.3</td>
    </tr>
    <tr class="toc-chapter">
        <td>BAB 3. PROSES BISNIS APLIKASI (BUSINESS WORKFLOWS)</td>
        <td style="text-align:right;">Bagian 3</td>
    </tr>
    <tr>
        <td style="padding-left:22px;">3.1 Alur Bisnis Publikasi & Editorial Konten Dwibahasa (ID/EN)</td>
        <td style="text-align:right;">Sub-bab 3.1</td>
    </tr>
    <tr>
        <td style="padding-left:22px;">3.2 Alur Bisnis Pengelolaan Akademik, Tridharma & Bulk Excel (.xlsx)</td>
        <td style="text-align:right;">Sub-bab 3.2</td>
    </tr>
    <tr>
        <td style="padding-left:22px;">3.3 Alur Bisnis Interaksi Publik, Smart Chatbot, Aksesibilitas & Tata Kelola</td>
        <td style="text-align:right;">Sub-bab 3.3 - 3.4</td>
    </tr>
    <tr class="toc-chapter">
        <td>BAB 4. REGULASI, KEBIJAKAN & STANDAR APLIKASI</td>
        <td style="text-align:right;">Bagian 4</td>
    </tr>
    <tr>
        <td style="padding-left:22px;">4.1 Regulasi Hak Akses & Otorisasi Berbasis Peran (Matriks RBAC)</td>
        <td style="text-align:right;">Sub-bab 4.1</td>
    </tr>
    <tr>
        <td style="padding-left:22px;">4.2 Regulasi Keamanan Siber, Standar Konten, Aksesibilitas & Backup</td>
        <td style="text-align:right;">Sub-bab 4.2 - 4.3</td>
    </tr>
    <tr class="toc-chapter">
        <td>BAB 5. KEUNGGULAN KOMPARATIF APLIKASI (8 PILAR UTAMA)</td>
        <td style="text-align:right;">Bagian 5</td>
    </tr>
    <tr class="toc-chapter">
        <td>BAB 6. PANDUAN PENGGUNAAN DETAIL SEMUA ROLE USER (STEP-BY-STEP)</td>
        <td style="text-align:right;">Bagian 6</td>
    </tr>
    <tr>
        <td style="padding-left:22px;">6.1 Panduan Role 1: Super Admin (<code>superadmin@prodi.ac.id</code>)</td>
        <td style="text-align:right;">Sub-bab 6.1</td>
    </tr>
    <tr>
        <td style="padding-left:22px;">6.2 Panduan Role 2: Admin Prodi (<code>admin@prodi.ac.id</code>)</td>
        <td style="text-align:right;">Sub-bab 6.2</td>
    </tr>
    <tr>
        <td style="padding-left:22px;">6.3 Panduan Role 3: Editor Konten (<code>editor@prodi.ac.id</code>)</td>
        <td style="text-align:right;">Sub-bab 6.3</td>
    </tr>
    <tr>
        <td style="padding-left:22px;">6.4 Panduan Role 4: Dosen (<code>dosen@prodi.ac.id</code>)</td>
        <td style="text-align:right;">Sub-bab 6.4</td>
    </tr>
    <tr>
        <td style="padding-left:22px;">6.5 Panduan Role 5: Operator Akademik (<code>operator@prodi.ac.id</code>)</td>
        <td style="text-align:right;">Sub-bab 6.5</td>
    </tr>
    <tr>
        <td style="padding-left:22px;">6.6 Panduan Role 6: Pengunjung Publik / Mahasiswa (Frontend User)</td>
        <td style="text-align:right;">Sub-bab 6.6</td>
    </tr>
    <tr class="toc-chapter">
        <td>BAB 7. GALERI VISUAL & SCREENSHOT APLIKASI LENGKAP (10 TAMPILAN)</td>
        <td style="text-align:right;">Bagian 7</td>
    </tr>
    <tr class="toc-chapter">
        <td>BAB 8. PANDUAN INSTALASI CEPAT (QUICK START) & DEPLOYMENT</td>
        <td style="text-align:right;">Bagian 8</td>
    </tr>
</table>

<div class="callout" style="margin-top: 16px;">
    <strong>Petunjuk Penggunaan Manual:</strong> Setiap panduan role pengguna pada Bab 6 dilengkapi dengan urutan langkah bernomor (<em>step-by-step</em>), rute URL langsung (contoh: <code>/admin/posts</code>), serta tangkapan layar antarmuka asli aplikasi.
</div>

<div class="page-break"></div>

<!-- =========================================================
     BAB 1: DESKRIPSI APLIKASI
     ========================================================= -->
<h1 class="chapter-title">BAB 1. DESKRIPSI APLIKASI & FILOSOFI</h1>

<h2 class="section-title">1.1 Pengenalan & Filosofi BalaKutaK CMS</h2>
<p>
    <strong>BalaKutaK CMS</strong> adalah sistem manajemen konten (<em>Content Management System</em>) berbasis <em>open-source</em> generasi baru yang dirancang khusus untuk menyederhanakan proses pembangunan, pengelolaan, dan tata kelola portal web institusional tanpa mengorbankan performa maupun estetika. Mengusung filosofi <strong>"Ringan, Cerdas & Adaptif"</strong>, nama <em>BalaKutaK</em> (cumi-cumi/sotong dalam bahasa Sunda) melambangkan kecerdasan, kelincahan, dan kemampuan beradaptasi tinggi di berbagai ekosistem digital—sebagaimana sotong yang mampu menyesuaikan warna serta bentuknya secara instan di berbagai lingkungan.
</p>
<p>
    Meskipun dilengkapi dengan <strong>Academic Suite</strong> kelas atas yang sangat komprehensif untuk Perguruan Tinggi, Fakultas, dan Program Studi, arsitektur modular BalaKutaK CMS menjadikannya solusi multi-fungsi (<em>Multi-Purpose CMS</em>) yang sangat ideal untuk:
</p>
<ul>
    <li><strong>Perguruan Tinggi & Program Studi:</strong> Portal informasi akademik, profil dosen/SDM, struktur kurikulum, repositori riset & pengabdian masyarakat, kalender akademik, hingga sertifikat akreditasi.</li>
    <li><strong>Sekolah & Lembaga Pendidikan:</strong> Pengelolaan profil sekolah, pengumuman kelulusan/akademik, agenda kegiatan siswa, dan galeri dokumentasi.</li>
    <li><strong>Organisasi, LSM & Instansi Pemerintahan:</strong> Publikasi laporan kegiatan, transparansi dokumen publik, layanan informasi masyarakat, dan pengumuman resmi.</li>
    <li><strong>Perusahaan & Komunitas Digital:</strong> <em>Company profile</em> modern dengan fitur <em>Page Builder</em>, <em>Dynamic Theme Engine</em>, manajemen mitra kerjasama, dan sponsor.</li>
</ul>

<h2 class="section-title">1.2 Ruang Lingkup 6 Domain Ekosistem Modul</h2>
<table class="data-table">
    <thead>
        <tr>
            <th style="width: 26%;">Domain Modul</th>
            <th>Fitur & Kapabilitas Utama</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><strong>1. Immersive UI & Theme Engine</strong></td>
            <td>20+ tema warna premium (termasuk <em>Aurora Glass</em>, <em>Oxford Luxury</em>, <em>Stanford Grow</em>, <em>NavyBlue</em>, <em>GreenGold</em>), <em>Smart Dark Mode</em>, animasi AOS, serta efek <em>Glassmorphism</em> modern.</td>
        </tr>
        <tr>
            <td><strong>2. Editorial & Publikasi</strong></td>
            <td>Manajemen Berita & Artikel bilingual (ID/EN), Kategori, Tag, Pengumuman berprioritas, Agenda & Event dengan <em>countdown</em> dan tautan registrasi, serta Halaman Statis & FAQ.</td>
        </tr>
        <tr>
            <td><strong>3. Academic & Tridharma Suite</strong></td>
            <td>Direktori Dosen & Staf (Import/Export Excel), Struktur Kurikulum per semester (Import/Export Excel), Kalender Akademik, Layanan Akademik, Penelitian & Pengabdian (Import/Export Excel), serta Pusat Dokumen & Sertifikat Akreditasi.</td>
        </tr>
        <tr>
            <td><strong>4. Visual Site & Page Builder</strong></td>
            <td><em>Drag-and-Drop Menu Builder</em> untuk navigasi bertingkat (Header/Footer), <em>Visual Page Builder</em> untuk menyusun <em>landing page</em> tanpa coding, serta <em>Media Library</em> terpusat.</td>
        </tr>
        <tr>
            <td><strong>5. Interaktivitas & Inklusivitas</strong></td>
            <td>Widget <em>Smart Chatbot</em> interaktif, <em>Accessibility Toolbar</em> ramah disabilitas (Text-to-Speech, Kontras Tinggi, Grayscale, Perbesar Huruf), serta Formulir Kontak berproteksi Captcha.</td>
        </tr>
        <tr>
            <td><strong>6. Sistem, Keamanan & Tata Kelola</strong></td>
            <td>Manajemen Role & Permission (Spatie RBAC), <em>User Impersonation</em>, Pencadangan Otomatis/Manual (<code>.zip</code>), Manajemen SEO & Sitemap XML otomatis, serta Audit Log Aktivitas.</td>
        </tr>
    </tbody>
</table>

<div class="page-break"></div>

<!-- =========================================================
     BAB 2: ARSITEKTUR APLIKASI
     ========================================================= -->
<h1 class="chapter-title">BAB 2. ARSITEKTUR SISTEM & TEKNOLOGI</h1>

<h2 class="section-title">2.1 Diagram & Pola Arsitektur Berlapis (Multi-Tier MVC)</h2>
<p>
    BalaKutaK CMS dibangun di atas kerangka kerja <strong>Laravel 11.x (PHP 8.2+)</strong> menggunakan pola arsitektur <strong>Layered MVC (Model-View-Controller)</strong> yang memisahkan secara tegas empat lapisan utama:
</p>

<div class="arch-box">
    <strong>LAYER 1 — PRESENTATION & CLIENT LAYER (FRONTEND & ADMIN UI)</strong><br>
    Blade Engine &bull; Tailwind CSS 3 &bull; Bootstrap 5 &bull; AdminLTE 3.15 &bull; Alpine.js &bull; Dynamic Theme CSS &bull; Smart Chatbot &amp; Accessibility Widgets
</div>
<div class="arch-arrow">&darr; &uarr;</div>
<div class="arch-box">
    <strong>LAYER 2 — ROUTING, LOCALIZATION & SECURITY MIDDLEWARE LAYER</strong><br>
    Laravel Router &bull; <code>LaravelLocalization</code> (ID/EN) &bull; <code>AdminLocale</code> &bull; Spatie Role &amp; Permission Guard &bull; CSRF &amp; XSS Protection &bull; Dynamic Captcha
</div>
<div class="arch-arrow">&darr; &uarr;</div>
<div class="arch-box">
    <strong>LAYER 3 — APPLICATION & BUSINESS LOGIC LAYER (CONTROLLERS & CORE ENGINES)</strong><br>
    25+ Admin Controllers &bull; Frontend Controllers &bull; Maatwebsite Excel Import/Export &bull; DomPDF Generator &bull; Intervention Image 3 &bull; Lab404 Impersonate
</div>
<div class="arch-arrow">&darr; &uarr;</div>
<div class="arch-box">
    <strong>LAYER 4 — DATA ACCESS, PERSISTENCE & STORAGE LAYER</strong><br>
    Eloquent ORM &bull; MySQL / MariaDB Database &bull; Spatie Activitylog (Audit Trail) &bull; Spatie Backup (<code>.zip</code> Archive) &bull; Public &amp; Local Storage Disk
</div>

<h2 class="section-title">2.2 Struktur Direktori Utama</h2>
<ul>
    <li><code>app/Http/Controllers/Admin/</code> &mdash; Berisi 25+ <em>controller</em> khusus pengelolaan modul panel administrasi.</li>
    <li><code>app/Http/Controllers/Frontend/</code> &mdash; Berisi <em>controller</em> penyajian halaman publik, pencarian global, dokumen, dan akademik.</li>
    <li><code>app/Models/</code> &mdash; Representasi entitas Eloquent ORM beserta relasi, <em>scope</em>, dan konfigurasi <em>activity log</em>.</li>
    <li><code>config/adminlte.php</code> &mdash; Konfigurasi struktur navigasi sidebar admin yang terintegrasi dengan izin akses (<code>can</code>).</li>
    <li><code>database/migrations/ &amp; seeders/</code> &mdash; Skema tabel database dan generator data awal (<code>RolePermissionSeeder</code> &amp; <code>UserSeeder</code>).</li>
    <li><code>public/css/themes/</code> &mdash; Kumpulan 20+ stylesheet tema warna dinamis (Aurora Glass, Oxford Luxury, Stanford Grow, dll).</li>
    <li><code>resources/views/</code> &mdash; Template Blade untuk halaman <code>frontend/</code>, <code>admin/</code>, dan <code>auth/</code>.</li>
</ul>

<h2 class="section-title">2.3 Spesifikasi Stack Teknologi</h2>
<table class="data-table">
    <thead>
        <tr>
            <th style="width: 22%;">Kategori</th>
            <th style="width: 30%;">Teknologi / Library</th>
            <th>Kegunaan dalam Sistem</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><strong>Core Framework</strong></td>
            <td>Laravel 11.x &amp; PHP 8.2+</td>
            <td>Pondasi utama aplikasi backend, routing, autentikasi, dan keamanan.</td>
        </tr>
        <tr>
            <td><strong>Access Control</strong></td>
            <td>Spatie Laravel Permission 6.24</td>
            <td>Manajemen Role dan Permission tingkat lanjut (RBAC).</td>
        </tr>
        <tr>
            <td><strong>Impersonation</strong></td>
            <td>Lab404 Laravel Impersonate 1.7</td>
            <td>Memungkinkan Super Admin masuk sebagai user lain untuk simulasi &amp; <em>troubleshooting</em>.</td>
        </tr>
        <tr>
            <td><strong>Multilingual Engine</strong></td>
            <td>Mcamara Laravel Localization 2.3</td>
            <td>Manajemen rute dan konten dua bahasa (Bahasa Indonesia &amp; Bahasa Inggris).</td>
        </tr>
        <tr>
            <td><strong>Data Import/Export</strong></td>
            <td>Maatwebsite Laravel Excel 3.1</td>
            <td>Ekspor dan impor massal data Dosen, Kurikulum, serta Penelitian dalam format <code>.xlsx</code>.</td>
        </tr>
        <tr>
            <td><strong>Document &amp; Image</strong></td>
            <td>DomPDF 3.1 &amp; Intervention Image 3.11</td>
            <td>Pembuatan dokumen PDF dinamis dan optimasi ukuran gambar unggahan.</td>
        </tr>
        <tr>
            <td><strong>Backup &amp; Audit</strong></td>
            <td>Spatie Backup 9.3 &amp; Activitylog 4.11</td>
            <td>Pencadangan penuh database/file ke ZIP dan pencatatan riwayat aktivitas pengguna.</td>
        </tr>
    </tbody>
</table>

<div class="page-break"></div>

<!-- =========================================================
     BAB 3: PROSES BISNIS APLIKASI
     ========================================================= -->
<h1 class="chapter-title">BAB 3. PROSES BISNIS APLIKASI</h1>

<p>
    Proses bisnis dalam <strong>BalaKutaK CMS</strong> dirancang mengikuti siklus tata kelola informasi institusi modern yang melibatkan kolaborasi lintas peran (<em>multi-role collaboration</em>) mulai dari perencanaan konten, validasi akademik, publikasi bilingual, hingga interaksi pengunjung dan pemeliharaan sistem.
</p>

<h2 class="section-title">3.1 Alur Bisnis Publikasi &amp; Editorial Konten (Editorial Workflow)</h2>
<ol>
    <li><strong>Inisiasi &amp; Penulisan Draft:</strong> <em>Dosen</em> atau <em>Editor Konten</em> membuat entri berita/artikel baru melalui modul <strong>Berita &amp; Artikel</strong>, melengkapi teks Bahasa Indonesia dan Bahasa Inggris, memilih Kategori/Tag, serta mengunggah gambar unggulan melalui <em>Media Library</em>. Artikel dapat disimpan berstatus <strong>Draft</strong>.</li>
    <li><strong>Kurasi, Optimasi SEO &amp; Publikasi:</strong> <em>Editor Konten</em>, <em>Admin Prodi</em>, atau <em>Super Admin</em> meninjau kelayakan artikel, menyempurnakan <em>Meta Title</em> dan <em>Meta Description</em> untuk SEO, lalu mengubah status menjadi <strong>Published</strong>.</li>
    <li><strong>Distribusi &amp; Indeksasi Otomatis:</strong> Sistem secara otomatis menampilkan artikel di Beranda dan Portal Berita sesuai bahasa aktif pengguna, serta memperbarui <code>/sitemap.xml</code> agar langsung terindeks mesin pencari.</li>
</ol>

<h2 class="section-title">3.2 Alur Bisnis Pengelolaan Akademik &amp; Tridharma (Academic Workflow)</h2>
<ol>
    <li><strong>Pembaruan Data Master Akademik:</strong> <em>Admin Prodi</em> mengelola data Dosen/SDM, sedangkan <em>Operator Akademik</em> bersama <em>Admin Prodi</em> memperbarui struktur Kurikulum per semester, Kalender Akademik, dan Layanan Akademik.</li>
    <li><strong>Operasi Data Massal (Bulk Excel Processing):</strong> Untuk efisiensi pada pergantian semester, pengguna mengunduh <em>Template Excel Resmi</em> dari sistem, mengisi ratusan baris data (Dosen, Kurikulum, atau Penelitian &amp; Pengabdian), lalu mengunggahnya kembali melalui fitur <strong>Import Excel</strong>. Sistem memvalidasi struktur kolom secara otomatis.</li>
    <li><strong>Arsip Dokumen &amp; Akreditasi:</strong> Dokumen SK, pedoman akademik, modul kuliah, serta Sertifikat Akreditasi diunggah ke modul <strong>Dokumen</strong> &amp; <strong>Pengaturan Akademik</strong>, sehingga publik dan asesor akreditasi dapat melakukan pratinjau (<em>live viewer</em>) maupun mengunduh file secara langsung.</li>
</ol>

<h2 class="section-title">3.3 Alur Bisnis Interaksi Publik &amp; Layanan Pengunjung</h2>
<ol>
    <li><strong>Akses Portal &amp; Personalisasi:</strong> Pengunjung membuka website, memilih bahasa (ID/EN), mengatur mode tampilan (Terang/Gelap), atau mengaktifkan fitur <em>Accessibility</em> (Text-to-Speech, Kontras Tinggi, Perbesar Font) bagi penyandang disabilitas.</li>
    <li><strong>Asistensi Pintar &amp; Pencarian:</strong> Pengunjung mencari informasi melalui fitur <em>Global Search</em> atau berinteraksi dengan <strong>Smart Chatbot</strong> untuk mendapatkan jawaban instan terkait profil, kurikulum, layanan, dan agenda.</li>
    <li><strong>Partisipasi Event &amp; Komunikasi:</strong> Pengunjung melihat hitung mundur (<em>countdown</em>) kegiatan pada modul <strong>Agenda &amp; Event</strong> dan melakukan registrasi melalui tautan pendaftaran, atau mengirimkan pesan/pertanyaan melalui <strong>Formulir Kontak</strong> (dilindungi Captcha).</li>
    <li><strong>Tindak Lanjut Admin:</strong> Pesan masuk tercatat di menu <strong>Pesan Kontak</strong> dan notifikasi Dashboard. <em>Admin Prodi</em> atau <em>Super Admin</em> membaca dan mengirimkan balasan resmi langsung dari panel admin.</li>
</ol>

<h2 class="section-title">3.4 Alur Bisnis Tata Kelola Sistem &amp; Pemeliharaan (System Governance)</h2>
<ol>
    <li><strong>Kustomisasi Identitas &amp; Navigasi:</strong> <em>Admin Prodi</em> / <em>Super Admin</em> memperbarui identitas situs, memilih tema warna di <strong>Pengaturan Tema</strong>, serta menyusun struktur navigasi melalui <strong>Menu Builder</strong> dan tata letak halaman kustom melalui <strong>Page Builder</strong>.</li>
    <li><strong>Audit &amp; Pencadangan Berkala:</strong> Seluruh tindakan krusial tercatat di <strong>Log Aktivitas Dashboard</strong>. <em>Super Admin</em> menjalankan pencadangan manual atau menjadwalkan <strong>Automated Backup</strong> (Harian/Mingguan/Bulanan) untuk mengamankan database dan aset file ke dalam arsip <code>.zip</code>.</li>
</ol>

<div class="page-break"></div>

<!-- =========================================================
     BAB 4: REGULASI APLIKASI
     ========================================================= -->
<h1 class="chapter-title">BAB 4. REGULASI, KEBIJAKAN &amp; STANDAR APLIKASI</h1>

<p>
    Untuk menjamin keamanan informasi, kepatuhan hukum, konsistensi mutu akademik, serta ketersediaan layanan yang berkelanjutan, <strong>BalaKutaK CMS</strong> menerapkan sejumlah regulasi dan kebijakan sistem yang wajib dipatuhi oleh seluruh pengelola.
</p>

<h2 class="section-title">4.1 Regulasi Hak Akses &amp; Otorisasi (RBAC Policy)</h2>
<p>
    Aplikasi menerapkan prinsip <strong>Least Privilege (Hak Akses Minimum yang Diperlukan)</strong> menggunakan matriks <em>Role-Based Access Control (RBAC)</em>:
</p>
<table class="data-table">
    <thead>
        <tr>
            <th>Modul / Kapabilitas</th>
            <th style="text-align:center;">Super Admin</th>
            <th style="text-align:center;">Admin Prodi</th>
            <th style="text-align:center;">Editor Konten</th>
            <th style="text-align:center;">Dosen</th>
            <th style="text-align:center;">Operator Akademik</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Dashboard &amp; Statistik</td>
            <td style="text-align:center;">Full</td>
            <td style="text-align:center;">Full</td>
            <td style="text-align:center;">View</td>
            <td style="text-align:center;">View</td>
            <td style="text-align:center;">View</td>
        </tr>
        <tr>
            <td>Berita &amp; Artikel (Posts)</td>
            <td style="text-align:center;">CRUD + Publish</td>
            <td style="text-align:center;">CRUD + Publish</td>
            <td style="text-align:center;">Create/Edit/Publish</td>
            <td style="text-align:center;">Create/Edit</td>
            <td style="text-align:center;">-</td>
        </tr>
        <tr>
            <td>Kategori &amp; Tag</td>
            <td style="text-align:center;">CRUD</td>
            <td style="text-align:center;">Create/Edit</td>
            <td style="text-align:center;">View</td>
            <td style="text-align:center;">-</td>
            <td style="text-align:center;">-</td>
        </tr>
        <tr>
            <td>Pengumuman &amp; Agenda Event</td>
            <td style="text-align:center;">CRUD</td>
            <td style="text-align:center;">CRUD</td>
            <td style="text-align:center;">Create/Edit</td>
            <td style="text-align:center;">-</td>
            <td style="text-align:center;">Create/Edit</td>
        </tr>
        <tr>
            <td>Halaman Statis, FAQ &amp; Galeri</td>
            <td style="text-align:center;">CRUD</td>
            <td style="text-align:center;">CRUD</td>
            <td style="text-align:center;">Create/Edit</td>
            <td style="text-align:center;">-</td>
            <td style="text-align:center;">-</td>
        </tr>
        <tr>
            <td>SDM / Dosen (Import/Export)</td>
            <td style="text-align:center;">CRUD</td>
            <td style="text-align:center;">CRUD</td>
            <td style="text-align:center;">-</td>
            <td style="text-align:center;">-</td>
            <td style="text-align:center;">-</td>
        </tr>
        <tr>
            <td>Kurikulum &amp; Dokumen Resmi</td>
            <td style="text-align:center;">CRUD</td>
            <td style="text-align:center;">CRUD</td>
            <td style="text-align:center;">-</td>
            <td style="text-align:center;">-</td>
            <td style="text-align:center;">Create/Edit</td>
        </tr>
        <tr>
            <td>Slider, Mitra, Testimoni, Menu</td>
            <td style="text-align:center;">CRUD</td>
            <td style="text-align:center;">CRUD / Approve</td>
            <td style="text-align:center;">-</td>
            <td style="text-align:center;">-</td>
            <td style="text-align:center;">-</td>
        </tr>
        <tr>
            <td>Media Library</td>
            <td style="text-align:center;">Upload/Delete</td>
            <td style="text-align:center;">Upload/Delete</td>
            <td style="text-align:center;">Upload/View</td>
            <td style="text-align:center;">Upload/View</td>
            <td style="text-align:center;">Upload/View</td>
        </tr>
        <tr>
            <td>Pengaturan Situs, Tema &amp; Kontak</td>
            <td style="text-align:center;">Full</td>
            <td style="text-align:center;">Full</td>
            <td style="text-align:center;">-</td>
            <td style="text-align:center;">-</td>
            <td style="text-align:center;">-</td>
        </tr>
        <tr>
            <td>Kelola User, Impersonate &amp; Backup</td>
            <td style="text-align:center;"><strong>Exclusive</strong></td>
            <td style="text-align:center;">-</td>
            <td style="text-align:center;">-</td>
            <td style="text-align:center;">-</td>
            <td style="text-align:center;">-</td>
        </tr>
    </tbody>
</table>

<h2 class="section-title">4.2 Regulasi Keamanan Siber &amp; Pelindungan Data</h2>
<ul>
    <li><strong>Enkripsi &amp; Kredensial:</strong> Seluruh kata sandi disimpan menggunakan algoritma hashing satu arah (<em>Bcrypt</em>). Pengguna wajib mengganti password bawaan seeder pada lingkungan produksi.</li>
    <li><strong>Proteksi Formulir &amp; Transmisi:</strong> Setiap permintaan perubahan data wajib menyertakan <em>CSRF Token</em> aktif. Formulir kontak publik wajib melewati verifikasi <em>Dynamic Image Captcha</em> untuk mencegah <em>spamming</em> otomatis.</li>
    <li><strong>Validasi File Unggahan:</strong> Unggahan gambar, dokumen PDF, dan file Excel divalidasi berdasarkan ekstensi dan <em>MIME-type</em> untuk mencegah eksekusi skrip berbahaya.</li>
    <li><strong>Auditabilitas (Audit Trail):</strong> Setiap aktivitas penambahan, pengubahan, dan penghapusan data terekam di dalam log aktivitas sistem beserta identitas pengguna dan cap waktu (<em>timestamp</em>).</li>
</ul>

<h2 class="section-title">4.3 Regulasi Standar Publikasi, Aksesibilitas &amp; Disaster Recovery</h2>
<ul>
    <li><strong>Standar Konten Dwibahasa (Bilingual Standard):</strong> Untuk mendukung internasionalisasi institusi, setiap konten utama memiliki dukungan penuh field Bahasa Indonesia (ID) dan Bahasa Inggris (EN).</li>
    <li><strong>Standar Inklusivitas &amp; Aksesibilitas Web:</strong> Website menyediakan fitur ramah disabilitas (<em>Text-to-Speech</em> Bahasa Indonesia, Kontras Tinggi, Grayscale, Highlight Link, dan Pengaturan Ukuran Font).</li>
    <li><strong>Kebijakan Pencadangan (Backup Policy):</strong> <em>Super Admin</em> wajib mengaktifkan jadwal backup otomatis minimal mingguan dan menyimpan salinan file <code>.zip</code> di penyimpanan eksternal yang aman.</li>
</ul>

<div class="page-break"></div>

<!-- =========================================================
     BAB 5: KEUNGGULAN APLIKASI
     ========================================================= -->
<h1 class="chapter-title">BAB 5. KEUNGGULAN KOMPARATIF APLIKASI</h1>

<p>
    Dibandingkan dengan CMS generik maupun pembuatan website statis konvensional, <strong>BalaKutaK CMS</strong> menghadirkan 8 keunggulan utama yang menjadikannya standar baru pengelolaan portal institusi dan akademik:
</p>

<table class="data-table">
    <thead>
        <tr>
            <th style="width: 5%;">#</th>
            <th style="width: 29%;">Pilar Keunggulan</th>
            <th>Detail Keunggulan &amp; Nilai Tambah</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><strong>1</strong></td>
            <td><strong>Dynamic Multi-Theme Engine (20+ Tema Premium)</strong></td>
            <td>Ubah tampilan dan nuansa seluruh website secara instan hanya dengan 1 klik tanpa mengubah kode. Tersedia tema eksklusif seperti <em>Aurora Glass</em> (efek glassmorphism futuristik), <em>Oxford Luxury</em> (NavyGold, RedGold, GreenGold, BlackGold), dan <em>Stanford Grow</em>.</td>
        </tr>
        <tr>
            <td><strong>2</strong></td>
            <td><strong>All-in-One Academic &amp; Accreditation Suite</strong></td>
            <td>Sudah mencakup seluruh modul yang dibutuhkan untuk penilaian akreditasi (BAN-PT / LAM): Direktori Dosen ber-NIDN, Kurikulum Semester, Kalender Akademik, Penelitian &amp; Pengabdian, Layanan Mahasiswa, hingga <em>Interactive Accreditation Certificate Viewer</em>.</td>
        </tr>
        <tr>
            <td><strong>3</strong></td>
            <td><strong>No-Code Drag &amp; Drop Menu &amp; Page Builder</strong></td>
            <td>Pengelola non-teknis dapat menyusun menu bertingkat (Header &amp; Footer) serta merancang halaman <em>Landing Page</em> kustom blok demi blok secara visual tanpa perlu menyentuh kode HTML/PHP.</td>
        </tr>
        <tr>
            <td><strong>4</strong></td>
            <td><strong>Built-in Smart Chatbot &amp; Accessibility Suite</strong></td>
            <td>Dilengkapi asisten virtual pintar (Chatbot) dan panel aksesibilitas disabilitas (termasuk pembaca layar <em>Text-to-Speech</em>) yang warnanya beradaptasi otomatis mengikuti palet tema aktif dan memiliki tata letak anti-bentrok.</td>
        </tr>
        <tr>
            <td><strong>5</strong></td>
            <td><strong>High-Speed Bulk Excel Import &amp; Export</strong></td>
            <td>Memangkas waktu input data akademik hingga 90% berkat fitur <em>Export to Excel (<code>.xlsx</code>)</em>, <em>Download Template</em>, dan <em>Bulk Import / Re-import</em> pada modul Dosen, Kurikulum, Penelitian, dan Artikel.</td>
        </tr>
        <tr>
            <td><strong>6</strong></td>
            <td><strong>Role Impersonation &amp; Granular RBAC</strong></td>
            <td>Super Admin dapat masuk ke akun pengguna lain (<em>Impersonate</em>) dengan 1 klik untuk menguji tampilan atau membantu menyelesaikan kendala pengguna tanpa perlu meminta password mereka.</td>
        </tr>
        <tr>
            <td><strong>7</strong></td>
            <td><strong>Integrated One-Click &amp; Scheduled Backup</strong></td>
            <td>Tidak perlu akses cPanel/SSH untuk mencadangkan data. Seluruh database dan aset sistem dapat dicadangkan secara instan atau terjadwal ke file <code>.zip</code> langsung dari dashboard.</td>
        </tr>
        <tr>
            <td><strong>8</strong></td>
            <td><strong>Ultra-Lightweight &amp; SEO Ready</strong></td>
            <td>Kode sumber bersih berbasis Laravel 11 menghasilkan kecepatan muat halaman yang sangat tinggi, dilengkapi manajemen Meta SEO per halaman serta pembuatan <code>sitemap.xml</code> dan <code>robots.txt</code> dinamis.</td>
        </tr>
    </tbody>
</table>

<div class="page-break"></div>

<!-- =========================================================
     BAB 6: PANDUAN STEP-BY-STEP SEMUA ROLE USER
     ========================================================= -->
<h1 class="chapter-title">BAB 6. PANDUAN PENGGUNAAN DETAIL SEMUA ROLE USER</h1>

<p>
    Bab ini menyajikan panduan operasional langkah demi langkah (<em>step-by-step</em>) untuk seluruh <strong>6 Role Pengguna</strong> pada ekosistem <strong>BalaKutaK CMS</strong>. Berikut adalah daftar akun bawaan (<em>Default Seeder Credentials</em>) yang tersedia setelah instalasi:
</p>

<table class="data-table">
    <thead>
        <tr>
            <th>No</th>
            <th>Role Pengguna</th>
            <th>Email Login Default</th>
            <th>Password Default</th>
            <th>Fokus Tanggung Jawab Utama</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>1</td>
            <td><strong>Super Admin</strong></td>
            <td><code>superadmin@prodi.ac.id</code></td>
            <td><code>password</code></td>
            <td>Otoritas penuh sistem, manajemen user/role, impersonasi, pengaturan inti, tema, &amp; backup.</td>
        </tr>
        <tr>
            <td>2</td>
            <td><strong>Admin Prodi</strong></td>
            <td><code>admin@prodi.ac.id</code></td>
            <td><code>password</code></td>
            <td>Manajemen operasional prodi, SDM dosen, kurikulum, riset, profil, menu, slider, &amp; pesan kontak.</td>
        </tr>
        <tr>
            <td>3</td>
            <td><strong>Editor Konten</strong></td>
            <td><code>editor@prodi.ac.id</code></td>
            <td><code>password</code></td>
            <td>Publikasi berita/artikel, pengumuman, halaman statis, agenda/event, galeri, &amp; media library.</td>
        </tr>
        <tr>
            <td>4</td>
            <td><strong>Dosen</strong></td>
            <td><code>dosen@prodi.ac.id</code></td>
            <td><code>password</code></td>
            <td>Penulisan artikel ilmiah/berita populer dosen dan pengunggahan media pendukung.</td>
        </tr>
        <tr>
            <td>5</td>
            <td><strong>Operator Akademik</strong></td>
            <td><code>operator@prodi.ac.id</code></td>
            <td><code>password</code></td>
            <td>Administrasi kurikulum semester, repositori dokumen resmi, pengumuman, &amp; jadwal agenda.</td>
        </tr>
        <tr>
            <td>6</td>
            <td><strong>Pengunjung Publik</strong></td>
            <td><em>Tanpa Login (Publik)</em></td>
            <td><em>-</em></td>
            <td>Akses informasi akademik, baca berita, unduh dokumen, daftar event, chatbot &amp; kontak.</td>
        </tr>
    </tbody>
</table>

@if($ssLogin)
<div class="screenshot-box">
    <img src="{{ $ssLogin }}" alt="Halaman Login BalaKutaK CMS">
    <div class="screenshot-caption">Gambar 6.1 — Halaman Login Resmi BalaKutaK CMS dengan Fitur Show/Hide Password</div>
</div>
@endif

<!-- ROLE 1: SUPER ADMIN -->
<h2 class="section-title">6.1 Panduan Role 1: Super Admin (<code>superadmin@prodi.ac.id</code>)</h2>
<div class="role-card">
    <span class="badge">OTORITAS TERTINGGI (FULL ACCESS)</span>
    <p style="margin-top:4px; margin-bottom:0;">
        <strong>Super Admin</strong> memegang kendali penuh atas seluruh fitur aplikasi, termasuk modul sensitif yang dikunci khusus untuk peran ini: <strong>Kelola User</strong>, <strong>Impersonate User</strong>, dan <strong>Backup Sistem</strong>.
    </p>
</div>

<div class="step-box"><span class="step-num">1</span> <strong>Login &amp; Monitoring Dashboard Utama:</strong> Buka <code>/login</code>, masukkan email <code>superadmin@prodi.ac.id</code> dan kata sandi <code>password</code> (gunakan ikon mata untuk melihat kata sandi), lalu klik <strong>Masuk</strong>. Pada halaman <strong>Dashboard</strong> (<code>/admin</code>), pantau <em>Info Box</em> ringkasan data, grafik <em>Statistik Pengunjung</em>, serta tabel <em>Log Aktivitas Terbaru</em>.</div>
@if($ssDashboard)
<div class="screenshot-box">
    <img src="{{ $ssDashboard }}" alt="Admin Dashboard">
    <div class="screenshot-caption">Gambar 6.2 — Tampilan Dashboard Utama Panel Administrasi</div>
</div>
@endif

<div class="step-box"><span class="step-num">2</span> <strong>Manajemen Pengguna &amp; Hak Akses (Kelola User):</strong>
    <ul>
        <li>Klik menu <strong>SISTEM &raquo; Kelola User</strong> (<code>/admin/users</code>).</li>
        <li>Klik tombol <strong>+ Tambah User</strong> untuk membuat akun baru. Isi Nama Lengkap, Email, Password, Status (Active/Inactive), dan pilih <strong>Role</strong> (Super Admin, Admin Prodi, Editor Konten, Dosen, atau Operator Akademik).</li>
        <li>Klik <strong>Simpan</strong>. Hak akses menu sidebar pengguna tersebut akan otomatis menyesuaikan role yang dipilih.</li>
    </ul>
</div>

<div class="step-box"><span class="step-num">3</span> <strong>Menggunakan Fitur Impersonate (Masuk Sebagai User Lain):</strong>
    <ul>
        <li>Pada tabel daftar pengguna di menu <strong>Kelola User</strong>, klik tombol kuning berikon kunci/orang (<strong>Impersonate</strong>) pada baris pengguna yang ingin disimulasikan.</li>
        <li>Sistem akan langsung mengalihkan sesi Anda menjadi pengguna tersebut tanpa perlu kata sandi.</li>
        <li>Untuk kembali ke akun Super Admin, klik tombol <strong>"Leave Impersonation / Kembali ke Akun Asli"</strong> di bagian atas layar.</li>
    </ul>
</div>

<div class="step-box"><span class="step-num">4</span> <strong>Mengganti Tema Website (Dynamic Theme Engine):</strong>
    <ul>
        <li>Buka menu <strong>SISTEM &raquo; Pengaturan &raquo; Tema</strong> (<code>/admin/settings/appearance</code>).</li>
        <li>Pilih salah satu kartu pratinjau tema warna (misalnya <em>Aurora Glass</em>, <em>Oxford Luxury NavyGold</em>, <em>Green Gold</em>, dll).</li>
        <li>Klik <strong>Simpan Pengaturan</strong>. Seluruh halaman publik, widget Chatbot, dan widget Aksesibilitas otomatis berubah mengikuti tema baru.</li>
    </ul>
</div>
@if($ssThemes)
<div class="screenshot-box">
    <img src="{{ $ssThemes }}" alt="Pengaturan Tema">
    <div class="screenshot-caption">Gambar 6.3 — Modul Dynamic Theme Engine pada Pengaturan Tampilan</div>
</div>
@endif

<div class="step-box"><span class="step-num">5</span> <strong>Menyusun Navigasi dengan Menu Builder &amp; Page Builder:</strong>
    <ul>
        <li>Buka menu <strong>SISTEM &raquo; Menu Builder</strong> (<code>/admin/menus</code>) untuk mengatur menu Header maupun Footer.</li>
        <li>Tambahkan item dari <em>Halaman Dinamis</em>, <em>Halaman Statis</em>, <em>Builder Page</em>, atau <em>Custom URL</em>. Seret dan lepas (<em>drag &amp; drop</em>) item ke kanan untuk membuat sub-menu dropdown, lalu klik <strong>Simpan Urutan Menu</strong>.</li>
        <li>Untuk membuat halaman kustom dengan blok visual, buka <strong>SISTEM &raquo; Page Builder &raquo; Tambah Halaman</strong>.</li>
    </ul>
</div>
@if($ssMenus)
<div class="screenshot-box">
    <img src="{{ $ssMenus }}" alt="Menu Builder">
    <div class="screenshot-caption">Gambar 6.4 — Antarmuka Drag &amp; Drop Menu Builder</div>
</div>
@endif

<div class="step-box"><span class="step-num">6</span> <strong>Manajemen Pencadangan Sistem (Backup Database &amp; File):</strong>
    <ul>
        <li>Buka menu <strong>SISTEM &raquo; Backup</strong> (<code>/admin/backups</code>).</li>
        <li>Klik tombol <strong>Buat Backup Baru</strong> untuk langsung mengarsipkan seluruh database dan file unggahan ke format <code>.zip</code>.</li>
        <li>Atur jadwal pencadangan otomatis pada panel <strong>Jadwal Backup</strong> (Harian/Mingguan/Bulanan) dan unduh file <code>.zip</code> ke komputer lokal Anda secara berkala.</li>
    </ul>
</div>
@if($ssBackups)
<div class="screenshot-box">
    <img src="{{ $ssBackups }}" alt="Backup Sistem">
    <div class="screenshot-caption">Gambar 6.5 — Modul Manajemen Backup Sistem &amp; Penjadwalan Otomatis</div>
</div>
@endif

<div class="step-box"><span class="step-num">7</span> <strong>Keamanan Berlapis dengan YantoSedunia Protection Guard:</strong>
    <ul>
        <li>Buka menu <strong>SISTEM &raquo; Protection Guard</strong> (<code>/admin/security-guard</code>).</li>
        <li>Pantau grafik tren ancaman 7 hari, daftar insiden (SQLi, XSS, LFI, RCE, Scanner, Brute Force), serta kelola pemblokiran IP otomatis/manual (<strong>IP Reputation &amp; Blocking</strong>).</li>
        <li>Gunakan tab <strong>Security Audit &amp; Integrity</strong> dan tombol <strong>Jalankan Security Cleanup</strong> untuk memindai konfigurasi keamanan serta membersihkan artefak berbahaya secara otomatis.</li>
    </ul>
</div>

<!-- ROLE 2: ADMIN PRODI -->
<h2 class="section-title">6.2 Panduan Role 2: Admin Prodi (<code>admin@prodi.ac.id</code>)</h2>
<div class="role-card">
    <span class="badge">MANAJER OPERASIONAL &amp; AKADEMIK</span>
    <p style="margin-top:4px; margin-bottom:0;">
        <strong>Admin Prodi</strong> bertanggung jawab mengelola seluruh data akademik, profil institusi, SDM/dosen, kurikulum, penelitian &amp; pengabdian, elemen beranda (slider, mitra, sponsor, infografis, testimoni), serta membalas pesan pengunjung.
    </p>
</div>

<div class="step-box"><span class="step-num">1</span> <strong>Mengelola Profil Institusi, Akreditasi &amp; Info Grafis:</strong>
    <ul>
        <li>Buka <strong>MODUL HALAMAN &raquo; Manajemen Profil</strong> (<code>/admin/settings/profile</code>) untuk memperbarui Sejarah, Visi &amp; Misi, Sambutan Pimpinan, serta URL Video Profil YouTube.</li>
        <li>Buka <strong>SISTEM &raquo; Pengaturan &raquo; Akademik</strong> (<code>/admin/settings/academic</code>) untuk mengunggah file <strong>Sertifikat Akreditasi</strong> (PDF/Gambar) dan memperbarui status akreditasi.</li>
        <li>Buka <strong>SISTEM &raquo; Pengaturan &raquo; Info Grafis</strong> (<code>/admin/infographics</code>) untuk memperbarui angka statistik capaian di beranda.</li>
    </ul>
</div>

<div class="step-box"><span class="step-num">2</span> <strong>Mengelola Sumber Daya Manusia (Dosen &amp; Staf):</strong>
    <ul>
        <li>Buka <strong>MODUL HALAMAN &raquo; Sumber Daya Manusia</strong> (<code>/admin/lecturers</code>).</li>
        <li><strong>Input Manual:</strong> Klik <strong>+ Tambah Dosen</strong>, lengkapi Nama, NIDN, Jabatan Fungsional, Bidang Keahlian, Pendidikan, Email, dan Foto Profil, lalu klik <strong>Simpan</strong>.</li>
        <li><strong>Import Massal Excel:</strong> Klik <strong>Download Template</strong>, isi daftar dosen di Microsoft Excel, lalu klik <strong>Import Excel</strong> dan unggah file <code>.xlsx</code> Anda. Gunakan tombol <strong>Export Excel</strong> untuk mengunduh rekapitulasi data dosen.</li>
    </ul>
</div>

<div class="step-box"><span class="step-num">3</span> <strong>Mengelola Kurikulum, Kalender &amp; Layanan Akademik:</strong>
    <ul>
        <li>Buka <strong>MODUL HALAMAN &raquo; Kurikulum</strong> (<code>/admin/curriculums</code>) untuk menambah mata kuliah per semester (Kode MK, Nama MK ID/EN, SKS, Semester, Kategori Wajib/Pilihan) secara manual maupun via <strong>Import/Export Excel</strong>.</li>
        <li>Buka <strong>Kalender Akademik</strong> (<code>/admin/academic-calendars</code>) untuk mempublikasikan jadwal akademik tahun ajaran berjalan.</li>
        <li>Buka <strong>Layanan Akademik</strong> (<code>/admin/academic-services</code>) untuk menyediakan tautan cepat layanan mahasiswa (KRS, Beasiswa, Magang, Tugas Akhir, Perpustakaan).</li>
    </ul>
</div>

<div class="step-box"><span class="step-num">4</span> <strong>Mengelola Penelitian &amp; Pengabdian Masyarakat:</strong>
    <ul>
        <li>Buka <strong>MODUL HALAMAN &raquo; Penelitian &amp; Pengabdian</strong> (<code>/admin/research-services</code>).</li>
        <li>Tambahkan data riset atau pengabdian dosen beserta tahun pelaksanaan, ketua peneliti, sumber dana, abstrak, dan tautan publikasi/jurnal.</li>
        <li>Gunakan fitur <strong>Import Excel</strong>, <strong>Download Template</strong>, dan <strong>Export Excel</strong> untuk sinkronisasi cepat dengan data LPPM/SINTA.</li>
    </ul>
</div>

<div class="step-box"><span class="step-num">5</span> <strong>Mengelola Slider, Mitra Kerjasama, Sponsor &amp; Testimoni Alumni:</strong>
    <ul>
        <li>Buka <strong>KONTEN WEBSITE &raquo; Slider/Banner</strong> (<code>/admin/sliders</code>) untuk mengatur banner hero halaman utama dan mengurutkannya secara <em>drag-and-drop</em>.</li>
        <li>Buka <strong>Mitra Kerjasama</strong> (<code>/admin/partners</code>) dan <strong>Pengaturan &raquo; Sponsor</strong> (<code>/admin/sponsors</code>) untuk mengunggah logo institusi mitra/sponsor.</li>
        <li>Buka <strong>Testimoni Alumni</strong> (<code>/admin/testimonials</code>) dan klik tombol <em>Toggle Status</em> untuk menyetujui (<em>Approve</em>) testimoni agar tampil di halaman depan.</li>
    </ul>
</div>

<div class="step-box"><span class="step-num">6</span> <strong>Menanggapi Pesan Kontak Masuk:</strong>
    <ul>
        <li>Buka <strong>SISTEM &raquo; Pesan Kontak</strong> (<code>/admin/contact-messages</code>).</li>
        <li>Klik tombol <strong>Lihat Detail</strong> pada pesan yang masuk, tulis tanggapan resmi pada kolom balasan, lalu klik <strong>Kirim Balasan</strong>.</li>
    </ul>
</div>

<!-- ROLE 3: EDITOR KONTEN -->
<h2 class="section-title">6.3 Panduan Role 3: Editor Konten (<code>editor@prodi.ac.id</code>)</h2>
<div class="role-card">
    <span class="badge">TIM REDAKSI, PUBLIKASI &amp; MEDIA</span>
    <p style="margin-top:4px; margin-bottom:0;">
        <strong>Editor Konten</strong> berfokus pada pengelolaan publikasi harian website: Berita &amp; Artikel, Pengumuman, Halaman Statis, Agenda/Event, Galeri Foto, dan Media Library.
    </p>
</div>

<div class="step-box"><span class="step-num">1</span> <strong>Membuat &amp; Mempublikasikan Berita / Artikel:</strong>
    <ul>
        <li>Buka <strong>KONTEN WEBSITE &raquo; Berita &amp; Artikel &raquo; Tambah Artikel</strong> (<code>/admin/posts/create</code>).</li>
        <li>Masukkan Judul dan Isi Artikel pada tab <strong>Bahasa Indonesia</strong> dan tab <strong>English</strong> menggunakan <em>Rich Text Editor</em>.</li>
        <li>Pilih <strong>Kategori</strong>, tambahkan <strong>Tag</strong>, dan pilih <strong>Gambar Unggulan (Featured Image)</strong> dari <em>Media Picker</em>.</li>
        <li>Isi bagian <strong>SEO Meta Title &amp; Description</strong>, pilih status <strong>Published</strong> (atau <strong>Draft</strong> jika belum siap tayang), lalu klik <strong>Simpan Artikel</strong>.</li>
    </ul>
</div>
@if($ssPosts)
<div class="screenshot-box">
    <img src="{{ $ssPosts }}" alt="Manajemen Artikel">
    <div class="screenshot-caption">Gambar 6.6 — Modul Manajemen Berita &amp; Artikel dengan Filter dan Pencarian Cepat</div>
</div>
@endif

<div class="step-box"><span class="step-num">2</span> <strong>Mempublikasikan Pengumuman &amp; Agenda Kegiatan:</strong>
    <ul>
        <li>Buka <strong>KONTEN WEBSITE &raquo; Pengumuman</strong> (<code>/admin/announcements</code>) untuk membuat pengumuman penting (mendukung lampiran dokumen/PDF dan tampilan berjalan <em>ticker/marquee</em>).</li>
        <li>Buka <strong>Agenda &amp; Event</strong> (<code>/admin/events</code>) untuk menjadwalkan seminar/workshop. Isi Tanggal Mulai &amp; Selesai, Lokasi, Poster Kegiatan, serta <strong>URL Pendaftaran (Registration URL)</strong> agar tombol daftar aktif di halaman publik.</li>
    </ul>
</div>

<div class="step-box"><span class="step-num">3</span> <strong>Mengelola Halaman Statis, Galeri &amp; Media Library:</strong>
    <ul>
        <li>Buka <strong>Halaman Statis</strong> (<code>/admin/pages</code>) untuk menyunting konten halaman informatif dan <strong>FAQs</strong> (<code>/admin/faqs</code>) untuk daftar tanya-jawab umum.</li>
        <li>Buka <strong>Galeri</strong> (<code>/admin/gallery</code>) untuk mengunggah dokumentasi foto/video kegiatan berdasarkan kategori album.</li>
        <li>Buka <strong>SISTEM &raquo; Media Library</strong> (<code>/admin/media</code>) untuk mengelola seluruh aset gambar dan membuat struktur folder penyimpanan.</li>
    </ul>
</div>
@if($ssGallery)
<div class="screenshot-box">
    <img src="{{ $ssGallery }}" alt="Manajemen Galeri">
    <div class="screenshot-caption">Gambar 6.7 — Modul Manajemen Galeri &amp; Dokumentasi Visual</div>
</div>
@endif

<!-- ROLE 4: DOSEN -->
<h2 class="section-title">6.4 Panduan Role 4: Dosen (<code>dosen@prodi.ac.id</code>)</h2>
<div class="role-card">
    <span class="badge">KONTRIBUTOR ARTIKEL AKADEMIK &amp; POPULER</span>
    <p style="margin-top:4px; margin-bottom:0;">
        <strong>Dosen</strong> memiliki akses khusus yang ringkas dan fokus untuk menulis artikel ilmiah populer, opini akademik, laporan kegiatan riset/pengabdian di blog kampus, serta mengelola media pendukung tulisannya.
    </p>
</div>

<div class="step-box"><span class="step-num">1</span> <strong>Login ke Portal Dosen:</strong> Masuk melalui <code>/login</code> menggunakan akun <code>dosen@prodi.ac.id</code> (password: <code>password</code>). Anda akan diarahkan ke <strong>Dashboard</strong> untuk melihat statistik konten dan aktivitas terbaru.</div>
<div class="step-box"><span class="step-num">2</span> <strong>Mengunggah Ilustrasi &amp; File Pendukung di Media Library:</strong>
    <ul>
        <li>Klik menu <strong>SISTEM &raquo; Media Library</strong> (<code>/admin/media</code>).</li>
        <li>Klik tombol <strong>Upload File</strong>, pilih foto dokumentasi riset, diagram, atau infografis pendukung tulisan Anda.</li>
    </ul>
</div>
<div class="step-box"><span class="step-num">3</span> <strong>Menulis &amp; Menyunting Artikel Dosen:</strong>
    <ul>
        <li>Klik menu <strong>KONTEN WEBSITE &raquo; Berita &amp; Artikel &raquo; Tambah Artikel</strong> (<code>/admin/posts/create</code>).</li>
        <li>Tuliskan judul dan isi artikel pada editor, sisipkan gambar dari <em>Media Library</em>, serta pilih kategori yang sesuai (misal: <em>Opini Dosen</em>, <em>Riset &amp; Inovasi</em>, atau <em>Akademik</em>).</li>
        <li>Simpan artikel. <em>Editor Konten</em> atau <em>Admin Prodi</em> selanjutnya dapat meninjau dan mempublikasikan tulisan Anda ke halaman utama.</li>
    </ul>
</div>

<!-- ROLE 5: OPERATOR AKADEMIK -->
<h2 class="section-title">6.5 Panduan Role 5: Operator Akademik (<code>operator@prodi.ac.id</code>)</h2>
<div class="role-card">
    <span class="badge">ADMINISTRATOR DATA AKADEMIK &amp; DOKUMEN</span>
    <p style="margin-top:4px; margin-bottom:0;">
        <strong>Operator Akademik</strong> bertugas menangani administrasi rutin akademik: pembaruan mata kuliah &amp; kurikulum, pengelolaan repositori dokumen unduhan, publikasi pengumuman akademik, serta agenda kegiatan prodi.
    </p>
</div>

<div class="step-box"><span class="step-num">1</span> <strong>Memperbarui Struktur Kurikulum Semester:</strong>
    <ul>
        <li>Buka menu <strong>MODUL HALAMAN &raquo; Kurikulum</strong> (<code>/admin/curriculums</code>).</li>
        <li>Tambahkan mata kuliah baru atau perbarui SKS/Semester mata kuliah yang ada. Untuk pembaruan massal setiap awal semester, gunakan tombol <strong>Import Excel</strong> dengan template resmi yang disediakan.</li>
    </ul>
</div>
<div class="step-box"><span class="step-num">2</span> <strong>Mengelola Pusat Dokumen Resmi (Repositori Unduhan):</strong>
    <ul>
        <li>Buka menu <strong>MODUL HALAMAN &raquo; Dokumen</strong> (<code>/admin/documents</code>).</li>
        <li>Klik <strong>+ Tambah Dokumen</strong>, masukkan Judul Dokumen (ID/EN), pilih <strong>Kategori Dokumen</strong> (misal: Pedoman Akademik, Formulir, SK, Kurikulum, SOP), unggah file (PDF/DOCX/XLSX), lalu klik <strong>Simpan</strong>.</li>
        <li>Dokumen yang disimpan akan langsung tersedia untuk diunduh oleh mahasiswa dan publik di halaman <code>/dokumen</code>.</li>
    </ul>
</div>
<div class="step-box"><span class="step-num">3</span> <strong>Mempublikasikan Pengumuman &amp; Agenda Akademik:</strong>
    <ul>
        <li>Buka <strong>KONTEN WEBSITE &raquo; Pengumuman</strong> (<code>/admin/announcements</code>) untuk menayangkan informasi jadwal KRS, ujian, wisuda, atau beasiswa.</li>
        <li>Buka <strong>Agenda &amp; Event</strong> (<code>/admin/events</code>) untuk memperbarui jadwal kuliah tamu, seminar proposal, atau kegiatan himpunan mahasiswa.</li>
    </ul>
</div>

<!-- ROLE 6: PENGUNJUNG PUBLIK -->
<h2 class="section-title">6.6 Panduan Role 6: Pengunjung Publik / Mahasiswa (Frontend User)</h2>
<div class="role-card">
    <span class="badge">PENGGUNA PUBLIK / MAHASISWA / CALON MAHASISWA / ASESOR</span>
    <p style="margin-top:4px; margin-bottom:0;">
        Pengunjung publik dapat mengakses seluruh informasi portal tanpa perlu login melalui antarmuka depan (<em>Frontend</em>) yang responsif dan interaktif.
    </p>
</div>

<div class="step-box"><span class="step-num">1</span> <strong>Menjelajahi Beranda, Bahasa &amp; Mode Tampilan:</strong>
    <ul>
        <li>Akses halaman utama website (<code>/</code>). Nikmati sajian visual Hero Slider, pengumuman terbaru, sambutan pimpinan, statistik infografis, berita terkini, agenda, testimoni alumni, hingga logo mitra &amp; sponsor.</li>
        <li>Gunakan tombol <strong>ID / EN</strong> di bilah navigasi atas untuk mengganti bahasa situs, dan klik ikon <strong>Bulan/Matahari</strong> untuk mengaktifkan <em>Smart Dark Mode</em>.</li>
    </ul>
</div>
<div class="step-box"><span class="step-num">2</span> <strong>Mengakses Informasi Akademik, Berita, Agenda &amp; Dokumen:</strong>
    <ul>
        <li>Jelajahi menu <strong>Profil / Tentang</strong>, <strong>Dosen</strong> (<code>/dosen</code>), <strong>Kurikulum</strong> (<code>/kurikulum</code>), <strong>Kalender Akademik</strong> (<code>/kalender-akademik</code>), <strong>Penelitian &amp; Pengabdian</strong> (<code>/penelitian</code> &amp; <code>/pengabdian</code>), serta <strong>Layanan Akademik</strong> (<code>/academic-services</code>).</li>
        <li>Buka halaman <strong>Berita</strong> (<code>/berita</code>) untuk membaca artikel berdasarkan kategori/tag, halaman <strong>Agenda</strong> (<code>/agenda</code>) untuk melihat detail acara &amp; klik tombol registrasi, serta halaman <strong>Dokumen</strong> (<code>/dokumen</code>) untuk mengunduh berkas resmi.</li>
    </ul>
</div>
<div class="step-box"><span class="step-num">3</span> <strong>Menggunakan Smart Chatbot, Fitur Aksesibilitas &amp; Formulir Kontak:</strong>
    <ul>
        <li>Klik tombol mengambang <strong>Chatbot</strong> di pojok kanan bawah untuk bertanya langsung mengenai informasi prodi, kurikulum, dosen, atau layanan akademik.</li>
        <li>Klik tombol <strong>Aksesibilitas (Ikon Disabilitas)</strong> untuk mengaktifkan fitur <em>Text-to-Speech</em> (pembaca suara otomatis saat teks dipilih), perbesar ukuran teks, mode kontras tinggi, atau skala abu-abu (<em>grayscale</em>).</li>
        <li>Buka halaman <strong>Kontak</strong> (<code>/kontak</code>), isi formulir pesan beserta kode <em>Captcha</em>, lalu klik <strong>Kirim Pesan</strong>.</li>
    </ul>
</div>

<div class="page-break"></div>

<!-- =========================================================
     BAB 7: GALERI VISUAL & SCREENSHOT APLIKASI LENGKAP
     ========================================================= -->
<h1 class="chapter-title">BAB 7. GALERI VISUAL &amp; SCREENSHOT APLIKASI LENGKAP</h1>
<p>Berikut adalah rekapitulasi visual 10 antarmuka utama (Frontend &amp; Backend) pada <strong>BalaKutaK CMS v2.1.0 Stable</strong>:</p>

<table style="width:100%; border-collapse: collapse; margin-bottom: 10px;">
    <tr>
        <td style="width:50%; text-align:center; padding:6px; border:1px solid #cbd5e1; background:#f8fafc;">
            @if($ssHome)<img src="{{ $ssHome }}" style="max-height:130px; width:95%; border:1px solid #94a3b8;">@endif
            <div class="screenshot-caption">1. Beranda Utama (Frontend Home)</div>
        </td>
        <td style="width:50%; text-align:center; padding:6px; border:1px solid #cbd5e1; background:#f8fafc;">
            @if($ssLogin)<img src="{{ $ssLogin }}" style="max-height:130px; width:95%; border:1px solid #94a3b8;">@endif
            <div class="screenshot-caption">2. Halaman Login Resmi</div>
        </td>
    </tr>
    <tr>
        <td style="width:50%; text-align:center; padding:6px; border:1px solid #cbd5e1; background:#f8fafc;">
            @if($ssBerita)<img src="{{ $ssBerita }}" style="max-height:130px; width:95%; border:1px solid #94a3b8;">@endif
            <div class="screenshot-caption">3. Portal Berita &amp; Artikel Publik</div>
        </td>
        <td style="width:50%; text-align:center; padding:6px; border:1px solid #cbd5e1; background:#f8fafc;">
            @if($ssAgenda)<img src="{{ $ssAgenda }}" style="max-height:130px; width:95%; border:1px solid #94a3b8;">@endif
            <div class="screenshot-caption">4. Portal Agenda &amp; Event Publik</div>
        </td>
    </tr>
    <tr>
        <td style="width:50%; text-align:center; padding:6px; border:1px solid #cbd5e1; background:#f8fafc;">
            @if($ssDashboard)<img src="{{ $ssDashboard }}" style="max-height:130px; width:95%; border:1px solid #94a3b8;">@endif
            <div class="screenshot-caption">5. Admin Dashboard &amp; Statistik</div>
        </td>
        <td style="width:50%; text-align:center; padding:6px; border:1px solid #cbd5e1; background:#f8fafc;">
            @if($ssPosts)<img src="{{ $ssPosts }}" style="max-height:130px; width:95%; border:1px solid #94a3b8;">@endif
            <div class="screenshot-caption">6. Manajemen Berita &amp; Artikel (Posts)</div>
        </td>
    </tr>
    <tr>
        <td style="width:50%; text-align:center; padding:6px; border:1px solid #cbd5e1; background:#f8fafc;">
            @if($ssGallery)<img src="{{ $ssGallery }}" style="max-height:130px; width:95%; border:1px solid #94a3b8;">@endif
            <div class="screenshot-caption">7. Manajemen Galeri &amp; Media</div>
        </td>
        <td style="width:50%; text-align:center; padding:6px; border:1px solid #cbd5e1; background:#f8fafc;">
            @if($ssMenus)<img src="{{ $ssMenus }}" style="max-height:130px; width:95%; border:1px solid #94a3b8;">@endif
            <div class="screenshot-caption">8. Visual Drag &amp; Drop Menu Builder</div>
        </td>
    </tr>
    <tr>
        <td style="width:50%; text-align:center; padding:6px; border:1px solid #cbd5e1; background:#f8fafc;">
            @if($ssThemes)<img src="{{ $ssThemes }}" style="max-height:130px; width:95%; border:1px solid #94a3b8;">@endif
            <div class="screenshot-caption">9. Dynamic Theme Engine (20+ Tema)</div>
        </td>
        <td style="width:50%; text-align:center; padding:6px; border:1px solid #cbd5e1; background:#f8fafc;">
            @if($ssBackups)<img src="{{ $ssBackups }}" style="max-height:130px; width:95%; border:1px solid #94a3b8;">@endif
            <div class="screenshot-caption">10. Sistem Backup Database &amp; File (.zip)</div>
        </td>
    </tr>
</table>

<div class="page-break"></div>

<!-- =========================================================
     BAB 8: PANDUAN INSTALASI & DEPLOYMENT
     ========================================================= -->
<h1 class="chapter-title">BAB 8. PANDUAN INSTALASI &amp; KONFIGURASI SERVER</h1>

<h2 class="section-title">8.1 Persyaratan Lingkungan Server (System Requirements)</h2>
<ul>
    <li><strong>PHP:</strong> Versi 8.2 atau lebih baru (dengan ekstensi <code>pdo_mysql</code>, <code>mbstring</code>, <code>gd</code>, <code>zip</code>, <code>xml</code>, <code>bcmath</code>, <code>intl</code>).</li>
    <li><strong>Database:</strong> MySQL 8.0+ atau MariaDB 10.6+.</li>
    <li><strong>Package Manager:</strong> Composer 2.x &amp; Node.js 18+ (NPM).</li>
    <li><strong>Web Server:</strong> Apache (dengan <code>mod_rewrite</code>) atau Nginx.</li>
</ul>

<h2 class="section-title">8.2 Langkah Instalasi Lengkap (Step-by-Step)</h2>
<ol>
    <li><strong>Clone Repositori dari GitHub:</strong><br>
        <code>git clone https://github.com/riyantoabuwinner/balakutak.git &amp;&amp; cd balakutak</code>
    </li>
    <li><strong>Instalasi Dependensi Backend &amp; Frontend:</strong><br>
        <code>composer install</code><br>
        <code>npm install &amp;&amp; npm run build</code>
    </li>
    <li><strong>Konfigurasi Environment &amp; Application Key:</strong><br>
        <code>cp .env.example .env &amp;&amp; php artisan key:generate</code><br>
        Sesuaikan pengaturan <code>DB_DATABASE</code>, <code>DB_USERNAME</code>, dan <code>DB_PASSWORD</code> di dalam file <code>.env</code>.
    </li>
    <li><strong>Migrasi Database, Seeding Data Awal &amp; Symlink Storage:</strong><br>
        <code>php artisan migrate:fresh --seed</code><br>
        <code>php artisan storage:link</code>
    </li>
    <li><strong>Menjalankan Server Aplikasi:</strong><br>
        <code>php artisan serve</code> &mdash; Akses portal di <code>http://127.0.0.1:8000</code> dan panel admin di <code>http://127.0.0.1:8000/admin</code>.
    </li>
</ol>

<div class="callout-success">
    <strong>Dokumentasi Selesai &amp; Terverifikasi:</strong><br>
    Seluruh modul, hak akses role pengguna, arsitektur, dan alur kerja pada dokumen ini telah disesuaikan dengan rilis <strong>BalaKutaK CMS v2.1.0 Stable</strong>. Dikembangkan dengan dedikasi tinggi untuk kemajuan ekosistem digital Indonesia.
</div>

</body>
</html>
