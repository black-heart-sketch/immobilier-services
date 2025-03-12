@extends('layouts.app')

@section('content')
<div class="bg-gray-50">
    <!-- Equipment Details -->
    <div class="py-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <!-- Image Gallery -->
                <div class="space-y-4">
                    <div class="bg-white p-2 rounded-xl shadow-lg">
                        <img src="{{ asset($equipment->image) }}" 
                             alt="{{ $equipment->name }}"
                             class="w-full h-96 object-cover rounded-lg">
                    </div>
                    <div class="grid grid-cols-4 gap-4">
                        @foreach(range(1, 4) as $index)
                        <button class="bg-white p-1 rounded-lg shadow hover:ring-2 hover:ring-primary-600 transition-all">
                            <img src="{{ asset($equipment->image) }}" 
                                 alt="Vue {{ $index }}"
                                 class="w-full h-20 object-cover rounded">
                        </button>
                        @endforeach
                    </div>
                </div>

                <!-- Equipment Info -->
                <div>
                    <div class="flex items-center justify-between mb-6">
                        <h1 class="text-3xl font-bold text-gray-900">{{ $equipment->name }}</h1>
                        <span class="px-4 py-2 rounded-full text-sm font-medium
                            {{ $equipment->status === 'available' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $equipment->status === 'available' ? 'Disponible' : 'En location' }}
                        </span>
                    </div>

                    <div class="prose prose-lg max-w-none mb-8">
                        <p>{{ $equipment->description }}</p>
                    </div>

                    <!-- Specifications -->
                    <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
                        <h2 class="text-xl font-bold text-gray-900 mb-4">Caractéristiques Techniques</h2>
                        <div class="grid grid-cols-2 gap-4">
                            @foreach($equipment->specifications as $spec => $value)
                            <div class="flex items-start">
                                <i class="fas fa-check-circle text-primary-600 mt-1 mr-2"></i>
                                <div>
                                    <span class="block text-sm font-medium text-gray-900">{{ $spec }}</span>
                                    <span class="text-gray-600">{{ $value }}</span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Pricing -->
                    <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
                        <h2 class="text-xl font-bold text-gray-900 mb-4">Tarifs de Location</h2>
                        <div class="grid grid-cols-3 gap-4">
                            <div class="text-center p-4 rounded-lg bg-gray-50">
                                <span class="block text-sm text-gray-600">Journalier</span>
                                <span class="block text-2xl font-bold text-primary-600 mt-1">
                                    {{ number_format($equipment->daily_rate, 0, ',', ' ') }} FCFA
                                </span>
                            </div>
                            <div class="text-center p-4 rounded-lg bg-gray-50">
                                <span class="block text-sm text-gray-600">Hebdomadaire</span>
                                <span class="block text-2xl font-bold text-primary-600 mt-1">
                                    {{ number_format($equipment->weekly_rate, 0, ',', ' ') }} FCFA
                                </span>
                            </div>
                            <div class="text-center p-4 rounded-lg bg-gray-50">
                                <span class="block text-sm text-gray-600">Mensuel</span>
                                <span class="block text-2xl font-bold text-primary-600 mt-1">
                                    {{ number_format($equipment->monthly_rate, 0, ',', ' ') }} FCFA
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex gap-4">
                        @if($equipment->status === 'available')
                        <button onclick="openRentalModal({{ $equipment->id }})"
                                class="flex-1 bg-primary-600 text-white px-8 py-4 rounded-lg hover:bg-primary-700 transition-colors">
                            Louer cet équipement
                        </button>
                        @endif
                        <button onclick="openMaintenanceModal({{ $equipment->id }})"
                                class="flex-1 bg-white text-primary-600 border-2 border-primary-600 px-8 py-4 rounded-lg hover:bg-primary-50 transition-colors">
                            Demander une maintenance
                        </button>
                    </div>
                </div>
            </div>

            <!-- Location Tracking -->
            @if($equipment->current_location)
            <div class="mt-12">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Localisation Actuelle</h2>
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div id="map" class="h-96"></div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Rental Modal Component -->
<x-equipment.rental-modal />

<!-- Maintenance Modal Component -->
<x-equipment.maintenance-modal />

@push('scripts')
<script>
// Map initialization code here (if using Google Maps or Leaflet)
</script>
@endpush
@endsection 