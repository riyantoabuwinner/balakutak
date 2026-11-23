<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\PostController as FrontPostController;
use App\Http\Controllers\Frontend\LecturerController as FrontLecturerController;
use App\Http\Controllers\Frontend\EventController as FrontEventController;
use App\Http\Controllers\Frontend\GalleryController as FrontGalleryController;
use App\Http\Controllers\Frontend\PageController as FrontFrontPageController;
use App\Http\Controllers\Frontend\FrontPageController as FrontInfoPageController;
use App\Http\Controllers\Frontend\DocumentController as FrontDocumentController;
use App\Http\Controllers\Frontend\FaqController as FrontFaqController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\AnnouncementController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\LecturerController;
use App\Http\Controllers\Admin\CurriculumController;
use App\Http\Controllers\Admin\AcademicCalendarController;
use App\Http\Controllers\Admin\AcademicServiceController;
use App\Http\Controllers\Admin\DocumentController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\InfographicController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\BackupController;
use App\Http\Controllers\Admin\SecurityGuardController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\ResearchServiceController;
use App\Http\Controllers\Admin\SponsorController;
use App\Http\Controllers\Admin\FaqController;

/* |-------------------------------------------------------------------------- | Admin Panel Routes (Protected) |-------------------------------------------------------------------------- */
Route::prefix('admin')->name('admin.')->middleware(['auth', 'verified', \App\Http\Middleware\AdminLocale::class])->group(function () {

    Route::get('/', [DashboardController::class , 'index'])->middleware('permission:view dashboard')->name('dashboard');
    Route::get('/stats', [DashboardController::class , 'stats'])->middleware('permission:view dashboard')->name('stats');

    // Posts / Articles
    Route::middleware(['permission:view posts'])->group(function () {
        Route::post('posts/import', [PostController::class , 'import'])->middleware('role:Super Admin|Admin Prodi')->name('posts.import');
        Route::delete('posts/mass-destroy', [PostController::class , 'massDestroy'])->middleware('permission:delete posts')->name('posts.mass-destroy');
        Route::resource('posts', PostController::class);
        Route::patch('posts/{post}/toggle-status', [PostController::class , 'toggleStatus'])->middleware('permission:publish posts')->name('posts.toggle-status');
    });

    // Pages & FAQs
    Route::middleware(['permission:view pages'])->group(function () {
        Route::get('builder-pages', [PageController::class , 'builderIndex'])->name('pages.builder-index');
        Route::get('pages/{page}/builder', [PageController::class , 'builder'])->middleware('permission:edit pages')->name('pages.builder');
        Route::post('pages/{page}/builder', [PageController::class , 'saveBuilder'])->middleware('permission:edit pages')->name('pages.save-builder');
        Route::resource('pages', PageController::class);
        Route::resource('faqs', FaqController::class);
    });

    // Categories & Tags
    Route::resource('categories', CategoryController::class)->middleware('permission:view categories');
    Route::resource('tags', TagController::class)->middleware('permission:view tags');

    // Announcements
    Route::resource('announcements', AnnouncementController::class)->middleware('permission:view announcements');

    // Events & Agenda, Academic Calendar, Academic Services, Research Services
    Route::middleware(['permission:view events'])->group(function () {
        Route::resource('events', EventController::class);
        Route::resource('academic-calendars', AcademicCalendarController::class);
        Route::resource('academic-services', AcademicServiceController::class);
        Route::post('research-services/import', [ResearchServiceController::class , 'import'])->name('research-services.import');
        Route::get('research-services/template', [ResearchServiceController::class , 'downloadTemplate'])->name('research-services.template');
        Route::get('research-services/export', [ResearchServiceController::class , 'export'])->name('research-services.export');
        Route::resource('research-services', ResearchServiceController::class);
    });

    // Lecturers
    Route::middleware(['permission:view lecturers'])->group(function () {
        Route::post('lecturers/import', [LecturerController::class , 'import'])->name('lecturers.import');
        Route::get('lecturers/template', [LecturerController::class , 'downloadTemplate'])->name('lecturers.template');
        Route::get('lecturers/export', [LecturerController::class , 'export'])->name('lecturers.export');
        Route::resource('lecturers', LecturerController::class);
    });

    // Curriculum
    Route::middleware(['permission:view curriculum'])->group(function () {
        Route::post('curriculums/import', [CurriculumController::class , 'import'])->name('curriculums.import');
        Route::get('curriculums/template', [CurriculumController::class , 'downloadTemplate'])->name('curriculums.template');
        Route::get('curriculums/export', [CurriculumController::class , 'export'])->name('curriculums.export');
        Route::resource('curriculums', CurriculumController::class);
    });

    // Documents
    Route::middleware(['permission:view documents'])->group(function () {
        Route::resource('documents', DocumentController::class);
        Route::get('documents/{document}/download', [DocumentController::class , 'download'])->name('documents.download');
    });

    // Gallery
    Route::middleware(['permission:view gallery'])->group(function () {
        Route::delete('gallery/mass-destroy', [GalleryController::class , 'massDestroy'])->middleware('permission:delete gallery')->name('gallery.mass-destroy');
        Route::resource('gallery', GalleryController::class);
    });

    // Sliders / Banners & Partners
    Route::middleware(['permission:view sliders'])->group(function () {
        Route::resource('sliders', SliderController::class);
        Route::patch('sliders/reorder', [SliderController::class , 'reorder'])->name('sliders.reorder');
        Route::patch('sliders/{slider}/toggle-status', [SliderController::class, 'toggleStatus'])->name('sliders.toggleStatus');
        Route::patch('partners/{partner}/toggle-status', [PartnerController::class , 'toggleStatus'])->name('partners.toggle-status');
        Route::resource('partners', PartnerController::class);
    });

    // Testimonials
    Route::middleware(['permission:view testimonials'])->group(function () {
        Route::resource('testimonials', TestimonialController::class);
        Route::patch('testimonials/{testimonial}/toggle-status', [TestimonialController::class , 'toggleStatus'])->name('testimonials.toggle-status');
    });

    // Menu Builder
    Route::middleware(['permission:view menus'])->group(function () {
        Route::resource('menus', MenuController::class);
        Route::post('menus/{menu}/items', [MenuController::class , 'saveItems'])->name('menus.save-items');
    });

    // Media Library
    Route::middleware(['permission:view media'])->group(function () {
        Route::get('media', [MediaController::class, 'index'])->name('media.index');
        Route::post('media/upload', [MediaController::class, 'upload'])->middleware('permission:upload media')->name('media.upload');
        Route::get('media/picker', [MediaController::class, 'picker'])->name('media.picker');
        Route::get('media/json/{id}', [MediaController::class, 'json'])->name('media.json');
        Route::get('media/json-by-path', [MediaController::class, 'jsonByPath'])->name('media.json-by-path');
        Route::resource('media', MediaController::class)->parameters([
            'media' => 'media'
        ]);
        Route::get('media/folders', [MediaController::class, 'folder'])->name('media.folder');
    });

    // Settings, Infographics & Sponsors
    Route::middleware(['permission:view settings'])->group(function () {
        Route::resource('infographics', InfographicController::class);
        Route::post('infographics/{infographic}/activate', [InfographicController::class , 'activate'])->name('infographics.activate');
        Route::patch('sponsors/{sponsor}/toggle-status', [SponsorController::class , 'toggleStatus'])->name('sponsors.toggle-status');
        Route::resource('sponsors', SponsorController::class);
        Route::get('settings', [SettingController::class , 'index'])->name('settings.index');
        Route::post('settings', [SettingController::class , 'update'])->middleware('permission:edit settings')->name('settings.update');
        Route::get('settings/{group}', [SettingController::class , 'group'])->name('settings.group');
    });

    // Users (Super Admin only)
    Route::resource('users', UserController::class)->middleware('role:Super Admin');

    // Contact Messages
    Route::middleware(['permission:view contact messages'])->group(function () {
        Route::get('contact-messages', [ContactMessageController::class , 'index'])->name('contact-messages.index');
        Route::get('contact-messages/{message}', [ContactMessageController::class , 'show'])->name('contact-messages.show');
        Route::post('contact-messages/{message}/reply', [ContactMessageController::class , 'reply'])->middleware('permission:reply contact messages')->name('contact-messages.reply');
        Route::delete('contact-messages/{message}', [ContactMessageController::class , 'destroy'])->middleware('permission:delete contact messages')->name('contact-messages.destroy');
    });

    // Backup Management
    Route::middleware(['role:Super Admin'])->group(function () {
            Route::get('backups', [BackupController::class , 'index'])->name('backups.index');
            Route::post('backups', [BackupController::class , 'create'])->name('backups.create');
            Route::get('backups/{filename}/download', [BackupController::class , 'download'])->name('backups.download');
            Route::delete('backups/{filename}', [BackupController::class , 'destroy'])->name('backups.destroy');
            Route::patch('backups/schedule', [BackupController::class , 'updateSchedule'])->name('backups.schedule');
            Route::delete('backups', [BackupController::class , 'destroyOld'])->name('backups.clean');

            // YantoSedunia Protection Guard
            Route::get('security-guard', [SecurityGuardController::class, 'index'])->name('security-guard.index');
            Route::post('security-guard/block-ip', [SecurityGuardController::class, 'blockIp'])->name('security-guard.block-ip');
            Route::delete('security-guard/unblock-ip/{blockedIp}', [SecurityGuardController::class, 'unblockIp'])->name('security-guard.unblock-ip');
            Route::post('security-guard/settings', [SecurityGuardController::class, 'updateSettings'])->name('security-guard.settings');
            Route::post('security-guard/cleanup', [SecurityGuardController::class, 'runCleanup'])->name('security-guard.cleanup');
            Route::delete('security-guard/logs', [SecurityGuardController::class, 'clearLogs'])->name('security-guard.clear-logs');
        }
        );

        // Language Switcher
        Route::get('language/{locale}', function ($locale) {
            if (!in_array($locale, ['en', 'id'])) {
                abort(400);
            }
            session(['admin_locale' => $locale]);
            return redirect()->back();
        }
        )->name('language.switch');

        // System Guide
        Route::get('guide', function () {
            return view('admin.guide.index');
        })->name('guide');
        Route::get('guide/pdf', function () {
            $pdfPath = base_path('docs/Panduan-Lengkap-BalaKutaK-CMS.pdf');
            if (file_exists($pdfPath)) {
                return response()->download($pdfPath, 'Panduan-Lengkap-BalaKutaK-CMS-v2.1.0.pdf');
            }
            $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.guide.pdf')
                ->setPaper('a4', 'portrait');
            return $pdf->download('Panduan-Lengkap-BalaKutaK-CMS-v2.1.0.pdf');
        })->name('guide.pdf');

        // Impersonate Routes
        Route::impersonate();
    });

// Captcha Route (defined before catch-all /{slug} and outside localization redirect, rate-limited)
Route::get('/captcha', [\App\Http\Controllers\CaptchaController::class, 'generate'])
    ->middleware('throttle:30,1')
    ->name('captcha.generate');

Route::group([
    'prefix' => \Mcamara\LaravelLocalization\Facades\LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {
    /* |-------------------------------------------------------------------------- | Frontend Public Routes |-------------------------------------------------------------------------- */
    Route::get('/', [HomeController::class , 'index'])->name('home');
    Route::get('/tentang', [FrontInfoPageController::class , 'about'])->name('about');
    Route::get('/akademik', [FrontInfoPageController::class , 'academic'])->name('academic');
    Route::get('/penelitian', [FrontInfoPageController::class , 'research'])->name('research');
    Route::get('/pengabdian', [FrontInfoPageController::class , 'community'])->name('community');
    Route::get('/penelitian/{slug}', [FrontInfoPageController::class, 'showResearch'])->name('research.show');
    Route::get('/dosen', [FrontLecturerController::class , 'index'])->name('lecturers.index');
    Route::get('/dosen/{lecturer}', [FrontLecturerController::class , 'show'])->name('lecturers.show');
    Route::get('/galeri', [FrontGalleryController::class , 'index'])->name('gallery.index');
    Route::get('/agenda', [FrontEventController::class , 'index'])->name('events.index');
    Route::get('/agenda/{slug}', [FrontEventController::class , 'show'])->name('events.show');
    Route::get('/berita', [FrontPostController::class , 'index'])->name('posts.index');
    Route::get('/berita/{slug}', [FrontPostController::class , 'show'])->name('posts.show');
    Route::get('/kategori/{slug}', [FrontPostController::class , 'category'])->name('posts.category');
    Route::get('/tag/{slug}', [FrontPostController::class , 'tag'])->name('posts.tag');
    Route::get('/kontak', [ContactController::class , 'index'])->name('contact.index');
    Route::post('/kontak', [ContactController::class , 'store'])->middleware('throttle:10,1')->name('contact.store');
    Route::get('/cari', [FrontInfoPageController::class , 'search'])->name('search');
    // Sitemap & Robots
    Route::get('/sitemap.xml', [HomeController::class , 'sitemap'])->name('sitemap');
    Route::get('/robots.txt', [HomeController::class , 'robots'])->name('robots');

    // Announcements
    Route::get('/pengumuman/{slug}', [HomeController::class , 'showAnnouncement'])->name('announcements.show');

    // Documents
    Route::get('/dokumen', [FrontDocumentController::class, 'index'])->name('documents');
    Route::get('/dokumen/{id}/download', [DocumentController::class , 'publicDownload'])->name('documents.public-download');

    // FAQs
    Route::get('/faqs', [FrontFaqController::class, 'index'])->name('faqs.index');

    // Captcha Route moved outside localization group for reliable image loading & rate limiting

    // Auth routes (Breeze)
    require __DIR__ . '/auth.php';

    // Curriculum
    Route::get('/kurikulum', [\App\Http\Controllers\Frontend\CurriculumController::class, 'index'])->name('curriculum');

    // Academic Calendar
    Route::get('/kalender-akademik', [\App\Http\Controllers\Frontend\AcademicCalendarController::class, 'index'])->name('calendar');

    // Academic Services
    Route::get('/academic-services', [\App\Http\Controllers\Frontend\AcademicServiceController::class, 'index'])->name('academic-services');
    Route::get('/layanan-akademik', function() {
        return redirect()->route('academic-services', [], 301);
    });

    // Static Pages (Catch-all for anything without a dedicated prefix)
    Route::get('/{slug}', [FrontFrontPageController::class , 'show'])->name('pages.show');
});

// Auth routes moved to localization group

/* |-------------------------------------------------------------------------- | API Routes - referenced via api.php |-------------------------------------------------------------------------- */
