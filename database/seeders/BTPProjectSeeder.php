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
                'title' => 'Villa Moderne à Bastos',
                'type' => 'construction',
                'description' => 'Construction d\'une villa moderne de 400m² avec piscine et jardin paysager dans le quartier diplomatique',
                'before_image' => 'images/btp/btp1.jpg',
                'after_image' => 'images/btp/btp1.jpg',
                'location' => 'Bastos, Yaoundé',
                'completion_date' => '2024-01-15',
                'surface_area' => 400,
                'cost' => 150000000,
                'testimonials' => [
                    [
                        'client_name' => 'M. Kamdem',
                        'content' => 'Un travail exceptionnel, notre villa est exactement comme nous l\'avions imaginée. L\'équipe a fait preuve d\'un grand professionnalisme.',
                        'rating' => 5
                    ]
                ]
            ],
            [
                'title' => 'Rénovation Appartement Bonapriso',
                'type' => 'renovation',
                'description' => 'Rénovation complète d\'un appartement de 120m² avec modernisation des installations et vue sur le Wouri',
                'before_image' => 'images/btp/btp2.jpg',
                'after_image' => 'images/btp/btp2.jpg',
                'location' => 'Bonapriso, Douala',
                'completion_date' => '2024-02-20',
                'surface_area' => 120,
                'cost' => 45000000,
                'testimonials' => [
                    [
                        'client_name' => 'Mme Ngo',
                        'content' => 'La transformation est incroyable, c\'est comme un nouvel appartement. La vue sur le fleuve est maintenant parfaitement mise en valeur.',
                        'rating' => 5
                    ]
                ]
            ],
            [
                'title' => 'Immeuble Commercial Akwa',
                'type' => 'construction',
                'description' => 'Construction d\'un immeuble de bureaux de 1200m² sur 4 étages au cœur du quartier des affaires',
                'before_image' => 'images/btp/btp3.jpg',
                'after_image' => 'images/btp/btp3.jpg',
                'location' => 'Akwa, Douala',
                'completion_date' => '2023-12-10',
                'surface_area' => 1200,
                'cost' => 450000000,
                'testimonials' => [
                    [
                        'client_name' => 'Cabinet MNP',
                        'content' => 'Un projet livré dans les délais avec une qualité exceptionnelle. L\'emplacement stratégique en fait un investissement remarquable.',
                        'rating' => 5
                    ]
                ]
            ],
            // [
            //     'title' => 'Extension Villa Riviera',
            //     'type' => 'extension',
            //     'description' => 'Extension d\'une villa avec ajout d\'un étage et d\'une terrasse panoramique',
            //     'before_image' => 'images/btp/projects/IMG-20240812-WA0128.jpg',
            //     'after_image' => 'images/btp/projects/IMG-20240812-WA0128.jpg',
            //     'location' => 'Riviera, Abidjan',
            //     'completion_date' => '2024-03-01',
            //     'surface_area' => 150,
            //     'cost' => 75000000,
            //     'testimonials' => [
            //         [
            //             'client_name' => 'Dr. Touré',
            //             'content' => 'L\'extension s\'intègre parfaitement avec l\'existant, excellent travail.',
            //             'rating' => 5
            //         ]
            //     ]
            // ],
            // [
            //     'title' => 'Rénovation Boutique Adjamé',
            //     'type' => 'renovation',
            //     'description' => 'Rénovation et modernisation d\'un espace commercial de 80m²',
            //     'before_image' => 'images/btp/projects/IMG-20240812-WA0128.jpg',
            //     'after_image' => 'images/btp/projects/IMG-20240812-WA0128.jpg',
            //     'location' => 'Adjamé, Abidjan',
            //     'completion_date' => '2024-02-05',
            //     'surface_area' => 80,
            //     'cost' => 25000000,
            //     'testimonials' => [
            //         [
            //             'client_name' => 'M. Diallo',
            //             'content' => 'Ma boutique attire beaucoup plus de clients depuis la rénovation.',
            //             'rating' => 5
            //         ]
            //     ]
            // ],
            // [
            //     'title' => 'Villa de Luxe Bassam',
            //     'type' => 'construction',
            //     'description' => 'Construction d\'une villa de luxe en bord de mer avec piscine à débordement',
            //     'before_image' => 'images/btp/projects/IMG-20240812-WA0128.jpg',
            //     'after_image' => 'images/btp/projects/IMG-20240812-WA0128.jpg',
            //     'location' => 'Grand-Bassam',
            //     'completion_date' => '2024-01-30',
            //     'surface_area' => 600,
            //     'cost' => 280000000,
            //     'testimonials' => [
            //         [
            //             'client_name' => 'M. Sanogo',
            //             'content' => 'Un rêve devenu réalité, chaque détail est parfait.',
            //             'rating' => 5
            //         ]
            //     ]
            // ]
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