<?php

namespace App\Http\Controllers;

use App\Models\BTPProject;
use App\Models\BTPTestimonial;
use Illuminate\Http\Request;

class BTPController extends Controller
{
    public function index()
    {
        $services = [
            [
                'title' => 'Construction',
                'icon' => 'fa-building',
                'description' => 'Construction de bâtiments résidentiels et commerciaux',
                'features' => [
                    'Maisons individuelles',
                    'Immeubles collectifs',
                    'Locaux commerciaux',
                    'Supervision complète'
                ]
            ],
            [
                'title' => 'Rénovation',
                'icon' => 'fa-hammer',
                'description' => 'Rénovation et réhabilitation de bâtiments existants',
                'features' => [
                    'Rénovation complète',
                    'Extension de bâtiment',
                    'Modernisation',
                    'Mise aux normes'
                ]
            ],
            [
                'title' => 'Aménagement',
                'icon' => 'fa-pencil-ruler',
                'description' => 'Aménagement intérieur et extérieur',
                'features' => [
                    'Design d\'intérieur',
                    'Aménagement paysager',
                    'Terrasses et piscines',
                    'Finitions de luxe'
                ]
            ]
        ];

        $projects = BTPProject::with('testimonials')->latest()->take(6)->get();
        $testimonials = BTPTestimonial::with('project')->latest()->take(4)->get();

        return view('btp.index', compact('services', 'projects', 'testimonials'));
    }

    public function calculateEstimate(Request $request)
    {
        $validated = $request->validate([
            'surface' => 'required|numeric|min:20',
            'type' => 'required|string|in:residential,commercial',
            'quality' => 'required|string|in:standard,premium,luxury',
            'options' => 'array'
        ]);

        // Prix de base par m² selon le type et la qualité
        $basePrices = [
            'residential' => [
                'standard' => 250000,
                'premium' => 350000,
                'luxury' => 500000
            ],
            'commercial' => [
                'standard' => 300000,
                'premium' => 400000,
                'luxury' => 600000
            ]
        ];

        $basePrice = $basePrices[$validated['type']][$validated['quality']];
        $totalPrice = $basePrice * $validated['surface'];

        // Ajout des options
        if (!empty($validated['options'])) {
            foreach ($validated['options'] as $option) {
                switch ($option) {
                    case 'pool':
                        $totalPrice += 15000000;
                        break;
                    case 'solar':
                        $totalPrice += 5000000;
                        break;
                    case 'security':
                        $totalPrice += 3000000;
                        break;
                }
            }
        }

        return response()->json([
            'estimate' => $totalPrice,
            'breakdown' => [
                'base_cost' => $basePrice * $validated['surface'],
                'options_cost' => $totalPrice - ($basePrice * $validated['surface']),
                'total' => $totalPrice
            ]
        ]);
    }

    public function requestQuote(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string',
            'project_type' => 'required|string',
            'surface' => 'required|numeric',
            'budget' => 'required|numeric',
            'description' => 'required|string',
            'timeline' => 'required|string'
        ]);

        BTPQuote::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Votre demande de devis a été envoyée avec succès.'
        ]);
    }
} 