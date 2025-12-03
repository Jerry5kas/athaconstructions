<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Services\ImageKitService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceController extends Controller
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
        // Optimized query with selective columns and pagination
        $services = Service::select(
                'id',
                'title',
                'slug',
                'description',
                'image_path',
                'is_active',
                'sort_order',
                'created_at',
                'updated_at'
            )
            ->orderBy('sort_order')
            ->orderBy('title')
            ->paginate(15); // Optimized pagination size

        return view('admin.services.index', [
            'pageTitle' => 'Services',
            'services' => $services,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.services.create', [
            'pageTitle' => 'Create Service',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:services,slug'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'mimes:png,jpg,jpeg,gif,webp', 'max:5120'], // 5MB max
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        // Generate slug if not provided
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        // Handle image upload to ImageKit
        if ($request->hasFile('image')) {
            $upload = $this->imageKit->upload($request->file('image'), 'atha/services');
            $data['image_path'] = $upload->result->url;
        }

        $data['is_active'] = $request->boolean('is_active', true);
        $data['sort_order'] = $data['sort_order'] ?? 0;

        Service::create($data);

        return redirect()
            ->route('admin.services.index')
            ->with('status', 'Service created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return redirect()->route('admin.services.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $service = Service::findOrFail($id);

        return view('admin.services.edit', [
            'pageTitle' => 'Edit Service',
            'service' => $service,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $service = Service::findOrFail($id);

        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:services,slug,' . $id],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'mimes:png,jpg,jpeg,gif,webp', 'max:5120'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        // Generate slug if not provided
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        // Handle image upload to ImageKit
        if ($request->hasFile('image')) {
            // Note: For ImageKit, we don't delete old files automatically
            // as we'd need fileId. Old URLs will remain but new one is stored.
            $upload = $this->imageKit->upload($request->file('image'), 'atha/services');
            $data['image_path'] = $upload->result->url;
        }

        $data['is_active'] = $request->boolean('is_active', $service->is_active);
        $data['sort_order'] = $data['sort_order'] ?? $service->sort_order;

        $service->update($data);

        return redirect()
            ->route('admin.services.index')
            ->with('status', 'Service updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $service = Service::findOrFail($id);

        // Note: ImageKit file deletion would require fileId
        // For now, we just delete the database record
        // Old ImageKit files can be cleaned up manually from dashboard if needed

        $service->delete();

        return redirect()
            ->route('admin.services.index')
            ->with('status', 'Service deleted successfully.');
    }
}

