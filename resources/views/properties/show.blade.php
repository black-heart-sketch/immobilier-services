@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen py-12">
    <div class="container mx-auto px-4">
        <!-- Breadcrumb -->
        <div class="mb-8">
            <div class="flex items-center text-sm text-gray-600">
                <a href="{{ route('properties.index') }}" class="hover:text-primary-600">Biens immobiliers</a>
                <i class="fas fa-chevron-right mx-2 text-xs"></i>
                <a href="{{ route($property->type === 'terrain' ? 'properties.terrains' : 'properties.maisons') }}" 
                   class="hover:text-primary-600">
                    {{ $property->type === 'terrain' ? 'Terrains' : 'Maisons' }}
                </a>
                <i class="fas fa-chevron-right mx-2 text-xs"></i>
                <span class="text-gray-900">{{ $property->title }}</span>
            </div>
        </div>

        <!-- Property Details -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <!-- Image Gallery -->
            <div class="relative h-96" x-data="{ activeImage: 0 }">
                @foreach($property->images as $index => $image)
                    <div x-show="activeImage === {{ $index }}"
                         class="absolute inset-0 transition-opacity duration-500">
                        <img src="{{ asset($image) }}" 
                             alt="{{ $property->title }}"
                             class="w-full h-full object-cover">
                    </div>
                @endforeach

                <!-- Navigation Arrows -->
                <button @click="activeImage = (activeImage - 1 + {{ count($property->images) }}) % {{ count($property->images) }}"
                        class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-black/50 text-white rounded-full p-3 hover:bg-black/70 transition-colors duration-300">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button @click="activeImage = (activeImage + 1) % {{ count($property->images) }}"
                        class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-black/50 text-white rounded-full p-3 hover:bg-black/70 transition-colors duration-300">
                    <i class="fas fa-chevron-right"></i>
                </button>

                <!-- Image Counter -->
                <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 bg-black/50 text-white px-3 py-1 rounded-full text-sm">
                    <span x-text="activeImage + 1"></span>/<span>{{ count($property->images) }}</span>
                </div>
            </div>

            <div class="p-8">
                <!-- Header -->
                <div class="flex justify-between items-start mb-6">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $property->title }}</h1>
                        <p class="text-lg text-gray-600 flex items-center">
                            <i class="fas fa-map-marker-alt mr-2 text-primary-600"></i>
                            {{ $property->location }}
                        </p>
                    </div>
                    <div class="text-right">
                        <div class="text-3xl font-bold text-primary-600 mb-2">
                            {{ number_format($property->price, 0, ',', ' ') }} FCFA
                        </div>
                        <div class="text-gray-600 flex items-center justify-end">
                            <i class="fas fa-ruler-combined mr-2"></i>
                            {{ $property->surface_area }} m²
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <div class="mb-8">
                    <h2 class="text-xl font-semibold mb-4">Description</h2>
                    <p class="text-gray-600">{{ $property->description }}</p>
                </div>

                <!-- Features -->
                <div class="mb-8">
                    <h2 class="text-xl font-semibold mb-4">Caractéristiques</h2>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        @foreach($property->features as $feature)
                            <div class="flex items-center text-gray-600">
                                <i class="fas fa-check-circle text-primary-600 mr-2"></i>
                                {{ $feature }}
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Map -->
                <div class="mb-8">
                    <h2 class="text-xl font-semibold mb-4">Localisation</h2>
                    <div class="h-64 bg-gray-200 rounded-lg">
                        <!-- Add map implementation here -->
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex gap-4">
                    <button class="flex-1 bg-primary-600 text-white py-3 rounded-lg hover:bg-primary-700 transition-colors duration-300 font-medium">
                        <i class="fas fa-phone-alt mr-2"></i>
                        Demander une visite
                    </button>
                    <button class="px-6 py-3 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors duration-300">
                        <i class="far fa-heart"></i>
                    </button>
                    <button class="px-6 py-3 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors duration-300">
                        <i class="fas fa-share-alt"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Similar Properties -->
        <div class="mt-12">
            <h2 class="text-2xl font-bold mb-6">Biens similaires</h2>
            <!-- Add similar properties grid here -->
        </div>
    </div>
</div>
@endsection 