<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Plant;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $sessionId = $request->session()->get('cart_id') ?? Str::random(40);
        $request->session()->put('cart_id', $sessionId);

        $cartItems = Cart::with('plant')
            ->where('session_id', $sessionId)
            ->get();

        $total = $cartItems->sum(function ($item) {
            return $item->quantity * $item->price;
        });

        return view('nursery.cart', compact('cartItems', 'total'));
    }

    public function add(Request $request, Plant $plant)
    {
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1|max:' . $plant->stock
        ]);

        $sessionId = $request->session()->get('cart_id') ?? Str::random(40);
        $request->session()->put('cart_id', $sessionId);

        $cartItem = Cart::where('session_id', $sessionId)
            ->where('plant_id', $plant->id)
            ->first();

        if ($cartItem) {
            $cartItem->update([
                'quantity' => $cartItem->quantity + $validated['quantity']
            ]);
        } else {
            Cart::create([
                'session_id' => $sessionId,
                'user_id' => auth()->id(),
                'plant_id' => $plant->id,
                'quantity' => $validated['quantity'],
                'price' => $plant->price
            ]);
        }

        $this->updateCartCount();

        return response()->json([
            'success' => true,
            'message' => 'Produit ajouté au panier',
            'cart_count' => session('cart_count')
        ]);
    }

    public function update(Request $request, Cart $cart)
    {
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1|max:' . $cart->plant->stock
        ]);

        $cart->update([
            'quantity' => $validated['quantity']
        ]);

        $this->updateCartCount();

        return response()->json([
            'success' => true,
            'message' => 'Quantité mise à jour',
            'cart_count' => session('cart_count'),
            'total' => number_format($cart->quantity * $cart->price, 0, ',', ' ')
        ]);
    }

    public function remove(Cart $cart)
    {
        $cart->delete();
        $this->updateCartCount();

        return response()->json([
            'success' => true,
            'message' => 'Produit retiré du panier',
            'cart_count' => session('cart_count')
        ]);
    }

    private function updateCartCount()
    {
        $count = Cart::where('session_id', session('cart_id'))->sum('quantity');
        session(['cart_count' => $count]);
    }
} 