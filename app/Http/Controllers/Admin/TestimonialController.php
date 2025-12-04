<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    /**
     * Display a listing of testimonials.
     */
    public function index()
    {
        $testimonials = Testimonial::orderByDesc('created_at')->paginate(20);

        return view('admin.testimonials.index', [
            'testimonials' => $testimonials,
        ]);
    }

    /**
     * Show the form for creating a new testimonial.
     */
    public function create()
    {
        return view('admin.testimonials.create');
    }

    /**
     * Store a newly created testimonial in storage.
     */
    public function store(Request $request)
    {
        $data = $this->validateData($request);

        Testimonial::create($data);

        return redirect()
            ->route('admin.testimonials.index')
            ->with('status', 'Testimonial created successfully.');
    }

    /**
     * Show the form for editing the specified testimonial.
     */
    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.edit', [
            'testimonial' => $testimonial,
        ]);
    }

    /**
     * Update the specified testimonial in storage.
     */
    public function update(Request $request, Testimonial $testimonial)
    {
        $data = $this->validateData($request, $testimonial->id);

        $testimonial->update($data);

        return redirect()
            ->route('admin.testimonials.index')
            ->with('status', 'Testimonial updated successfully.');
    }

    /**
     * Remove the specified testimonial from storage.
     */
    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();

        return redirect()
            ->route('admin.testimonials.index')
            ->with('status', 'Testimonial deleted successfully.');
    }

    /**
     * Shared validation logic.
     */
    protected function validateData(Request $request, ?int $id = null): array
    {
        return $request->validate([
            'slug'              => ['nullable', 'string', 'max:255', 'unique:testimonials,slug,' . ($id ?? 'NULL') . ',id'],
            'title'             => ['required', 'string', 'max:255'],
            'review_text'       => ['required', 'string'],
            'rating'            => ['nullable', 'integer', 'min:1', 'max:5'],
            'client_name'       => ['required', 'string', 'max:255'],
            'client_role'       => ['nullable', 'string', 'max:255'],
            'client_company'    => ['nullable', 'string', 'max:255'],
            'client_avatar'     => ['nullable', 'string', 'max:500'],
            'project_name'      => ['nullable', 'string', 'max:255'],
            'project_location'  => ['nullable', 'string', 'max:255'],
            'project_type'      => ['nullable', 'string', 'max:255'],
            'featured'          => ['nullable', 'boolean'],
            'status'            => ['required', 'in:draft,published'],
            'published_at'      => ['nullable', 'date'],
        ]);
    }
}


