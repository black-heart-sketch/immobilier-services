<?php

namespace Database\Seeders;

use App\Models\TopographyProject;
use Illuminate\Database\Seeder;

class TopographyProjectSeeder extends Seeder
{
    public function run()
    {
        $projects = [
            [
                'title' => 'Bornage terrain résidentiel Cocody',
                'type' => 'bornage',
                'description' => 'Délimitation précise d\'un terrain de 1000m² avec pose de bornes officielles',
                'images' => [
                    'images/topography/project1-1.jpg',
                    'images/topography/project1-2.jpg'
                ],
                'location' => 'Cocody, Abidjan',
                'completion_date' => '2024-02-15'
            ],
            [
                'title' => 'Levé topographique Riviera',
                'type' => 'leve',
                'description' => 'Cartographie détaillée d\'un terrain de 2500m² pour un projet immobilier',
                'images' => [
                    'images/topography/project2-1.jpg',
                    'images/topography/project2-2.jpg'
                ],
                'location' => 'Riviera, Abidjan',
                'completion_date' => '2024-01-20'
            ],
            [
                'title' => 'Nivellement Yopougon',
                'type' => 'nivellement',
                'description' => 'Étude de nivellement pour l\'implantation d\'un complexe commercial',
                'images' => [
                    'images/topography/project3-1.jpg',
                    'images/topography/project3-2.jpg'
                ],
                'location' => 'Yopougon, Abidjan',
                'completion_date' => '2024-03-01'
            ]
        ];

        foreach ($projects as $project) {
            TopographyProject::create($project);
        }
    }
} 