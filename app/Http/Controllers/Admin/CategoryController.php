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
        $categories = Category::select('id', 'name', 'slug', 'type', 'media_path', 'media_type', 'is_active', 'sort_order', 'created_at')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->paginate(15); // Optimized pagination size

        return view('admin.categories.index', [
            'pageTitle' => 'Common',
            'categories' => $categories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create', [
            'pageTitle' => 'Create Common Item',
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
            // Context type (grouping), free text – e.g. "hero", "testimonial", etc.
            'type' => ['nullable', 'string', 'max:100'],
            'description' => ['nullable', 'string'],
            'media' => ['nullable', 'file', 'mimes:png,jpg,jpeg,gif,svg,webp,ico,mp4,mov,webm,mkv,avi,pdf,doc,docx,xls,xlsx,csv,ppt,pptx,txt', 'max:20480'], // up to 20MB
            'media_type' => ['nullable', 'string', 'in:image,svg,icon,video,pdf,document,spreadsheet,presentation,other'],
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
                $ext = strtolower($extension);
                $mimeType = $file->getMimeType();
                
                if (in_array($ext, ['svg'])) {
                    $data['media_type'] = 'svg';
                } elseif (in_array($ext, ['ico', 'icon'])) {
                    $data['media_type'] = 'icon';
                } elseif (in_array($ext, ['mp4', 'mov', 'webm', 'mkv', 'avi']) || strpos($mimeType, 'video/') === 0) {
                    $data['media_type'] = 'video';
                } elseif ($ext === 'pdf' || $mimeType === 'application/pdf') {
                    $data['media_type'] = 'pdf';
                } elseif (in_array($ext, ['doc', 'docx']) || in_array($mimeType, ['application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'])) {
                    $data['media_type'] = 'document';
                } elseif (in_array($ext, ['xls', 'xlsx', 'csv']) || in_array($mimeType, ['application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'text/csv'])) {
                    $data['media_type'] = 'spreadsheet';
                } elseif (in_array($ext, ['ppt', 'pptx']) || in_array($mimeType, ['application/vnd.ms-powerpoint', 'application/vnd.openxmlformats-officedocument.presentationml.presentation'])) {
                    $data['media_type'] = 'presentation';
                } elseif (in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp', 'bmp'])) {
                    $data['media_type'] = 'image';
                } else {
                    $data['media_type'] = 'other';
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
            // Context type (grouping)
            'type' => ['nullable', 'string', 'max:100'],
            'description' => ['nullable', 'string'],
            'media' => ['nullable', 'file', 'mimes:png,jpg,jpeg,gif,svg,webp,mp4,mov,webm,mkv,avi', 'max:20480'],
            'media_type' => ['nullable', 'string', 'in:image,svg,icon,video'],
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
                $ext = strtolower($extension);
                $mimeType = $file->getMimeType();
                
                if (in_array($ext, ['svg'])) {
                    $data['media_type'] = 'svg';
                } elseif (in_array($ext, ['ico', 'icon'])) {
                    $data['media_type'] = 'icon';
                } elseif (in_array($ext, ['mp4', 'mov', 'webm', 'mkv', 'avi']) || strpos($mimeType, 'video/') === 0) {
                    $data['media_type'] = 'video';
                } elseif ($ext === 'pdf' || $mimeType === 'application/pdf') {
                    $data['media_type'] = 'pdf';
                } elseif (in_array($ext, ['doc', 'docx']) || in_array($mimeType, ['application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'])) {
                    $data['media_type'] = 'document';
                } elseif (in_array($ext, ['xls', 'xlsx', 'csv']) || in_array($mimeType, ['application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'text/csv'])) {
                    $data['media_type'] = 'spreadsheet';
                } elseif (in_array($ext, ['ppt', 'pptx']) || in_array($mimeType, ['application/vnd.ms-powerpoint', 'application/vnd.openxmlformats-officedocument.presentationml.presentation'])) {
                    $data['media_type'] = 'presentation';
                } elseif (in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp', 'bmp'])) {
                    $data['media_type'] = 'image';
                } else {
                    $data['media_type'] = 'other';
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
            ->with('status', 'Common item updated successfully.');
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
            ->with('status', 'Common item deleted successfully.');
    }
}

