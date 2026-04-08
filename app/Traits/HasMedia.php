<?php

namespace App\Traits;

use App\Models\Media;
use App\Models\Gallery;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

trait HasMedia
{
    /**
     * Handle image upload/selection for a model attribute
     */
    protected function handleMedia(string $fieldName, string $folder = 'general', string $title = 'Untitled')
    {
        // 1. Check for local file upload
        if (request()->hasFile($fieldName . '_file')) {
            $file = request()->file($fieldName . '_file');
            $path = $this->uploadAndRegisterMedia($file, $folder, $title);
            return $path;
        }

        // 2. Check for manual URL/Path from Media Picker
        if (request()->filled($fieldName)) {
            return request()->input($fieldName);
        }

        return null;
    }

    /**
     * Upload file and register it to Media table
     */
    protected function uploadAndRegisterMedia(UploadedFile $file, string $folder = 'uploads', string $title = 'Media File')
    {
        $filename = uniqid() . '_' . time() . '.' . $file->getClientOriginalExtension();
        $storePath = 'media/' . ltrim($folder, '/');
        
        $imageManager = new ImageManager(new Driver());
        
        // Compress images
        if (str_starts_with($file->getMimeType(), 'image/')) {
            $image = $imageManager->read($file->getRealPath());
            if ($image->width() > 1920 || $image->height() > 1080) {
                $image->scaleDown(1920, 1080);
            }

            $fullPath = storage_path("app/public/{$storePath}/{$filename}");
            if (!file_exists(dirname($fullPath))) {
                mkdir(dirname($fullPath), 0755, true);
            }
            $image->toJpeg(85)->save($fullPath);
            $size = filesize($fullPath);
            $width = $image->width();
            $height = $image->height();
        } else {
            $file->storeAs($storePath, $filename, 'public');
            $size = $file->getSize();
            $width = null;
            $height = null;
        }

        $path = "{$storePath}/{$filename}";

        Media::create([
            'user_id' => auth()->id(),
            'filename' => $filename,
            'original_name' => $file->getClientOriginalName(),
            'path' => $path,
            'url' => asset("storage/{$path}"),
            'folder' => $folder,
            'mime_type' => $file->getMimeType(),
            'extension' => $file->getClientOriginalExtension(),
            'size' => $size,
            'width' => $width,
            'height' => $height,
        ]);

        return $path;
    }
}
