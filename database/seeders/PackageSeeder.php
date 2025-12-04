<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Package;
use App\Models\PackageSection;
use App\Models\PackageFeature;
use Illuminate\Support\Str;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define packages
        $packagesData = [
            [
                'name' => 'Basic Package',
                'price_per_sqft' => 1849,
                'sort_order' => 1,
            ],
            [
                'name' => 'Standard Package',
                'price_per_sqft' => 2025,
                'sort_order' => 2,
            ],
            [
                'name' => 'Premium Package',
                'price_per_sqft' => 2399,
                'sort_order' => 3,
            ],
            [
                'name' => 'Budget Package',
                'price_per_sqft' => 2799,
                'sort_order' => 4,
            ],
            [
                'name' => 'Luxury Package',
                'price_per_sqft' => 4400,
                'sort_order' => 5,
            ],
        ];

        // Create or update packages
        $packages = [];
        foreach ($packagesData as $packageData) {
            $package = Package::updateOrCreate(
                ['price_per_sqft' => $packageData['price_per_sqft']],
                [
                    'name' => $packageData['name'],
                    'slug' => Str::slug($packageData['name']),
                    'price_per_sqft' => $packageData['price_per_sqft'],
                    'sort_order' => $packageData['sort_order'],
                    'is_active' => true,
                ]
            );
            $packages[$packageData['price_per_sqft']] = $package;
        }

        // Read JSON file
        $jsonPath = base_path('z-packages-details/package_details.json');
        if (!file_exists($jsonPath)) {
            $this->command->error('Package details JSON file not found at: ' . $jsonPath);
            return;
        }

        $jsonContent = file_get_contents($jsonPath);
        $data = json_decode($jsonContent, true);

        if (!isset($data['Table2']) || !is_array($data['Table2'])) {
            $this->command->error('Invalid JSON structure. Expected "Table2" array.');
            return;
        }

        // Process sections and features
        $sortOrder = 1;
        $sectionsCreated = 0;
        $featuresCreated = 0;
        
        foreach ($data['Table2'] as $sectionData) {
            if (!isset($sectionData['section'])) {
                $this->command->warn('Skipping section entry: missing "section" field');
                continue;
            }

            $sectionName = $sectionData['section'];
            
            // Create or update section
            $section = PackageSection::updateOrCreate(
                ['slug' => Str::slug($sectionName)],
                [
                    'name' => $sectionName,
                    'sort_order' => $sortOrder++,
                    'is_active' => true,
                ]
            );
            
            if ($section->wasRecentlyCreated) {
                $sectionsCreated++;
                $this->command->info("Created section: {$sectionName}");
            } else {
                $this->command->line("Updated section: {$sectionName}");
            }

            // Process features for each package in this section
            $priceKeys = ['1849', '2025', '2399', '2799', '4400'];
            
            foreach ($priceKeys as $priceKey) {
                $pricePerSqft = (int)$priceKey;
                
                // Check if package exists
                if (!isset($packages[$pricePerSqft])) {
                    $this->command->warn("Package with price {$pricePerSqft} not found, skipping feature creation");
                    continue;
                }

                $package = $packages[$pricePerSqft];
                
                // Get content for this package-section combination
                $content = $sectionData[$priceKey] ?? null;
                
                if ($content !== null && trim($content) !== '') {
                    // Create or update feature
                    $feature = PackageFeature::updateOrCreate(
                        [
                            'package_section_id' => $section->id,
                            'package_id' => $package->id,
                        ],
                        [
                            'content' => trim($content),
                        ]
                    );
                    
                    if ($feature->wasRecentlyCreated) {
                        $featuresCreated++;
                    }
                } else {
                    // Remove feature if content is null/empty (for cases like "What is Included" for 2025)
                    PackageFeature::where('package_section_id', $section->id)
                        ->where('package_id', $package->id)
                        ->delete();
                }
            }
        }

        // Summary
        $this->command->newLine();
        $this->command->info('═══════════════════════════════════════════════════════');
        $this->command->info('Package Seeding Summary');
        $this->command->info('═══════════════════════════════════════════════════════');
        $this->command->info('Packages: ' . count($packages) . ' (all packages processed)');
        $this->command->info('Sections: ' . PackageSection::count() . ' total (' . $sectionsCreated . ' newly created)');
        $this->command->info('Features: ' . PackageFeature::count() . ' total (' . $featuresCreated . ' newly created)');
        $this->command->info('═══════════════════════════════════════════════════════');
        $this->command->newLine();
    }
}
