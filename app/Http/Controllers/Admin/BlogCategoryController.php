<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = BlogCategory::orderBy('name')
            ->paginate(15);

        return view('admin.blog-categories.index', [
            'pageTitle' => 'Blog Categories',
            'categories' => $categories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.blog-categories.create', [
            'pageTitle' => 'Create Blog Category',
            'category' => new BlogCategory(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $this->validateRequest($request);

        // Generate slug if not provided
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }

        BlogCategory::create($data);

        return redirect()
            ->route('admin.blog-categories.index')
            ->with('status', 'Blog category created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $category = BlogCategory::findOrFail($id);

        return view('admin.blog-categories.edit', [
            'pageTitle' => 'Edit Blog Category',
            'category' => $category,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $category = BlogCategory::findOrFail($id);

        $data = $this->validateRequest($request, $category->id);

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }

        $category->update($data);

        return redirect()
            ->route('admin.blog-categories.index')
            ->with('status', 'Blog category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $category = BlogCategory::findOrFail($id);

        // Detach from blogs, then delete
        $category->blogs()->update(['category_id' => null]);
        $category->delete();

        return redirect()
            ->route('admin.blog-categories.index')
            ->with('status', 'Blog category deleted successfully.');
    }

    /**
     * Validate blog category request data.
     */
    protected function validateRequest(Request $request, ?int $categoryId = null): array
    {
        $uniqueSlugRule = 'unique:blog_categories,slug';
        if ($categoryId) {
            $uniqueSlugRule .= ',' . $categoryId;
        }

        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', $uniqueSlugRule],
            'description' => ['nullable', 'string'],
        ]);
    }
}


