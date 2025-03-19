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
                    'images/topography/topo11.jpg',
                    'images/topography/topo11.jpg'
                ],
                'location' => 'Cocody, Abidjan',
                'completion_date' => '2024-02-15'
            ],
            [
                'title' => 'Levé topographique Riviera',
                'type' => 'leve',
                'description' => 'Cartographie détaillée d\'un terrain de 2500m² pour un projet immobilier',
                'images' => [
                    'images/topography/topo10.jpg',
                    'images/topography/topo10.jpg'
                ],
                'location' => 'Riviera, Abidjan',
                'completion_date' => '2024-01-20'
            ],
            [
                'title' => 'Nivellement Yopougon',
                'type' => 'nivellement',
                'description' => 'Étude de nivellement pour l\'implantation d\'un complexe commercial',
                'images' => [
                    'images/topography/topo9.jpg',
                    'images/topography/topo9.jpg'
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