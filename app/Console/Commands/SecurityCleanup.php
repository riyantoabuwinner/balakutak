<?php

namespace App\Console\Commands;

use App\Models\AcademicCalendar;
use App\Models\AcademicService;
use App\Models\Announcement;
use App\Models\Category;
use App\Models\Document;
use App\Models\Event;
use App\Models\Faq;
use App\Models\Gallery;
use App\Models\Lecturer;
use App\Models\Media;
use App\Models\Page;
use App\Models\Partner;
use App\Models\Post;
use App\Models\ResearchService;
use App\Models\Slider;
use App\Models\Sponsor;
use App\Models\Tag;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class SecurityCleanup extends Command
{
    protected $signature = 'security:cleanup {--force : Jalankan pembersihan tanpa konfirmasi}';
    protected $description = 'Bersihkan artefak serangan/pentest dari database dan direktori upload publik';

    public function handle(): int
    {
        if (!$this->option('force') && !$this->confirm('Hapus seluruh data pentest/spam dan file berbahaya dari sistem?')) {
            $this->info('Dibatalkan.');
            return self::SUCCESS;
        }

        $titlePatterns = ['PENTEST%', 'P7611%', 'P7620%', 'PT5932%', 'NormalItem%', 'Normalltem%', '%gal_shell%', 'foldertest'];
        $spamTerms = ['Aurora Toto', 'MAXI188', 'Wukong778', 'slot777', 'unicorn778', '<script'];

        $cleanModel = function (string $modelClass, array $columns, string $label) use ($titlePatterns, $spamTerms) {
            $query = $modelClass::query();
            $query->where(function ($q) use ($columns, $titlePatterns, $spamTerms) {
                foreach ($columns as $col) {
                    foreach ($titlePatterns as $pat) {
                        $q->orWhere($col, 'like', $pat);
                    }
                    foreach ($spamTerms as $term) {
                        $q->orWhere($col, 'like', '%' . $term . '%');
                    }
                }
            });

            $items = $query->get();
            foreach ($items as $item) {
                foreach (['file_path', 'featured_image', 'attachment', 'path'] as $fileCol) {
                    if (!empty($item->$fileCol) && Storage::disk('public')->exists($item->$fileCol)) {
                        Storage::disk('public')->delete($item->$fileCol);
                    }
                }
                if (method_exists($item, 'forceDelete')) {
                    $item->forceDelete();
                } else {
                    $item->delete();
                }
            }

            $this->line(" - {$label}: {$items->count()} entri dibersihkan.");
        };

        $cleanModel(Post::class, ['title', 'content', 'slug'], 'Posts');
        $cleanModel(Announcement::class, ['title', 'content', 'slug'], 'Announcements');
        $cleanModel(Gallery::class, ['title', 'album', 'file_path'], 'Galleries');
        $cleanModel(Media::class, ['original_name', 'filename', 'folder', 'path'], 'Media');
        $cleanModel(Page::class, ['title', 'content', 'slug'], 'Pages');
        $cleanModel(Event::class, ['title', 'description', 'content', 'slug'], 'Events');
        $cleanModel(Slider::class, ['title', 'subtitle', 'button_text', 'button_url'], 'Sliders');
        $cleanModel(Partner::class, ['name', 'description'], 'Partners');
        $cleanModel(Sponsor::class, ['name'], 'Sponsors');
        $cleanModel(Testimonial::class, ['name', 'content', 'company'], 'Testimonials');
        $cleanModel(Category::class, ['name', 'slug'], 'Categories');
        $cleanModel(Tag::class, ['name', 'slug'], 'Tags');
        $cleanModel(Faq::class, ['question', 'answer'], 'FAQs');
        $cleanModel(Document::class, ['title', 'description'], 'Documents');
        $cleanModel(Lecturer::class, ['name', 'biography'], 'Lecturers');
        $cleanModel(AcademicService::class, ['title', 'description'], 'AcademicServices');
        $cleanModel(AcademicCalendar::class, ['title', 'description'], 'AcademicCalendars');
        $cleanModel(ResearchService::class, ['title', 'abstract', 'content'], 'ResearchServices');

        // Also remove any Gallery or Media records pointing to dangerous file extensions (.html/.svg/.php/.phtml)
        $badExts = ['%.html', '%.htm', '%.svg', '%.php%', '%.phtml', '%.js'];
        $badGalleries = Gallery::where(function ($q) use ($badExts) {
            foreach ($badExts as $ext) {
                $q->orWhere('file_path', 'like', $ext);
            }
        })->orWhere('title', 'one')->get();
        foreach ($badGalleries as $g) {
            if ($g->file_path && Storage::disk('public')->exists($g->file_path)) {
                Storage::disk('public')->delete($g->file_path);
            }
            $g->delete();
        }
        $this->line(" - Galleries (ekstensi berbahaya): {$badGalleries->count()} entri dibersihkan.");

        $badMedia = Media::where(function ($q) use ($badExts) {
            foreach ($badExts as $ext) {
                $q->orWhere('path', 'like', $ext);
            }
        })->orWhere('original_name', 'one')->get();
        foreach ($badMedia as $m) {
            if ($m->path && Storage::disk('public')->exists($m->path)) {
                Storage::disk('public')->delete($m->path);
            }
            $m->delete();
        }
        $this->line(" - Media (ekstensi berbahaya): {$badMedia->count()} entri dibersihkan.");

        // Clean suspicious pentest users or users without any assigned role
        $suspiciousUsers = User::withTrashed()
            ->where(function ($q) {
                $q->where('name', 'like', 'Pentest%')
                  ->orWhere('name', 'like', 'PENTEST%')
                  ->orWhere('email', 'like', '%pentest%')
                  ->orWhereDoesntHave('roles');
            })
            ->get();

        foreach ($suspiciousUsers as $user) {
            $this->warn(" - Menghapus user mencurigakan/tanpa role: {$user->name} ({$user->email})");
            $user->forceDelete();
        }

        $this->info('Pembersihan database selesai.');
        return self::SUCCESS;
    }
}
