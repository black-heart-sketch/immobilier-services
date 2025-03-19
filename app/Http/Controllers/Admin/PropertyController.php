<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PropertyController extends Controller
{
    public function __construct()
    {
        // Comment out middleware for development
        // $this->middleware(['auth', 'admin']);
    }

    public function index()
    {
        $properties = Property::where('type', 'terrain')
            ->latest()
            ->paginate(10); // Add pagination with 10 items per page

        return view('admin.terrains', compact('properties'));
    }

    /**
     * Store a newly created property in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'required|string|max:255',
            'surface_area' => 'required|numeric|min:0',
            'price' => 'required|numeric|min:0',
            'reference' => 'nullable|string|max:50',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'type' => 'required|string|in:terrain,maison,appartement',
            'status' => 'required|string|in:available,pending,sold',
        ]);

        // Handle image uploads
        $images = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('properties', 'public');
                $images[] = 'storage/' . $path;
            }
        }

        // Create property
        $property = Property::create([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'location' => $validated['location'],
            'surface_area' => $validated['surface_area'],
            'price' => $validated['price'],
            'reference' => $validated['reference'] ?? null,
            'images' => json_encode($images),
            'type' => $validated['type'],
            'status' => $validated['status'],
        ]);

        return redirect()->route('admin.terrains')
            ->with('success', 'Terrain ajouté avec succès.');
    }

    /**
     * Show the form for editing the specified property.
     */
    public function edit(Property $property)
    {
        // Decode images for frontend
        $property->images = json_decode($property->images);
        
        return response()->json($property);
    }

    /**
     * Update the specified property in storage.
     */
    public function update(Request $request, Property $property)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'required|string|max:255',
            'surface_area' => 'required|numeric|min:0',
            'price' => 'required|numeric|min:0',
            'reference' => 'nullable|string|max:50',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|string|in:available,pending,sold',
        ]);

        // Get existing images
        $images = json_decode($property->images) ?: [];

        // Handle image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('properties', 'public');
                $images[] = 'storage/' . $path;
            }
        }

        // Update property
        $property->update([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'location' => $validated['location'],
            'surface_area' => $validated['surface_area'],
            'price' => $validated['price'],
            'reference' => $validated['reference'] ?? null,
            'images' => json_encode($images),
            'status' => $validated['status'],
        ]);

        return redirect()->route('admin.terrains')
            ->with('success', 'Terrain mis à jour avec succès.');
    }

    /**
     * Remove the specified property from storage.
     */
    public function destroy(Property $property)
    {
        // Delete associated images
        if ($property->images) {
            $images = json_decode($property->images);
            foreach ($images as $image) {
                $path = str_replace('storage/', '', $image);
                if (Storage::disk('public')->exists($path)) {
                    Storage::disk('public')->delete($path);
                }
            }
        }

        $property->delete();

        return redirect()->route('admin.terrains')
            ->with('success', 'Terrain supprimé avec succès.');
    }

    /**
     * Show the form for creating a new property.
     */
    public function create()
    {
        return view('admin.properties.create');
    }
} 