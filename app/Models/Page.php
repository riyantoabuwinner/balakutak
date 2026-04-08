<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [
        'user_id', 'title', 'slug', 'content', 'excerpt', 'featured_image',
        'template', 'is_builder', 'builder_data', 'is_published', 'order', 'seo_meta'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
