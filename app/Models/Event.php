<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id', 'title', 'slug', 'description', 'content', 'featured_image',
        'location', 'online_url', 'start_date', 'end_date',
        'registration_deadline', 'max_participants', 'is_published',
        'is_free', 'price', 'category', 'organizer', 'contact_person', 
        'registration_url', 'seo_meta',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'registration_deadline' => 'datetime',
        'is_published' => 'boolean',
        'is_free' => 'boolean',
        'seo_meta' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeUpcoming($query)
    {
        return $query->where('start_date', '>=', now());
    }

    public function getFeaturedImageUrlAttribute(): string
    {
        if ($this->featured_image) {
            return asset('storage/' . $this->featured_image);
        }
        return asset('images/default-event.jpg');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
