@extends('layouts.admin')

@section('title', 'Gestion des Terrains')

@section('content')
<div class="bg-white shadow-sm rounded-lg">
    <!-- Header with actions -->
    <div class="p-4 sm:px-6 lg:px-8 border-b border-gray-200">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h2 class="text-xl font-semibold text-gray-900">Terrains</h2>
                <p class="mt-2 text-sm text-gray-700">Liste de tous les terrains disponibles à la vente.</p>
            </div>
            <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                <button type="button" 
                        onclick="document.getElementById('addModal').classList.remove('hidden');"
                        class="inline-flex items-center justify-center rounded-md border border-transparent bg-primary-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 sm:w-auto">
                    <i class="fas fa-plus mr-2"></i>
                    Ajouter un terrain
                </button>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="p-4 sm:px-6 lg:px-8 border-b border-gray-200">
        <form action="{{ route('admin.terrains') }}" method="GET" class="flex flex-col sm:flex-row gap-4">
            <div class="flex-1">
                <label for="search" class="sr-only">Rechercher</label>
                <div class="relative rounded-md shadow-sm">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                    <input type="text" name="search" id="search" 
                           value="{{ request('search') }}"
                           class="focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 sm:text-sm border-gray-300 rounded-md" 
                           placeholder="Rechercher un terrain...">
                </div>
            </div>
            <div class="flex gap-4">
                <select name="status" class="rounded-md border-gray-300 focus:ring-primary-500 focus:border-primary-500">
                    <option value="">Tous les statuts</option>
                    <option value="available" {{ request('status') == 'available' ? 'selected' : '' }}>Disponible</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>En attente</option>
                    <option value="sold" {{ request('status') == 'sold' ? 'selected' : '' }}>Vendu</option>
                </select>
                <select name="sort" class="rounded-md border-gray-300 focus:ring-primary-500 focus:border-primary-500">
                    <option value="">Trier par</option>
                    <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Prix croissant</option>
                    <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Prix décroissant</option>
                    <option value="date_desc" {{ request('sort') == 'date_desc' ? 'selected' : '' }}>Plus récent</option>
                    <option value="date_asc" {{ request('sort') == 'date_asc' ? 'selected' : '' }}>Plus ancien</option>
                </select>
                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2">
                    Filtrer
                </button>
            </div>
        </form>
    </div>

    <!-- Table -->
    <div class="flex flex-col">
        <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                <table class="min-w-full divide-y divide-gray-300">
                    <thead>
                        <tr>
                            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900">ID</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Image</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Titre</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Surface</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Prix</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Statut</th>
                            <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6 text-right text-sm font-semibold text-gray-900">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        @foreach($properties as $property)
                        <tr>
                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm text-gray-900">{{ $property->id }}</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm">
                                @if($property->image)
                                <img src="{{ asset($property->image) }}" alt="{{ $property->title }}" class="h-12 w-12 rounded-md object-cover">
                                @else
                                <div class="h-12 w-12 rounded-md bg-gray-100 flex items-center justify-center">
                                    <i class="fas fa-map text-gray-400"></i>
                                </div>
                                @endif
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">{{ $property->title }}</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">{{ $property->surface_area }} m²</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">{{ number_format($property->price, 0, ',', ' ') }} FCFA</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm">
                                <span class="inline-flex rounded-full px-2 text-xs font-semibold leading-5 {{ 
                                    $property->status === 'available' ? 'bg-green-100 text-green-800' : 
                                    ($property->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800') 
                                }}">
                                    {{ $property->status === 'available' ? 'Disponible' : 
                                       ($property->status === 'pending' ? 'En attente' : 'Vendu') }}
                                </span>
                            </td>
                            <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium">
                                <button onclick="document.getElementById('editModal').classList.remove('hidden'); document.getElementById('editForm').action = '/admin/properties/{{ $property->id }}';" class="text-primary-600 hover:text-primary-900 mr-3">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button onclick="document.getElementById('deleteModal').classList.remove('hidden'); document.getElementById('deleteForm').action = '/admin/properties/{{ $property->id }}';" class="text-red-600 hover:text-red-900">
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
        {{ $properties->links() }}
    </div>
</div>

<!-- Using the modal component -->
<x-modal id="addModal" title="Ajouter un terrain">
    <form id="addTerrainForm" action="{{ route('admin.terrains') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 gap-4">
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">Titre</label>
                <input type="text" name="title" id="title" class="mt-1 focus:ring-primary-500 focus:border-primary-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" id="description" rows="3" class="mt-1 focus:ring-primary-500 focus:border-primary-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></textarea>
            </div>
            <div>
                <label for="location" class="block text-sm font-medium text-gray-700">Emplacement</label>
                <input type="text" name="location" id="location" class="mt-1 focus:ring-primary-500 focus:border-primary-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>
            <div>
                <label for="surface_area" class="block text-sm font-medium text-gray-700">Surface (m²)</label>
                <input type="number" name="surface_area" id="surface_area" class="mt-1 focus:ring-primary-500 focus:border-primary-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>
            <div>
                <label for="price" class="block text-sm font-medium text-gray-700">Prix (FCFA)</label>
                <input type="number" name="price" id="price" class="mt-1 focus:ring-primary-500 focus:border-primary-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>
            <div>
                <label for="image" class="block text-sm font-medium text-gray-700">Image</label>
                <input type="file" name="image" id="image" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100">
            </div>
            <input type="hidden" name="type" value="terrain">
            <input type="hidden" name="status" value="available">
        </div>
    </form>
    
    <x-slot name="footer">
        <button type="button" onclick="document.getElementById('addModal').classList.add('hidden');" class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
            Annuler
        </button>
        <button type="submit" form="addTerrainForm" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
            Ajouter
        </button>
    </x-slot>
</x-modal>

<x-modal id="editModal" title="Modifier le terrain">
    <form id="editForm" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 gap-4">
            <div>
                <label for="edit_title" class="block text-sm font-medium text-gray-700">Titre</label>
                <input type="text" name="title" id="edit_title" class="mt-1 focus:ring-primary-500 focus:border-primary-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>
            <div>
                <label for="edit_description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" id="edit_description" rows="3" class="mt-1 focus:ring-primary-500 focus:border-primary-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></textarea>
            </div>
            <div>
                <label for="edit_location" class="block text-sm font-medium text-gray-700">Emplacement</label>
                <input type="text" name="location" id="edit_location" class="mt-1 focus:ring-primary-500 focus:border-primary-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>
            <div>
                <label for="edit_surface_area" class="block text-sm font-medium text-gray-700">Surface (m²)</label>
                <input type="number" name="surface_area" id="edit_surface_area" class="mt-1 focus:ring-primary-500 focus:border-primary-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>
            <div>
                <label for="edit_price" class="block text-sm font-medium text-gray-700">Prix (FCFA)</label>
                <input type="number" name="price" id="edit_price" class="mt-1 focus:ring-primary-500 focus:border-primary-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>
            <div>
                <label for="edit_status" class="block text-sm font-medium text-gray-700">Statut</label>
                <select name="status" id="edit_status" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm rounded-md">
                    <option value="available">Disponible</option>
                    <option value="pending">En attente</option>
                    <option value="sold">Vendu</option>
                </select>
            </div>
            <div>
                <label for="edit_image" class="block text-sm font-medium text-gray-700">Image</label>
                <input type="file" name="image" id="edit_image" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100">
            </div>
            <div id="current_image_container" class="mt-2">
                <p class="text-sm text-gray-500">Image actuelle:</p>
                <img id="current_image" src="" alt="Image actuelle" class="mt-2 h-24 w-24 object-cover rounded-md">
            </div>
        </div>
    </form>
    
    <x-slot name="footer">
        <button type="button" onclick="document.getElementById('editModal').classList.add('hidden');" class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
            Annuler
        </button>
        <button type="submit" form="editForm" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
            Mettre à jour
        </button>
    </x-slot>
</x-modal>

<x-modal id="deleteModal" title="Confirmer la suppression">
    <p class="text-sm text-gray-500">Êtes-vous sûr de vouloir supprimer ce terrain? Cette action est irréversible.</p>
    
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