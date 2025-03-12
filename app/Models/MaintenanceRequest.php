<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MaintenanceRequest extends Model
{
    protected $fillable = [
        'equipment_id',
        'type', // routine, emergency, repair
        'description',
        'reported_by',
        'status', // pending, in_progress, completed
        'priority', // low, medium, high, critical
        'scheduled_date',
        'completion_date',
        'technician_notes',
        'cost'
    ];

    protected $casts = [
        'scheduled_date' => 'datetime',
        'completion_date' => 'datetime',
        'cost' => 'decimal:2'
    ];

    public function equipment(): BelongsTo
    {
        return $this->belongsTo(Equipment::class);
    }
} 