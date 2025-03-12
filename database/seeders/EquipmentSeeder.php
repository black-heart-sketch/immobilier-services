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
                'name' => 'Pelle Hydraulique CAT 320',
                'type' => 'excavator',
                'description' => 'Pelle hydraulique puissante idéale pour les travaux d\'excavation et de terrassement',
                'specifications' => [
                    'Poids opérationnel' => '20.000 kg',
                    'Puissance moteur' => '121 kW',
                    'Capacité du godet' => '1.2 m³',
                    'Profondeur de fouille' => '6.7 m',
                    'Portée maximale' => '9.9 m'
                ],
                'daily_rate' => 350000,
                'weekly_rate' => 2100000,
                'monthly_rate' => 8000000,
                'image' => 'images/equipment/cat-320.jpg',
                'status' => 'available',
                'current_location' => [
                    'lat' => 5.3484,
                    'lng' => -4.0126,
                    'address' => 'Zone Industrielle de Yopougon, Abidjan'
                ]
            ],
            [
                'name' => 'Chargeuse sur Pneus Volvo L120H',
                'type' => 'loader',
                'description' => 'Chargeuse polyvalente pour le chargement et la manutention de matériaux',
                'specifications' => [
                    'Poids opérationnel' => '18.700 kg',
                    'Puissance moteur' => '147 kW',
                    'Capacité du godet' => '3.0 m³',
                    'Charge de basculement' => '12.400 kg',
                    'Hauteur de déversement' => '2.9 m'
                ],
                'daily_rate' => 300000,
                'weekly_rate' => 1800000,
                'monthly_rate' => 7000000,
                'image' => 'images/equipment/volvo-l120h.jpg',
                'status' => 'available',
                'current_location' => [
                    'lat' => 5.3167,
                    'lng' => -4.0333,
                    'address' => 'Port Autonome d\'Abidjan'
                ]
            ],
            [
                'name' => 'Grue Mobile Liebherr LTM 1060',
                'type' => 'crane',
                'description' => 'Grue tout-terrain pour les travaux de levage en milieu urbain',
                'specifications' => [
                    'Capacité de levage max' => '60 tonnes',
                    'Hauteur de levage max' => '48 m',
                    'Longueur de flèche' => '40 m',
                    'Nombre d\'essieux' => '3',
                    'Contrepoids total' => '12.8 tonnes'
                ],
                'daily_rate' => 500000,
                'weekly_rate' => 3000000,
                'monthly_rate' => 11000000,
                'image' => 'images/equipment/liebherr-ltm1060.jpg',
                'status' => 'rented',
                'current_location' => [
                    'lat' => 5.3600,
                    'lng' => -3.9667,
                    'address' => 'Chantier Cocody, Abidjan'
                ]
            ],
            [
                'name' => 'Camion Benne MAN TGS 33.420',
                'type' => 'truck',
                'description' => 'Camion benne robuste pour le transport de matériaux en vrac',
                'specifications' => [
                    'Charge utile' => '20 tonnes',
                    'Volume de benne' => '16 m³',
                    'Puissance moteur' => '420 ch',
                    'Nombre d\'essieux' => '3',
                    'Type de benne' => 'Benne arrière'
                ],
                'daily_rate' => 200000,
                'weekly_rate' => 1200000,
                'monthly_rate' => 4500000,
                'image' => 'images/equipment/man-tgs.jpg',
                'status' => 'available',
                'current_location' => [
                    'lat' => 5.3484,
                    'lng' => -4.0126,
                    'address' => 'Zone Industrielle de Yopougon, Abidjan'
                ]
            ],
            [
                'name' => 'Compacteur HAMM H11i',
                'type' => 'compactor',
                'description' => 'Compacteur monocylindre pour les travaux de terrassement',
                'specifications' => [
                    'Poids opérationnel' => '11.300 kg',
                    'Largeur de travail' => '2.140 mm',
                    'Force centrifuge' => '256 kN',
                    'Amplitude' => '1.9/0.9 mm',
                    'Fréquence de vibration' => '30/40 Hz'
                ],
                'daily_rate' => 250000,
                'weekly_rate' => 1500000,
                'monthly_rate' => 5500000,
                'image' => 'images/equipment/hamm-h11i.jpg',
                'status' => 'available',
                'current_location' => [
                    'lat' => 5.3167,
                    'lng' => -4.0333,
                    'address' => 'Chantier Autoroute, Abidjan'
                ]
            ]
        ];

        foreach ($equipment as $item) {
            Equipment::create($item);
        }
    }
} 