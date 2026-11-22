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
        $allowedMimes = [
            'image/jpeg' => 'jpg',
            'image/png'  => 'png',
            'image/gif'  => 'gif',
            'image/webp' => 'webp',
        ];

        $mime = $file->getMimeType();
        if (!isset($allowedMimes[$mime]) || @getimagesize($file->getRealPath()) === false) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'file' => 'Format gambar tidak valid atau tidak diizinkan (hanya JPG, PNG, GIF, WEBP).',
            ]);
        }

        $extension = $allowedMimes[$mime];
        $filename = uniqid() . '_' . time() . '.' . $extension;
        $mediaFolder = trim(str_replace(['..', "\0"], '', $folder), '/');
        $storePath = 'media' . ($mediaFolder ? '/' . $mediaFolder : '');
        $path = "{$storePath}/{$filename}";

        $imageManager = new ImageManager(new Driver());
        $image = $imageManager->read($file->getRealPath());
        if ($image->width() > 1920 || $image->height() > 1080) {
            $image->scaleDown(1920, 1080);
        }

        $fullPath = storage_path("app/public/{$path}");
        if (!file_exists(dirname($fullPath))) {
            mkdir(dirname($fullPath), 0755, true);
        }
        $image->toJpeg(85)->save($fullPath);
        $size = filesize($fullPath);
        $width = $image->width();
        $height = $image->height();

        Media::create([
            'user_id' => auth()->id(),
            'filename' => $filename,
            'original_name' => $file->getClientOriginalName(),
            'path' => $path,
            'url' => asset("storage/{$path}"),
            'folder' => $mediaFolder ?: 'uploads',
            'mime_type' => 'image/jpeg',
            'extension' => 'jpg',
            'size' => $size,
            'width' => $width,
            'height' => $height,
        ]);

        return $path;
    }

    /**
     * Sync a model's featured image to the Gallery table
     */
    protected function syncToGallery($model, ?string $path, string $album = 'Imported')
    {
        if (!$path) return null;

        // Ensure we are using a relative path if it's a local storage URL
        $cleanPath = $path;
        $storageUrl = asset('storage/');
        if (str_starts_with($path, $storageUrl)) {
            $cleanPath = str_replace($storageUrl, '', $path);
        }

        \Illuminate\Support\Facades\Log::info("Syncing to gallery: Path={$cleanPath}, Title=" . ($model->title ?? $model->name ?? 'Media Artikel'));

        return \App\Models\Gallery::updateOrCreate(
            [
                'file_path' => $cleanPath, 
                'title' => $model->title ?? $model->name ?? 'Media Artikel'
            ],
            [
                'album' => $album,
                'type' => 'photo',
                'is_active' => true,
                'language' => $model->language ?? app()->getLocale(),
            ]
        );
    }
}
