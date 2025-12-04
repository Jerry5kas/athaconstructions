<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Package extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'price_per_sqft',
        'image_path',
        'image_file_id',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
        'price_per_sqft' => 'integer',
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        // Auto-generate slug from name if not provided
        static::creating(function ($package) {
            if (empty($package->slug)) {
                $package->slug = Str::slug($package->name);
            }
        });

        static::updating(function ($package) {
            if ($package->isDirty('name') && empty($package->slug)) {
                $package->slug = Str::slug($package->name);
            }
        });
    }

    /**
     * Get the features for this package.
     */
    public function features()
    {
        return $this->hasMany(PackageFeature::class);
    }

    /**
     * Get features for a specific section.
     */
    public function featuresForSection($sectionId)
    {
        return $this->features()->where('package_section_id', $sectionId)->first();
    }

    /**
     * Scope: Get only active packages.
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
     * Get formatted price per sqft.
     */
    public function getPricePerSqftFormattedAttribute()
    {
        return $this->price_per_sqft . '/sqft';
    }

    /**
     * Get formatted price.
     */
    public function getPriceFormattedAttribute()
    {
        return '₹' . number_format($this->price_per_sqft, 0);
    }
}
