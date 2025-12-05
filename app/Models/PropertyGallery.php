<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Services\ImageKitService;

class PropertyGallery extends Model
{
    protected $table = 'property_gallery';

    protected $fillable = [
        'property_id',
        'type',
        'image_url',
        'image_file_id',
        'sort_order',
    ];

    protected $casts = [
        'sort_order' => 'integer',
    ];

    /**
     * Relationships
     */
    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    /**
     * Get the optimized image URL.
     * Handles both ImageKit URLs (full URLs) and local storage paths.
     * Automatically optimizes ImageKit images for web delivery.
     */
    public function getOptimizedImageUrlAttribute()
    {
        $url = $this->image_url;
        
        if (!$url) {
            return null;
        }

        // If it's already a full URL (ImageKit), optimize it for web
        if (filter_var($url, FILTER_VALIDATE_URL)) {
            // Check if it's an ImageKit URL
            if (strpos($url, 'ik.imagekit.io') !== false) {
                // Use ImageKit service to get optimized URL
                $imageKitService = app(ImageKitService::class);
                return $imageKitService->getOptimizedUrl($url, 'image');
            }
            // If it's another CDN URL, return as-is
            return $url;
        }

        // Otherwise, it's a local storage path
        return \Illuminate\Support\Facades\Storage::disk('public')->url($url);
    }

    /**
     * Scopes
     */
    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('created_at');
    }
}

