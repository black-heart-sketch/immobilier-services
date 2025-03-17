@extends('layouts.admin')

@section('title', 'Gestion des Maisons')

@push('head-scripts')
<script>
    // Define editHouse function in the head section so it's available before the HTML is rendered
    function editHouse(id, title, description, location, surfaceArea, price, status, houseType, bedrooms, bathrooms) {
        // Set form action
        document.getElementById('editForm').action = `/admin/maisons/${id}`;
        
        // Populate form fields
        document.getElementById('edit_title').value = title;
        document.getElementById('edit_description').value = description;
        document.getElementById('edit_location').value = location;
        document.getElementById('edit_surface_area').value = surfaceArea;
        document.getElementById('edit_price').value = price;
        document.getElementById('edit_status').value = status;
        document.getElementById('edit_house_type').value = houseType;
        document.getElementById('edit_bedrooms').value = bedrooms;
        document.getElementById('edit_bathrooms').value = bathrooms;
        
        // Show current image if available
        const currentImageContainer = document.getElementById('current_image_container');
        const currentImage = document.getElementById('current_image');
        
        // For testing - in production, you'd use the actual image URL
        currentImage.src = `/storage/properties/${id}/main.jpg`;
        currentImageContainer.classList.remove('hidden');
        
        // Show the modal
        document.getElementById('editModal').classList.remove('hidden');
    }
</script>
@endpush

@section('content')
<div class="bg-white shadow-sm rounded-lg">
    <!-- Header with actions -->
    <div class="p-4 sm:px-6 lg:px-8 border-b border-gray-200">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h2 class="text-xl font-semibold text-gray-900">Maisons</h2>
                <p class="mt-2 text-sm text-gray-700">Liste de toutes les maisons disponibles à la vente.</p>
            </div>
            <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                <button type="button" 
                        onclick="document.getElementById('addModal').classList.remove('hidden');"
                        class="inline-flex items-center justify-center rounded-md border border-transparent bg-primary-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 sm:w-auto">
                    <i class="fas fa-plus mr-2"></i>
                    Ajouter une maison
                </button>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="p-4 sm:px-6 lg:px-8 border-b border-gray-200">
        <form action="{{ route('admin.maisons') }}" method="GET" class="flex flex-col sm:flex-row gap-4">
            <div class="flex-1">
                <label for="search" class="sr-only">Rechercher</label>
                <div class="relative rounded-md shadow-sm">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                    <input type="text" name="search" id="search" 
                           value="{{ request('search') }}"
                           class="focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 sm:text-sm border-gray-300 rounded-md" 
                           placeholder="Rechercher une maison...">
                </div>
            </div>
            <div class="flex flex-wrap gap-4">
                <select name="house_type" class="rounded-md border-gray-300 focus:ring-primary-500 focus:border-primary-500">
                    <option value="">Type de bien</option>
                    <option value="villa" {{ request('house_type') == 'villa' ? 'selected' : '' }}>Villa</option>
                    <option value="apartment" {{ request('house_type') == 'apartment' ? 'selected' : '' }}>Appartement</option>
                    <option value="duplex" {{ request('house_type') == 'duplex' ? 'selected' : '' }}>Duplex</option>
                </select>
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
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Type</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Chambres</th>
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
                                    <i class="fas fa-home text-gray-400"></i>
                                </div>
                                @endif
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">{{ $property->title }}</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">
                                <span class="inline-flex rounded-full px-2 text-xs font-semibold leading-5 bg-blue-100 text-blue-800">
                                    {{ $property->house_type }}
                                </span>
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">{{ $property->bedrooms }}</td>
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
                                <button onclick="editHouse(
                                    {{ $property->id }}, 
                                    {{ json_encode($property->title) }}, 
                                    {{ json_encode($property->description) }}, 
                                    {{ json_encode($property->location) }}, 
                                    {{ $property->surface_area }}, 
                                    {{ $property->price }}, 
                                    {{ json_encode($property->status) }}, 
                                    {{ json_encode($property->house_type) }}, 
                                    {{ $property->bedrooms ?? 0 }}, 
                                    {{ $property->bathrooms ?? 0 }}
                                );" class="text-primary-600 hover:text-primary-900 mr-3">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button onclick="document.getElementById('deleteModal').classList.remove('hidden'); document.getElementById('deleteForm').action = '/admin/maisons/{{ $property->id }}';" class="text-red-600 hover:text-red-900">
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

<!-- Add House Modal -->
<x-modal id="addModal" title="Ajouter une maison">
    <form id="addForm" action="{{ route('admin.maisons') }}" method="POST" enctype="multipart/form-data" class="overflow-y-auto max-h-[calc(100vh-16rem)]">
        @csrf
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
            <div class="col-span-2">
                <label for="title" class="block text-sm font-medium text-gray-700">Titre <span class="text-red-500">*</span></label>
                <input type="text" name="title" id="title" required class="mt-1 focus:ring-primary-500 focus:border-primary-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>
            
            <div class="col-span-2">
                <label for="description" class="block text-sm font-medium text-gray-700">Description <span class="text-red-500">*</span></label>
                <textarea name="description" id="description" rows="3" required class="mt-1 focus:ring-primary-500 focus:border-primary-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></textarea>
            </div>
            
            <div>
                <label for="house_type" class="block text-sm font-medium text-gray-700">Type de bien <span class="text-red-500">*</span></label>
                <select name="house_type" id="house_type" required class="mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-primary-500 focus:outline-none focus:ring-primary-500 sm:text-sm">
                    <option value="">Sélectionner un type</option>
                    <option value="villa">Villa</option>
                    <option value="apartment">Appartement</option>
                    <option value="duplex">Duplex</option>
                </select>
            </div>
            
            <div>
                <label for="location" class="block text-sm font-medium text-gray-700">Emplacement <span class="text-red-500">*</span></label>
                <input type="text" name="location" id="location" required class="mt-1 focus:ring-primary-500 focus:border-primary-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>
            
            <div>
                <label for="bedrooms" class="block text-sm font-medium text-gray-700">Nombre de chambres <span class="text-red-500">*</span></label>
                <input type="number" name="bedrooms" id="bedrooms" min="1" required class="mt-1 focus:ring-primary-500 focus:border-primary-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>
            
            <div>
                <label for="bathrooms" class="block text-sm font-medium text-gray-700">Nombre de salles de bain <span class="text-red-500">*</span></label>
                <input type="number" name="bathrooms" id="bathrooms" min="1" required class="mt-1 focus:ring-primary-500 focus:border-primary-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>
            
            <div>
                <label for="surface_area" class="block text-sm font-medium text-gray-700">Surface (m²) <span class="text-red-500">*</span></label>
                <input type="number" name="surface_area" id="surface_area" required class="mt-1 focus:ring-primary-500 focus:border-primary-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>
            
            <div>
                <label for="price" class="block text-sm font-medium text-gray-700">Prix (FCFA) <span class="text-red-500">*</span></label>
                <input type="number" name="price" id="price" required class="mt-1 focus:ring-primary-500 focus:border-primary-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>
            
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700">Statut <span class="text-red-500">*</span></label>
                <select name="status" id="status" required class="mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-primary-500 focus:outline-none focus:ring-primary-500 sm:text-sm">
                    <option value="">Sélectionner un statut</option>
                    <option value="available">Disponible</option>
                    <option value="pending">En attente</option>
                    <option value="sold">Vendu</option>
                </select>
            </div>
            
            <div class="col-span-2">
                <label for="image" class="block text-sm font-medium text-gray-700">Image <span class="text-red-500">*</span></label>
                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md hover:bg-gray-50 transition duration-150 ease-in-out">
                    <div class="space-y-1 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="flex text-sm text-gray-600 justify-center">
                            <label for="image" class="relative cursor-pointer bg-white rounded-md font-medium text-primary-600 hover:text-primary-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-primary-500">
                                <span>Télécharger une image</span>
                                <input id="image" name="image" type="file" class="sr-only" required accept="image/*">
                            </label>
                            <p class="pl-1">ou glisser-déposer</p>
                        </div>
                        <p class="text-xs text-gray-500">PNG, JPG, GIF jusqu'à 10MB</p>
                    </div>
                </div>
                <div id="preview-container" class="mt-3 hidden">
                    <p class="text-sm text-gray-500">Aperçu:</p>
                    <img id="preview-image" src="" alt="Aperçu" class="mt-2 h-32 w-auto rounded-md">
                </div>
            </div>
        </div>
    </form>
    
    <x-slot name="footer">
        <button type="button" onclick="document.getElementById('addModal').classList.add('hidden');" class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
            Annuler
        </button>
        <button type="submit" form="addForm" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
            Ajouter
        </button>
    </x-slot>
</x-modal>

<!-- Edit House Modal -->
<x-modal id="editModal" title="Modifier la maison">
    <form id="editForm" method="POST" enctype="multipart/form-data" class="overflow-y-auto max-h-[calc(100vh-16rem)]">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
            <div class="col-span-2">
                <label for="edit_title" class="block text-sm font-medium text-gray-700">Titre <span class="text-red-500">*</span></label>
                <input type="text" name="title" id="edit_title" required class="mt-1 focus:ring-primary-500 focus:border-primary-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>
            
            <div class="col-span-2">
                <label for="edit_description" class="block text-sm font-medium text-gray-700">Description <span class="text-red-500">*</span></label>
                <textarea name="description" id="edit_description" rows="3" required class="mt-1 focus:ring-primary-500 focus:border-primary-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></textarea>
            </div>
            
            <div>
                <label for="edit_house_type" class="block text-sm font-medium text-gray-700">Type de bien <span class="text-red-500">*</span></label>
                <select name="house_type" id="edit_house_type" required class="mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-primary-500 focus:outline-none focus:ring-primary-500 sm:text-sm">
                    <option value="villa">Villa</option>
                    <option value="apartment">Appartement</option>
                    <option value="duplex">Duplex</option>
                </select>
            </div>
            
            <div>
                <label for="edit_location" class="block text-sm font-medium text-gray-700">Emplacement <span class="text-red-500">*</span></label>
                <input type="text" name="location" id="edit_location" required class="mt-1 focus:ring-primary-500 focus:border-primary-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>
            
            <div>
                <label for="edit_bedrooms" class="block text-sm font-medium text-gray-700">Nombre de chambres <span class="text-red-500">*</span></label>
                <input type="number" name="bedrooms" id="edit_bedrooms" min="1" required class="mt-1 focus:ring-primary-500 focus:border-primary-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>
            
            <div>
                <label for="edit_bathrooms" class="block text-sm font-medium text-gray-700">Nombre de salles de bain <span class="text-red-500">*</span></label>
                <input type="number" name="bathrooms" id="edit_bathrooms" min="1" required class="mt-1 focus:ring-primary-500 focus:border-primary-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>
            
            <div>
                <label for="edit_surface_area" class="block text-sm font-medium text-gray-700">Surface (m²) <span class="text-red-500">*</span></label>
                <input type="number" name="surface_area" id="edit_surface_area" required class="mt-1 focus:ring-primary-500 focus:border-primary-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>
            
            <div>
                <label for="edit_price" class="block text-sm font-medium text-gray-700">Prix (FCFA) <span class="text-red-500">*</span></label>
                <input type="number" name="price" id="edit_price" required class="mt-1 focus:ring-primary-500 focus:border-primary-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>
            
            <div>
                <label for="edit_status" class="block text-sm font-medium text-gray-700">Statut <span class="text-red-500">*</span></label>
                <select name="status" id="edit_status" required class="mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-primary-500 focus:outline-none focus:ring-primary-500 sm:text-sm">
                    <option value="available">Disponible</option>
                    <option value="pending">En attente</option>
                    <option value="sold">Vendu</option>
                </select>
            </div>
            
            <div class="col-span-2">
                <label for="edit_image" class="block text-sm font-medium text-gray-700">Image</label>
                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md hover:bg-gray-50 transition duration-150 ease-in-out">
                    <div class="space-y-1 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="flex text-sm text-gray-600 justify-center">
                            <label for="edit_image" class="relative cursor-pointer bg-white rounded-md font-medium text-primary-600 hover:text-primary-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-primary-500">
                                <span>Remplacer l'image</span>
                                <input id="edit_image" name="image" type="file" class="sr-only" accept="image/*">
                            </label>
                            <p class="pl-1">ou glisser-déposer</p>
                        </div>
                        <p class="text-xs text-gray-500">PNG, JPG, GIF jusqu'à 10MB</p>
                    </div>
                </div>
            </div>
            
            <div id="current_image_container" class="col-span-2 mt-2">
                <p class="text-sm text-gray-500">Image actuelle:</p>
                <img id="current_image" src="" alt="Image actuelle" class="mt-2 h-32 w-auto object-cover rounded-md shadow-sm">
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

<!-- Delete Confirmation Modal -->
<x-modal id="deleteModal" title="Confirmer la suppression">
    <div class="p-6 text-center">
        <svg class="mx-auto mb-4 text-red-400 w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
        </svg>
        <h3 class="mb-5 text-lg font-medium text-gray-900">Êtes-vous sûr de vouloir supprimer cette maison?</h3>
        <p class="text-sm text-gray-500 mb-6">Cette action est irréversible et supprimera définitivement cette maison ainsi que toutes les données associées.</p>
    
        <form id="deleteForm" method="POST">
            @csrf
            @method('DELETE')
        </form>
    </div>
    
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

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Image preview for add form
        const imageInput = document.getElementById('image');
        const previewContainer = document.getElementById('preview-container');
        const previewImage = document.getElementById('preview-image');
        
        imageInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                
                reader.addEventListener('load', function() {
                    previewImage.setAttribute('src', this.result);
                    previewContainer.classList.remove('hidden');
                });
                
                reader.readAsDataURL(file);
            }
        });
        
        // Image preview for edit form
        const editImageInput = document.getElementById('edit_image');
        
        editImageInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                
                reader.addEventListener('load', function() {
                    document.getElementById('current_image').setAttribute('src', this.result);
                    document.getElementById('current_image_container').classList.remove('hidden');
                });
                
                reader.readAsDataURL(file);
            }
        });
    });
</script>
@endpush 