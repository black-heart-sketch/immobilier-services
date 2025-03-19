@extends('layouts.app')

@section('content')
<div class="bg-gray-50">
    <!-- Hero Section -->
    <div class="relative py-16 bg-gray-900 h-[90vh]">
        <div class="absolute inset-0">
            <img src="{{ asset('images/engines/hero.jpeg') }}" 
                 alt="Location d'Engins" 
                 class="w-full h-full object-cover opacity-70">
            <div class="absolute inset-0 bg-gradient-to-r from-gray-900/60 to-gray-900/30"></div>
        </div>
        <div class="relative container mx-auto px-4 h-full flex items-center">
            <div class="max-w-3xl">
                <h1 class="text-4xl font-bold text-white mb-6 drop-shadow-lg">
                    Location d'Engins
                </h1>
                <p class="text-xl text-white mb-8 drop-shadow-md">
                    Une large gamme d'équipements professionnels pour vos chantiers
                </p>
                <div class="flex flex-wrap gap-4">
                    <a href="#equipment-list" 
                       class="bg-primary-600/90 text-white px-8 py-4 rounded-lg hover:bg-primary-700 transition-colors">
                        Voir nos équipements
                    </a>
                    <a href="#contact" 
                       class="bg-white/90 text-gray-900 px-8 py-4 rounded-lg hover:bg-white transition-colors">
                        Nous contacter
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Equipment List -->
    <div id="equipment-list" class="py-24">
        <div class="container mx-auto px-4">
            <!-- Filters -->
            <div class="mb-12">
                <div class="flex flex-wrap gap-4 items-center justify-between">
                    <div class="flex gap-4">
                        <select x-model="selectedType" 
                                class="rounded-lg border-gray-300 focus:border-primary-600 focus:ring-primary-600">
                            <option value="">Tous les types</option>
                            <option value="excavator">Excavateurs</option>
                            <option value="loader">Chargeurs</option>
                            <option value="crane">Grues</option>
                            <option value="truck">Camions</option>
                        </select>
                        <select x-model="availability" 
                                class="rounded-lg border-gray-300 focus:border-primary-600 focus:ring-primary-600">
                            <option value="">Toutes disponibilités</option>
                            <option value="available">Disponible</option>
                            <option value="rented">En location</option>
                        </select>
                    </div>
                    <div class="relative">
                        <input type="text" 
                               placeholder="Rechercher un équipement..." 
                               class="pl-10 pr-4 py-2 rounded-lg border-gray-300 focus:border-primary-600 focus:ring-primary-600">
                        <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    </div>
                </div>
            </div>

            <!-- Equipment Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($equipment as $item)
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="relative">
                        <img src="{{ asset($item->image) }}" 
                             alt="{{ $item->name }}" 
                             class="w-full h-48 object-cover">
                        <div class="absolute top-4 right-4">
                            <span class="px-3 py-1 rounded-full text-sm font-medium
                                {{ $item->status === 'available' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $item->status === 'available' ? 'Disponible' : 'En location' }}
                            </span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $item->name }}</h3>
                        <p class="text-gray-600 mb-4">{{ $item->description }}</p>
                        
                        <!-- Specifications -->
                        <div class="space-y-2 mb-6">
                            @foreach($item->specifications as $spec => $value)
                            <div class="flex items-center text-sm text-gray-600">
                                <i class="fas fa-check text-primary-600 mr-2"></i>
                                <span>{{ $spec }}: {{ $value }}</span>
                            </div>
                            @endforeach
                        </div>

                        <!-- Pricing -->
                        <div class="border-t border-gray-200 pt-4">
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-sm text-gray-600">Journalier</span>
                                <span class="font-medium">{{ number_format($item->daily_rate, 0, ',', ' ') }} FCFA</span>
                            </div>
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-sm text-gray-600">Hebdomadaire</span>
                                <span class="font-medium">{{ number_format($item->weekly_rate, 0, ',', ' ') }} FCFA</span>
                            </div>
                            <div class="flex justify-between items-center mb-4">
                                <span class="text-sm text-gray-600">Mensuel</span>
                                <span class="font-medium">{{ number_format($item->monthly_rate, 0, ',', ' ') }} FCFA</span>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="flex gap-4">
                            <a href="{{ route('equipment.show', $item) }}" 
                               class="flex-1 text-center bg-primary-600 text-white px-4 py-2 rounded-lg hover:bg-primary-700 transition-colors">
                                Détails
                            </a>
                            @if($item->status === 'available')
                            <button onclick="openRentalModal({{ $item->id }})" 
                                    class="flex-1 bg-white text-primary-600 border-2 border-primary-600 px-4 py-2 rounded-lg hover:bg-primary-50 transition-colors">
                                Louer
                            </button>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<!-- Rental Modal -->
<div x-data="rentalModal()" 
     x-show="isOpen" 
     class="fixed inset-0 z-50 overflow-y-auto"
     style="display: none;">
    <!-- Modal content here -->
</div>

@push('scripts')
<script>
function rentalModal() {
    return {
        isOpen: false,
        equipmentId: null,
        formData: {
            client_name: '',
            client_email: '',
            client_phone: '',
            company_name: '',
            start_date: '',
            end_date: '',
            rental_type: 'daily'
        },
        // ... rest of the modal logic
    }
}
</script>
@endpush
@endsection 