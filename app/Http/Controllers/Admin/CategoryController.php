<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Services\ImageKitService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
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
        // Optimized query with eager loading and pagination
        $categories = Category::select('id', 'name', 'slug', 'media_path', 'media_type', 'is_active', 'sort_order', 'created_at')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->paginate(15); // Optimized pagination size

        return view('admin.categories.index', [
            'pageTitle' => 'Categories',
            'categories' => $categories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create', [
            'pageTitle' => 'Create Category',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:categories,slug'],
            'description' => ['nullable', 'string'],
            'media' => ['nullable', 'file', 'mimes:png,jpg,jpeg,gif,svg,webp', 'max:5120'], // 5MB max
            'media_type' => ['nullable', 'string', 'in:image,svg,icon'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        // Generate slug if not provided
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }

        // Handle file upload to ImageKit
        if ($request->hasFile('media')) {
            $file = $request->file('media');
            $extension = $file->getClientOriginalExtension();
            
            // Determine media type based on extension
            if (empty($data['media_type'])) {
                if (in_array(strtolower($extension), ['svg'])) {
                    $data['media_type'] = 'svg';
                } elseif (in_array(strtolower($extension), ['ico', 'icon'])) {
                    $data['media_type'] = 'icon';
                } else {
                    $data['media_type'] = 'image';
                }
            }
            
            $upload = $this->imageKit->upload($file, 'atha/categories');
            $data['media_path'] = $upload->result->url ?? null;
            $data['media_file_id'] = $upload->result->fileId ?? null;
        }

        $data['is_active'] = $request->boolean('is_active', true);
        $data['sort_order'] = $data['sort_order'] ?? 0;

        Category::create($data);

        return redirect()
            ->route('admin.categories.index')
            ->with('status', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return redirect()->route('admin.categories.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);

        return view('admin.categories.edit', [
            'pageTitle' => 'Edit Category',
            'category' => $category,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::findOrFail($id);

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:categories,slug,' . $id],
            'description' => ['nullable', 'string'],
            'media' => ['nullable', 'file', 'mimes:png,jpg,jpeg,gif,svg,webp', 'max:5120'],
            'media_type' => ['nullable', 'string', 'in:image,svg,icon'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        // Generate slug if not provided
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }

        // Handle file upload to ImageKit
        if ($request->hasFile('media')) {
            // Delete old media from ImageKit if we have a file ID
            if ($category->media_file_id) {
                $this->imageKit->delete($category->media_file_id);
            }

            $file = $request->file('media');
            $extension = $file->getClientOriginalExtension();
            
            // Determine media type based on extension
            if (empty($data['media_type'])) {
                if (in_array(strtolower($extension), ['svg'])) {
                    $data['media_type'] = 'svg';
                } elseif (in_array(strtolower($extension), ['ico', 'icon'])) {
                    $data['media_type'] = 'icon';
                } else {
                    $data['media_type'] = 'image';
                }
            }
            
            $upload = $this->imageKit->upload($file, 'atha/categories');
            $data['media_path'] = $upload->result->url ?? $category->media_path;
            $data['media_file_id'] = $upload->result->fileId ?? $category->media_file_id;
        }

        $data['is_active'] = $request->boolean('is_active', $category->is_active);
        $data['sort_order'] = $data['sort_order'] ?? $category->sort_order;

        $category->update($data);

        return redirect()
            ->route('admin.categories.index')
            ->with('status', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        // Delete associated ImageKit file if we have a stored file ID
        if ($category->media_file_id) {
            $this->imageKit->delete($category->media_file_id);
        }
        $category->delete();

        return redirect()
            ->route('admin.categories.index')
            ->with('status', 'Category deleted successfully.');
    }
}

