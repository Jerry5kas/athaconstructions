<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PackageSection;
use App\Models\Package;
use App\Models\PackageFeature;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PackageSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sections = PackageSection::select(
                'id',
                'name',
                'slug',
                'sort_order',
                'is_active',
                'created_at',
                'updated_at'
            )
            ->orderBy('sort_order')
            ->orderBy('name')
            ->paginate(15);

        return view('admin.package-sections.index', [
            'pageTitle' => 'Package Sections',
            'sections' => $sections,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.package-sections.create', [
            'pageTitle' => 'Create Package Section',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:package_sections,slug'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        // Generate slug if not provided
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }

        $data['is_active'] = $request->boolean('is_active', true);
        $data['sort_order'] = $data['sort_order'] ?? 0;

        PackageSection::create($data);

        return redirect()
            ->route('admin.package-sections.index')
            ->with('status', 'Package section created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $section = PackageSection::with('features.package')->findOrFail($id);
        $packages = Package::active()->ordered()->get();

        return view('admin.package-sections.show', [
            'pageTitle' => 'Manage Features: ' . $section->name,
            'section' => $section,
            'packages' => $packages,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $section = PackageSection::findOrFail($id);

        return view('admin.package-sections.edit', [
            'pageTitle' => 'Edit Package Section',
            'section' => $section,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $section = PackageSection::findOrFail($id);

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:package_sections,slug,' . $id],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        // Generate slug if not provided
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }

        $data['is_active'] = $request->boolean('is_active', $section->is_active);
        $data['sort_order'] = $data['sort_order'] ?? $section->sort_order;

        $section->update($data);

        return redirect()
            ->route('admin.package-sections.index')
            ->with('status', 'Package section updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $section = PackageSection::findOrFail($id);
        $section->delete();

        return redirect()
            ->route('admin.package-sections.index')
            ->with('status', 'Package section deleted successfully.');
    }
}
