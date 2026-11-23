<?php

namespace App\Console\Commands;

use App\Models\Announcement;
use App\Models\Event;
use App\Models\Gallery;
use App\Models\Media;
use App\Models\Page;
use App\Models\Post;
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

        $titlePatterns = ['PENTEST%', 'P7611%', 'PT5932%', 'NormalItem%', 'Normalltem%'];
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
