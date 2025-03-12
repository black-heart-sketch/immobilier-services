<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TopographyQuote extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'service_type',
        'project_details',
        'status'
    ];
} 