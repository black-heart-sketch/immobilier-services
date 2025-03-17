@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<!-- Welcome Banner -->
<div class="bg-gradient-to-r from-primary-600 to-primary-800 rounded-lg shadow-lg mb-6">
    <div class="px-6 py-8 md:flex md:items-center md:justify-between">
        <div class="max-w-xl">
            <h1 class="text-white text-2xl font-bold">Bienvenue sur votre tableau de bord</h1>
            <p class="mt-2 text-primary-100">Consultez les statistiques et gérez vos propriétés et services en un seul endroit.</p>
        </div>
        <div class="mt-4 md:mt-0">
            <a href="{{ route('admin.terrains') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-primary-700 bg-white hover:bg-primary-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                <i class="fas fa-plus mr-2"></i>
                Ajouter une propriété
            </a>
        </div>
    </div>
</div>

<!-- Key Metrics -->
<div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4 mb-8">
    <!-- Terrains Card -->
    <div class="bg-white overflow-hidden shadow-sm rounded-lg transition-all duration-300 hover:shadow-md transform hover:-translate-y-1">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-primary-100 rounded-md p-3">
                    <i class="fas fa-map text-primary-600 text-xl"></i>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">
                            Total Terrains
                        </dt>
                        <dd class="flex items-baseline">
                            <div class="text-2xl font-semibold text-gray-900">
                                {{ $terrainCount }}
                            </div>
                            <div class="ml-2 flex items-baseline text-sm font-semibold text-green-600">
                                <i class="fas fa-arrow-up"></i>
                                <span class="sr-only">Increased by</span>
                                12%
                            </div>
                        </dd>
                    </dl>
                </div>
            </div>
            <div class="mt-4">
                <a href="{{ route('admin.terrains') }}" class="text-sm font-medium text-primary-600 hover:text-primary-500">
                    Voir tous les terrains <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Maisons Card -->
    <div class="bg-white overflow-hidden shadow-sm rounded-lg transition-all duration-300 hover:shadow-md transform hover:-translate-y-1">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-blue-100 rounded-md p-3">
                    <i class="fas fa-home text-blue-600 text-xl"></i>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">
                            Total Maisons
                        </dt>
                        <dd class="flex items-baseline">
                            <div class="text-2xl font-semibold text-gray-900">
                                {{ $maisonCount }}
                            </div>
                            <div class="ml-2 flex items-baseline text-sm font-semibold text-green-600">
                                <i class="fas fa-arrow-up"></i>
                                <span class="sr-only">Increased by</span>
                                8%
                            </div>
                        </dd>
                    </dl>
                </div>
            </div>
            <div class="mt-4">
                <a href="{{ route('admin.maisons') }}" class="text-sm font-medium text-primary-600 hover:text-primary-500">
                    Voir toutes les maisons <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Revenue Card -->
    <div class="bg-white overflow-hidden shadow-sm rounded-lg transition-all duration-300 hover:shadow-md transform hover:-translate-y-1">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-green-100 rounded-md p-3">
                    <i class="fas fa-money-bill-wave text-green-600 text-xl"></i>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">
                            Revenus (mois en cours)
                        </dt>
                        <dd class="flex items-baseline">
                            <div class="text-2xl font-semibold text-gray-900">
                                {{ number_format($salesStats['current_month'], 0, ',', ' ') }} FCFA
                            </div>
                            <div class="ml-2 flex items-baseline text-sm font-semibold text-green-600">
                                <i class="fas fa-arrow-up"></i>
                                <span class="sr-only">Increased by</span>
                                {{ number_format($salesStats['growth_percentage'], 1) }}%
                            </div>
                        </dd>
                    </dl>
                </div>
            </div>
            <div class="mt-4">
                <button type="button" class="text-sm font-medium text-primary-600 hover:text-primary-500">
                    Voir le rapport financier <i class="fas fa-arrow-right ml-1"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Pending Requests Card -->
    <div class="bg-white overflow-hidden shadow-sm rounded-lg transition-all duration-300 hover:shadow-md transform hover:-translate-y-1">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-yellow-100 rounded-md p-3">
                    <i class="fas fa-clock text-yellow-600 text-xl"></i>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">
                            Demandes en attente
                        </dt>
                        <dd class="flex items-baseline">
                            <div class="text-2xl font-semibold text-gray-900">
                                {{ count($pendingRequests) }}
                            </div>
                        </dd>
                    </dl>
                </div>
            </div>
            <div class="mt-4">
                <button type="button" class="text-sm font-medium text-primary-600 hover:text-primary-500">
                    Voir toutes les demandes <i class="fas fa-arrow-right ml-1"></i>
                </button>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Latest Properties -->
    <div class="lg:col-span-2 bg-white shadow-sm rounded-lg overflow-hidden">
        <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
            <h3 class="text-lg leading-6 font-medium text-gray-900 flex items-center">
                <i class="fas fa-building mr-2 text-primary-600"></i>
                Dernières Propriétés
            </h3>
        </div>
        <div class="p-0">
            <div class="flow-root">
                <ul role="list" class="divide-y divide-gray-200">
                    @foreach($latestProperties as $property)
                    <li class="p-4 hover:bg-gray-50 transition-colors duration-150">
                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0 h-16 w-16 bg-gray-200 rounded-md overflow-hidden">
                                @if($property->image)
                                <img src="{{ asset($property->image) }}" alt="{{ $property->title }}" class="h-full w-full object-cover">
                                @else
                                <div class="h-full w-full flex items-center justify-center bg-gray-100">
                                    <i class="fas {{ $property->type == 'terrain' ? 'fa-map' : 'fa-home' }} text-gray-400 text-2xl"></i>
                                </div>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 truncate">
                                    {{ $property->title }}
                                </p>
                                <p class="text-sm text-gray-500">
                                    {{ $property->location }}
                                </p>
                                <p class="text-sm font-semibold text-primary-600">
                                    {{ number_format($property->price, 0, ',', ' ') }} FCFA
                                </p>
                            </div>
                            <div>
                                <a href="#" class="inline-flex items-center px-2.5 py-1.5 border border-transparent text-xs font-medium rounded text-primary-700 bg-primary-100 hover:bg-primary-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                                    Détails
                                </a>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="bg-gray-50 px-4 py-4 sm:px-6 border-t border-gray-200">
            <div class="flex items-center justify-between">
                <span class="text-sm text-gray-700">
                    Affichage des 5 dernières propriétés
                </span>
                <a href="{{ route('admin.terrains') }}" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                    Voir toutes les propriétés
                </a>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="bg-white shadow-sm rounded-lg overflow-hidden">
        <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
            <h3 class="text-lg leading-6 font-medium text-gray-900 flex items-center">
                <i class="fas fa-history mr-2 text-primary-600"></i>
                Activités Récentes
            </h3>
        </div>
        <div class="p-0">
            <div class="flow-root">
                <ul role="list" class="divide-y divide-gray-200">
                    @foreach($recentActivities as $activity)
                    <li class="p-4 hover:bg-gray-50 transition-colors duration-150">
                        <div class="flex space-x-3">
                            <div class="flex-shrink-0">
                                <div class="h-10 w-10 rounded-full bg-primary-500 flex items-center justify-center">
                                    <span class="text-white font-medium text-sm">{{ substr($activity['user'], 0, 1) }}</span>
                                </div>
                            </div>
                            <div class="min-w-0 flex-1">
                                <p class="text-sm text-gray-900">
                                    <span class="font-medium">{{ $activity['user'] }}</span> {{ $activity['action'] }}
                                    <span class="font-medium">{{ $activity['subject'] }}</span>
                                </p>
                                <p class="text-sm text-gray-500">
                                    {{ $activity['created_at']->diffForHumans() }}
                                </p>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="bg-gray-50 px-4 py-4 sm:px-6 border-t border-gray-200">
            <button type="button" class="text-sm text-primary-600 hover:text-primary-900">
                Voir toutes les activités <i class="fas fa-arrow-right ml-1"></i>
            </button>
        </div>
    </div>
</div>

<!-- Pending Requests Section -->
<div class="mt-8 bg-white shadow-sm rounded-lg overflow-hidden">
    <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
        <h3 class="text-lg leading-6 font-medium text-gray-900 flex items-center">
            <i class="fas fa-tasks mr-2 text-primary-600"></i>
            Demandes en Attente
        </h3>
    </div>
    <div class="p-0">
        <div class="flow-root">
            <ul role="list" class="divide-y divide-gray-200">
                @foreach($pendingRequests as $request)
                <li class="p-4 hover:bg-gray-50 transition-colors duration-150">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="flex-shrink-0">
                                <div class="h-10 w-10 rounded-full bg-yellow-100 flex items-center justify-center">
                                    <i class="fas fa-file-alt text-yellow-600"></i>
                                </div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900">
                                    {{ $request['type'] }}
                                </p>
                                <p class="text-sm text-gray-500">
                                    {{ $request['client_name'] }} - {{ $request['created_at']->diffForHumans() }}
                                </p>
                            </div>
                        </div>
                        <div class="flex space-x-2">
                            <button type="button" class="inline-flex items-center px-2.5 py-1.5 border border-transparent text-xs font-medium rounded text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                                Traiter
                            </button>
                            <button type="button" class="inline-flex items-center px-2.5 py-1.5 border border-gray-300 text-xs font-medium rounded text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                                Détails
                            </button>
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>

<!-- Quick Access Section -->
<div class="mt-8 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
    <a href="{{ route('admin.topographie') }}" class="bg-white overflow-hidden shadow-sm rounded-lg transition-all duration-300 hover:shadow-md transform hover:-translate-y-1 p-6 flex flex-col items-center justify-center text-center">
        <div class="h-12 w-12 rounded-md bg-indigo-100 flex items-center justify-center mb-4">
            <i class="fas fa-mountain text-indigo-600 text-xl"></i>
        </div>
        <h3 class="text-lg font-medium text-gray-900">Topographie</h3>
        <p class="mt-2 text-sm text-gray-500">Gérer les projets topographiques</p>
    </a>
    
    <a href="{{ route('admin.btp') }}" class="bg-white overflow-hidden shadow-sm rounded-lg transition-all duration-300 hover:shadow-md transform hover:-translate-y-1 p-6 flex flex-col items-center justify-center text-center">
        <div class="h-12 w-12 rounded-md bg-yellow-100 flex items-center justify-center mb-4">
            <i class="fas fa-hard-hat text-yellow-600 text-xl"></i>
        </div>
        <h3 class="text-lg font-medium text-gray-900">BTP</h3>
        <p class="mt-2 text-sm text-gray-500">Gérer les projets de construction</p>
    </a>
    
    <a href="{{ route('admin.decoration') }}" class="bg-white overflow-hidden shadow-sm rounded-lg transition-all duration-300 hover:shadow-md transform hover:-translate-y-1 p-6 flex flex-col items-center justify-center text-center">
        <div class="h-12 w-12 rounded-md bg-pink-100 flex items-center justify-center mb-4">
            <i class="fas fa-paint-brush text-pink-600 text-xl"></i>
        </div>
        <h3 class="text-lg font-medium text-gray-900">Décoration</h3>
        <p class="mt-2 text-sm text-gray-500">Gérer les projets de décoration</p>
    </a>
    
    <a href="{{ route('admin.pepinieres') }}" class="bg-white overflow-hidden shadow-sm rounded-lg transition-all duration-300 hover:shadow-md transform hover:-translate-y-1 p-6 flex flex-col items-center justify-center text-center">
        <div class="h-12 w-12 rounded-md bg-green-100 flex items-center justify-center mb-4">
            <i class="fas fa-leaf text-green-600 text-xl"></i>
        </div>
        <h3 class="text-lg font-medium text-gray-900">Pépinières</h3>
        <p class="mt-2 text-sm text-gray-500">Gérer l'inventaire des plantes</p>
    </a>
</div>

<!-- Any modals would follow the same pattern -->
<x-modal id="detailsModal" title="Détails">
    <!-- Content -->
    <x-slot name="footer">
        <button type="button" onclick="document.getElementById('detailsModal').classList.add('hidden');">
            Fermer
        </button>
    </x-slot>
</x-modal>

@endsection 

@push('scripts')
<script>
    // Add any JavaScript for interactivity here
    document.addEventListener('DOMContentLoaded', function() {
        // Example: Add animation to the stats cards
        const statCards = document.querySelectorAll('.hover\\:shadow-md');
        statCards.forEach((card, index) => {
            setTimeout(() => {
                card.classList.add('opacity-100');
                card.classList.remove('opacity-0');
            }, 100 * index);
        });
    });
</script>
@endpush 