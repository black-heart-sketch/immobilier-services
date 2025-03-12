<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TopographyProject extends Model
{
    protected $fillable = [
        'title',
        'type',
        'description',
        'images',
        'location',
        'completion_date'
    ];

    protected $casts = [
        'images' => 'array',
        'completion_date' => 'date'
    ];
} 