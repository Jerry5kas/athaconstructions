<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'media_path',
        'media_type',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        // Auto-generate slug from name if not provided
        static::creating(function ($category) {
            if (empty($category->slug)) {
                $category->slug = Str::slug($category->name);
            }
        });

        static::updating(function ($category) {
            if ($category->isDirty('name') && empty($category->slug)) {
                $category->slug = Str::slug($category->name);
            }
        });
    }

    /**
     * Get the media URL.
     * Handles both ImageKit URLs (full URLs) and local storage paths.
     * Automatically optimizes ImageKit media for web delivery.
     */
    public function getMediaUrlAttribute()
    {
        if (!$this->media_path) {
            return null;
        }

        // If it's already a full URL (ImageKit), optimize it for web
        if (filter_var($this->media_path, FILTER_VALIDATE_URL)) {
            // Check if it's an ImageKit URL
            if (strpos($this->media_path, 'ik.imagekit.io') !== false) {
                // Use ImageKit service to get optimized URL
                $imageKitService = app(\App\Services\ImageKitService::class);
                // Use media_type if available, otherwise auto-detect
                $mediaType = $this->media_type === 'svg' ? 'svg' : 
                            ($this->media_type === 'icon' ? 'icon' : 'image');
                return $imageKitService->getOptimizedUrl($this->media_path, $mediaType);
            }
            // If it's another CDN URL, return as-is
            return $this->media_path;
        }

        // Otherwise, it's a local storage path
        return Storage::disk('public')->url($this->media_path);
    }

    /**
     * Scope: Get only active categories.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope: Order by sort order.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }

    /**
     * Scope: Filter by media type.
     */
    public function scopeByMediaType($query, $type)
    {
        return $query->where('media_type', $type);
    }

    /**
     * Get categories optimized for dropdowns/selects.
     */
    public static function getForSelect()
    {
        return static::active()
            ->ordered()
            ->select('id', 'name', 'slug')
            ->get()
            ->pluck('name', 'id');
    }
}
