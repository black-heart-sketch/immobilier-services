<?php

namespace Database\Seeders;

use App\Models\BTPProject;
use App\Models\BTPTestimonial;
use Illuminate\Database\Seeder;

class BTPProjectSeeder extends Seeder
{
    public function run()
    {
        $projects = [
            [
                'title' => 'Villa Moderne à Cocody',
                'type' => 'construction',
                'description' => 'Construction d\'une villa moderne de 400m² avec piscine et jardin paysager',
                'before_image' => 'images/btp/projects/villa-before.jpg',
                'after_image' => 'images/btp/projects/villa-after.jpg',
                'location' => 'Cocody, Abidjan',
                'completion_date' => '2024-01-15',
                'surface_area' => 400,
                'cost' => 150000000,
                'testimonials' => [
                    [
                        'client_name' => 'M. Koné',
                        'content' => 'Un travail exceptionnel, notre villa est exactement comme nous l\'avions imaginée.',
                        'rating' => 5
                    ]
                ]
            ],
            [
                'title' => 'Rénovation Appartement Plateau',
                'type' => 'renovation',
                'description' => 'Rénovation complète d\'un appartement de 120m² avec modernisation des installations',
                'before_image' => 'images/btp/projects/apartment-before.jpg',
                'after_image' => 'images/btp/projects/apartment-after.jpg',
                'location' => 'Plateau, Abidjan',
                'completion_date' => '2024-02-20',
                'surface_area' => 120,
                'cost' => 45000000,
                'testimonials' => [
                    [
                        'client_name' => 'Mme Bamba',
                        'content' => 'La transformation est incroyable, c\'est comme un nouvel appartement.',
                        'rating' => 5
                    ]
                ]
            ],
            [
                'title' => 'Immeuble Commercial Marcory',
                'type' => 'construction',
                'description' => 'Construction d\'un immeuble de bureaux de 1200m² sur 4 étages',
                'before_image' => 'images/btp/projects/commercial-before.jpg',
                'after_image' => 'images/btp/projects/commercial-after.jpg',
                'location' => 'Marcory, Abidjan',
                'completion_date' => '2023-12-10',
                'surface_area' => 1200,
                'cost' => 450000000,
                'testimonials' => [
                    [
                        'client_name' => 'Cabinet KLM',
                        'content' => 'Un projet livré dans les délais avec une qualité exceptionnelle.',
                        'rating' => 5
                    ]
                ]
            ],
            [
                'title' => 'Extension Villa Riviera',
                'type' => 'extension',
                'description' => 'Extension d\'une villa avec ajout d\'un étage et d\'une terrasse panoramique',
                'before_image' => 'images/btp/projects/extension-before.jpg',
                'after_image' => 'images/btp/projects/extension-after.jpg',
                'location' => 'Riviera, Abidjan',
                'completion_date' => '2024-03-01',
                'surface_area' => 150,
                'cost' => 75000000,
                'testimonials' => [
                    [
                        'client_name' => 'Dr. Touré',
                        'content' => 'L\'extension s\'intègre parfaitement avec l\'existant, excellent travail.',
                        'rating' => 5
                    ]
                ]
            ],
            [
                'title' => 'Rénovation Boutique Adjamé',
                'type' => 'renovation',
                'description' => 'Rénovation et modernisation d\'un espace commercial de 80m²',
                'before_image' => 'images/btp/projects/shop-before.jpg',
                'after_image' => 'images/btp/projects/shop-after.jpg',
                'location' => 'Adjamé, Abidjan',
                'completion_date' => '2024-02-05',
                'surface_area' => 80,
                'cost' => 25000000,
                'testimonials' => [
                    [
                        'client_name' => 'M. Diallo',
                        'content' => 'Ma boutique attire beaucoup plus de clients depuis la rénovation.',
                        'rating' => 5
                    ]
                ]
            ],
            [
                'title' => 'Villa de Luxe Bassam',
                'type' => 'construction',
                'description' => 'Construction d\'une villa de luxe en bord de mer avec piscine à débordement',
                'before_image' => 'images/btp/projects/luxury-before.jpg',
                'after_image' => 'images/btp/projects/luxury-after.jpg',
                'location' => 'Grand-Bassam',
                'completion_date' => '2024-01-30',
                'surface_area' => 600,
                'cost' => 280000000,
                'testimonials' => [
                    [
                        'client_name' => 'M. Sanogo',
                        'content' => 'Un rêve devenu réalité, chaque détail est parfait.',
                        'rating' => 5
                    ]
                ]
            ]
        ];

        foreach ($projects as $projectData) {
            $testimonials = $projectData['testimonials'];
            unset($projectData['testimonials']);
            
            $project = BTPProject::create($projectData);
            
            foreach ($testimonials as $testimonialData) {
                BTPTestimonial::create([
                    'btp_project_id' => $project->id,
                    'client_name' => $testimonialData['client_name'],
                    'content' => $testimonialData['content'],
                    'rating' => $testimonialData['rating']
                ]);
            }
        }
    }
} 