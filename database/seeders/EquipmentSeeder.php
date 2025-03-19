<?php

namespace Database\Seeders;

use App\Models\Equipment;
use Illuminate\Database\Seeder;

class EquipmentSeeder extends Seeder
{
    public function run()
    {
        $equipment = [
            [
                'name' => 'Pelle Hydraulique',
                'type' => 'excavator',
                'description' => 'Pelle hydraulique puissante pour les travaux de terrassement, excavation et démolition. Équipée d\'un système hydraulique performant et d\'une cabine ergonomique.',
                'specifications' => [
                    'Type' => 'Excavatrice',
                    'Système' => 'Bras articulé avec godet',
                    'Mobilité' => 'Chenilles tout-terrain',
                    'Cabine' => 'Fermée et climatisée',
                    'Usage' => 'Terrassement, excavation, démolition'
                ],
                'daily_rate' => 350000,
                'weekly_rate' => 2100000,
                'monthly_rate' => 8000000,
                'image' => 'images/engines/pelle.jpeg',
                'status' => 'available',
                'current_location' => [
                    'lat' => 3.8667,
                    'lng' => 11.5167,
                    'address' => 'Yaoundé, Cameroun'
                ]
            ],
            [
                'name' => 'Rétrochargeuse',
                'type' => 'backhoe',
                'description' => 'Machine polyvalente équipée d\'une pelleteuse à l\'arrière et d\'une chargeuse à l\'avant, idéale pour les travaux de terrassement et le transport de matériaux.',
                'specifications' => [
                    'Type' => 'Backhoe Loader',
                    'Équipement' => 'Pelleteuse arrière et chargeuse avant',
                    'Mobilité' => 'Roues adaptées aux chantiers',
                    'Cabine' => 'Fermée avec visibilité panoramique',
                    'Usage' => 'Terrassement, nivellement, transport'
                ],
                'daily_rate' => 300000,
                'weekly_rate' => 1800000,
                'monthly_rate' => 7000000,
                'image' => 'images/engines/retro.jpeg',
                'status' => 'available',
                'current_location' => [
                    'lat' => 3.8667,
                    'lng' => 11.5167,
                    'address' => 'Yaoundé, Cameroun'
                ]
            ],
            [
                'name' => 'Chargeuse sur Pneus',
                'type' => 'loader',
                'description' => 'Chargeuse puissante conçue pour le chargement et le transport de matériaux en vrac. Équipée de roues larges pour une excellente stabilité.',
                'specifications' => [
                    'Type' => 'Wheel Loader',
                    'Équipement' => 'Grande pelle frontale',
                    'Mobilité' => 'Roues larges tout-terrain',
                    'Moteur' => 'Haute puissance',
                    'Cabine' => 'Ergonomique avec commandes hydrauliques'
                ],
                'daily_rate' => 320000,
                'weekly_rate' => 1900000,
                'monthly_rate' => 7500000,
                'image' => 'images/engines/char.jpeg',
                'status' => 'available',
                'current_location' => [
                    'lat' => 3.8667,
                    'lng' => 11.5167,
                    'address' => 'Yaoundé, Cameroun'
                ]
            ],
            [
                'name' => 'Pelle sur Chenilles',
                'type' => 'excavator',
                'description' => 'Excavatrice de chantier robuste pour les travaux de terrassement et creusement profond. Excellente stabilité grâce aux chenilles.',
                'specifications' => [
                    'Type' => 'Excavatrice de chantier',
                    'Équipement' => 'Long bras avec godet robuste',
                    'Mobilité' => 'Chenilles pour terrains instables',
                    'Stabilité' => 'Renforcée pour grands travaux',
                    'Cabine' => 'Commandes précises et ergonomiques'
                ],
                'daily_rate' => 380000,
                'weekly_rate' => 2300000,
                'monthly_rate' => 8500000,
                'image' => 'images/engines/pellc.jpeg',
                'status' => 'available',
                'current_location' => [
                    'lat' => 3.8667,
                    'lng' => 11.5167,
                    'address' => 'Yaoundé, Cameroun'
                ]
            ]
        ];

        foreach ($equipment as $item) {
            Equipment::create($item);
        }
    }
} 