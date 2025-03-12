<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $slides = [
            [
                'image' => 'images/slides/real.jpg',
                'title' => 'Services Immobiliers',
                'description' => 'Découvrez nos terrains et maisons disponibles',
                'overlay' => 'bg-black/40'
            ],
            [
                'image' => 'images/slides/topo.jpg',
                'title' => 'Services Topographiques',
                'description' => 'Une expertise professionnelle à votre service',
                'overlay' => 'bg-black/50'
            ],
            [
                'image' => 'images/slides/construction.jpg',
                'title' => 'Services BTP',
                'description' => 'Construction et rénovation de qualité',
                'overlay' => 'bg-black/45'
            ]
        ];

        $services = [
            [
                'icon' => 'fa-home',
                'title' => 'Vente de Terrains',
                'description' => 'Trouvez le terrain idéal pour votre projet',
                'link' => '/terrains',
                'images' => [
                    'images/services/terrain-1.jpg',
                    'images/services/terrain-2.jpg',
                    'images/services/terrain-3.jpg'
                ],
                'stats' => ['200+ Terrains', '100% Légal', 'Prix Compétitifs'],
                'features' => ['Terrains constructibles', 'Titres fonciers', 'Assistance administrative']
            ],
            [
                'icon' => 'fa-ruler',
                'title' => 'Topographie',
                'description' => 'Services de topographie professionnels',
                'link' => '/topographie',
                'images' => [
                    'images/services/topo-1.jpg',
                    'images/services/topo-2.jpg',
                    'images/services/topo-3.jpg'
                ],
                'stats' => ['500+ Projets', 'Haute Précision', 'Équipe Experte'],
                'features' => ['Bornage', 'Levés topographiques', 'Plans cadastraux']
            ],
            [
                'icon' => 'fa-building',
                'title' => 'BTP',
                'description' => 'Construction et rénovation',
                'link' => '/btp',
                'images' => [
                    'images/services/contruction1.jpg',
                    'images/services/contruction2.jpg',
                    'images/services/contruction3.jpg'
                ],
                'stats' => ['300+ Chantiers', '15 ans d\'expérience', 'Garantie 10 ans'],
                'features' => ['Construction', 'Rénovation', 'Gros œuvre']
            ],
            [
                'icon' => 'fa-paint-brush',
                'title' => 'Décoration',
                'description' => 'Design d\'intérieur personnalisé',
                'link' => '/decoration',
                'images' => [
                    'images/services/decoration-1.jpg',
                    'images/services/decoration-2.jpg',
                    'images/services/decoration-3.jpg'
                ],
                'stats' => ['1000+ Designs', 'Style Unique', 'Satisfaction 100%'],
                'features' => ['Design intérieur', 'Aménagement', 'Conseil déco']
            ]
        ];

        return view('home', compact('slides', 'services'));
    }
} 