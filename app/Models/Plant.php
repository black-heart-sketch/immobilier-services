<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plant extends Model
{
    protected $fillable = [
        'name',
        'scientific_name',
        'category',
        'description',
        'care_instructions',
        'specifications',
        'benefits',
        'price',
        'stock',
        'image',
        'gallery',
        'available_wholesale',
        'wholesale_min_quantity',
        'wholesale_price'
    ];

    protected $casts = [
        'specifications' => 'array',
        'benefits' => 'array',
        'gallery' => 'array',
        'available_wholesale' => 'boolean',
    ];

    public function orders()
    {
        return $this->belongsToMany(PlantOrder::class, 'plant_order_items')
                    ->withPivot('quantity', 'unit_price')
                    ->withTimestamps();
    }
} 