<?php

use App\Models\Gallery;
use App\Models\Media;
use Illuminate\Support\Facades\Storage;

echo "Syncing Galleries to Media Library...\n";

$galleries = Gallery::where('type', 'photo')->get();
$count = 0;

foreach ($galleries as $g) {
    if (!$g->file_path) continue;
    
    // Check if already in media
    $exists = Media::where('path', $g->file_path)->exists();
    
    if (!$exists) {
        $fullPath = storage_path('app/public/' . $g->file_path);
        
        $mime = 'image/jpeg';
        $size = 0;
        if (file_exists($fullPath)) {
            $mime = mime_content_type($fullPath);
            $size = filesize($fullPath);
        }
        
        $media = Media::create([
            'user_id' => $g->user_id ?? 1,
            'filename' => basename($g->file_path),
            'original_name' => $g->title ?? basename($g->file_path),
            'path' => $g->file_path,
            'url' => asset('storage/' . $g->file_path),
            'mime_type' => $mime,
            'extension' => pathinfo($g->file_path, PATHINFO_EXTENSION),
            'size' => $size,
            'folder' => 'gallery'
        ]);
        
        echo "Added: " . $g->file_path . "\n";
        $count++;
    }
}

echo "Done. Synchronized $count items.\n";
