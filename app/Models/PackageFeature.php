<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackageFeature extends Model
{
    protected $fillable = [
        'package_section_id',
        'package_id',
        'content',
    ];

    /**
     * Get the package section that owns this feature.
     */
    public function section()
    {
        return $this->belongsTo(PackageSection::class, 'package_section_id');
    }

    /**
     * Get the package that owns this feature.
     */
    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}
