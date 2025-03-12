<?php

namespace Database\Seeders;

use App\Models\Property;
use Illuminate\Database\Seeder;

class PropertySeeder extends Seeder
{
    public function run()
    {
        // Clear existing records
        Property::truncate();

        $properties = [
            [
                'title' => 'Terrain constructible à Cocody',
                'type' => 'terrain',
                'description' => 'Magnifique terrain plat de 500m² dans un quartier résidentiel',
                'price' => 25000000,
                'surface_area' => 500,
                'location' => 'Cocody, Abidjan',
                'latitude' => 5.359952,
                'longitude' => -3.996633,
                'features' => [
                    'Titre foncier disponible',
                    'Quartier résidentiel',
                    'Proche des commodités'
                ],
                'images' => [
                    'images/properties/terrain-1.jpg',
                    'images/properties/terrain-2.jpg',
                    'images/properties/terrain-3.jpg'
                ],
                'status' => 'available'
            ],
            [
                'title' => 'Villa moderne à Riviera',
                'type' => 'maison',
                'description' => 'Superbe villa de 4 chambres avec piscine',
                'price' => 150000000,
                'surface_area' => 300,
                'location' => 'Riviera, Abidjan',
                'latitude' => 5.348889,
                'longitude' => -3.981111,
                'features' => [
                    '4 chambres',
                    '3 salles de bain',
                    'Piscine',
                    'Jardin'
                ],
                'images' => [
                    'images/properties/maison-1.jpg',
                    'images/properties/maison-2.jpg',
                    'images/properties/maison-3.jpg'
                ],
                'status' => 'available'
            ],
            [
                'title' => 'Terrain à Bingerville',
                'type' => 'terrain',
                'description' => 'Grand terrain avec vue sur la lagune',
                'price' => 35000000,
                'surface_area' => 800,
                'location' => 'Bingerville, Abidjan',
                'latitude' => 5.350123,
                'longitude' => -3.885432,
                'features' => [
                    'Vue sur la lagune',
                    'Terrain plat',
                    'Accès facile'
                ],
                'images' => [
                    'images/properties/terrain-4.jpg',
                    'images/properties/terrain-5.jpg',
                    'images/properties/terrain-6.jpg'
                ],
                'status' => 'available'
            ],
            [
                'title' => 'Villa de luxe à Angré',
                'type' => 'maison',
                'description' => 'Magnifique villa moderne avec piscine et jardin',
                'price' => 180000000,
                'surface_area' => 450,
                'location' => 'Angré, Abidjan',
                'latitude' => 5.364789,
                'longitude' => -3.978654,
                'features' => [
                    '5 chambres',
                    '4 salles de bain',
                    'Piscine chauffée',
                    'Jardin paysager',
                    'Garage double'
                ],
                'images' => [
                    'images/properties/maison-4.jpg',
                    'images/properties/maison-5.jpg',
                    'images/properties/maison-6.jpg'
                ],
                'status' => 'available'
            ],
            [
                'title' => 'Terrain commercial à Yopougon',
                'type' => 'terrain',
                'description' => 'Terrain idéal pour projet commercial',
                'price' => 45000000,
                'surface_area' => 1000,
                'location' => 'Yopougon, Abidjan',
                'latitude' => 5.328976,
                'longitude' => -4.056789,
                'features' => [
                    'Zone commerciale',
                    'Grand frontage',
                    'Tous réseaux'
                ],
                'images' => [
                    'images/properties/terrain-7.jpg',
                    'images/properties/terrain-8.jpg',
                    'images/properties/terrain-9.jpg'
                ],
                'status' => 'available'
            ]
        ];

        foreach ($properties as $property) {
            try {
                Property::create($property);
            } catch (\Exception $e) {
                \Log::error('Failed to create property: ' . $e->getMessage());
                \Log::error('Property data: ' . json_encode($property));
            }
        }
    }
} 