@extends('layouts.admin')

@section('title', 'Gestion BTP')

@section('content')
<div class="grid grid-cols-1 gap-6">
    <!-- Projects Section -->
    <div class="bg-white shadow-sm rounded-lg">
        <div class="p-4 sm:px-6 lg:px-8 border-b border-gray-200">
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h2 class="text-xl font-semibold text-gray-900">Projets BTP</h2>
                    <p class="mt-2 text-sm text-gray-700">Liste des projets de construction en cours et terminés.</p>
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

        <!-- Filters -->
        <div class="p-4 sm:px-6 lg:px-8 border-b border-gray-200">
            <div class="flex flex-col sm:flex-row gap-4">
                <div class="flex-1">
                    <input type="text" 
                           placeholder="Rechercher un projet..." 
                           class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                </div>
                <div class="flex gap-4">
                    <select class="rounded-md border-gray-300 focus:ring-primary-500 focus:border-primary-500">
                        <option value="">Type de projet</option>
                        <option value="residential">Résidentiel</option>
                        <option value="commercial">Commercial</option>
                        <option value="industrial">Industriel</option>
                    </select>
                    <select class="rounded-md border-gray-300 focus:ring-primary-500 focus:border-primary-500">
                        <option value="">Statut</option>
                        <option value="planning">En planification</option>
                        <option value="in_progress">En cours</option>
                        <option value="completed">Terminé</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Projects Grid -->
        <div class="p-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($projects as $project)
                <div class="bg-white overflow-hidden shadow-sm rounded-lg border border-gray-200">
                    <div class="aspect-w-16 aspect-h-9">
                        <img src="{{ asset($project['image']) }}" alt="{{ $project['title'] }}" class="object-cover">
                    </div>
                    <div class="p-4">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-medium text-gray-900">{{ $project['title'] }}</h3>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ 
                                $project['status'] === 'completed' ? 'bg-green-100 text-green-800' : 
                                ($project['status'] === 'in_progress' ? 'bg-yellow-100 text-yellow-800' : 'bg-blue-100 text-blue-800') 
                            }}">
                                {{ $project['status'] }}
                            </span>
                        </div>
                        <p class="mt-1 text-sm text-gray-500">{{ $project['location'] }}</p>
                        <div class="mt-4 flex items-center justify-between">
                            <div class="text-sm text-gray-500">
                                <i class="fas fa-calendar mr-1"></i>
                                {{ $project['completion_date']->format('d/m/Y') }}
                            </div>
                            <div class="flex space-x-2">
                                <button class="text-primary-600 hover:text-primary-900">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="text-red-600 hover:text-red-900">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
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

    <!-- Statistics Section -->
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
        <div class="bg-white overflow-hidden shadow-sm rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-hard-hat text-primary-600 text-3xl"></i>
                    </div>
                    <div class="ml-5">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Projets en cours</dt>
                            <dd class="mt-1 text-3xl font-semibold text-gray-900">{{ $stats['ongoing'] }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
        <!-- Add more stat cards here -->
    </div>
</div>

<!-- Modals with inline JS for visibility control -->
<x-modal id="addModal" title="Ajouter un projet BTP">
    <!-- Form fields -->
    <x-slot name="footer">
        <button type="button" onclick="document.getElementById('addModal').classList.add('hidden');">
            Annuler
        </button>
        <!-- Submit button -->
    </x-slot>
</x-modal>
@endsection 