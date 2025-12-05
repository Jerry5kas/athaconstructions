<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Amenity;
use Illuminate\Http\Request;

class AmenityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $amenities = Amenity::select(
                'id',
                'name',
                'icon',
                'sort_order',
                'is_active',
                'created_at',
                'updated_at'
            )
            ->ordered()
            ->paginate(15);

        return view('admin.amenities.index', [
            'pageTitle' => 'Amenities',
            'amenities' => $amenities,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.amenities.create', [
            'pageTitle' => 'Create Amenity',
            'amenity' => new Amenity(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:amenities,name'],
            'icon' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $data['is_active'] = $request->boolean('is_active', true);
        $data['sort_order'] = $data['sort_order'] ?? 0;

        Amenity::create($data);

        return redirect()
            ->route('admin.amenities.index')
            ->with('status', 'Amenity created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return redirect()->route('admin.amenities.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $amenity = Amenity::findOrFail($id);

        return view('admin.amenities.edit', [
            'pageTitle' => 'Edit Amenity',
            'amenity' => $amenity,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $amenity = Amenity::findOrFail($id);

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:amenities,name,' . $id],
            'icon' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $data['is_active'] = $request->boolean('is_active', $amenity->is_active);
        $data['sort_order'] = $data['sort_order'] ?? $amenity->sort_order;

        $amenity->update($data);

        return redirect()
            ->route('admin.amenities.index')
            ->with('status', 'Amenity updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $amenity = Amenity::findOrFail($id);
        $amenity->delete();

        return redirect()
            ->route('admin.amenities.index')
            ->with('status', 'Amenity deleted successfully.');
    }
}

