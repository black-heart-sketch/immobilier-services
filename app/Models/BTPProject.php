<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BTPProject extends Model
{
    protected $table = 'btp_projects';

    protected $fillable = [
        'title',
        'type',
        'description',
        'before_image',
        'after_image',
        'location',
        'completion_date',
        'surface_area',
        'cost'
    ];

    protected $casts = [
        'completion_date' => 'date',
        'surface_area' => 'decimal:2',
        'cost' => 'decimal:2'
    ];

    public function testimonials(): HasMany
    {
        return $this->hasMany(BTPTestimonial::class, 'btp_project_id', 'id');
    }
} 