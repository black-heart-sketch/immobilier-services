<?php

namespace Database\Seeders;

use App\Models\Plant;
use Illuminate\Database\Seeder;

class PlantSeeder extends Seeder
{
    public function run()
    {
        $plants = [
            [
                'name' => 'Manguier',
                'scientific_name' => 'Mangifera indica',
                'category' => 'arbres_fruitiers',
                'description' => 'Le manguier est un arbre fruitier tropical qui produit les délicieuses mangues. Il peut atteindre une hauteur de 30 mètres et vivre plus de 100 ans.',
                'care_instructions' => 'Arrosage régulier mais modéré. Exposition ensoleillée. Protection contre le vent. Fertilisation organique au printemps.',
                'specifications' => [
                    'hauteur_maximale' => '30 mètres',
                    'croissance' => 'moyenne',
                    'exposition' => 'plein soleil',
                    'résistance' => 'moyenne'
                ],
                'benefits' => [
                    'Production de fruits',
                    'Ombre généreuse',
                    'Brise-vent naturel',
                    'Habitat pour la biodiversité'
                ],
                'price' => 15000,
                'stock' => 50,
                'image' => 'images/plants/manguier.jpg',
                'gallery' => [
                    'images/plants/manguier-1.jpg',
                    'images/plants/manguier-2.jpg',
                    'images/plants/manguier-3.jpg'
                ],
                'available_wholesale' => true,
                'wholesale_min_quantity' => 10,
                'wholesale_price' => 12000
            ],
            [
                'name' => 'Bougainvillier',
                'scientific_name' => 'Bougainvillea spectabilis',
                'category' => 'plantes_ornementales',
                'description' => 'Plante grimpante spectaculaire avec des bractées colorées. Parfaite pour les clôtures et pergolas.',
                'care_instructions' => 'Arrosage modéré. Taille régulière pour maintenir la forme. Exposition ensoleillée.',
                'specifications' => [
                    'hauteur_maximale' => '12 mètres',
                    'croissance' => 'rapide',
                    'exposition' => 'plein soleil',
                    'résistance' => 'forte'
                ],
                'benefits' => [
                    'Décoration colorée',
                    'Protection naturelle',
                    'Résistant à la sécheresse',
                    'Attire les pollinisateurs'
                ],
                'price' => 5000,
                'stock' => 100,
                'image' => 'images/plants/bougainvillier.jpg',
                'gallery' => [
                    'images/plants/bougainvillier-1.jpg',
                    'images/plants/bougainvillier-2.jpg'
                ],
                'available_wholesale' => true,
                'wholesale_min_quantity' => 20,
                'wholesale_price' => 4000
            ],
            [
                'name' => 'Palmier Royal',
                'scientific_name' => 'Roystonea regia',
                'category' => 'palmiers',
                'description' => 'Palmier majestueux à croissance rapide, idéal pour les allées et les grands jardins.',
                'care_instructions' => 'Arrosage abondant. Sol bien drainé. Protection contre les vents forts.',
                'specifications' => [
                    'hauteur_maximale' => '25 mètres',
                    'croissance' => 'rapide',
                    'exposition' => 'plein soleil',
                    'résistance' => 'moyenne'
                ],
                'benefits' => [
                    'Aspect majestueux',
                    'Ombre verticale',
                    'Valorisation paysagère',
                    'Résistant aux embruns'
                ],
                'price' => 25000,
                'stock' => 30,
                'image' => 'images/plants/palmier-royal.jpg',
                'gallery' => [
                    'images/plants/palmier-royal-1.jpg',
                    'images/plants/palmier-royal-2.jpg'
                ],
                'available_wholesale' => true,
                'wholesale_min_quantity' => 5,
                'wholesale_price' => 20000
            ]
        ];

        foreach ($plants as $plant) {
            Plant::create($plant);
        }
    }
} 