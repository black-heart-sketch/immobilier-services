<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DecorationService extends Model
{
    protected $fillable = [
        'title',
        'description',
        'icon',
        'image',
        'features',
        'price_range'
    ];

    protected $casts = [
        'features' => 'array'
    ];
} 