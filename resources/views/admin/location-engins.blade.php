@extends('layouts.admin')

@section('title', 'Gestion Location d\'Engins')

@section('content')
<div class="grid grid-cols-1 gap-6">
    <!-- Equipment List -->
    <div class="bg-white shadow-sm rounded-lg">
        <div class="p-4 sm:px-6 lg:px-8 border-b border-gray-200">
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h2 class="text-xl font-semibold text-gray-900">Parc d'Engins</h2>
                    <p class="mt-2 text-sm text-gray-700">Gérer les engins disponibles à la location</p>
                </div>
                <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                    <button type="button" 
                            onclick="document.getElementById('addModal').classList.remove('hidden');"
                            class="inline-flex items-center justify-center rounded-md border border-transparent bg-primary-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 sm:w-auto">
                        <i class="fas fa-plus mr-2"></i>
                        Ajouter un engin
                    </button>
                </div>
            </div>
        </div>

        <!-- Filters -->
        <div class="p-4 sm:px-6 lg:px-8 border-b border-gray-200">
            <div class="flex flex-col sm:flex-row gap-4">
                <div class="flex-1">
                    <input type="text" 
                           placeholder="Rechercher un engin..." 
                           class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                </div>
                <div class="flex gap-4">
                    <select class="rounded-md border-gray-300 focus:ring-primary-500 focus:border-primary-500">
                        <option value="">Type d'engin</option>
                        <option value="excavator">Excavatrice</option>
                        <option value="bulldozer">Bulldozer</option>
                        <option value="crane">Grue</option>
                    </select>
                    <select class="rounded-md border-gray-300 focus:ring-primary-500 focus:border-primary-500">
                        <option value="">Disponibilité</option>
                        <option value="available">Disponible</option>
                        <option value="rented">En location</option>
                        <option value="maintenance">En maintenance</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Equipment Table -->
        <div class="flex flex-col">
            <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                    <table class="min-w-full divide-y divide-gray-300">
                        <thead>
                            <tr>
                                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900">Engin</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Type</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Tarif journalier</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Statut</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Localisation</th>
                                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                    <span class="sr-only">Actions</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            @foreach($equipment as $item)
                            <tr>
                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm">
                                    <div class="flex items-center">
                                        <div class="h-10 w-10 flex-shrink-0">
                                            <img src="{{ asset($item['image']) }}" alt="" class="h-10 w-10 rounded-full object-cover">
                                        </div>
                                        <div class="ml-4">
                                            <div class="font-medium text-gray-900">{{ $item['name'] }}</div>
                                            <div class="text-gray-500">{{ $item['model'] }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $item['type'] }}</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">
                                    {{ number_format($item['daily_rate'], 0, ',', ' ') }} FCFA
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm">
                                    <span class="inline-flex rounded-full px-2 text-xs font-semibold leading-5 {{ 
                                        $item['status'] === 'available' ? 'bg-green-100 text-green-800' : 
                                        ($item['status'] === 'rented' ? 'bg-blue-100 text-blue-800' : 'bg-yellow-100 text-yellow-800') 
                                    }}">
                                        {{ $item['status'] }}
                                    </span>
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $item['location'] }}</td>
                                <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium">
                                    <button onclick="document.getElementById('editModal').classList.remove('hidden'); document.getElementById('editForm').action = '/admin/location-engins/{{ $item['id'] }}';" class="text-primary-600 hover:text-primary-900 mr-3">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button onclick="document.getElementById('deleteModal').classList.remove('hidden'); document.getElementById('deleteForm').action = '/admin/location-engins/{{ $item['id'] }}';" class="text-red-600 hover:text-red-900">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <div class="px-4 py-3 border-t border-gray-200 sm:px-6">
            {{ $equipment->links() }}
        </div>
    </div>

    <!-- Current Rentals -->
    <div class="bg-white shadow-sm rounded-lg">
        <div class="p-4 sm:px-6 lg:px-8 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-900">Locations en cours</h2>
            <p class="mt-2 text-sm text-gray-700">Aperçu des locations actives</p>
        </div>

        <div class="p-4 sm:px-6 lg:px-8">
            <div class="overflow-hidden">
                <ul role="list" class="divide-y divide-gray-200">
                    @foreach($activeRentals as $rental)
                    <li class="py-4">
                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0">
                                <img src="{{ asset($rental['equipment']['image']) }}" alt="" class="h-8 w-8 rounded-full">
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 truncate">
                                    {{ $rental['equipment']['name'] }}
                                </p>
                                <p class="text-sm text-gray-500">
                                    {{ $rental['client_name'] }} - {{ $rental['start_date']->format('d/m/Y') }} au {{ $rental['end_date']->format('d/m/Y') }}
                                </p>
                            </div>
                            <div>
                                <button type="button" class="inline-flex items-center px-2.5 py-1.5 border border-transparent text-xs font-medium rounded text-primary-700 bg-primary-100 hover:bg-primary-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
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
</div>

<!-- Modals -->
<x-modal id="addModal" title="Ajouter un engin">
    <!-- Form content -->
    <x-slot name="footer">
        <button type="button" onclick="document.getElementById('addModal').classList.add('hidden');">
            Annuler
        </button>
        <!-- Submit button -->
    </x-slot>
</x-modal>

<x-modal id="editModal" title="Modifier l'engin">
    <!-- Form content -->
    <x-slot name="footer">
        <button type="button" onclick="document.getElementById('editModal').classList.add('hidden');">
            Annuler
        </button>
        <button type="submit" form="editForm" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
            Mettre à jour
        </button>
    </x-slot>
</x-modal>

<x-modal id="deleteModal" title="Confirmer la suppression">
    <p class="text-sm text-gray-500">Êtes-vous sûr de vouloir supprimer cet engin? Cette action est irréversible.</p>
    
    <form id="deleteForm" method="POST">
        @csrf
        @method('DELETE')
    </form>
    
    <x-slot name="footer">
        <button type="button" onclick="document.getElementById('deleteModal').classList.add('hidden');" class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
            Annuler
        </button>
        <button type="submit" form="deleteForm" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
            Supprimer
        </button>
    </x-slot>
</x-modal>
@endsection 