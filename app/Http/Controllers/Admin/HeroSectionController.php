<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSection;
use App\Services\ImageKitService;
use Illuminate\Http\Request;

class HeroSectionController extends Controller
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
        $heroSections = HeroSection::orderByDesc('created_at')->paginate(10);

        return view('admin.hero-sections.index', [
            'pageTitle' => 'Hero Section',
            'heroSections' => $heroSections,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.hero-sections.create', [
            'pageTitle' => 'Create Hero Section',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['nullable', 'string', 'max:255'],
            'page_title' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'pagetype' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'max:4096'],
            'video' => ['nullable', 'file', 'mimetypes:video/mp4,video/webm,video/ogg', 'max:102400'], // 100MB max
            'use_image' => ['nullable', 'boolean'],
            'use_video' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $data['use_image'] = $request->boolean('use_image');
        $data['use_video'] = $request->boolean('use_video');
        $data['is_active'] = $request->boolean('is_active');

        // Simple rule: if video is enabled, image is disabled.
        if ($data['use_video']) {
            $data['use_image'] = false;
        }

        if ($request->hasFile('image')) {
            try {
                $upload = $this->imageKit->upload($request->file('image'), 'atha/hero');
                if (isset($upload->result->url)) {
                    $data['image_path'] = $upload->result->url;
                } else {
                    return redirect()
                        ->back()
                        ->withInput()
                        ->withErrors(['image' => 'Image upload failed. Please try again.']);
                }
            } catch (\Exception $e) {
                \Log::error("Image upload error", ['error' => $e->getMessage()]);
                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors(['image' => 'Image upload failed: ' . $e->getMessage()]);
            }
        }

        if ($request->hasFile('video')) {
            try {
                $upload = $this->imageKit->upload($request->file('video'), 'atha/hero');
                if (isset($upload->result->url)) {
                    $data['video_path'] = $upload->result->url;
                } else {
                    return redirect()
                        ->back()
                        ->withInput()
                        ->withErrors(['video' => 'Video upload failed. Please try again or check file size.']);
                }
            } catch (\Exception $e) {
                \Log::error("Video upload error", ['error' => $e->getMessage()]);
                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors(['video' => 'Video upload failed: ' . $e->getMessage()]);
            }
        }

        HeroSection::create($data);

        return redirect()
            ->route('admin.hero-sections.index')
            ->with('status', 'Hero section created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return redirect()->route('admin.hero-sections.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $heroSection = HeroSection::findOrFail($id);

        return view('admin.hero-sections.edit', [
            'pageTitle' => 'Edit Hero Section',
            'heroSection' => $heroSection,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $heroSection = HeroSection::findOrFail($id);

        $data = $request->validate([
            'title' => ['nullable', 'string', 'max:255'],
            'page_title' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'pagetype' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'max:4096'],
            'video' => ['nullable', 'file', 'mimetypes:video/mp4,video/webm,video/ogg', 'max:102400'], // 100MB max
            'use_image' => ['nullable', 'boolean'],
            'use_video' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $data['use_image'] = $request->boolean('use_image');
        $data['use_video'] = $request->boolean('use_video');
        $data['is_active'] = $request->boolean('is_active');

        if ($data['use_video']) {
            $data['use_image'] = false;
        }

        if ($request->hasFile('image')) {
            try {
                $upload = $this->imageKit->upload($request->file('image'), 'atha/hero');
                if (isset($upload->result->url)) {
                    $data['image_path'] = $upload->result->url;
                } else {
                    return redirect()
                        ->back()
                        ->withInput()
                        ->withErrors(['image' => 'Image upload failed. Please try again.']);
                }
            } catch (\Exception $e) {
                \Log::error("Image upload error", ['error' => $e->getMessage()]);
                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors(['image' => 'Image upload failed: ' . $e->getMessage()]);
            }
        }

        if ($request->hasFile('video')) {
            try {
                $upload = $this->imageKit->upload($request->file('video'), 'atha/hero');
                if (isset($upload->result->url)) {
                    $data['video_path'] = $upload->result->url;
                } else {
                    return redirect()
                        ->back()
                        ->withInput()
                        ->withErrors(['video' => 'Video upload failed. Please try again or check file size.']);
                }
            } catch (\Exception $e) {
                \Log::error("Video upload error", ['error' => $e->getMessage()]);
                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors(['video' => 'Video upload failed: ' . $e->getMessage()]);
            }
        }

        $heroSection->update($data);

        return redirect()
            ->route('admin.hero-sections.index')
            ->with('status', 'Hero section updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $heroSection = HeroSection::findOrFail($id);
        $heroSection->delete();

        return redirect()
            ->route('admin.hero-sections.index')
            ->with('status', 'Hero section deleted successfully.');
    }
}
