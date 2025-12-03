<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Services\ImageKitService;
use App\Models\BlogCategory;
use App\Models\Tag;

class Blog extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'cover_image',
        'cover_image_file_id',
        'meta_title',
        'meta_description',
        'keywords',
        'category_id',
        'author',
        'status',
        'published_at',
        'views',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    /**
     * Model boot method.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function (Blog $blog) {
            // Auto-generate slug if not provided
            if (empty($blog->slug)) {
                $blog->slug = Str::slug($blog->title);
            }

            // Default meta title to title if not set
            if (empty($blog->meta_title)) {
                $blog->meta_title = $blog->title;
            }
        });

        static::updating(function (Blog $blog) {
            // If title changed and slug is empty, regenerate slug
            if ($blog->isDirty('title') && empty($blog->slug)) {
                $blog->slug = Str::slug($blog->title);
            }
        });
    }

    /**
     * Accessor: Get the optimized cover image URL.
     * Handles both ImageKit URLs (full URLs) and local storage paths.
     */
    public function getCoverImageUrlAttribute(): ?string
    {
        if (! $this->cover_image) {
            return null;
        }

        // If it's already a full URL (likely ImageKit or another CDN)
        if (filter_var($this->cover_image, FILTER_VALIDATE_URL)) {
            // If it's an ImageKit URL, apply optimization
            if (strpos($this->cover_image, 'ik.imagekit.io') !== false) {
                /** @var ImageKitService $imageKit */
                $imageKit = app(ImageKitService::class);

                return $imageKit->getOptimizedUrl($this->cover_image, 'image');
            }

            // Non-ImageKit URL, return as-is
            return $this->cover_image;
        }

        // Fallback for any legacy local paths (if ever used)
        return \Illuminate\Support\Facades\Storage::disk('public')->url($this->cover_image);
    }

    /**
     * Scope: only published blogs.
     * For now we keep it simple: any blog with status = 'published'.
     * (You can re-introduce date-based filtering later if you need scheduling.)
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function category()
    {
        return $this->belongsTo(BlogCategory::class, 'category_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}


