<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Services\ImageKitService;

class PropertyUnit extends Model
{
    protected $fillable = [
        'property_id',
        'bhk',
        'carpet_area',
        'builtup_area',
        'super_builtup_area',
        'floor_plan_image',
        'floor_plan_image_file_id',
    ];

    /**
     * Relationships
     */
    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    /**
     * Get the floor plan image URL.
     * Handles both ImageKit URLs (full URLs) and local storage paths.
     * Automatically optimizes ImageKit images for web delivery.
     */
    public function getFloorPlanImageUrlAttribute()
    {
        if (!$this->floor_plan_image) {
            return null;
        }

        // If it's already a full URL (ImageKit), optimize it for web
        if (filter_var($this->floor_plan_image, FILTER_VALIDATE_URL)) {
            // Check if it's an ImageKit URL
            if (strpos($this->floor_plan_image, 'ik.imagekit.io') !== false) {
                // Use ImageKit service to get optimized URL
                $imageKitService = app(ImageKitService::class);
                return $imageKitService->getOptimizedUrl($this->floor_plan_image, 'image');
            }
            // If it's another CDN URL, return as-is
            return $this->floor_plan_image;
        }

        // Otherwise, it's a local storage path
        return \Illuminate\Support\Facades\Storage::disk('public')->url($this->floor_plan_image);
    }
}

