<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;

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
} 