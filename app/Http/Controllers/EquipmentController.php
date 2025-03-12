<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\EquipmentRental;
use App\Models\MaintenanceRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class EquipmentController extends Controller
{
    public function index(Request $request)
    {
        $query = Equipment::query();

        // Filter by type
        if ($request->type) {
            $query->where('type', $request->type);
        }

        // Filter by status
        if ($request->status) {
            $query->where('status', $request->status);
        }

        // Filter for authenticated user's rentals
        if ($request->filter === 'rented' && auth()->check()) {
            $query->whereHas('rentals', function ($q) {
                $q->where('client_email', auth()->user()->email)
                  ->whereIn('status', ['active', 'pending']);
            });
        }

        // Filter for maintenance requests
        if ($request->filter === 'maintenance' && auth()->check()) {
            $query->whereHas('maintenanceRequests', function ($q) {
                $q->where('reported_by', auth()->user()->email)
                  ->whereIn('status', ['pending', 'in_progress']);
            });
        }

        // Price range filter
        if ($request->min_price) {
            $query->where('daily_rate', '>=', $request->min_price);
        }
        if ($request->max_price) {
            $query->where('daily_rate', '<=', $request->max_price);
        }

        $equipment = $query->paginate(12);

        return view('equipment.index', compact('equipment'));
    }

    public function show(Equipment $equipment)
    {
        $equipment->load(['rentals' => function ($query) {
            $query->where('end_date', '>=', now())
                  ->where('status', 'confirmed')
                  ->orderBy('start_date');
        }]);

        $maintenanceHistory = collect($equipment->maintenance_history ?? [])
            ->sortByDesc('date')
            ->take(5);

        return view('equipment.show', compact('equipment', 'maintenanceHistory'));
    }

    public function rent(Request $request, Equipment $equipment)
    {
        $validated = $request->validate([
            'client_name' => 'required|string|max:255',
            'client_email' => 'required|email',
            'client_phone' => 'required|string',
            'company_name' => 'nullable|string|max:255',
            'start_date' => 'required|date|after:today',
            'end_date' => 'required|date|after:start_date',
            'rental_type' => 'required|in:daily,weekly,monthly'
        ]);

        // Check if equipment is available for the requested period
        $isAvailable = $equipment->rentals()
            ->where('status', 'confirmed')
            ->where(function ($query) use ($validated) {
                $query->whereBetween('start_date', [$validated['start_date'], $validated['end_date']])
                    ->orWhereBetween('end_date', [$validated['start_date'], $validated['end_date']]);
            })->doesntExist();

        if (!$isAvailable) {
            return response()->json([
                'success' => false,
                'message' => 'L\'équipement n\'est pas disponible pour cette période.'
            ], 422);
        }

        // Calculate rental duration and total amount
        $start = Carbon::parse($validated['start_date']);
        $end = Carbon::parse($validated['end_date']);
        
        $total = match($validated['rental_type']) {
            'daily' => $equipment->daily_rate * $start->diffInDays($end),
            'weekly' => $equipment->weekly_rate * ceil($start->diffInDays($end) / 7),
            'monthly' => $equipment->monthly_rate * ceil($start->diffInDays($end) / 30),
        };

        // Create rental record
        $rental = $equipment->rentals()->create([
            ...$validated,
            'total_amount' => $total,
            'deposit_amount' => $total * 0.3, // 30% deposit
            'status' => 'pending',
            'payment_status' => 'pending'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Votre demande de location a été enregistrée.',
            'rental_id' => $rental->id
        ]);
    }

    public function requestMaintenance(Request $request, Equipment $equipment)
    {
        $validated = $request->validate([
            'type' => 'required|in:routine,repair,emergency',
            'description' => 'required|string',
            'priority' => 'required|in:low,medium,high,critical',
            'scheduled_date' => 'required|date|after:today',
            'reported_by' => 'required|string',
            'contact_phone' => 'required|string'
        ]);

        $maintenance = $equipment->maintenanceRequests()->create([
            ...$validated,
            'status' => 'pending'
        ]);

        // Update equipment maintenance history
        $history = $equipment->maintenance_history ?? [];
        $history[] = [
            'date' => now()->toDateTimeString(),
            'type' => $validated['type'],
            'description' => $validated['description'],
            'request_id' => $maintenance->id
        ];
        
        $equipment->update(['maintenance_history' => $history]);

        return response()->json([
            'success' => true,
            'message' => 'Votre demande de maintenance a été enregistrée.'
        ]);
    }

    public function downloadContract(EquipmentRental $rental)
    {
        // In a real application, generate PDF contract here
        return response()->json([
            'contract_url' => $rental->contract_file
        ]);
    }

    public function signContract(Request $request, EquipmentRental $rental)
    {
        $validated = $request->validate([
            'signature' => 'required|string',
            'signed_by' => 'required|string'
        ]);

        $rental->update([
            'contract_signed' => true,
            'status' => 'confirmed'
        ]);

        // Update equipment status
        $rental->equipment->update(['status' => 'rented']);

        return response()->json([
            'success' => true,
            'message' => 'Le contrat a été signé avec succès.'
        ]);
    }

    public function checkAvailability(Request $request, Equipment $equipment)
    {
        $request->validate([
            'start_date' => 'required|date|after:today',
            'end_date' => 'required|date|after:start_date'
        ]);

        $isAvailable = $equipment->rentals()
            ->where('status', 'confirmed')
            ->where(function ($query) use ($request) {
                $query->whereBetween('start_date', [$request->start_date, $request->end_date])
                    ->orWhereBetween('end_date', [$request->start_date, $request->end_date]);
            })->doesntExist();

        return response()->json([
            'available' => $isAvailable,
            'dates' => $isAvailable ? [] : $equipment->rentals()
                ->where('status', 'confirmed')
                ->where('end_date', '>=', now())
                ->get(['start_date', 'end_date'])
        ]);
    }
} 