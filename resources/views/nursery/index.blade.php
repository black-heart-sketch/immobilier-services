@extends('layouts.app')

@section('content')
<x-page-banner 
    title="Pépinière"
    description="Découvrez notre sélection de plantes et d'arbres pour embellir votre espace. Des espèces locales aux plantes exotiques, trouvez la verdure qui vous correspond."
    image="images/plants/row-fresh-green-plants-pot.jpg"
/>

<div class="bg-white">
    
    <!-- Filters section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-lg shadow-sm p-6">
            <form action="{{ route('nursery.index') }}" method="GET" class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-4">
                <!-- Search -->
                <div>
                    <label for="search" class="block text-sm font-medium text-gray-700">Recherche</label>
                    <div class="mt-1">
                        <input type="text" name="search" id="search" value="{{ request('search') }}"
                               class="shadow-sm focus:ring-primary-500 focus:border-primary-500 block w-full sm:text-sm border-gray-300 rounded-md"
                               placeholder="Nom de plante...">
                    </div>
                </div>

                <!-- Category filter -->
                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700">Catégorie</label>
                    <select name="category" id="category"
                            class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm rounded-md">
                        <option value="">Toutes les catégories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>
                                {{ ucfirst($category) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Price range -->
                <div>
                    <label for="min_price" class="block text-sm font-medium text-gray-700">Prix minimum</label>
                    <div class="mt-1">
                        <input type="number" name="min_price" id="min_price" value="{{ request('min_price') }}"
                               class="shadow-sm focus:ring-primary-500 focus:border-primary-500 block w-full sm:text-sm border-gray-300 rounded-md"
                               placeholder="Prix min...">
                    </div>
                </div>

                <div>
                    <label for="max_price" class="block text-sm font-medium text-gray-700">Prix maximum</label>
                    <div class="mt-1">
                        <input type="number" name="max_price" id="max_price" value="{{ request('max_price') }}"
                               class="shadow-sm focus:ring-primary-500 focus:border-primary-500 block w-full sm:text-sm border-gray-300 rounded-md"
                               placeholder="Prix max...">
                    </div>
                </div>

                <div class="sm:col-span-4 flex justify-end">
                    <button type="submit"
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                        Filtrer
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Add this near the top of the file, after the filters section -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Categories section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 gap-y-10 sm:grid-cols-2 gap-x-6 lg:grid-cols-3 xl:gap-x-8">
            @foreach($plants as $plant)
            <div class="group relative bg-white rounded-lg shadow-lg overflow-hidden transform transition duration-300 hover:-translate-y-1 hover:shadow-xl">
                <!-- Image with overlay -->
                <div class="relative w-full h-80">
                    <img src="{{ asset($plant->image) }}" 
                         alt="{{ $plant->name }}" 
                         class="w-full h-full object-center object-cover">
                    <div class="absolute inset-0 bg-black bg-opacity-20 group-hover:bg-opacity-30 transition-opacity"></div>
                    
                    <!-- Quick actions overlay -->
                    <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                        <div class="flex space-x-4">
                            <button type="button" 
                                    data-modal-target="quickview-{{ $plant->id }}"
                                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-primary-600 bg-opacity-90 hover:bg-opacity-100 focus:outline-none">
                                <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                Aperçu rapide
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Content -->
                <div class="p-6">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">
                                <a href="{{ route('nursery.show', $plant) }}" class="hover:text-primary-600">
                                    {{ $plant->name }}
                                </a>
                            </h3>
                            <p class="mt-1 text-sm text-gray-500">{{ $plant->scientific_name }}</p>
                        </div>
                        <p class="text-xl font-bold text-primary-600">{{ number_format($plant->price, 0, ',', ' ') }} FCFA</p>
                    </div>

                    <!-- Specifications -->
                    <div class="mt-4 grid grid-cols-2 gap-4 text-sm">
                        <div class="flex items-center text-gray-600">
                            <svg class="h-5 w-5 mr-2 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            {{ $plant->specifications['hauteur_maximale'] ?? 'N/A' }}
                        </div>
                        <div class="flex items-center text-gray-600">
                            <svg class="h-5 w-5 mr-2 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            {{ $plant->specifications['exposition'] ?? 'N/A' }}
                        </div>
                    </div>

                    <!-- Stock status and Add to cart -->
                    <div class="mt-6 flex items-center justify-between">
                        @if($plant->stock > 0)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-primary-100 text-primary-800">
                                <svg class="mr-1.5 h-2 w-2 text-primary-400" fill="currentColor" viewBox="0 0 8 8">
                                    <circle cx="4" cy="4" r="3" />
                                </svg>
                                En stock ({{ $plant->stock }})
                            </span>
                            <form data-add-to-cart data-plant-id="{{ $plant->id }}" class="mt-4">
                                <div class="flex items-center gap-2">
                                    <input type="number" 
                                           name="quantity" 
                                           min="1" 
                                           max="{{ $plant->stock }}" 
                                           value="1" 
                                           class="w-20 rounded-lg border-gray-300 focus:border-primary-500 focus:ring-primary-500">
                                    <button type="submit" 
                                            class="flex-1 bg-primary-600 text-white px-4 py-2 rounded-lg hover:bg-primary-700 transition-colors">
                                        <i class="fas fa-shopping-cart mr-2"></i>
                                        Ajouter au panier
                                    </button>
                                </div>
                            </form>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                <svg class="mr-1.5 h-2 w-2 text-red-400" fill="currentColor" viewBox="0 0 8 8">
                                    <circle cx="4" cy="4" r="3" />
                                </svg>
                                Rupture de stock
                            </span>
                            <button disabled class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-gray-400 cursor-not-allowed">
                                <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                Indisponible
                            </button>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Quick view modal -->
            <div id="quickview-{{ $plant->id }}" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-modal="true">
                <!-- ... Quick view modal content ... -->
            </div>
            @endforeach
        </div>
    </div>

    <!-- Pagination -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        {{ $plants->links() }}
    </div>

    <!-- Features section -->
    <div class="bg-gray-50">
        <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:py-24 lg:px-8">
            <div class="max-w-3xl mx-auto text-center">
                <h2 class="text-3xl font-extrabold text-gray-900">Pourquoi choisir notre pépinière ?</h2>
                <p class="mt-4 text-lg text-gray-500">
                    Des plantes de qualité, des conseils d'experts et un service personnalisé.
                </p>
            </div>
            <dl class="mt-12 space-y-10 sm:space-y-0 sm:grid sm:grid-cols-2 sm:gap-x-6 sm:gap-y-12 lg:grid-cols-4 lg:gap-x-8">
                <div class="relative">
                    <dt>
                        <svg class="absolute h-6 w-6 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <p class="ml-9 text-lg leading-6 font-medium text-gray-900">Qualité garantie</p>
                    </dt>
                    <dd class="mt-2 ml-9 text-base text-gray-500">
                        Toutes nos plantes sont sélectionnées avec soin et bénéficient d'un suivi rigoureux.
                    </dd>
                </div>

                <div class="relative">
                    <dt>
                        <svg class="absolute h-6 w-6 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        <p class="ml-9 text-lg leading-6 font-medium text-gray-900">Conseils personnalisés</p>
                    </dt>
                    <dd class="mt-2 ml-9 text-base text-gray-500">
                        Nos experts vous accompagnent dans le choix et l'entretien de vos plantes.
                    </dd>
                </div>

                <div class="relative">
                    <dt>
                        <svg class="absolute h-6 w-6 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3" />
                        </svg>
                        <p class="ml-9 text-lg leading-6 font-medium text-gray-900">Prix compétitifs</p>
                    </dt>
                    <dd class="mt-2 ml-9 text-base text-gray-500">
                        Des tarifs adaptés à tous les budgets, particuliers comme professionnels.
                    </dd>
                </div>

                <div class="relative">
                    <dt>
                        <svg class="absolute h-6 w-6 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                        <p class="ml-9 text-lg leading-6 font-medium text-gray-900">Livraison soignée</p>
                    </dt>
                    <dd class="mt-2 ml-9 text-base text-gray-500">
                        Un service de livraison adapté pour garantir l'arrivée de vos plantes en parfait état.
                    </dd>
                </div>
            </dl>
        </div>
    </div>
</div>

<!-- Toast notification -->
<div id="toast" class="fixed bottom-4 right-4 px-4 py-2 bg-primary-500 text-white rounded-lg shadow-lg transform transition-all duration-300 ease-in-out translate-y-full opacity-0">
</div>

@push('scripts')
<script src="{{ asset('js/cart.js') }}"></script>
@endpush
@endsection 