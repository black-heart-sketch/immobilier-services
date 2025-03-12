<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function index(Request $request)
    {
        $query = Property::query();
        
        // Always filter by type if it's set in the route
        $type = $request->route('type') ?? $request->get('type');
        if ($type) {
            $query->where('type', $type);
        }

        // Get min/max values for the current type
        $priceRange = [
            'min' => Property::min('price') ?? 0,
            'max' => Property::max('price') ?? 1000000
        ];
        
        $surfaceRange = [
            'min' => Property::min('surface_area') ?? 0,
            'max' => Property::max('surface_area') ?? 1000
        ];

        // Apply other filters
        if ($request->filled('price_min')) {
            $query->where('price', '>=', $request->price_min);
        }

        if ($request->filled('price_max')) {
            $query->where('price', '<=', $request->price_max);
        }

        if ($request->filled('surface_min')) {
            $query->where('surface_area', '>=', $request->surface_min);
        }

        if ($request->filled('location')) {
            $query->where('location', 'like', '%' . $request->location . '%');
        }

        $properties = $query->latest()->paginate(12);

        $initialFilters = null;
        if ($type) {
            $initialFilters = [
                'type' => $type,
                'price_range' => [$priceRange['min'], $priceRange['max']],
                'surface_range' => [$surfaceRange['min'], $surfaceRange['max']]
            ];
        }

        return view('properties.index', compact('properties', 'priceRange', 'surfaceRange', 'initialFilters', 'type'));
    }

    public function show(Property $property)
    {
        // Get similar properties (same type, similar price range)
        $similarProperties = Property::where('id', '!=', $property->id)
            ->where('type', $property->type)
            ->whereBetween('price', [$property->price * 0.7, $property->price * 1.3])
            ->take(4)
            ->get();

        return view('properties.show', compact('property', 'similarProperties'));
    }

    public function map()
    {
        $properties = Property::all();
        return view('properties.map', compact('properties'));
    }

    public function filter(Request $request)
    {
        $query = Property::query();
        
        // Keep type filter from the route
        if ($request->route('type')) {
            $query->where('type', $request->route('type'));
        }
        
        // Apply filters
        foreach ($request->all() as $filter => $value) {
            if (!empty($value)) {
                $query->when($filter === 'location', function ($q) use ($value) {
                    return $q->where('location', 'like', "%{$value}%");
                })->when($filter === 'price_range', function ($q) use ($value) {
                    list($min, $max) = explode(',', $value);
                    return $q->whereBetween('price', [$min, $max]);
                })->when($filter === 'surface_range', function ($q) use ($value) {
                    list($min, $max) = explode(',', $value);
                    return $q->whereBetween('surface_area', [$min, $max]);
                });
            }
        }

        $properties = $query->latest()->get();
        \Log::info('Filtered properties count: ' . $properties->count());

        return response()->json($properties);
    }
} 