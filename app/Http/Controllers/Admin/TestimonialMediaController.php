<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use App\Models\TestimonialMedia;
use Illuminate\Http\Request;

class TestimonialMediaController extends Controller
{
    /**
     * Display a listing of testimonial media.
     */
    public function index()
    {
        $media = TestimonialMedia::with('testimonial')
            ->orderBy('testimonial_id')
            ->orderBy('sort_order')
            ->paginate(30);

        return view('admin.testimonial-media.index', [
            'media' => $media,
        ]);
    }

    /**
     * Show the form for creating new media.
     */
    public function create()
    {
        $testimonials = Testimonial::orderByDesc('created_at')->get();

        return view('admin.testimonial-media.create', [
            'testimonials' => $testimonials,
        ]);
    }

    /**
     * Store newly created media.
     */
    public function store(Request $request)
    {
        $data = $this->validateData($request);

        TestimonialMedia::create($data);

        return redirect()
            ->route('admin.testimonial-media.index')
            ->with('status', 'Media item created successfully.');
    }

    /**
     * Show the form for editing media.
     */
    public function edit(TestimonialMedia $testimonial_medium)
    {
        $testimonials = Testimonial::orderByDesc('created_at')->get();

        return view('admin.testimonial-media.edit', [
            'media'        => $testimonial_medium,
            'testimonials' => $testimonials,
        ]);
    }

    /**
     * Update the specified media.
     */
    public function update(Request $request, TestimonialMedia $testimonial_medium)
    {
        $data = $this->validateData($request);

        $testimonial_medium->update($data);

        return redirect()
            ->route('admin.testimonial-media.index')
            ->with('status', 'Media item updated successfully.');
    }

    /**
     * Remove the specified media from storage.
     */
    public function destroy(TestimonialMedia $testimonial_medium)
    {
        $testimonial_medium->delete();

        return redirect()
            ->route('admin.testimonial-media.index')
            ->with('status', 'Media item deleted successfully.');
    }

    protected function validateData(Request $request): array
    {
        return $request->validate([
            'testimonial_id' => ['required', 'exists:testimonials,id'],
            'media_type'     => ['required', 'in:image,video'],
            'media_url'      => ['required', 'string', 'max:500'],
            'sort_order'     => ['nullable', 'integer', 'min:0'],
        ]);
    }
}


