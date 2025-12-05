<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\Property;
use App\Models\PropertyLocation;
use App\Models\PropertyUnit;
use App\Models\PropertySpecification;
use App\Models\Amenity;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create global amenities if not present
        $amenities = [
            'Clubhouse',
            'Swimming Pool',
            'Gym',
            'Children’s Play Area',
            'Power Backup',
            'CCTV Surveillance',
            'Covered Parking',
            'Landscaped Gardens',
            'Elevators',
            'Rainwater Harvesting',
        ];

        $amenityIds = [];
        foreach ($amenities as $index => $name) {
            $amenity = Amenity::firstOrCreate(
                ['name' => $name],
                [
                    'icon' => null,
                    'sort_order' => $index,
                    'is_active' => true,
                ]
            );
            $amenityIds[] = $amenity->id;
        }

        $properties = [
            [
                'title' => 'Atha Greenwood Residences',
                'project_type' => 'apartment',
                'status' => 'ongoing',
                'rera_number' => 'PRM/KA/RERA/1251/1234/05/2025',
                'short_description' => 'Premium 2 & 3 BHK homes nestled in a green enclave off Sarjapur Road.',
                'description' => 'Greenwood Residences is designed for families who value space, light, and community living. With expansive courtyards, walking trails, and a clubhouse, it brings together modern amenities and lush surroundings.',
                'launch_date' => Carbon::now()->subMonths(8)->toDateString(),
                'possession_date' => Carbon::now()->addMonths(14)->toDateString(),
                'total_land_area' => '4.5 Acres',
                'total_units' => 220,
                'floors' => 12,
                'brochure_url' => null,
                'meta_title' => 'Atha Greenwood Residences | Sarjapur Road',
                'meta_description' => 'Premium 2 & 3 BHK apartments with clubhouse, pool, and landscaped gardens near Sarjapur Road.',
                'location' => [
                    'address' => 'Off Sarjapur Road, near Wipro SEZ, Bengaluru, Karnataka',
                    'city' => 'Bengaluru',
                    'locality' => 'Sarjapur Road',
                    'landmark' => 'Near Wipro SEZ',
                    'latitude' => '12.9000',
                    'longitude' => '77.6900',
                    'pincode' => '560035',
                ],
                'units' => [
                    ['bhk' => 2, 'carpet_area' => 940, 'builtup_area' => 1120, 'super_builtup_area' => 1280],
                    ['bhk' => 3, 'carpet_area' => 1230, 'builtup_area' => 1450, 'super_builtup_area' => 1680],
                ],
                'specifications' => [
                    ['section' => 'Structure', 'description' => 'RCC framed structure with seismic compliance.', 'sort_order' => 0],
                    ['section' => 'Flooring', 'description' => 'Vitrified tiles in living, dining, bedrooms; anti-skid tiles in balconies & bathrooms.', 'sort_order' => 1],
                    ['section' => 'Doors & Windows', 'description' => 'Main door teak finish, internal flush doors, UPVC windows with mosquito mesh.', 'sort_order' => 2],
                    ['section' => 'Electrical', 'description' => 'Modular switches, FRLS wiring, provision for AC in all bedrooms, and inverter point.', 'sort_order' => 3],
                ],
                'amenities' => ['Clubhouse', 'Swimming Pool', 'Gym', 'Power Backup', 'CCTV Surveillance', 'Covered Parking'],
            ],
            [
                'title' => 'Atha Lakeview Villas',
                'project_type' => 'villa',
                'status' => 'upcoming',
                'rera_number' => 'PRM/KA/RERA/1251/5678/06/2025',
                'short_description' => 'Limited edition 4 BHK villas with private gardens and lake-facing decks in Yelahanka.',
                'description' => 'Lakeview Villas offers expansive independent homes with double-height living, private gardens, and serene lake views. Perfect for families seeking privacy with premium community amenities.',
                'launch_date' => Carbon::now()->subMonths(2)->toDateString(),
                'possession_date' => Carbon::now()->addMonths(24)->toDateString(),
                'total_land_area' => '6.2 Acres',
                'total_units' => 48,
                'floors' => 3,
                'brochure_url' => null,
                'meta_title' => 'Atha Lakeview Villas | Yelahanka',
                'meta_description' => 'Luxury 4 BHK villas with private gardens and lake views in Yelahanka, Bengaluru.',
                'location' => [
                    'address' => 'Jakkur Lake Main Road, Yelahanka, Bengaluru, Karnataka',
                    'city' => 'Bengaluru',
                    'locality' => 'Yelahanka',
                    'landmark' => 'Near Jakkur Lake',
                    'latitude' => '13.0800',
                    'longitude' => '77.5900',
                    'pincode' => '560064',
                ],
                'units' => [
                    ['bhk' => 4, 'carpet_area' => 2150, 'builtup_area' => 2550, 'super_builtup_area' => 2980],
                ],
                'specifications' => [
                    ['section' => 'Structure', 'description' => 'RCC with solid block masonry, termite-resistant foundation.', 'sort_order' => 0],
                    ['section' => 'Flooring', 'description' => 'Imported marble in living/dining; laminated wooden flooring in bedrooms.', 'sort_order' => 1],
                    ['section' => 'Kitchen', 'description' => 'Granite platform with stainless steel sink, dado up to 2 ft., utility provision.', 'sort_order' => 2],
                    ['section' => 'Bath & Plumbing', 'description' => 'Branded CP fittings, wall-hung closets, concealed CPVC piping.', 'sort_order' => 3],
                ],
                'amenities' => ['Clubhouse', 'Swimming Pool', 'Gym', 'Children’s Play Area', 'Landscaped Gardens', 'Power Backup'],
            ],
            [
                'title' => 'Atha Midtown Heights',
                'project_type' => 'apartment',
                'status' => 'completed',
                'rera_number' => 'PRM/KA/RERA/1251/9101/08/2024',
                'short_description' => 'Ready-to-move 2 & 3 BHK homes with quick access to ITPL and Whitefield metro.',
                'description' => 'Midtown Heights is a completed community with operational clubhouse, pool, and retail conveniences. Ideal for families seeking immediate possession near IT corridors.',
                'launch_date' => Carbon::now()->subMonths(24)->toDateString(),
                'possession_date' => Carbon::now()->subMonths(2)->toDateString(),
                'total_land_area' => '3.8 Acres',
                'total_units' => 180,
                'floors' => 10,
                'brochure_url' => null,
                'meta_title' => 'Atha Midtown Heights | Whitefield',
                'meta_description' => 'Ready-to-move 2 & 3 BHK apartments near ITPL and Whitefield metro with clubhouse and pool.',
                'location' => [
                    'address' => 'ITPL Main Road, Whitefield, Bengaluru, Karnataka',
                    'city' => 'Bengaluru',
                    'locality' => 'Whitefield',
                    'landmark' => 'Near ITPL Metro',
                    'latitude' => '12.9840',
                    'longitude' => '77.7499',
                    'pincode' => '560066',
                ],
                'units' => [
                    ['bhk' => 2, 'carpet_area' => 910, 'builtup_area' => 1080, 'super_builtup_area' => 1240],
                    ['bhk' => 3, 'carpet_area' => 1180, 'builtup_area' => 1385, 'super_builtup_area' => 1605],
                ],
                'specifications' => [
                    ['section' => 'Flooring', 'description' => 'Vitrified tiles in all rooms; anti-skid in balconies & bathrooms.', 'sort_order' => 0],
                    ['section' => 'Electrical', 'description' => 'Modular switches, FRLS wiring, DG backup for common areas & lifts.', 'sort_order' => 1],
                    ['section' => 'Common Areas', 'description' => 'Fully operational clubhouse, gym, pool, indoor games, multipurpose hall.', 'sort_order' => 2],
                ],
                'amenities' => ['Clubhouse', 'Swimming Pool', 'Gym', 'Elevators', 'Power Backup', 'CCTV Surveillance', 'Covered Parking'],
            ],
            [
                'title' => 'Atha Prime One',
                'project_type' => 'commercial',
                'status' => 'ongoing',
                'rera_number' => 'PRM/KA/RERA/1251/3141/07/2025',
                'short_description' => 'Grade-A commercial tower with flexible office plates on Outer Ring Road.',
                'description' => 'Prime One is designed for modern businesses with efficient floor plates, premium lobby, high-speed elevators, and ample parking. Strategically located on ORR for easy access to tech parks and the airport.',
                'launch_date' => Carbon::now()->subMonths(5)->toDateString(),
                'possession_date' => Carbon::now()->addMonths(18)->toDateString(),
                'total_land_area' => '2.4 Acres',
                'total_units' => 30,
                'floors' => 14,
                'brochure_url' => null,
                'meta_title' => 'Atha Prime One | ORR Commercial',
                'meta_description' => 'Grade-A commercial office spaces with premium specs and connectivity on Outer Ring Road.',
                'location' => [
                    'address' => 'Outer Ring Road, near Marathahalli, Bengaluru, Karnataka',
                    'city' => 'Bengaluru',
                    'locality' => 'Marathahalli ORR',
                    'landmark' => 'Near Ecospace',
                    'latitude' => '12.9345',
                    'longitude' => '77.6875',
                    'pincode' => '560103',
                ],
                'units' => [
                    ['bhk' => 0, 'carpet_area' => 4500, 'builtup_area' => 5200, 'super_builtup_area' => 6000],
                ],
                'specifications' => [
                    ['section' => 'Structure', 'description' => 'Post-tension slabs for flexible office layouts; seismic compliant.', 'sort_order' => 0],
                    ['section' => 'MEP', 'description' => 'Centralized HVAC shafts, 100% DG backup for common areas, separate AHU rooms.', 'sort_order' => 1],
                    ['section' => 'Lifts', 'description' => 'High-speed passenger and service elevators with access control.', 'sort_order' => 2],
                ],
                'amenities' => ['Power Backup', 'Elevators', 'CCTV Surveillance', 'Covered Parking', 'Landscaped Gardens', 'Rainwater Harvesting'],
            ],
        ];

        foreach ($properties as $data) {
            $property = Property::create([
                'title' => $data['title'],
                'slug' => Str::slug($data['title']),
                'project_type' => $data['project_type'],
                'status' => $data['status'],
                'rera_number' => $data['rera_number'],
                'short_description' => $data['short_description'],
                'description' => $data['description'],
                'launch_date' => $data['launch_date'],
                'possession_date' => $data['possession_date'],
                'total_land_area' => $data['total_land_area'],
                'total_units' => $data['total_units'],
                'floors' => $data['floors'],
                'featured_image' => null,
                'featured_image_file_id' => null,
                'brochure_url' => $data['brochure_url'],
                'video_url' => null,
                'meta_title' => $data['meta_title'],
                'meta_description' => $data['meta_description'],
            ]);

            // Location
            PropertyLocation::create(array_merge(
                $data['location'],
                ['property_id' => $property->id]
            ));

            // Units
            foreach ($data['units'] as $unit) {
                PropertyUnit::create(array_merge(
                    $unit,
                    [
                        'property_id' => $property->id,
                        'floor_plan_image' => null,
                        'floor_plan_image_file_id' => null,
                    ]
                ));
            }

            // Specifications
            foreach ($data['specifications'] as $spec) {
                PropertySpecification::create(array_merge(
                    $spec,
                    ['property_id' => $property->id]
                ));
            }

            // Amenities pivot
            $amenityIdsToAttach = Amenity::whereIn('name', $data['amenities'])->pluck('id')->toArray();
            $property->amenities()->sync($amenityIdsToAttach);
        }
    }
}

