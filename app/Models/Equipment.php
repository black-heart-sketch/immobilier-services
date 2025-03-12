<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Equipment extends Model
{
    protected $fillable = [
        'name',
        'type',
        'description',
        'specifications',
        'daily_rate',
        'weekly_rate',
        'monthly_rate',
        'image',
        'status',
        'maintenance_history',
        'current_location',
        'tracking_device_id'
    ];

    protected $casts = [
        'specifications' => 'array',
        'maintenance_history' => 'array',
        'current_location' => 'array',
        'daily_rate' => 'decimal:2',
        'weekly_rate' => 'decimal:2',
        'monthly_rate' => 'decimal:2'
    ];

    public function rentals(): HasMany
    {
        return $this->hasMany(EquipmentRental::class);
    }

    public function maintenanceRequests(): HasMany
    {
        return $this->hasMany(MaintenanceRequest::class);
    }
} 