<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class AdminController extends Controller
{
    // Remove or comment out the constructor if it has middleware
    /*
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }
    */

    public function index()
    {
        // Get counts for different property types
        $terrainCount = Property::where('type', 'terrain')->count();
        $maisonCount = Property::where('type', 'maison')->count();
        
        // Create test data for recent activities (this would come from a real Activity model in production)
        $recentActivities = collect([
            [
                'id' => 1,
                'user' => 'Admin',
                'action' => 'a ajouté un nouveau terrain',
                'subject' => 'Terrain à Cocody',
                'created_at' => now()->subHours(2),
            ],
            [
                'id' => 2,
                'user' => 'Admin',
                'action' => 'a mis à jour',
                'subject' => 'Villa à Riviera',
                'created_at' => now()->subHours(5),
            ],
            [
                'id' => 3,
                'user' => 'Admin',
                'action' => 'a supprimé',
                'subject' => 'Projet de topographie',
                'created_at' => now()->subDays(1),
            ],
        ]);
        
        // Get latest properties
        $latestProperties = Property::latest()->take(5)->get();
        
        // Create test data for pending requests (this would come from real models in production)
        $pendingRequests = collect([
            [
                'id' => 1,
                'type' => 'Devis Topographie',
                'client_name' => 'Client Test',
                'created_at' => now()->subDays(1),
                'status' => 'pending',
            ],
            [
                'id' => 2,
                'type' => 'Demande de visite',
                'client_name' => 'Entreprise ABC',
                'created_at' => now()->subDays(2),
                'status' => 'pending',
            ],
        ]);
        
        // Create test data for sales/revenue statistics
        $salesStats = [
            'current_month' => 12500000,
            'previous_month' => 9800000,
            'year_to_date' => 78500000,
            'growth_percentage' => 27.55,
        ];
        
        return view('admin.dashboard', compact(
            'terrainCount',
            'maisonCount',
            'recentActivities',
            'latestProperties',
            'pendingRequests',
            'salesStats'
        ));
    }

    public function terrains()
    {
        return view('admin.terrains', [
            'properties' => [] // Add dummy data or actual data
        ]);
    }

    public function maisons()
    {
        $properties = Property::where('type', 'maison')
            ->latest()
            ->paginate(10); // Add pagination with 10 items per page

        return view('admin.maisons', compact('properties'));
    }

    public function topographie()
    {
        // Create test data
        $projectsData = collect([
            [
                'id' => 1,
                'title' => 'Projet Test 1',
                'image' => 'images/default-project.png',
                'location' => 'Abidjan',
                'type' => 'Levé topographique',
                'client_name' => 'Client Test',
                'completion_date' => now(),
                'status' => 'in_progress'
            ],
            // Add more test items here if needed
        ]);

        // Manually paginate the projects
        $page = request()->get('page', 1); // Get the current page from the url
        $perPage = 10; // Number of items per page
        
        $projects = new LengthAwarePaginator(
            $projectsData->forPage($page, $perPage),
            $projectsData->count(),
            $perPage,
            $page,
            ['path' => request()->url()]
        );

        // Do the same for quote requests
        $quoteRequestsData = collect([
            [
                'id' => 1,
                'name' => 'Test Client',
                'email' => 'test@example.com',
                'service_type' => 'Levé topographique',
                'status' => 'pending'
            ],
            // Add more test items here if needed
        ]);

        $quoteRequests = new LengthAwarePaginator(
            $quoteRequestsData->forPage($page, $perPage),
            $quoteRequestsData->count(),
            $perPage,
            $page,
            ['path' => request()->url()]
        );

        return view('admin.topographie', compact('projects', 'quoteRequests'));
    }

    public function btp()
    {
        // Create test data for BTP projects
        $projectsData = collect([
            [
                'id' => 1,
                'title' => 'Projet Construction Test',
                'image' => 'images/default-project.png',
                'location' => 'Abidjan',
                'type' => 'Résidentiel',
                'status' => 'in_progress',
                'completion_date' => now(),
            ],
            // Add more test items here if needed
        ]);

        // Manually paginate the projects
        $page = request()->get('page', 1); // Get the current page from the url
        $perPage = 10; // Number of items per page
        
        $projects = new LengthAwarePaginator(
            $projectsData->forPage($page, $perPage),
            $projectsData->count(),
            $perPage,
            $page,
            ['path' => request()->url()]
        );

        // Stats data
        $stats = [
            'ongoing' => 1,
            'completed' => 0,
            'planned' => 0,
            'total_budget' => '50,000,000 FCFA'
        ];

        return view('admin.btp', compact('projects', 'stats'));
    }

    public function decoration()
    {
        // Create test data for decoration projects
        $projectsData = collect([
            [
                'id' => 1,
                'title' => 'Décoration Villa Moderne',
                'main_image' => 'images/default-project.png',
                'client_name' => 'Client Test',
                'status' => 'completed',
                'completion_date' => now(),
            ],
            // Add more test items here if needed
        ]);

        // Manually paginate the projects
        $page = request()->get('page', 1); // Get the current page from the url
        $perPage = 10; // Number of items per page
        
        $projects = new LengthAwarePaginator(
            $projectsData->forPage($page, $perPage),
            $projectsData->count(),
            $perPage,
            $page,
            ['path' => request()->url()]
        );

        // Create test data for decoration services
        $servicesData = collect([
            [
                'id' => 1,
                'title' => 'Consultation Design',
                'icon' => 'fa-paint-brush',
                'price_range' => '50,000 - 150,000 FCFA',
            ],
            [
                'id' => 2,
                'title' => 'Décoration Complète',
                'icon' => 'fa-home',
                'price_range' => '500,000 - 2,000,000 FCFA',
            ],
            // Add more test items here if needed
        ]);

        $services = new LengthAwarePaginator(
            $servicesData->forPage($page, $perPage),
            $servicesData->count(),
            $perPage,
            $page,
            ['path' => request()->url()]
        );

        return view('admin.decoration', compact('projects', 'services'));
    }

    public function locationEngins()
    {
        // Create test data for equipment
        $equipmentData = collect([
            [
                'id' => 1,
                'name' => 'Excavatrice CAT',
                'model' => 'CAT 320',
                'image' => 'images/default-equipment.png',
                'type' => 'Excavatrice',
                'daily_rate' => 250000,
                'status' => 'available',
                'location' => 'Abidjan'
            ],
            // Add more test items here if needed
        ]);

        // Manually paginate the equipment
        $page = request()->get('page', 1); // Get the current page from the url
        $perPage = 10; // Number of items per page
        
        $equipment = new LengthAwarePaginator(
            $equipmentData->forPage($page, $perPage),
            $equipmentData->count(),
            $perPage,
            $page,
            ['path' => request()->url()]
        );

        // Create test data for active rentals
        $activeRentalsData = collect([
            [
                'id' => 1,
                'equipment' => [
                    'id' => 1,
                    'name' => 'Excavatrice CAT',
                    'image' => 'images/default-equipment.png'
                ],
                'client_name' => 'Client Test',
                'start_date' => now(),
                'end_date' => now()->addDays(5)
            ],
            // Add more test items here if needed
        ]);

        $activeRentals = new LengthAwarePaginator(
            $activeRentalsData->forPage($page, $perPage),
            $activeRentalsData->count(),
            $perPage,
            $page,
            ['path' => request()->url()]
        );

        return view('admin.location-engins', compact('equipment', 'activeRentals'));
    }

    public function pepinieres()
    {
        // Create test data for plants
        $plantsData = collect([
            [
                'id' => 1,
                'name' => 'Palmier Royal',
                'scientific_name' => 'Roystonea regia',
                'image' => 'images/default-plant.png',
                'price' => 15000,
                'stock' => 25,
                'category' => 'trees'
            ],
            [
                'id' => 2,
                'name' => 'Bougainvillier',
                'scientific_name' => 'Bougainvillea spectabilis',
                'image' => 'images/default-plant.png',
                'price' => 5000,
                'stock' => 8,
                'category' => 'shrubs'
            ],
            // Add more test items here if needed
        ]);

        // Manually paginate the plants
        $page = request()->get('page', 1); // Get the current page from the url
        $perPage = 10; // Number of items per page
        
        $plants = new LengthAwarePaginator(
            $plantsData->forPage($page, $perPage),
            $plantsData->count(),
            $perPage,
            $page,
            ['path' => request()->url()]
        );

        // Create test data for orders
        $ordersData = collect([
            [
                'id' => 1001,
                'customer_name' => 'Client Test',
                'created_at' => now()->subDays(2),
                'total' => 45000,
                'status' => 'processing'
            ],
            [
                'id' => 1002,
                'customer_name' => 'Entreprise ABC',
                'created_at' => now()->subDays(5),
                'total' => 120000,
                'status' => 'completed'
            ],
            // Add more test items here if needed
        ]);

        $orders = new LengthAwarePaginator(
            $ordersData->forPage($page, $perPage),
            $ordersData->count(),
            $perPage,
            $page,
            ['path' => request()->url()]
        );

        return view('admin.pepinieres', compact('plants', 'orders'));
    }

    public function account()
    {
        return view('admin.account');
    }
} 