<?php

namespace App\Http\Controllers;

use App\Models\Plant;
use App\Models\PlantOrder;
use Illuminate\Http\Request;
use App\Models\Order;

class NurseryController extends Controller
{
    public function index(Request $request)
    {
        $query = Plant::query();

        // Filter by category
        if ($request->category) {
            $query->where('category', $request->category);
        }

        // Filter by price range
        if ($request->min_price) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->max_price) {
            $query->where('price', '<=', $request->max_price);
        }

        // Search by name
        if ($request->search) {
            $query->where('name', 'like', "%{$request->search}%")
                  ->orWhere('scientific_name', 'like', "%{$request->search}%");
        }

        $plants = $query->paginate(12);
        $categories = Plant::distinct('category')->pluck('category');

        return view('nursery.index', compact('plants', 'categories'));
    }

    public function show(Plant $plant)
    {
        return view('nursery.show', compact('plant'));
    }

    public function guide()
    {
        $plants = Plant::all()->groupBy('category');
        return view('nursery.guide', compact('plants'));
    }

    public function requestQuote(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string',
            'plants' => 'required|array',
            'plants.*.id' => 'required|exists:plants,id',
            'plants.*.quantity' => 'required|integer|min:1',
            'notes' => 'nullable|string'
        ]);

        $order = PlantOrder::create([
            'client_name' => $validated['name'],
            'client_email' => $validated['email'],
            'client_phone' => $validated['phone'],
            'is_wholesale' => true,
            'notes' => $validated['notes'],
            'status' => 'quote_requested'
        ]);

        foreach ($validated['plants'] as $item) {
            $plant = Plant::find($item['id']);
            $order->items()->create([
                'plant_id' => $item['id'],
                'quantity' => $item['quantity'],
                'unit_price' => $plant->wholesale_price ?? $plant->price
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Votre demande de devis a été envoyée avec succès.'
        ]);
    }

    public function orders()
    {
        $orders = auth()->user()->orders()
            ->with('items.plant')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        return view('nursery.orders', compact('orders'));
    }

    public function orderDetails(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }
        
        return view('nursery.order-details', compact('order'));
    }
} 