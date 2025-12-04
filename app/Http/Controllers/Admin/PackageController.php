<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Services\ImageKitService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PackageController extends Controller
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
        $packages = Package::select(
                'id',
                'name',
                'slug',
                'price_per_sqft',
                'image_path',
                'is_active',
                'sort_order',
                'created_at',
                'updated_at'
            )
            ->orderBy('sort_order')
            ->orderBy('name')
            ->paginate(15);

        return view('admin.packages.index', [
            'pageTitle' => 'Packages',
            'packages' => $packages,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.packages.create', [
            'pageTitle' => 'Create Package',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:packages,slug'],
            'price_per_sqft' => ['required', 'integer', 'min:0'],
            'image' => ['nullable', 'image', 'mimes:png,jpg,jpeg,gif,webp', 'max:5120'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        // Generate slug if not provided
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }

        // Handle image upload to ImageKit
        if ($request->hasFile('image')) {
            $upload = $this->imageKit->upload($request->file('image'), 'atha/packages');
            $data['image_path'] = $upload->result->url ?? null;
            $data['image_file_id'] = $upload->result->fileId ?? null;
        }

        $data['is_active'] = $request->boolean('is_active', true);
        $data['sort_order'] = $data['sort_order'] ?? 0;

        Package::create($data);

        return redirect()
            ->route('admin.packages.index')
            ->with('status', 'Package created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return redirect()->route('admin.packages.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $package = Package::findOrFail($id);

        return view('admin.packages.edit', [
            'pageTitle' => 'Edit Package',
            'package' => $package,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $package = Package::findOrFail($id);

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:packages,slug,' . $id],
            'price_per_sqft' => ['required', 'integer', 'min:0'],
            'image' => ['nullable', 'image', 'mimes:png,jpg,jpeg,gif,webp', 'max:5120'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        // Generate slug if not provided
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }

        // Handle image upload to ImageKit
        if ($request->hasFile('image')) {
            // Delete old image from ImageKit if we have a file ID
            if ($package->image_file_id) {
                $this->imageKit->delete($package->image_file_id);
            }

            $upload = $this->imageKit->upload($request->file('image'), 'atha/packages');
            $data['image_path'] = $upload->result->url ?? $package->image_path;
            $data['image_file_id'] = $upload->result->fileId ?? $package->image_file_id;
        }

        $data['is_active'] = $request->boolean('is_active', $package->is_active);
        $data['sort_order'] = $data['sort_order'] ?? $package->sort_order;

        $package->update($data);

        return redirect()
            ->route('admin.packages.index')
            ->with('status', 'Package updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $package = Package::findOrFail($id);
        // Delete associated ImageKit file if we have a stored file ID
        if ($package->image_file_id) {
            $this->imageKit->delete($package->image_file_id);
        }
        $package->delete();

        return redirect()
            ->route('admin.packages.index')
            ->with('status', 'Package deleted successfully.');
    }
}
