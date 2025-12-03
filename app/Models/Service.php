<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class Service extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'image_path',
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

        // Auto-generate slug from title if not provided
        static::creating(function ($service) {
            if (empty($service->slug)) {
                $service->slug = Str::slug($service->title);
            }
        });

        static::updating(function ($service) {
            if ($service->isDirty('title') && empty($service->slug)) {
                $service->slug = Str::slug($service->title);
            }
        });
    }

    /**
     * Get the image URL.
     * Handles both ImageKit URLs (full URLs) and local storage paths.
     * Automatically optimizes ImageKit images for web delivery.
     */
    public function getImageUrlAttribute()
    {
        if (!$this->image_path) {
            return null;
        }

        // If it's already a full URL (ImageKit), optimize it for web
        if (filter_var($this->image_path, FILTER_VALIDATE_URL)) {
            // Check if it's an ImageKit URL
            if (strpos($this->image_path, 'ik.imagekit.io') !== false) {
                // Use ImageKit service to get optimized URL
                $imageKitService = app(\App\Services\ImageKitService::class);
                return $imageKitService->getOptimizedUrl($this->image_path, 'image');
            }
            // If it's another CDN URL, return as-is
            return $this->image_path;
        }

        // Otherwise, it's a local storage path
        return Storage::disk('public')->url($this->image_path);
    }

    /**
     * Scope: Get only active services.
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
        return $query->orderBy('sort_order')->orderBy('title');
    }

    /**
     * Get services optimized for dropdowns/selects.
     */
    public static function getForSelect()
    {
        return static::active()
            ->ordered()
            ->select('id', 'title', 'slug')
            ->get()
            ->pluck('title', 'id');
    }
}
