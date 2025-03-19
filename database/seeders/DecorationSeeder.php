<?php

namespace Database\Seeders;

use App\Models\DecorationService;
use App\Models\DecorationProject;
use App\Models\DecorationArticle;
use Illuminate\Database\Seeder;

class DecorationSeeder extends Seeder
{
    public function run()
    {
        // Seed Services
        $services = [
            [
                'title' => 'Design d\'Intérieur',
                'description' => 'Conception complète d\'espaces intérieurs adaptés à votre style de vie',
                'icon' => 'fa-pencil-ruler',
                'image' => 'images/services/amm.jpeg',
                'features' => [
                    'Plans et rendus 3D',
                    'Sélection des matériaux',
                    'Coordination des travaux',
                    'Suivi de projet'
                ],
                'price_range' => '500 000 FCFA - 2M FCFA'
            ],
            [
                'title' => 'Ameublement',
                'description' => 'Sélection et agencement de mobilier pour créer des espaces fonctionnels et esthétiques',
                'icon' => 'fa-couch',
                'image' => 'images/services/des.jpeg',
                'features' => [
                    'Mobilier sur mesure',
                    'Conseil en agencement',
                    'Accessoires décoratifs',
                    'Installation complète'
                ],
                'price_range' => '300 000 FCFA - 1.5M FCFA'
            ],
            [
                'title' => 'Rénovation Décorative',
                'description' => 'Transformation complète de vos espaces avec des solutions décoratives innovantes',
                'icon' => 'fa-paint-roller',
                'image' => 'images/services/inte1.jpeg',
                'features' => [
                    'Peinture décorative',
                    'Revêtements muraux',
                    'Éclairage design',
                    'Finitions personnalisées'
                ],
                'price_range' => '200 000 FCFA - 1M FCFA'
            ]
        ];

        foreach ($services as $service) {
            DecorationService::create($service);
        }

        // Seed Projects
        $projects = [
            [
                'title' => 'Villa Moderne Yaounde',
                'description' => 'Rénovation complète d\'une villa avec un style contemporain',
                'type' => 'Résidentiel',
                'before_image' => 'images/services/res.jpeg',
                'after_image' => 'images/services/res.jpeg',
                'additional_images' => ['detail1.jpg', 'detail2.jpg'],
                'client_name' => 'M. et Mme Koné',
                'testimonial' => 'Une transformation incroyable qui dépasse nos attentes.',
                'completion_date' => '2024-02-15'
            ],
            [
                'title' => 'Bureau Design Plateau',
                'description' => 'Aménagement d\'un espace de travail moderne et créatif',
                'type' => 'Commercial',
                'before_image' => 'images/services/des.jpeg',
                'after_image' => 'images/services/des.jpeg',
                'additional_images' => ['detail1.jpg', 'detail2.jpg'],
                'client_name' => 'StartupHub CI',
                'testimonial' => 'Un environnement de travail qui inspire la créativité.',
                'completion_date' => '2024-01-20'
            ]
        ];

        foreach ($projects as $project) {
            DecorationProject::create($project);
        }

        // Seed Articles
        $articles = [
            [
                'title' => 'Les Tendances Déco 2024',
                'slug' => 'tendances-deco-2024',
                'content' => 'Découvrez les tendances qui marqueront la décoration d\'intérieur en 2024...',
                'image' => 'images/services/inte1.jpeg',
                'author_name' => 'Sophie Kouamé',
                'reading_time' => 5,
                'tags' => ['Tendances', '2024', 'Design']
            ],
            [
                'title' => 'Comment Choisir ses Couleurs',
                'slug' => 'guide-choix-couleurs',
                'content' => 'Guide complet pour créer une palette de couleurs harmonieuse...',
                'image' => 'images/services/inte1.jpeg',
                'author_name' => 'Marc Diallo',
                'reading_time' => 8,
                'tags' => ['Couleurs', 'Guide', 'Conseils']
            ]
        ];

        foreach ($articles as $article) {
            DecorationArticle::create($article);
        }
    }
} 