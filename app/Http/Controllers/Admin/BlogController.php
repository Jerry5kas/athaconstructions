<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Tag;
use App\Services\ImageKitService;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    protected ImageKitService $imageKit;

    public function __construct(ImageKitService $imageKit)
    {
        $this->imageKit = $imageKit;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::orderByDesc('published_at')
            ->orderByDesc('created_at')
            ->paginate(15);

        return view('admin.blogs.index', [
            'pageTitle' => 'Blogs',
            'blogs' => $blogs,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = BlogCategory::orderBy('name')->get();

        return view('admin.blogs.create', [
            'pageTitle' => 'Create Blog',
            'blog' => new Blog(),
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $this->validateRequest($request);

        // Handle cover image upload to ImageKit
        if ($request->hasFile('cover_image')) {
            $upload = $this->imageKit->upload($request->file('cover_image'), 'atha/blogs/covers');
            $data['cover_image'] = $upload->result->url ?? null;
            $data['cover_image_file_id'] = $upload->result->fileId ?? null;
        }

        // Default published_at when publishing
        if (($data['status'] ?? 'draft') === 'published' && empty($data['published_at'])) {
            $data['published_at'] = now();
        }

        /** @var Blog $blog */
        $blog = Blog::create($data);

        // Sync tags from comma-separated input
        $this->syncTags($blog, $request->input('tags'));

        return redirect()
            ->route('admin.blogs.index')
            ->with('status', 'Blog created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $blog = Blog::findOrFail($id);

        $categories = BlogCategory::orderBy('name')->get();

        return view('admin.blogs.edit', [
            'pageTitle' => 'Edit Blog',
            'blog' => $blog,
            'categories' => $categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $blog = Blog::findOrFail($id);

        $data = $this->validateRequest($request, $blog->id);

        // Handle cover image upload to ImageKit
        if ($request->hasFile('cover_image')) {
            // Delete old cover image from ImageKit if we have a file ID
            if ($blog->cover_image_file_id) {
                $this->imageKit->delete($blog->cover_image_file_id);
            }

            $upload = $this->imageKit->upload($request->file('cover_image'), 'atha/blogs/covers');
            $data['cover_image'] = $upload->result->url ?? $blog->cover_image;
            $data['cover_image_file_id'] = $upload->result->fileId ?? $blog->cover_image_file_id;
        }

        // If publishing now and no published_at yet
        if (($data['status'] ?? $blog->status) === 'published' && ! $blog->published_at) {
            $data['published_at'] = $data['published_at'] ?? now();
        }

        $blog->update($data);

        // Sync tags from comma-separated input
        $this->syncTags($blog, $request->input('tags'));

        return redirect()
            ->route('admin.blogs.index')
            ->with('status', 'Blog updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $blog = Blog::findOrFail($id);
        // Delete associated ImageKit cover image if we have a stored file ID
        if ($blog->cover_image_file_id) {
            $this->imageKit->delete($blog->cover_image_file_id);
        }
        $blog->delete();

        return redirect()
            ->route('admin.blogs.index')
            ->with('status', 'Blog deleted successfully.');
    }

    /**
     * Validate blog request data.
     */
    protected function validateRequest(Request $request, ?int $blogId = null): array
    {
        $uniqueSlugRule = 'unique:blogs,slug';
        if ($blogId) {
            $uniqueSlugRule .= ',' . $blogId;
        }

        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', $uniqueSlugRule],
            // Excerpt can be a longer summary; DB column is text
            'excerpt' => ['nullable', 'string'],
            'content' => ['nullable', 'string'],
            'cover_image' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp', 'max:5120'], // 5MB
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string'],
            'keywords' => ['nullable', 'string', 'max:255'],
            'category_id' => ['nullable', 'integer', 'exists:blog_categories,id'],
            'tags' => ['nullable', 'string'],
            'author' => ['nullable', 'string', 'max:255'],
            'status' => ['required', 'in:draft,published'],
            'published_at' => ['nullable', 'date'],
        ]);
    }

    /**
     * Sync tags from a comma-separated string to the pivot table.
     */
    protected function syncTags(Blog $blog, ?string $tagsInput): void
    {
        if ($tagsInput === null) {
            $blog->tags()->detach();
            return;
        }

        $names = collect(explode(',', $tagsInput))
            ->map(fn ($name) => trim($name))
            ->filter()
            ->unique();

        if ($names->isEmpty()) {
            $blog->tags()->detach();
            return;
        }

        $tagIds = [];

        foreach ($names as $name) {
            $tag = Tag::firstOrCreate(
                ['slug' => \Illuminate\Support\Str::slug($name)],
                ['name' => $name]
            );
            $tagIds[] = $tag->id;
        }

        $blog->tags()->sync($tagIds);
    }
}

// {
//   "cells": [],
//   "metadata": {
//     "language_info": {
//       "name": "python"
//     }
//   },
//   "nbformat": 4,
//   "nbformat_minor": 2
// }