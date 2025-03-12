<?php

namespace App\View\Components;

use App\Models\Cart;
use Illuminate\View\Component;

class CartIcon extends Component
{
    public $count = 0;

    public function __construct()
    {
        if (session()->has('cart_id')) {
            $this->count = Cart::where('session_id', session('cart_id'))->sum('quantity');
        }
    }

    public function render()
    {
        return view('components.cart-icon');
    }
} 