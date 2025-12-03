<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeroSection extends Model
{
    protected $fillable = [
        'title',
        'page_title',
        'description',
        'pagetype',
        'image_path',
        'video_path',
        'use_image',
        'use_video',
        'is_active',
    ];

    protected $casts = [
        'use_image' => 'boolean',
        'use_video' => 'boolean',
        'is_active' => 'boolean',
    ];

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
        return \Illuminate\Support\Facades\Storage::disk('public')->url($this->image_path);
    }

    /**
     * Get the video URL.
     * Handles both ImageKit URLs (full URLs) and local storage paths.
     * Automatically optimizes ImageKit videos for web delivery.
     */
    public function getVideoUrlAttribute()
    {
        if (!$this->video_path) {
            return null;
        }

        // If it's already a full URL (ImageKit), optimize it for web
        if (filter_var($this->video_path, FILTER_VALIDATE_URL)) {
            // Check if it's an ImageKit URL
            if (strpos($this->video_path, 'ik.imagekit.io') !== false) {
                // Use ImageKit service to get optimized URL
                $imageKitService = app(\App\Services\ImageKitService::class);
                return $imageKitService->getVideoUrlWithQuality($this->video_path, 'auto');
            }
            // If it's another CDN URL, return as-is
            return $this->video_path;
        }

        // Otherwise, it's a local storage path
        return \Illuminate\Support\Facades\Storage::disk('public')->url($this->video_path);
    }
}
