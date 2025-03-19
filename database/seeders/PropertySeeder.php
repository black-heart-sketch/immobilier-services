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
                'title' => 'Terrain à Afanoyoa',
                'type' => 'terrain',
                'description' => 'Opportunité à ne pas manquer ! Nous vous proposons un terrain titré et loti d`une superficie de 500 mètre carré à Afanoyoa, plus précisement au lycée de Nkolabam.',
                'price' => 8000000, // 16000 FCFA * 500m2
                'surface_area' => 500,
                'location' => 'Afanoyoa, Yaoundé',
                'latitude' => 3.8667,
                'longitude' => 11.5167,
                'features' => [
                    'Terrain plat et dégagé',
                    'Accès facile depuis la route principale',
                    'Au niveau du lycée Nkolabal',
                    'Zone habitable et électrifiée'
                ],
                'images' => [
                    'images/properties/terrain-1.jpg',
                    'images/properties/terrain-1.jpg'
                ],
                'status' => 'available',
                'reference' => 'LMIYTAA00'
            ],
            [
                'title' => 'Terrain à Afanoyoa 1000m²',
                'type' => 'terrain',
                'description' => 'Opportunité à ne pas manquer ! Nous vous proposons un terrain titré et loti d`une superficie de 1000 mètre carré à Afanoyoa, plus précisement à 2km après le lycée de Nkolabam.',
                'price' => 16000000, // 16000 FCFA * 1000m2
                'surface_area' => 1000,
                'location' => 'Afanoyoa, Yaoundé',
                'latitude' => 3.8667,
                'longitude' => 11.5167,
                'features' => [
                    'Terrain plat et dégagé',
                    'Accès facile depuis la route principale',
                    'Idéal pour résidence privée, immeuble locatif, bureau, hôtel',
                    'Zone habitable et électrifiée'
                ],
                'images' => [
                    'images/properties/terrain-2.jpg',
                    'images/properties/terrain-2.jpg'
                ],
                'status' => 'available',
                'reference' => 'LMIYTAA01'
            ],
            [
                'title' => 'Terrain à Ahala 2000m²',
                'type' => 'terrain',
                'description' => 'Opportunité en foncière à ne pas manquer concernant un terrain titré et loti d`une superficie de 2.000m² situé sur l`axe lourd Douala-Yaoundé dèrrière la station Blessing à 50m du goudron.',
                'price' => 76000000, // 38000 FCFA * 2000m2
                'surface_area' => 2000,
                'location' => 'Ahala, Yaoundé',
                'latitude' => 3.8667,
                'longitude' => 11.5167,
                'features' => [
                    'Situé à 200m de BARRIERE, derrière la station de service Blessing',
                    'Le terrain se trouve à 150m du goudron',
                    'Terrain plat et dégagé',
                    'Zone habitable et électrifiée'
                ],
                'images' => [
                    'images/properties/terrain-3.jpg',
                    'images/properties/terrain-3.jpg'
                ],
                'status' => 'available',
                'reference' => 'LMIYAALA00'
            ],
            [
                'title' => 'Terrain à Ahala 5000m²',
                'type' => 'terrain',
                'description' => 'Opportunité en or à ne pas manquer concernant un terrain titré et loti d`une superficie de 5.000m² situé sur l`axe lourd Douala-Yaoundé dèrrière la station Blessing à 50m du goudron.',
                'price' => 190000000, // 38000 FCFA * 5000m2
                'surface_area' => 5000,
                'location' => 'Ahala, Yaoundé',
                'latitude' => 3.8667,
                'longitude' => 11.5167,
                'features' => [
                    'Situé à 200m de BARRIERE, derrière la station de service Blessing',
                    'Le terrain se trouve à 150m du goudron',
                    'Terrain plat et dégagé',
                    'Zone habitable et électrifiée'
                ],
                'images' => [
                    'images/properties/terrain-4.jpg',
                    'images/properties/terrain-5.jpg'
                ],
                'status' => 'available',
                'reference' => 'LMIYTALA01'
            ],
            [
                'title' => 'Terrain à Ahala 2 Hectares',
                'type' => 'terrain',
                'description' => 'Opportunité en or à ne pas manquer concernant un terrain titré et loti d`une superficie de 20.000/m² situé sur l`axe lourd Douala-Yaoundé derrière la station Blessing à 50m du goudron.',
                'price' => 900000000, // 45000 FCFA * 20000m2
                'surface_area' => 20000,
                'location' => 'Ahala, Yaoundé',
                'latitude' => 3.8667,
                'longitude' => 11.5167,
                'features' => [
                    'Situé au niveau de la station Blessing, à 50 mètres de la route',
                    'Zone habitable et électrifiée',
                    'Terrain plat et dégagé',
                    'Projets possibles: résidence privée, immeuble locatif, bureau, hôtel'
                ],
                'images' => [
                    'images/properties/terrain-6.jpg',
                    'images/properties/terrain-7.jpg'
                ],
                'status' => 'available',
                'reference' => 'LMIYTALA02'
            ],
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
                    'images/properties/terrain-8.jpg',
                    'images/properties/terrain-8.jpg',
                    'images/properties/terrain-8.jpg'
                ],
                'status' => 'available'
            ],
            [
                'title' => 'Terrain à Ekoumdoum',
                'type' => 'terrain',
                'description' => 'Exceptionnel Terrain de 1.022 m² à vendre à Ekoumdoum - Yaoundé. Découvrez ce terrain titré de 1.022 m² situé au quartier Ekoumdoum à Yaoundé.',
                'price' => 45990000, // 45000 FCFA * 1022m2
                'surface_area' => 1022,
                'location' => 'Ekoumdoum, Yaoundé',
                'latitude' => 3.8667,
                'longitude' => 11.5167,
                'features' => [
                    'Ekoumdoum à 1.5km du carrefour',
                    'Le quartier est goudroné jusqu\'à 150 m du site',
                    'Accès facile en voiture',
                    'Zone habitable et électrifiée'
                ],
                'images' => [
                    'images/properties/terrain-20.jpg',
                    'images/properties/terrain-21.jpg'
                ],
                'status' => 'available',
                'reference' => 'LMIYTEM00'
            ],
            [
                'title' => 'Terrain à Elat 1.5 Hectares',
                'type' => 'terrain',
                'description' => 'Magnifique Terrain de 1ha5000m2 à Vendre à Elat - Yaoundé. Le site est à 20min du carrefour NKOABANG en voiture (15km).',
                'price' => 75000000, // 5000 FCFA * 15000m2
                'surface_area' => 15000,
                'location' => 'Elat, Yaoundé',
                'latitude' => 3.8667,
                'longitude' => 11.5167,
                'features' => [
                    'Situé à Elat avant le carrefour et à 200m du goudron',
                    'Le terrain est morcelable à partir de 5.000/m2',
                    'Projets possibles: résidence privée, complexe sportif, école, clinique privée'
                ],
                'images' => [
                    'images/properties/terrain-22.jpg',
                    'images/properties/terrain-23.jpg'
                ],
                'status' => 'available',
                'reference' => 'LMIYTET00'
            ],
            [
                'title' => 'Terrain à Elat 5 Hectares',
                'type' => 'terrain',
                'description' => 'Magnifique Terrain de 5Ha à Vendre à Elat - Yaoundé. Saisissez l\'opportunité d\'acquérir ce terrain titré et loti de 5 hectares situé au quartier Elat.',
                'price' => 175000000, // 3500 FCFA * 50000m2
                'surface_area' => 50000,
                'location' => 'Elat, Yaoundé',
                'latitude' => 3.8667,
                'longitude' => 11.5167,
                'features' => [
                    'Situé à 5mins du carrefour Elat au lieu dit Nkolato',
                    'À 700m du goudron',
                    'Le terrain est morcelable à partir de 500m2',
                    'Projets possibles: résidence privée, école, complexe sportif'
                ],
                'images' => [
                    'images/properties/terrain-24.jpg',
                    'images/properties/terrain-25.jpg'
                ],
                'status' => 'available',
                'reference' => 'LMIYTETO1'
            ],
            [
                'title' => 'Terrain Commercial à Fougerolle',
                'type' => 'terrain',
                'description' => 'Magnifique LOT de terrain commercial de 3000m2 à vendre à FOUGEROLLE - Yaoundé. Saisissez l\'opportunité d\'acquérir ce terrain titré de 3000 m² situé au quartier FOUGEROLLE avant SOA.',
                'price' => 195000000, // 65000 FCFA * 3000m2
                'surface_area' => 3000,
                'location' => 'Fougerolle, Yaoundé',
                'latitude' => 3.8667,
                'longitude' => 11.5167,
                'features' => [
                    'Situé à FOUGEROLLE au lieu dit collège AMITY',
                    'En bordure de route principale',
                    'Idéal pour supermarché, station service, ou immeuble locatif'
                ],
                'images' => [
                    'images/properties/terrain-26.jpg',
                    'images/properties/terrain-27.jpg'
                ],
                'status' => 'available'
            ],
            [
                'title' => 'Terrain à Mbankomo 1000m²',
                'type' => 'terrain',
                'description' => 'À Vendre : Terrains à Mbankomo - Yaoundé sur l\'axe yaoundé-douala. Découvrez ces terrains titrés disponibles à la vente au quartier Mbankomo, Yaoundé.',
                'price' => 9900000, // 9900 FCFA * 1000m2
                'surface_area' => 1000,
                'location' => 'Mbankomo, Yaoundé',
                'latitude' => 3.8667,
                'longitude' => 11.5167,
                'features' => [
                    'Située à 420m de l\'axe lourd',
                    'Goudron à 100m du site',
                    'Zone électrifiée et habitée au lieu-dit OSSA'
                ],
                'images' => [
                    'images/properties/terrain-28.jpg',
                    'images/properties/terrain-29.jpg'
                ],
                'status' => 'available',
                'reference' => 'LMIYTMMO01'
            ],
            [
                'title' => 'Terrain à Mfou 700m²',
                'type' => 'terrain',
                'description' => 'Magnifique Terrain a vendre de 700 m² à Mfou - Yaoundé. Découvrez ce terrain titré de 700 m² situé au quartier Mfou, Yaoundé.',
                'price' => 5250000, // 7500 FCFA * 700m2
                'surface_area' => 700,
                'location' => 'Mfou, Yaoundé',
                'latitude' => 3.8667,
                'longitude' => 11.5167,
                'features' => [
                    'Situé sur la route de MFOU au lieu-dit Nkassomo',
                    'Le lot est en plein carrefour d\'une route secondaire',
                    'Emplacement stratégique avec excellente visibilité'
                ],
                'images' => [
                    'images/properties/terrain-30.jpg',
                    'images/properties/terrain-31.jpg'
                ],
                'status' => 'available',
                'reference' => 'LMIYTMU00'
            ],
            [
                'title' => 'Terrain à Mfou 3 Hectares',
                'type' => 'terrain',
                'description' => 'Magnifique terrain de 3 Hectares à vendre à Mfou - Yaoundé. Saisissez l\'opportunité d\'acquérir un terrain titré de 3 hectares situé au quartier Mfou, Yaoundé.',
                'price' => 255000000, // 8500 FCFA * 30000m2
                'surface_area' => 30000,
                'location' => 'Mfou, Yaoundé',
                'latitude' => 3.8667,
                'longitude' => 11.5167,
                'features' => [
                    'Situé à 3,5km du centre-ville',
                    'Zone habitable et électrifiée',
                    'Proximité de la route',
                    'Idéal pour résidences, complexe sportif, hôpital ou projets commerciaux'
                ],
                'images' => [
                    'images/properties/terrain-32.jpg',
                    'images/properties/terrain-33.jpg'
                ],
                'status' => 'available',
                'reference' => 'LMIYTMU01'
            ],
            [
                'title' => 'Terrain Commercial à Ngousso',
                'type' => 'terrain',
                'description' => 'Magnifique opportunité a saisir concernant un terrain d\'une supperficie de 1280m2 au quartier Ngousso situé en bordure de la route principale.',
                'price' => 490000000, // Direct price from data
                'surface_area' => 1280,
                'location' => 'Ngousso, Yaoundé',
                'latitude' => 3.8667,
                'longitude' => 11.5167,
                'features' => [
                    'Situé à la chapelle NGOUSSO',
                    'Sur le terrain il y\'a une résidence et plusieurs boutiques déjà en location',
                    'La résidence peut-être rénovée ou détruite par le nouvel acquéreur',
                    'Excellente opportunité investisseur'
                ],
                'images' => [
                    'images/properties/terrain-34.jpg',
                    'images/properties/terrain-35.jpg'
                ],
                'status' => 'available',
                'reference' => 'LMEYTNSO00'
            ],
            [
                'title' => 'Terrain à Nkoabang 400m²',
                'type' => 'terrain',
                'description' => 'Magnifique terrain de 400m2 à vendre à Nkoabang - Yaoundé. Découvrez ce terrain titré de 400 m² situé au quartier Nkoabang, Yaoundé.',
                'price' => 12000000, // 30000 FCFA * 400m2
                'surface_area' => 400,
                'location' => 'Nkoabang, Yaoundé',
                'latitude' => 3.8667,
                'longitude' => 11.5167,
                'features' => [
                    'Situé à Nkoabang derrière la mission catholique',
                    'À 300m de l\'axe principale et à 50m du goudron de la paroisse',
                    '02 signataires'
                ],
                'images' => [
                    'images/properties/terrain-36.jpg',
                    'images/properties/terrain-37.jpg'
                ],
                'status' => 'available',
                'reference' => 'LMIYTNNG01'
            ],
            [
                'title' => 'Terrain à Nkolnda 5000m²',
                'type' => 'terrain',
                'description' => 'Magnifique terrain de 5000 m2 à vendre à Nkolnda - Yaoundé. Saisissez l\'opportunité d\'acquérir ce terrain titré de 5 000 m² situé au quartier Nkolnda, Yaoundé.',
                'price' => 90000000, // 18000 FCFA * 5000m2
                'surface_area' => 5000,
                'location' => 'Nkolnda, Yaoundé',
                'latitude' => 3.8667,
                'longitude' => 11.5167,
                'features' => [
                    'Situé à Nkolnda au lieu dit Evondo, bordure de route',
                    'Zone habitable et électrifiée',
                    'Idéal pour maison d\'habitation, hôpital ou immeuble locatif'
                ],
                'images' => [
                    'images/properties/terrain-38.jpg',
                    'images/properties/terrain-39.jpg'
                ],
                'status' => 'available',
                'reference' => 'LMIYTNDA01'
            ],
            [
                'title' => 'Terrain à Tsinga Village 2 Hectares',
                'type' => 'terrain',
                'description' => 'Offre magnifique d\'un terrain d\'une superficcie de 02 hectares au lieu dit Tsinga villa à 200 metres de la Station Nickel oil seulement 20000 fr/m².',
                'price' => 400000000, // 20000 FCFA * 20000m2
                'surface_area' => 20000,
                'location' => 'Tsinga Village, Yaoundé',
                'latitude' => 3.8667,
                'longitude' => 11.5167,
                'features' => [
                    'Situé à 200m de la station Nickel oil',
                    'Morcelable à partir de 300m²',
                    'Zone habitable et électrifiée',
                    'Idéal pour maisons d\'habitation ou immeubles locatifs'
                ],
                'images' => [
                    'images/properties/terrain-40.jpg',
                    'images/properties/terrain-41.jpg'
                ],
                'status' => 'available',
                'reference' => 'LMIYTTGE00'
            ],
            [
                'title' => 'Terrain à Tsinga Village 5000m²',
                'type' => 'terrain',
                'description' => 'Magnifique Terrain a vendre d\'une superficie de Total de 5000 m² au lieu dit Tsinga Village à 50 metre de la route principale à seulement 15000fr/m²',
                'price' => 100000000, // 20000 FCFA * 5000m2
                'surface_area' => 5000,
                'location' => 'Tsinga Village, Yaoundé',
                'latitude' => 3.8667,
                'longitude' => 11.5167,
                'features' => [
                    'Situé à Tsinga Village derrière le lycée',
                    'À 50m de la route principale',
                    'Zone habitable et électrifiée',
                    'Idéal pour maison d\'habitation, hôpital ou immeuble locatif'
                ],
                'images' => [
                    'images/properties/terrain-42.jpg',
                    'images/properties/terrain-43.jpg'
                ],
                'status' => 'available',
                'reference' => 'LMIYTTGE02'
            ]
        ];

        foreach ($properties as $property) {
            try {
              //  Log::error('Failed to create property: ' . $e->getMessage());
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