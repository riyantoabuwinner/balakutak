<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ResearchService extends Model
{
    protected $table = 'research_services';

    protected $fillable = [
        'title',
        'slug',
        'author',
        'year',
        'type',
        'abstract',
        'content',
        'featured_image',
        'file_path',
        'external_link',
        'is_active',
        'order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function getFeaturedImageUrlAttribute()
    {
        if ($this->featured_image) {
            if (str_contains($this->featured_image, 'http')) {
                return $this->featured_image;
            }
            return asset('storage/' . $this->featured_image);
        }
        return asset('images/placeholder-research.jpg');
    }

    public function getExcerptAttribute($value)
    {
        if ($this->abstract) {
            return Str::limit($this->abstract, 160);
        }
        return Str::limit(strip_tags($this->content), 160);
    }

    public function getPublishedAtAttribute()
    {
        return $this->created_at;
    }

    public function getViewsAttribute()
    {
        return 0; // Placeholder for now
    }

    public function getCategoryAttribute()
    {
        // Mock category for front-end badge
        return (object)[
            'name' => ($this->type === 'research' ? 'Penelitian' : 'Pengabdian')
        ];
    }

    public function getUserAttribute()
    {
        // Mock user for front-end compatibility
        return (object)[
            'name' => ($this->author ?? 'Admin')
        ];
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->title);
            }
        });
    }
}
