<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DecorationProject extends Model
{
    protected $fillable = [
        'title',
        'description',
        'type',
        'before_image',
        'after_image',
        'additional_images',
        'client_name',
        'testimonial',
        'completion_date'
    ];

    protected $casts = [
        'additional_images' => 'array',
        'completion_date' => 'date'
    ];
} 