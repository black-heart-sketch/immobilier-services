<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BTPTestimonial extends Model
{
    protected $table = 'btp_testimonials';

    protected $fillable = [
        'btp_project_id',
        'client_name',
        'content',
        'rating'
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(BTPProject::class, 'btp_project_id', 'id');
    }
} 