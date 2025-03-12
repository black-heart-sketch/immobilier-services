<?php

namespace App\Http\Controllers;

use App\Models\TopographyProject;
use App\Models\TopographyQuote;
use Illuminate\Http\Request;

class TopographyController extends Controller
{
    public function index()
    {
        $projects = TopographyProject::latest()->take(6)->get();
        
        $services = [
            [
                'title' => 'Bornage de terrain',
                'icon' => 'fa-map-marker-alt',
                'description' => 'Délimitation précise des limites de propriété avec pose de bornes officielles.'
            ],
            [
                'title' => 'Nivellement',
                'icon' => 'fa-mountain',
                'description' => 'Mesure et analyse des différences de niveau pour optimiser votre projet.'
            ],
            [
                'title' => 'Levé topographique',
                'icon' => 'fa-layer-group',
                'description' => 'Cartographie détaillée du terrain incluant relief et éléments existants.'
            ],
            [
                'title' => 'Implantation',
                'icon' => 'fa-drafting-compass',
                'description' => 'Matérialisation précise de votre projet sur le terrain.'
            ]
        ];

        return view('topography.index', compact('projects', 'services'));
    }

    public function requestQuote(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string',
            'service_type' => 'required|string',
            'project_details' => 'required|string',
        ]);

        TopographyQuote::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Votre demande a été envoyée avec succès.'
        ]);
    }
} 