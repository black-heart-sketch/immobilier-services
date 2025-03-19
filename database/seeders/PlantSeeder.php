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
                'image' => 'images/plants/Manguier.jpg',
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
                'name' => 'Avocatier',
                'scientific_name' => 'Persea americana',
                'category' => 'arbres_fruitiers',
                'description' => 'L\'avocatier est un arbre fruitier tropical qui produit des avocats riches en nutriments. Il peut atteindre une hauteur de 20 mètres et produit des fruits toute l\'année.',
                'care_instructions' => 'Arrosage régulier, sol bien drainé, exposition ensoleillée à mi-ombragée. Protection contre le gel.',
                'specifications' => [
                    'hauteur_maximale' => '20 mètres',
                    'croissance' => 'moyenne',
                    'exposition' => 'soleil/mi-ombre',
                    'résistance' => 'moyenne'
                ],
                'benefits' => [
                    'Production de fruits nutritifs',
                    'Ombre dense',
                    'Amélioration de la qualité du sol',
                    'Longue durée de vie'
                ],
                'price' => 12000,
                'stock' => 40,
                'image' => 'images/plants/avocatier1.jpeg',
                'gallery' => [
                    'images/plants/avocatier-1.jpg',
                    'images/plants/avocatier-2.jpg',
                    'images/plants/avocatier-3.jpg'
                ],
                'available_wholesale' => true,
                'wholesale_min_quantity' => 10,
                'wholesale_price' => 9000
            ],
            [
                'name' => 'Safoutier',
                'scientific_name' => 'Dacryodes edulis',
                'category' => 'arbres_fruitiers',
                'description' => 'Le safoutier est un arbre fruitier africain qui produit les safous, très appréciés en Afrique centrale. Arbre à croissance lente mais durable.',
                'care_instructions' => 'Arrosage modéré, sol riche et bien drainé. Protection contre les vents forts.',
                'specifications' => [
                    'hauteur_maximale' => '25 mètres',
                    'croissance' => 'lente',
                    'exposition' => 'plein soleil',
                    'résistance' => 'forte'
                ],
                'benefits' => [
                    'Production de safous',
                    'Bois de qualité',
                    'Ombre dense',
                    'Adapté au climat tropical'
                ],
                'price' => 15000,
                'stock' => 30,
                'image' => 'images/plants/safroutier.jpeg',
                'gallery' => [
                    'images/plants/safoutier-1.jpg',
                    'images/plants/safoutier-2.jpg'
                ],
                'available_wholesale' => true,
                'wholesale_min_quantity' => 8,
                'wholesale_price' => 12000
            ],
            [
                'name' => 'Citronnier',
                'scientific_name' => 'Citrus limon',
                'category' => 'arbres_fruitiers',
                'description' => 'Le citronnier est un agrume qui produit des citrons tout au long de l\'année. Parfait pour les jardins et peut être cultivé en pot.',
                'care_instructions' => 'Arrosage régulier, sol acide bien drainé, exposition ensoleillée, protection contre le gel.',
                'specifications' => [
                    'hauteur_maximale' => '6 mètres',
                    'croissance' => 'moyenne',
                    'exposition' => 'plein soleil',
                    'résistance' => 'moyenne'
                ],
                'benefits' => [
                    'Production continue de citrons',
                    'Parfum agréable',
                    'Usage culinaire et médicinal',
                    'Adapté à la culture en pot'
                ],
                'price' => 8000,
                'stock' => 60,
                'image' => 'images/plants/citronier.jpeg',
                'gallery' => [
                    'images/plants/citronnier-1.jpg',
                    'images/plants/citronnier-2.jpg'
                ],
                'available_wholesale' => true,
                'wholesale_min_quantity' => 15,
                'wholesale_price' => 6000
            ],
            [
                'name' => 'Corossolier',
                'scientific_name' => 'Annona muricata',
                'category' => 'arbres_fruitiers',
                'description' => 'Le corossolier produit le corossol, un fruit tropical aux nombreuses vertus médicinales. Arbre de taille moyenne idéal pour les jardins.',
                'care_instructions' => 'Arrosage régulier, sol riche et bien drainé, exposition ensoleillée à mi-ombragée.',
                'specifications' => [
                    'hauteur_maximale' => '8 mètres',
                    'croissance' => 'moyenne',
                    'exposition' => 'soleil/mi-ombre',
                    'résistance' => 'moyenne'
                ],
                'benefits' => [
                    'Fruits aux propriétés médicinales',
                    'Production régulière',
                    'Feuillage décoratif',
                    'Culture facile'
                ],
                'price' => 10000,
                'stock' => 45,
                'image' => 'images/plants/corosolier.jpeg',
                'gallery' => [
                    'images/plants/corossolier-1.jpg',
                    'images/plants/corossolier-2.jpg'
                ],
                'available_wholesale' => true,
                'wholesale_min_quantity' => 12,
                'wholesale_price' => 8000
            ],
            [
                'name' => 'Cacaoyer',
                'scientific_name' => 'Theobroma cacao',
                'category' => 'arbres_fruitiers',
                'description' => 'Le cacaoyer est l\'arbre qui produit les fèves de cacao. Il nécessite un environnement tropical humide et ombragé.',
                'care_instructions' => 'Arrosage régulier, sol riche et bien drainé, exposition mi-ombragée, protection contre le soleil direct.',
                'specifications' => [
                    'hauteur_maximale' => '10 mètres',
                    'croissance' => 'lente',
                    'exposition' => 'mi-ombre',
                    'résistance' => 'moyenne'
                ],
                'benefits' => [
                    'Production de fèves de cacao',
                    'Culture sous couvert forestier',
                    'Valeur économique',
                    'Biodiversité'
                ],
                'price' => 18000,
                'stock' => 35,
                'image' => 'images/plants/cacaoyier.jpeg',
                'gallery' => [
                    'images/plants/cacaoyer-1.jpg',
                    'images/plants/cacaoyer-2.jpg',
                    'images/plants/cacaoyer-3.jpg'
                ],
                'available_wholesale' => true,
                'wholesale_min_quantity' => 10,
                'wholesale_price' => 15000
            ]
        ];

        foreach ($plants as $plant) {
            Plant::create($plant);
        }
    }
} 