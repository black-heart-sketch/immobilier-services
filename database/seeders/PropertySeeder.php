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
                'title' => 'Villa moderne à Bastos',
                'type' => 'maison',
                'description' => 'Superbe villa de 4 chambres avec piscine dans le quartier prisé de Bastos',
                'price' => 150000000,
                'surface_area' => 300,
                'location' => 'Bastos, Yaoundé',
                'latitude' => 3.884235,
                'longitude' => 11.501149,
                'features' => [
                    '4 chambres',
                    '3 salles de bain',
                    'Piscine',
                    'Jardin',
                    'Quartier sécurisé'
                ],
                'images' => [
                    'images/properties/maison-1.jpg',
                    'images/properties/maison-2.jpg',
                    'images/properties/maison-3.jpg'
                ],
                'status' => 'available'
            ],
            [
                'title' => 'Villa de luxe à Bonapriso',
                'type' => 'maison',
                'description' => 'Magnifique villa moderne avec piscine et jardin dans le quartier résidentiel de Bonapriso',
                'price' => 180000000,
                'surface_area' => 450,
                'location' => 'Bonapriso, Douala',
                'latitude' => 4.024536,
                'longitude' => 9.692579,
                'features' => [
                    '5 chambres',
                    '4 salles de bain',
                    'Piscine chauffée',
                    'Jardin paysager',
                    'Garage double',
                    'Vue sur le fleuve Wouri'
                ],
                'images' => [
                    'images/properties/maison-4.jpg',
                    'images/properties/maison-5.jpg',
                    'images/properties/maison-6.jpg'
                ],
                'status' => 'available'
            ],
            [
                'title' => 'Terrain constructible à Odza',
                'type' => 'terrain',
                'description' => 'Beau terrain plat de 800m² dans un quartier résidentiel calme',
                'price' => 45000000,
                'surface_area' => 800,
                'location' => 'Odza, Yaoundé',
                'latitude' => 3.8084,
                'longitude' => 11.5397,
                'features' => [
                    'Titre foncier',
                    'Plat',
                    'Viabilisé',
                    'Quartier résidentiel'
                ],
                'images' => [
                    'images/properties/terrain-1.jpg',
                    'images/properties/terrain-2.jpg'
                ],
                'status' => 'available'
            ],
            [
                'title' => 'Parcelle à Bonamoussadi',
                'type' => 'terrain',
                'description' => 'Terrain viabilisé de 1000m² idéal pour projet immobilier',
                'price' => 65000000,
                'surface_area' => 1000,
                'location' => 'Bonamoussadi, Douala',
                'latitude' => 4.0781,
                'longitude' => 9.7366,
                'features' => [
                    'Titre foncier',
                    'Viabilisé',
                    'Proche commerces',
                    'Zone résidentielle'
                ],
                'images' => [
                    'images/properties/terrain-3.jpg',
                    'images/properties/terrain-4.jpg'
                ],
                'status' => 'available'
            ],
            [
                'title' => 'Villa à Santa Barbara',
                'type' => 'maison',
                'description' => 'Belle villa familiale dans un environnement calme et sécurisé',
                'price' => 120000000,
                'surface_area' => 250,
                'location' => 'Santa Barbara, Douala',
                'latitude' => 4.0547,
                'longitude' => 9.7085,
                'features' => [
                    '3 chambres',
                    '2 salles de bain',
                    'Jardin',
                    'Garage',
                    'Quartier sécurisé'
                ],
                'images' => [
                    'images/properties/maison-7.jpg',
                    'images/properties/maison-8.jpg'
                ],
                'status' => 'available'
            ],
            [
                'title' => 'Terrain à Nsimeyong',
                'type' => 'terrain',
                'description' => 'Grand terrain avec belle vue sur la ville',
                'price' => 55000000,
                'surface_area' => 1200,
                'location' => 'Nsimeyong, Yaoundé',
                'latitude' => 3.8445,
                'longitude' => 11.4892,
                'features' => [
                    'Titre foncier',
                    'Vue panoramique',
                    'Accès facile',
                    'Quartier en développement'
                ],
                'images' => [
                    'images/properties/terrain-5.jpg',
                    'images/properties/terrain-6.jpg'
                ],
                'status' => 'available'
            ]
        ];

        foreach ($properties as $property) {
            try {
                print_r($property);
                Property::create($property);
            } catch (\Exception $e) {
                \Log::error('Failed to create property: ' . $e->getMessage());
                \Log::error('Property data: ' . json_encode($property));
                \Log::error('Stack trace: ' . $e->getTraceAsString());
            }
        }
    }
} 