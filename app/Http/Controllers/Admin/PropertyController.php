<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\PropertyLocation;
use App\Models\PropertyUnit;
use App\Models\PropertyGallery;
use App\Models\PropertySpecification;
use App\Models\Amenity;
use App\Services\ImageKitService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class PropertyController extends Controller
{
    protected $imageKit;

    public function __construct(ImageKitService $imageKit)
    {
        $this->imageKit = $imageKit;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Property::with(['location'])
            ->select(
                'id',
                'title',
                'slug',
                'project_type',
                'status',
                'featured_image',
                'created_at',
                'updated_at'
            );

        // Filter by status
        if ($status = request()->query('status')) {
            $query->where('status', $status);
        }

        // Filter by project type
        if ($type = request()->query('type')) {
            $query->where('project_type', $type);
        }

        // Search
        if ($search = request()->query('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('short_description', 'like', "%{$search}%");
            });
        }

        $properties = $query->ordered()->paginate(15)->withQueryString();

        return view('admin.properties.index', [
            'pageTitle' => 'Properties',
            'properties' => $properties,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $amenities = Amenity::active()->ordered()->get();

        return view('admin.properties.create', [
            'pageTitle' => 'Create Property',
            'amenities' => $amenities,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            // Property fields
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:properties,slug'],
            'project_type' => ['required', 'in:apartment,villa,plot,commercial'],
            'status' => ['required', 'in:upcoming,ongoing,completed'],
            'rera_number' => ['nullable', 'string', 'max:255'],
            'short_description' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'launch_date' => ['nullable', 'date'],
            'possession_date' => ['nullable', 'date'],
            'total_land_area' => ['nullable', 'string', 'max:255'],
            'total_units' => ['nullable', 'integer', 'min:0'],
            'floors' => ['nullable', 'integer', 'min:0'],
            'featured_image' => ['nullable', 'image', 'mimes:png,jpg,jpeg,gif,webp', 'max:5120'],
            'brochure_url' => ['nullable', 'url', 'max:500'],
            'video_url' => ['nullable', 'url', 'max:500'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string'],

            // Location fields
            'address' => ['required', 'string'],
            'city' => ['required', 'string', 'max:100'],
            'locality' => ['nullable', 'string', 'max:255'],
            'landmark' => ['nullable', 'string', 'max:255'],
            'latitude' => ['nullable', 'string', 'max:50'],
            'longitude' => ['nullable', 'string', 'max:50'],
            'pincode' => ['nullable', 'string', 'max:10'],

            // Units (array)
            'units' => ['nullable', 'array'],
            'units.*.bhk' => ['required_with:units', 'integer', 'min:1', 'max:10'],
            'units.*.carpet_area' => ['nullable', 'numeric', 'min:0'],
            'units.*.builtup_area' => ['nullable', 'numeric', 'min:0'],
            'units.*.super_builtup_area' => ['nullable', 'numeric', 'min:0'],
            'units.*.floor_plan_image' => ['nullable', 'image', 'mimes:png,jpg,jpeg,gif,webp', 'max:5120'],

            // Amenities
            'amenities' => ['nullable', 'array'],
            'amenities.*' => ['exists:amenities,id'],

            // Gallery
            'gallery' => ['nullable', 'array'],
            'gallery.*.type' => ['required_with:gallery', 'in:interior,exterior,amenities,floorplan,masterplan'],
            'gallery.*.image' => ['required_with:gallery', 'image', 'mimes:png,jpg,jpeg,gif,webp', 'max:5120'],

            // Specifications
            'specifications' => ['nullable', 'array'],
            'specifications.*.section' => ['required_with:specifications', 'string', 'max:255'],
            'specifications.*.description' => ['required_with:specifications', 'string'],
        ]);

        DB::beginTransaction();
        try {
            // Generate slug if not provided
            if (empty($validated['slug'])) {
                $validated['slug'] = Str::slug($validated['title']);
            }

            // Handle featured image upload
            if ($request->hasFile('featured_image')) {
                $upload = $this->imageKit->upload($request->file('featured_image'), 'atha/properties');
                $validated['featured_image'] = $upload->result->url ?? null;
                $validated['featured_image_file_id'] = $upload->result->fileId ?? null;
            }

            // Create property
            $property = Property::create([
                'title' => $validated['title'],
                'slug' => $validated['slug'],
                'project_type' => $validated['project_type'],
                'status' => $validated['status'],
                'rera_number' => $validated['rera_number'] ?? null,
                'short_description' => $validated['short_description'] ?? null,
                'description' => $validated['description'] ?? null,
                'launch_date' => $validated['launch_date'] ?? null,
                'possession_date' => $validated['possession_date'] ?? null,
                'total_land_area' => $validated['total_land_area'] ?? null,
                'total_units' => $validated['total_units'] ?? null,
                'floors' => $validated['floors'] ?? null,
                'featured_image' => $validated['featured_image'] ?? null,
                'featured_image_file_id' => $validated['featured_image_file_id'] ?? null,
                'brochure_url' => $validated['brochure_url'] ?? null,
                'video_url' => $validated['video_url'] ?? null,
                'meta_title' => $validated['meta_title'] ?? null,
                'meta_description' => $validated['meta_description'] ?? null,
            ]);

            // Create location
            $property->location()->create([
                'address' => $validated['address'],
                'city' => $validated['city'],
                'locality' => $validated['locality'] ?? null,
                'landmark' => $validated['landmark'] ?? null,
                'latitude' => $validated['latitude'] ?? null,
                'longitude' => $validated['longitude'] ?? null,
                'pincode' => $validated['pincode'] ?? null,
            ]);

            // Create units
            if (!empty($validated['units'])) {
                foreach ($validated['units'] as $index => $unitData) {
                    $unit = [
                        'bhk' => $unitData['bhk'],
                        'carpet_area' => $unitData['carpet_area'] ?? null,
                        'builtup_area' => $unitData['builtup_area'] ?? null,
                        'super_builtup_area' => $unitData['super_builtup_area'] ?? null,
                    ];

                    // Handle floor plan image
                    if ($request->hasFile("units.{$index}.floor_plan_image")) {
                        $upload = $this->imageKit->upload(
                            $request->file("units.{$index}.floor_plan_image"),
                            'atha/properties/floor-plans'
                        );
                        $unit['floor_plan_image'] = $upload->result->url ?? null;
                        $unit['floor_plan_image_file_id'] = $upload->result->fileId ?? null;
                    }

                    $property->units()->create($unit);
                }
            }

            // Attach amenities
            if (!empty($validated['amenities'])) {
                $property->amenities()->attach($validated['amenities']);
            }

            // Create gallery images
            if (!empty($validated['gallery'])) {
                foreach ($validated['gallery'] as $index => $galleryData) {
                    if ($request->hasFile("gallery.{$index}.image")) {
                        $upload = $this->imageKit->upload(
                            $request->file("gallery.{$index}.image"),
                            'atha/properties/gallery'
                        );
                        $property->gallery()->create([
                            'type' => $galleryData['type'],
                            'image_url' => $upload->result->url ?? null,
                            'image_file_id' => $upload->result->fileId ?? null,
                            'sort_order' => $index,
                        ]);
                    }
                }
            }

            // Create specifications
            if (!empty($validated['specifications'])) {
                foreach ($validated['specifications'] as $index => $specData) {
                    $property->specifications()->create([
                        'section' => $specData['section'],
                        'description' => $specData['description'],
                        'sort_order' => $index,
                    ]);
                }
            }

            DB::commit();

            return redirect()
                ->route('admin.properties.index')
                ->with('status', 'Property created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Property creation failed', ['error' => $e->getMessage()]);
            
            return back()
                ->withInput()
                ->withErrors(['error' => 'Failed to create property. Please try again.']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return redirect()->route('admin.properties.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $property = Property::with(['location', 'units', 'amenities', 'gallery', 'specifications'])
            ->findOrFail($id);

        $amenities = Amenity::active()->ordered()->get();

        return view('admin.properties.edit', [
            'pageTitle' => 'Edit Property',
            'property' => $property,
            'amenities' => $amenities,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $property = Property::findOrFail($id);

        $validated = $request->validate([
            // Property fields
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:properties,slug,' . $id],
            'project_type' => ['required', 'in:apartment,villa,plot,commercial'],
            'status' => ['required', 'in:upcoming,ongoing,completed'],
            'rera_number' => ['nullable', 'string', 'max:255'],
            'short_description' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'launch_date' => ['nullable', 'date'],
            'possession_date' => ['nullable', 'date'],
            'total_land_area' => ['nullable', 'string', 'max:255'],
            'total_units' => ['nullable', 'integer', 'min:0'],
            'floors' => ['nullable', 'integer', 'min:0'],
            'featured_image' => ['nullable', 'image', 'mimes:png,jpg,jpeg,gif,webp', 'max:5120'],
            'brochure_url' => ['nullable', 'url', 'max:500'],
            'video_url' => ['nullable', 'url', 'max:500'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string'],

            // Location fields
            'address' => ['required', 'string'],
            'city' => ['required', 'string', 'max:100'],
            'locality' => ['nullable', 'string', 'max:255'],
            'landmark' => ['nullable', 'string', 'max:255'],
            'latitude' => ['nullable', 'string', 'max:50'],
            'longitude' => ['nullable', 'string', 'max:50'],
            'pincode' => ['nullable', 'string', 'max:10'],

            // Units (array)
            'units' => ['nullable', 'array'],
            'units.*.id' => ['nullable', 'exists:property_units,id'],
            'units.*.bhk' => ['required_with:units', 'integer', 'min:1', 'max:10'],
            'units.*.carpet_area' => ['nullable', 'numeric', 'min:0'],
            'units.*.builtup_area' => ['nullable', 'numeric', 'min:0'],
            'units.*.super_builtup_area' => ['nullable', 'numeric', 'min:0'],
            'units.*.floor_plan_image' => ['nullable', 'image', 'mimes:png,jpg,jpeg,gif,webp', 'max:5120'],

            // Amenities
            'amenities' => ['nullable', 'array'],
            'amenities.*' => ['exists:amenities,id'],

            // Gallery
            'gallery' => ['nullable', 'array'],
            'gallery.*.id' => ['nullable', 'exists:property_gallery,id'],
            'gallery.*.type' => ['required_with:gallery', 'in:interior,exterior,amenities,floorplan,masterplan'],
            'gallery.*.image' => ['nullable', 'image', 'mimes:png,jpg,jpeg,gif,webp', 'max:5120'],

            // Specifications
            'specifications' => ['nullable', 'array'],
            'specifications.*.id' => ['nullable', 'exists:property_specifications,id'],
            'specifications.*.section' => ['required_with:specifications', 'string', 'max:255'],
            'specifications.*.description' => ['required_with:specifications', 'string'],
        ]);

        DB::beginTransaction();
        try {
            // Generate slug if not provided
            if (empty($validated['slug'])) {
                $validated['slug'] = Str::slug($validated['title']);
            }

            // Handle featured image upload
            if ($request->hasFile('featured_image')) {
                // Delete old image if exists
                if ($property->featured_image_file_id) {
                    $this->imageKit->delete($property->featured_image_file_id);
                }

                $upload = $this->imageKit->upload($request->file('featured_image'), 'atha/properties');
                $validated['featured_image'] = $upload->result->url ?? $property->featured_image;
                $validated['featured_image_file_id'] = $upload->result->fileId ?? $property->featured_image_file_id;
            }

            // Update property
            $property->update([
                'title' => $validated['title'],
                'slug' => $validated['slug'],
                'project_type' => $validated['project_type'],
                'status' => $validated['status'],
                'rera_number' => $validated['rera_number'] ?? null,
                'short_description' => $validated['short_description'] ?? null,
                'description' => $validated['description'] ?? null,
                'launch_date' => $validated['launch_date'] ?? null,
                'possession_date' => $validated['possession_date'] ?? null,
                'total_land_area' => $validated['total_land_area'] ?? null,
                'total_units' => $validated['total_units'] ?? null,
                'floors' => $validated['floors'] ?? null,
                'featured_image' => $validated['featured_image'] ?? $property->featured_image,
                'featured_image_file_id' => $validated['featured_image_file_id'] ?? $property->featured_image_file_id,
                'brochure_url' => $validated['brochure_url'] ?? null,
                'video_url' => $validated['video_url'] ?? null,
                'meta_title' => $validated['meta_title'] ?? null,
                'meta_description' => $validated['meta_description'] ?? null,
            ]);

            // Update or create location
            $property->location()->updateOrCreate(
                ['property_id' => $property->id],
                [
                    'address' => $validated['address'],
                    'city' => $validated['city'],
                    'locality' => $validated['locality'] ?? null,
                    'landmark' => $validated['landmark'] ?? null,
                    'latitude' => $validated['latitude'] ?? null,
                    'longitude' => $validated['longitude'] ?? null,
                    'pincode' => $validated['pincode'] ?? null,
                ]
            );

            // Handle units - update existing, create new, delete removed
            $existingUnitIds = $property->units->pluck('id')->toArray();
            $submittedUnitIds = [];

            if (!empty($validated['units'])) {
                foreach ($validated['units'] as $index => $unitData) {
                    $unit = [
                        'bhk' => $unitData['bhk'],
                        'carpet_area' => $unitData['carpet_area'] ?? null,
                        'builtup_area' => $unitData['builtup_area'] ?? null,
                        'super_builtup_area' => $unitData['super_builtup_area'] ?? null,
                    ];

                    // Handle floor plan image
                    if ($request->hasFile("units.{$index}.floor_plan_image")) {
                        // Delete old image if exists
                        if (isset($unitData['id']) && $existingUnit = PropertyUnit::find($unitData['id'])) {
                            if ($existingUnit->floor_plan_image_file_id) {
                                $this->imageKit->delete($existingUnit->floor_plan_image_file_id);
                            }
                        }

                        $upload = $this->imageKit->upload(
                            $request->file("units.{$index}.floor_plan_image"),
                            'atha/properties/floor-plans'
                        );
                        $unit['floor_plan_image'] = $upload->result->url ?? null;
                        $unit['floor_plan_image_file_id'] = $upload->result->fileId ?? null;
                    }

                    if (isset($unitData['id']) && in_array($unitData['id'], $existingUnitIds)) {
                        // Update existing unit
                        $property->units()->where('id', $unitData['id'])->update($unit);
                        $submittedUnitIds[] = $unitData['id'];
                    } else {
                        // Create new unit
                        $newUnit = $property->units()->create($unit);
                        $submittedUnitIds[] = $newUnit->id;
                    }
                }
            }

            // Delete units that were removed
            $unitsToDelete = array_diff($existingUnitIds, $submittedUnitIds);
            if (!empty($unitsToDelete)) {
                foreach ($unitsToDelete as $unitId) {
                    $unit = PropertyUnit::find($unitId);
                    if ($unit && $unit->floor_plan_image_file_id) {
                        $this->imageKit->delete($unit->floor_plan_image_file_id);
                    }
                }
                $property->units()->whereIn('id', $unitsToDelete)->delete();
            }

            // Sync amenities
            $property->amenities()->sync($validated['amenities'] ?? []);

            // Handle gallery - update existing, create new, delete removed
            $existingGalleryIds = $property->gallery->pluck('id')->toArray();
            $submittedGalleryIds = [];

            if (!empty($validated['gallery'])) {
                foreach ($validated['gallery'] as $index => $galleryData) {
                    $galleryItem = [
                        'type' => $galleryData['type'],
                    ];

                    if ($request->hasFile("gallery.{$index}.image")) {
                        // Delete old image if exists
                        if (isset($galleryData['id']) && $existingGallery = PropertyGallery::find($galleryData['id'])) {
                            if ($existingGallery->image_file_id) {
                                $this->imageKit->delete($existingGallery->image_file_id);
                            }
                        }

                        $upload = $this->imageKit->upload(
                            $request->file("gallery.{$index}.image"),
                            'atha/properties/gallery'
                        );
                        $galleryItem['image_url'] = $upload->result->url ?? null;
                        $galleryItem['image_file_id'] = $upload->result->fileId ?? null;
                        $galleryItem['sort_order'] = $index;
                    }

                    if (isset($galleryData['id']) && in_array($galleryData['id'], $existingGalleryIds)) {
                        // Update existing gallery item
                        if (isset($galleryItem['image_url'])) {
                            $property->gallery()->where('id', $galleryData['id'])->update($galleryItem);
                        } else {
                            // Only update type if no new image
                            $property->gallery()->where('id', $galleryData['id'])->update(['type' => $galleryData['type']]);
                        }
                        $submittedGalleryIds[] = $galleryData['id'];
                    } else {
                        // Create new gallery item (only if image is provided)
                        if (isset($galleryItem['image_url'])) {
                            $newGallery = $property->gallery()->create($galleryItem);
                            $submittedGalleryIds[] = $newGallery->id;
                        }
                    }
                }
            }

            // Delete gallery items that were removed
            $galleryToDelete = array_diff($existingGalleryIds, $submittedGalleryIds);
            if (!empty($galleryToDelete)) {
                foreach ($galleryToDelete as $galleryId) {
                    $gallery = PropertyGallery::find($galleryId);
                    if ($gallery && $gallery->image_file_id) {
                        $this->imageKit->delete($gallery->image_file_id);
                    }
                }
                $property->gallery()->whereIn('id', $galleryToDelete)->delete();
            }

            // Handle specifications - update existing, create new, delete removed
            $existingSpecIds = $property->specifications->pluck('id')->toArray();
            $submittedSpecIds = [];

            if (!empty($validated['specifications'])) {
                foreach ($validated['specifications'] as $index => $specData) {
                    $spec = [
                        'section' => $specData['section'],
                        'description' => $specData['description'],
                        'sort_order' => $index,
                    ];

                    if (isset($specData['id']) && in_array($specData['id'], $existingSpecIds)) {
                        // Update existing spec
                        $property->specifications()->where('id', $specData['id'])->update($spec);
                        $submittedSpecIds[] = $specData['id'];
                    } else {
                        // Create new spec
                        $newSpec = $property->specifications()->create($spec);
                        $submittedSpecIds[] = $newSpec->id;
                    }
                }
            }

            // Delete specs that were removed
            $specsToDelete = array_diff($existingSpecIds, $submittedSpecIds);
            if (!empty($specsToDelete)) {
                $property->specifications()->whereIn('id', $specsToDelete)->delete();
            }

            DB::commit();

            return redirect()
                ->route('admin.properties.index')
                ->with('status', 'Property updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Property update failed', ['error' => $e->getMessage()]);
            
            return back()
                ->withInput()
                ->withErrors(['error' => 'Failed to update property. Please try again.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $property = Property::with(['gallery', 'units'])->findOrFail($id);

        DB::beginTransaction();
        try {
            // Delete featured image from ImageKit
            if ($property->featured_image_file_id) {
                $this->imageKit->delete($property->featured_image_file_id);
            }

            // Delete gallery images from ImageKit
            foreach ($property->gallery as $galleryItem) {
                if ($galleryItem->image_file_id) {
                    $this->imageKit->delete($galleryItem->image_file_id);
                }
            }

            // Delete unit floor plan images from ImageKit
            foreach ($property->units as $unit) {
                if ($unit->floor_plan_image_file_id) {
                    $this->imageKit->delete($unit->floor_plan_image_file_id);
                }
            }

            // Delete property (cascade will handle related records)
            $property->delete();

            DB::commit();

            return redirect()
                ->route('admin.properties.index')
                ->with('status', 'Property deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Property deletion failed', ['error' => $e->getMessage()]);
            
            return back()
                ->withErrors(['error' => 'Failed to delete property. Please try again.']);
        }
    }
}

