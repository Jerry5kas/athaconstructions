<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PackageFeature;
use App\Models\PackageSection;
use App\Models\Package;
use Illuminate\Http\Request;

class PackageFeatureController extends Controller
{
    /**
     * Store or update features for a section across all packages.
     */
    public function storeOrUpdate(Request $request, string $sectionId)
    {
        $section = PackageSection::findOrFail($sectionId);
        
        $request->validate([
            'features' => ['required', 'array'],
            'features.*.package_id' => ['required', 'exists:packages,id'],
            'features.*.content' => ['nullable', 'string'],
        ]);

        foreach ($request->features as $featureData) {
            $packageId = $featureData['package_id'];
            $content = $featureData['content'] ?? null;

            PackageFeature::updateOrCreate(
                [
                    'package_section_id' => $section->id,
                    'package_id' => $packageId,
                ],
                [
                    'content' => $content,
                ]
            );
        }

        return redirect()
            ->route('admin.package-sections.show', $section->id)
            ->with('status', 'Features updated successfully.');
    }

    /**
     * Delete a specific feature.
     */
    public function destroy(string $id)
    {
        $feature = PackageFeature::findOrFail($id);
        $sectionId = $feature->package_section_id;
        $feature->delete();

        return redirect()
            ->route('admin.package-sections.show', $sectionId)
            ->with('status', 'Feature deleted successfully.');
    }
}
