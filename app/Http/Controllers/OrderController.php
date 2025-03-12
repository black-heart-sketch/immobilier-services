<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            
            // Get cart items
            $cartItems = Cart::with('plant')
                ->where('session_id', session('cart_id'))
                ->get();

            if ($cartItems->isEmpty()) {
                return back()->with('error', 'Votre panier est vide');
            }

            // Calculate total
            $total = $cartItems->sum(function ($item) {
                return $item->quantity * $item->price;
            });

            // Create order
            $order = Order::create([
                'user_id' => auth()->id(),
                'total_amount' => $total,
                'status' => 'pending',
                'shipping_name' => auth()->user()->name,
                'shipping_email' => auth()->user()->email,
                'shipping_phone' => $request->phone ?? '',
                'shipping_address' => $request->address ?? '',
                'shipping_city' => $request->city ?? '',
                'notes' => $request->notes
            ]);

            // Create order items
            foreach ($cartItems as $item) {
                $order->items()->create([
                    'plant_id' => $item->plant_id,
                    'quantity' => $item->quantity,
                    'unit_price' => $item->price
                ]);

                // Update stock
                $item->plant->decrement('stock', $item->quantity);
            }

            // Clear cart
            Cart::where('session_id', session('cart_id'))->delete();
            session()->forget('cart_count');

            DB::commit();

            return redirect()
                ->route('orders.show', $order)
                ->with('success', 'Votre commande a été enregistrée avec succès');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Une erreur est survenue lors de la création de votre commande');
        }
    }

    public function show(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        return view('orders.show', compact('order'));
    }
} 