@extends('layouts.admin')

@section('title', 'Gestion de la Décoration')

@section('content')
<div class="grid grid-cols-1 gap-6">
    <!-- Projects Section -->
    <div class="bg-white shadow-sm rounded-lg">
        <div class="p-4 sm:px-6 lg:px-8 border-b border-gray-200">
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h2 class="text-xl font-semibold text-gray-900">Projets de Décoration</h2>
                    <p class="mt-2 text-sm text-gray-700">Liste des projets de décoration intérieure</p>
                </div>
                <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                    <button type="button" 
                            onclick="document.getElementById('addModal').classList.remove('hidden');"
                            class="inline-flex items-center justify-center rounded-md border border-transparent bg-primary-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 sm:w-auto">
                        <i class="fas fa-plus mr-2"></i>
                        Nouveau projet
                    </button>
                </div>
            </div>
        </div>

        <!-- Gallery Grid -->
        <div class="p-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($projects as $project)
                <div class="group relative">
                    <div class="aspect-w-4 aspect-h-3 bg-gray-100 overflow-hidden rounded-lg">
                        <img src="{{ asset($project['main_image']) }}" 
                             alt="{{ $project['title'] }}" 
                             class="object-cover group-hover:opacity-75 transition-opacity duration-300">
                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300 flex items-center justify-center">
                            <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex space-x-4">
                                <button class="p-2 bg-white rounded-full text-gray-900 hover:text-primary-600">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="p-2 bg-white rounded-full text-gray-900 hover:text-red-600">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <h3 class="text-lg font-medium text-gray-900">{{ $project['title'] }}</h3>
                        <p class="text-sm text-gray-500">{{ $project['client_name'] }}</p>
                        <div class="mt-2 flex items-center justify-between">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ 
                                $project['status'] === 'completed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800'
                            }}">
                                {{ $project['status'] }}
                            </span>
                            <span class="text-sm text-gray-500">
                                {{ $project['completion_date']->format('d/m/Y') }}
                            </span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Pagination -->
        <div class="px-4 py-3 border-t border-gray-200 sm:px-6">
            {{ $projects->links() }}
        </div>
    </div>

    <!-- Services Section -->
    <div class="bg-white shadow-sm rounded-lg">
        <div class="p-4 sm:px-6 lg:px-8 border-b border-gray-200">
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h2 class="text-xl font-semibold text-gray-900">Services de Décoration</h2>
                    <p class="mt-2 text-sm text-gray-700">Gérer les services de décoration proposés</p>
                </div>
                <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                    <button type="button" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary-600 hover:bg-primary-700">
                        <i class="fas fa-plus mr-2"></i>
                        Ajouter un service
                    </button>
                </div>
            </div>
        </div>

        <div class="p-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                @foreach($services as $service)
                <div class="relative rounded-lg border border-gray-300 bg-white px-6 py-5 shadow-sm flex items-center space-x-3 hover:border-gray-400">
                    <div class="flex-shrink-0">
                        <i class="fas {{ $service['icon'] }} text-2xl text-primary-600"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <a href="#" class="focus:outline-none">
                            <span class="absolute inset-0" aria-hidden="true"></span>
                            <p class="text-sm font-medium text-gray-900">{{ $service['title'] }}</p>
                            <p class="text-sm text-gray-500 truncate">{{ $service['price_range'] }}</p>
                        </a>
                    </div>
                    <div class="flex-shrink-0">
                        <button class="text-gray-400 hover:text-primary-600">
                            <i class="fas fa-edit"></i>
                        </button>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<!-- Modals -->
<x-modal id="addModal" title="Ajouter un projet de décoration">
    <!-- Form content -->
    <x-slot name="footer">
        <button type="button" onclick="document.getElementById('addModal').classList.add('hidden');">
            Annuler
        </button>
        <!-- Submit button -->
    </x-slot>
</x-modal>
@endsection 