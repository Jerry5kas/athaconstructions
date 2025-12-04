<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Testimonial extends Model
{
    protected $fillable = [
        'slug',
        'title',
        'review_text',
        'rating',
        'client_name',
        'client_role',
        'client_company',
        'client_avatar',
        'project_name',
        'project_location',
        'project_type',
        'featured',
        'status',
        'published_at',
    ];

    protected $casts = [
        'featured'     => 'boolean',
        'rating'       => 'integer',
        'published_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($testimonial) {
            if (empty($testimonial->slug)) {
                $testimonial->slug = Str::slug($testimonial->title ?: $testimonial->client_name);
            }
        });

        static::updating(function ($testimonial) {
            if ($testimonial->isDirty('title') && empty($testimonial->slug)) {
                $testimonial->slug = Str::slug($testimonial->title ?: $testimonial->client_name);
            }
        });
    }

    public function media()
    {
        return $this->hasMany(TestimonialMedia::class)->orderBy('sort_order');
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }
}


