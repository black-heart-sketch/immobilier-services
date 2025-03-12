@extends('layouts.app')

@section('content')
<x-page-banner 
    title="Propriétés"
    description="Découvrez notre sélection de propriétés exceptionnelles. Des terrains aux maisons, trouvez le bien qui vous correspond."
    image="images/properties/hero-bg.jpg"
/>

<div class="bg-gray-50 min-h-screen py-12">
    <div class="container mx-auto px-4">
        <!-- Page Title -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-3">
                {{ $type === 'terrain' ? 'Terrains disponibles' : 
                   ($type === 'maison' ? 'Maisons à vendre' : 
                   'Tous nos biens immobiliers') }}
            </h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                {{ $type === 'terrain' ? 'Découvrez nos terrains constructibles dans les meilleurs quartiers d\'Abidjan' : 
                   ($type === 'maison' ? 'Explorez notre sélection de maisons modernes et confortables' : 
                   'Parcourez l\'ensemble de nos biens immobiliers de prestige') }}
            </p>
        </div>

        <!-- View Toggle -->
        <div class="flex justify-end mb-6">
            <div class="bg-white rounded-lg shadow-sm p-1 inline-flex">
                <button class="px-4 py-2 rounded-lg bg-primary-600 text-white">
                    <i class="fas fa-th-large mr-2"></i>Grille
                </button>
                <button class="px-4 py-2 rounded-lg text-gray-600 hover:bg-gray-100">
                    <i class="fas fa-map-marked-alt mr-2"></i>Carte
                </button>
            </div>
        </div>

        <!-- Properties Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($properties as $property)
                <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow duration-300 overflow-hidden group">
                    <!-- Property Image -->
                    <div class="relative h-48 overflow-hidden">
                        <img src="{{ asset($property->images[0]) }}" 
                             alt="{{ $property->title }}"
                             class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                        <div class="absolute top-3 right-3">
                            <span class="px-3 py-1 bg-primary-600 text-white text-sm font-medium rounded-full shadow-lg">
                                {{ $property->type === 'terrain' ? 'Terrain' : 'Maison' }}
                            </span>
                        </div>
                        <div class="absolute bottom-3 left-3 right-3">
                            <span class="text-white text-lg font-semibold line-clamp-1">{{ $property->title }}</span>
                            <span class="text-white/90 text-sm flex items-center">
                                <i class="fas fa-map-marker-alt mr-1"></i>
                                {{ $property->location }}
                            </span>
                        </div>
                    </div>

                    <!-- Property Details -->
                    <div class="p-4">
                        <div class="flex justify-between items-center mb-3">
                            <span class="text-xl font-bold text-primary-600">
                                {{ number_format($property->price, 0, ',', ' ') }} FCFA
                            </span>
                            <span class="text-gray-600 flex items-center">
                                <i class="fas fa-ruler-combined mr-1"></i>
                                {{ $property->surface_area }} m²
                            </span>
                        </div>

                        <!-- Features -->
                        <div class="mb-4 space-y-2">
                            <div class="flex flex-wrap gap-2">
                                @foreach(array_slice($property->features, 0, 3) as $feature)
                                    <span class="inline-flex items-center bg-gray-100 rounded-full px-2.5 py-0.5 text-xs font-medium text-gray-700">
                                        {{ $feature }}
                                    </span>
                                @endforeach
                                @if(count($property->features) > 3)
                                    <span class="inline-flex items-center bg-gray-100 rounded-full px-2.5 py-0.5 text-xs font-medium text-gray-700">
                                        +{{ count($property->features) - 3 }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex gap-2">
                            <a href="{{ route('properties.show', $property) }}" 
                               class="flex-1 text-center bg-primary-600 text-white py-2 rounded-lg hover:bg-primary-700 transition-colors duration-300 text-sm font-medium">
                                Voir les détails
                            </a>
                            <button class="px-3 py-2 bg-gray-100 text-gray-600 rounded-lg hover:bg-gray-200 transition-colors duration-300">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Empty State -->
        @if($properties->isEmpty())
            <div class="text-center py-12">
                <div class="text-gray-400 mb-4">
                    <i class="fas fa-home text-6xl"></i>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Aucun bien disponible</h3>
                <p class="text-gray-600">Aucun bien ne correspond à vos critères de recherche.</p>
            </div>
        @endif
    </div>
</div>
@endsection 