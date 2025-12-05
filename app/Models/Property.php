<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Services\ImageKitService;

class Property extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'project_type',
        'status',
        'rera_number',
        'short_description',
        'description',
        'launch_date',
        'possession_date',
        'total_land_area',
        'total_units',
        'floors',
        'featured_image',
        'featured_image_file_id',
        'brochure_url',
        'video_url',
        'meta_title',
        'meta_description',
    ];

    protected $casts = [
        'launch_date' => 'date',
        'possession_date' => 'date',
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        // Auto-generate slug from title if not provided
        static::creating(function ($property) {
            if (empty($property->slug)) {
                $property->slug = Str::slug($property->title);
            }
        });

        static::updating(function ($property) {
            if ($property->isDirty('title') && empty($property->slug)) {
                $property->slug = Str::slug($property->title);
            }
        });
    }

    /**
     * Get the featured image URL.
     * Handles both ImageKit URLs (full URLs) and local storage paths.
     * Automatically optimizes ImageKit images for web delivery.
     */
    public function getFeaturedImageUrlAttribute()
    {
        if (!$this->featured_image) {
            return null;
        }

        // If it's already a full URL (ImageKit), optimize it for web
        if (filter_var($this->featured_image, FILTER_VALIDATE_URL)) {
            // Check if it's an ImageKit URL
            if (strpos($this->featured_image, 'ik.imagekit.io') !== false) {
                // Use ImageKit service to get optimized URL
                $imageKitService = app(ImageKitService::class);
                return $imageKitService->getOptimizedUrl($this->featured_image, 'image');
            }
            // If it's another CDN URL, return as-is
            return $this->featured_image;
        }

        // Otherwise, it's a local storage path
        return \Illuminate\Support\Facades\Storage::disk('public')->url($this->featured_image);
    }

    /**
     * Relationships
     */
    public function location()
    {
        return $this->hasOne(PropertyLocation::class);
    }

    public function units()
    {
        return $this->hasMany(PropertyUnit::class);
    }

    public function amenities()
    {
        return $this->belongsToMany(Amenity::class, 'property_amenities');
    }

    public function gallery()
    {
        return $this->hasMany(PropertyGallery::class);
    }

    public function specifications()
    {
        return $this->hasMany(PropertySpecification::class);
    }

    /**
     * Scopes
     */
    public function scopeUpcoming($query)
    {
        return $query->where('status', 'upcoming');
    }

    public function scopeOngoing($query)
    {
        return $query->where('status', 'ongoing');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function scopeByType($query, $type)
    {
        return $query->where('project_type', $type);
    }

    /**
     * Get properties ordered by status priority and date
     */
    public function scopeOrdered($query)
    {
        return $query->orderByRaw("CASE 
            WHEN status = 'ongoing' THEN 1 
            WHEN status = 'upcoming' THEN 2 
            WHEN status = 'completed' THEN 3 
            ELSE 4 
        END")
        ->orderByDesc('created_at');
    }
}

