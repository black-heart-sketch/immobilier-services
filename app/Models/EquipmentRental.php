<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EquipmentRental extends Model
{
    protected $fillable = [
        'equipment_id',
        'client_name',
        'client_email',
        'client_phone',
        'company_name',
        'start_date',
        'end_date',
        'rental_type', // daily, weekly, monthly
        'total_amount',
        'deposit_amount',
        'status', // pending, confirmed, active, completed, cancelled
        'contract_signed',
        'contract_file',
        'payment_status',
        'notes'
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'total_amount' => 'decimal:2',
        'deposit_amount' => 'decimal:2',
        'contract_signed' => 'boolean'
    ];

    public function equipment(): BelongsTo
    {
        return $this->belongsTo(Equipment::class);
    }
} 