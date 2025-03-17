@extends('layouts.admin')

@section('title', 'Gestion de la Topographie')

@push('head-scripts')
<script>
    // Define editProject function in the head section so it's available before the HTML is rendered
    function editProject(id, title, description, location, type, clientName, completionDate, status, images) {
        // Set form action
        document.getElementById('editForm').action = `/admin/topographie/${id}`;
        
        // Populate form fields
        document.getElementById('edit_title').value = title;
        document.getElementById('edit_description').value = description;
        document.getElementById('edit_location').value = location;
        document.getElementById('edit_type').value = type;
        document.getElementById('edit_client_name').value = clientName;
        document.getElementById('edit_completion_date').value = completionDate;
        document.getElementById('edit_status').value = status;
        
        // Show current image if available
        const currentImageContainer = document.getElementById('current_image_container');
        const currentImage = document.getElementById('current_image');
        
        if (images && images.length > 0) {
            currentImage.src = images[0]; // Display the first image
            currentImageContainer.classList.remove('hidden');
        } else {
            currentImageContainer.classList.add('hidden');
        }
        
        // Show the modal
        document.getElementById('editModal').classList.remove('hidden');
    }
    
    function viewProject(id, title, description, location, type, clientName, completionDate, status, images) {
        // Populate the view modal
        document.getElementById('view_title').textContent = title;
        document.getElementById('view_description').textContent = description;
        document.getElementById('view_location').textContent = location;
        document.getElementById('view_type').textContent = type;
        document.getElementById('view_client').textContent = clientName;
        document.getElementById('view_date').textContent = completionDate;
        document.getElementById('view_status').textContent = status;
        
        // Clear existing images
        const imageGallery = document.getElementById('view_images');
        imageGallery.innerHTML = '';
        
        // Add images to gallery
        if (images && images.length > 0) {
            images.forEach(image => {
                const imgElement = document.createElement('img');
                imgElement.src = image;
                imgElement.className = 'h-24 w-24 object-cover rounded-md mr-2 mb-2';
                imageGallery.appendChild(imgElement);
            });
        } else {
            imageGallery.innerHTML = '<p class="text-gray-500">Aucune image disponible</p>';
        }
        
        // Show the modal
        document.getElementById('viewProjectModal').classList.remove('hidden');
    }
    
    function confirmDelete(id) {
        document.getElementById('deleteForm').action = `/admin/topographie/${id}`;
        document.getElementById('deleteModal').classList.remove('hidden');
    }
</script>
@endpush

@section('content')
<div class="grid grid-cols-1 gap-6">
    <!-- Stats Overview -->
    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
        <!-- Total Projects Card -->
        <div class="bg-white overflow-hidden shadow-sm rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-primary-100 rounded-md p-3">
                        <i class="fas fa-mountain text-primary-600 text-xl"></i>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Total Projets</dt>
                            <dd class="mt-1 text-3xl font-semibold text-gray-900">{{ count($projects) }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Projects in Progress Card -->
        <div class="bg-white overflow-hidden shadow-sm rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-yellow-100 rounded-md p-3">
                        <i class="fas fa-clock text-yellow-600 text-xl"></i>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Projets en cours</dt>
                            <dd class="mt-1 text-3xl font-semibold text-gray-900">
                                {{ $projects->where('status', 'in_progress')->count() }}
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Completed Projects Card -->
        <div class="bg-white overflow-hidden shadow-sm rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-green-100 rounded-md p-3">
                        <i class="fas fa-check-circle text-green-600 text-xl"></i>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Projets terminés</dt>
                            <dd class="mt-1 text-3xl font-semibold text-gray-900">
                                {{ $projects->where('status', 'completed')->count() }}
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Projects Section -->
    <div class="bg-white shadow-sm rounded-lg">
        <div class="p-4 sm:px-6 lg:px-8 border-b border-gray-200">
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h2 class="text-xl font-semibold text-gray-900">Projets Topographiques</h2>
                    <p class="mt-2 text-sm text-gray-700">Liste des projets de topographie en cours et terminés.</p>
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
            <form action="{{ route('admin.topographie') }}" method="GET" class="flex flex-col sm:flex-row gap-4">
                <div class="flex-1">
                    <label for="search" class="sr-only">Rechercher</label>
                    <div class="relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                        <input type="text" name="search" id="search" 
                               value="{{ request('search') }}"
                               class="focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 sm:text-sm border-gray-300 rounded-md" 
                               placeholder="Rechercher un projet...">
                    </div>
                </div>
                <div class="flex flex-wrap gap-4">
                    <select name="type" class="rounded-md border-gray-300 focus:ring-primary-500 focus:border-primary-500">
                        <option value="">Type de projet</option>
                        <option value="bornage" {{ request('type') == 'bornage' ? 'selected' : '' }}>Bornage terrain</option>
                        <option value="leve" {{ request('type') == 'leve' ? 'selected' : '' }}>Levé topographique</option>
                        <option value="nivellement" {{ request('type') == 'nivellement' ? 'selected' : '' }}>Nivellement</option>
                    </select>
                    <select name="status" class="rounded-md border-gray-300 focus:ring-primary-500 focus:border-primary-500">
                        <option value="">Statut</option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Terminé</option>
                        <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>En cours</option>
                        <option value="planning" {{ request('status') == 'planning' ? 'selected' : '' }}>Planification</option>
                    </select>
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2">
                        Filtrer
                    </button>
                </div>
            </form>
        </div>

        <!-- Projects Grid View -->
        <div class="p-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($projects as $project)
                <!-- Debug: Print the structure of the project array -->
                <pre class="text-xs bg-gray-100 p-2 mb-2">{{ json_encode($project, JSON_PRETTY_PRINT) }}</pre>
                
                <div class="bg-white overflow-hidden shadow-sm rounded-lg border border-gray-200 transition-all duration-300 hover:shadow-md hover:border-primary-300">
                    <div class="aspect-w-16 aspect-h-9 bg-gray-200">
                        <div class="flex items-center justify-center h-full bg-gray-100">
                            <i class="fas fa-mountain text-gray-400 text-4xl"></i>
                        </div>
                    </div>
                    <div class="p-4">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-medium text-gray-900 truncate" title="{{ $project['title'] }}">{{ $project['title'] }}</h3>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                {{ \Carbon\Carbon::parse($project['completion_date'])->isPast() ? 'Terminé' : 'En cours' }}
                            </span>
                        </div>
                        <p class="mt-1 text-sm text-gray-500 truncate" title="{{ $project['location'] }}">
                            <i class="fas fa-map-marker-alt mr-1"></i> {{ $project['location'] }}
                        </p>
                        <p class="mt-1 text-sm text-gray-500 truncate">
                            <i class="fas fa-tag mr-1"></i> 
                            {{ $project['type'] === 'bornage' ? 'Bornage terrain' : 
                               ($project['type'] === 'leve' ? 'Levé topographique' : 'Nivellement') }}
                        </p>
                        <div class="mt-4 flex items-center justify-between">
                            <div class="text-sm text-gray-500">
                                <i class="fas fa-calendar mr-1"></i>
                                {{ \Carbon\Carbon::parse($project['completion_date'])->format('d/m/Y') }}
                            </div>
                            <div class="flex space-x-2">
                                <!-- Use isset to check if keys exist before accessing them -->
                                <button onclick="viewProject(
                                    {{ $project['id'] }},
                                    {{ json_encode($project['title']) }},
                                    {{ json_encode($project['description'] ?? 'Pas de description disponible') }},
                                    {{ json_encode($project['location']) }},
                                    {{ json_encode($project['type']) }},
                                    'Non spécifié',
                                    {{ json_encode(\Carbon\Carbon::parse($project['completion_date'])->format('d/m/Y')) }},
                                    {{ \Carbon\Carbon::parse($project['completion_date'])->isPast() ? json_encode('completed') : json_encode('in_progress') }},
                                    []
                                )" class="text-primary-600 hover:text-primary-900">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button onclick="editProject(
                                    {{ $project['id'] }},
                                    {{ json_encode($project['title']) }},
                                    {{ json_encode($project['description'] ?? '') }},
                                    {{ json_encode($project['location']) }},
                                    {{ json_encode($project['type']) }},
                                    '',
                                    {{ json_encode($project['completion_date']) }},
                                    {{ \Carbon\Carbon::parse($project['completion_date'])->isPast() ? json_encode('completed') : json_encode('in_progress') }},
                                    []
                                )" class="text-primary-600 hover:text-primary-900">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button onclick="confirmDelete({{ $project['id'] }})" class="text-red-600 hover:text-red-900">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            @if(count($projects) === 0)
            <div class="text-center py-12">
                <i class="fas fa-folder-open text-gray-400 text-5xl mb-4"></i>
                <h3 class="text-lg font-medium text-gray-900">Aucun projet trouvé</h3>
                <p class="mt-2 text-sm text-gray-500">Commencez par ajouter un nouveau projet topographique</p>
            </div>
            @endif
        </div>

        <!-- Pagination -->
        <div class="px-4 py-3 border-t border-gray-200 sm:px-6">
            {{ $projects->links() }}
        </div>
    </div>

    <!-- Quote Requests Section -->
    <div class="bg-white shadow-sm rounded-lg">
        <div class="p-4 sm:px-6 lg:px-8 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-900">Demandes de Devis</h2>
            <p class="mt-2 text-sm text-gray-700">Dernières demandes de devis reçues</p>
        </div>

        <div class="overflow-hidden">
            <ul role="list" class="divide-y divide-gray-200">
                @foreach($quoteRequests as $request)
                <li class="p-4 sm:px-6 lg:px-8 hover:bg-gray-50 transition-colors duration-150">
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <h3 class="text-sm font-medium">{{ $request['name'] }}</h3>
                            <p class="text-sm text-gray-500">{{ $request['email'] }}</p>
                            <p class="mt-1 text-sm text-gray-500">{{ $request['service_type'] }}</p>
                        </div>
                        <div class="ml-6 flex items-center space-x-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ 
                                $request['status'] === 'pending' ? 'bg-yellow-100 text-yellow-800' : 
                                ($request['status'] === 'contacted' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800') 
                            }}">
                                {{ $request['status'] === 'pending' ? 'En attente' : 
                                   ($request['status'] === 'contacted' ? 'Contacté' : 'Terminé') }}
                            </span>
                            <button type="button" onclick="document.getElementById('viewRequestModal').classList.remove('hidden');" class="text-primary-600 hover:text-primary-900">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
            
            @if(count($quoteRequests) === 0)
            <div class="text-center py-12">
                <i class="fas fa-inbox text-gray-400 text-5xl mb-4"></i>
                <h3 class="text-lg font-medium text-gray-900">Aucune demande de devis</h3>
                <p class="mt-2 text-sm text-gray-500">Les nouvelles demandes apparaîtront ici</p>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Add Project Modal -->
<x-modal id="addModal" title="Ajouter un projet topographique">
    <form id="addForm" method="POST" action="{{ route('admin.topographie') }}" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-2">
            <div class="sm:col-span-2">
                <label for="title" class="block text-sm font-medium text-gray-700">Titre <span class="text-red-500">*</span></label>
                <input type="text" name="title" id="title" required class="mt-1 focus:ring-primary-500 focus:border-primary-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>
            
            <div class="sm:col-span-2">
                <label for="description" class="block text-sm font-medium text-gray-700">Description <span class="text-red-500">*</span></label>
                <textarea name="description" id="description" rows="3" required class="mt-1 focus:ring-primary-500 focus:border-primary-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></textarea>
            </div>
            
            <div>
                <label for="type" class="block text-sm font-medium text-gray-700">Type de projet <span class="text-red-500">*</span></label>
                <select name="type" id="type" required class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm rounded-md">
                    <option value="bornage">Bornage terrain</option>
                    <option value="leve">Levé topographique</option>
                    <option value="nivellement">Nivellement</option>
                </select>
            </div>
            
            <div>
                <label for="location" class="block text-sm font-medium text-gray-700">Emplacement <span class="text-red-500">*</span></label>
                <input type="text" name="location" id="location" required class="mt-1 focus:ring-primary-500 focus:border-primary-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>
            
            <div>
                <label for="client_name" class="block text-sm font-medium text-gray-700">Nom du client <span class="text-red-500">*</span></label>
                <input type="text" name="client_name" id="client_name" required class="mt-1 focus:ring-primary-500 focus:border-primary-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>
            
            <div>
                <label for="completion_date" class="block text-sm font-medium text-gray-700">Date de réalisation <span class="text-red-500">*</span></label>
                <input type="date" name="completion_date" id="completion_date" required class="mt-1 focus:ring-primary-500 focus:border-primary-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>
            
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700">Statut <span class="text-red-500">*</span></label>
                <select name="status" id="status" required class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm rounded-md">
                    <option value="planning">Planification</option>
                    <option value="in_progress">En cours</option>
                    <option value="completed">Terminé</option>
                </select>
            </div>
            
            <div class="sm:col-span-2">
                <label for="image" class="block text-sm font-medium text-gray-700">Images du projet</label>
                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                    <div class="space-y-1 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="flex text-sm text-gray-600">
                            <label for="images" class="relative cursor-pointer bg-white rounded-md font-medium text-primary-600 hover:text-primary-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-primary-500">
                                <span>Télécharger des images</span>
                                <input id="images" name="images[]" type="file" class="sr-only" multiple>
                            </label>
                            <p class="pl-1">ou glisser-déposer</p>
                        </div>
                        <p class="text-xs text-gray-500">PNG, JPG, GIF jusqu'à 5MB</p>
                    </div>
                </div>
            </div>
            
            <div class="sm:col-span-2 hidden" id="preview-container">
                <label class="block text-sm font-medium text-gray-700">Aperçu</label>
                <div class="mt-1">
                    <img src="" alt="Aperçu" id="preview-image" class="h-32 w-auto object-cover rounded-md shadow-sm">
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

<!-- Edit Project Modal -->
<x-modal id="editModal" title="Modifier le projet">
    <form id="editForm" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-2">
            <div class="sm:col-span-2">
                <label for="edit_title" class="block text-sm font-medium text-gray-700">Titre <span class="text-red-500">*</span></label>
                <input type="text" name="title" id="edit_title" required class="mt-1 focus:ring-primary-500 focus:border-primary-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>
            
            <div class="sm:col-span-2">
                <label for="edit_description" class="block text-sm font-medium text-gray-700">Description <span class="text-red-500">*</span></label>
                <textarea name="description" id="edit_description" rows="3" required class="mt-1 focus:ring-primary-500 focus:border-primary-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></textarea>
            </div>
            
            <div>
                <label for="edit_type" class="block text-sm font-medium text-gray-700">Type de projet <span class="text-red-500">*</span></label>
                <select name="type" id="edit_type" required class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm rounded-md">
                    <option value="bornage">Bornage terrain</option>
                    <option value="leve">Levé topographique</option>
                    <option value="nivellement">Nivellement</option>
                </select>
            </div>
            
            <div>
                <label for="edit_location" class="block text-sm font-medium text-gray-700">Emplacement <span class="text-red-500">*</span></label>
                <input type="text" name="location" id="edit_location" required class="mt-1 focus:ring-primary-500 focus:border-primary-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>
            
            <div>
                <label for="edit_client_name" class="block text-sm font-medium text-gray-700">Nom du client <span class="text-red-500">*</span></label>
                <input type="text" name="client_name" id="edit_client_name" required class="mt-1 focus:ring-primary-500 focus:border-primary-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>
            
            <div>
                <label for="edit_completion_date" class="block text-sm font-medium text-gray-700">Date de réalisation <span class="text-red-500">*</span></label>
                <input type="date" name="completion_date" id="edit_completion_date" required class="mt-1 focus:ring-primary-500 focus:border-primary-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>
            
            <div>
                <label for="edit_status" class="block text-sm font-medium text-gray-700">Statut <span class="text-red-500">*</span></label>
                <select name="status" id="edit_status" required class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm rounded-md">
                    <option value="planning">Planification</option>
                    <option value="in_progress">En cours</option>
                    <option value="completed">Terminé</option>
                </select>
            </div>
            
            <div class="sm:col-span-2">
                <label for="edit_image" class="block text-sm font-medium text-gray-700">Images du projet</label>
                <input type="file" name="images[]" id="edit_image" multiple class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100">
                <p class="mt-1 text-xs text-gray-500">Vous pouvez sélectionner plusieurs images (JPG, PNG, max 5MB chacune)</p>
            </div>
            
            <div class="sm:col-span-2">
                <div id="current_image_container" class="mt-2 hidden">
                    <p class="text-sm text-gray-500 mb-2">Image actuelle:</p>
                    <img id="current_image" src="" alt="Image actuelle" class="h-24 w-24 object-cover rounded-md">
                </div>
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

<!-- View Project Modal -->
<x-modal id="viewProjectModal" title="Détails du projet">
    <div class="space-y-6">
        <div>
            <h3 id="view_title" class="text-lg font-medium text-gray-900"></h3>
            <p id="view_description" class="mt-2 text-sm text-gray-500"></p>
        </div>
        
        <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-2">
            <div>
                <h4 class="text-sm font-medium text-gray-500">Type de projet</h4>
                <p id="view_type" class="mt-1 text-sm text-gray-900"></p>
            </div>
            
            <div>
                <h4 class="text-sm font-medium text-gray-500">Emplacement</h4>
                <p id="view_location" class="mt-1 text-sm text-gray-900"></p>
            </div>
            
            <div>
                <h4 class="text-sm font-medium text-gray-500">Client</h4>
                <p id="view_client" class="mt-1 text-sm text-gray-900"></p>
            </div>
            
            <div>
                <h4 class="text-sm font-medium text-gray-500">Date de réalisation</h4>
                <p id="view_date" class="mt-1 text-sm text-gray-900"></p>
            </div>
            
            <div>
                <h4 class="text-sm font-medium text-gray-500">Statut</h4>
                <p id="view_status" class="mt-1 text-sm text-gray-900"></p>
            </div>
        </div>
        
        <div>
            <h4 class="text-sm font-medium text-gray-500 mb-2">Images du projet</h4>
            <div id="view_images" class="flex flex-wrap"></div>
        </div>
    </div>
    
    <x-slot name="footer">
        <button type="button" onclick="document.getElementById('viewProjectModal').classList.add('hidden');" class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
            Fermer
        </button>
    </x-slot>
</x-modal>

<!-- Delete Confirmation Modal -->
<x-modal id="deleteModal" title="Confirmer la suppression">
    <div class="p-6 text-center">
        <svg class="mx-auto mb-4 text-red-400 w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
        </svg>
        <h3 class="mb-5 text-lg font-medium text-gray-900">Êtes-vous sûr de vouloir supprimer ce projet?</h3>
        <p class="text-sm text-gray-500 mb-6">Cette action est irréversible et supprimera définitivement ce projet ainsi que toutes les données associées.</p>
    
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

<!-- View Quote Request Modal -->
<x-modal id="viewRequestModal" title="Détails de la demande">
    <dl class="grid grid-cols-1 gap-y-4 gap-x-6 sm:grid-cols-2">
        <div>
            <dt class="text-sm font-medium text-gray-500">Nom</dt>
            <dd class="mt-1 text-sm text-gray-900" id="request_name"></dd>
        </div>
        <div>
            <dt class="text-sm font-medium text-gray-500">Email</dt>
            <dd class="mt-1 text-sm text-gray-900" id="request_email"></dd>
        </div>
        <div>
            <dt class="text-sm font-medium text-gray-500">Téléphone</dt>
            <dd class="mt-1 text-sm text-gray-900" id="request_phone"></dd>
        </div>
        <div>
            <dt class="text-sm font-medium text-gray-500">Date</dt>
            <dd class="mt-1 text-sm text-gray-900" id="request_date"></dd>
        </div>
        <div class="sm:col-span-2">
            <dt class="text-sm font-medium text-gray-500">Type de service</dt>
            <dd class="mt-1 text-sm text-gray-900" id="request_service"></dd>
        </div>
        <div class="sm:col-span-2">
            <dt class="text-sm font-medium text-gray-500">Message</dt>
            <dd class="mt-1 text-sm text-gray-900" id="request_message"></dd>
        </div>
        <div class="sm:col-span-2">
            <dt class="text-sm font-medium text-gray-500">Statut</dt>
            <dd class="mt-1">
                <select class="mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-primary-500 focus:outline-none focus:ring-primary-500 sm:text-sm" id="request_status">
                    <option value="pending">En attente</option>
                    <option value="contacted">Contacté</option>
                    <option value="completed">Terminé</option>
                </select>
            </dd>
        </div>
    </dl>
    
    <x-slot name="footer">
        <button type="button" onclick="document.getElementById('viewRequestModal').classList.add('hidden');" class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
            Fermer
        </button>
        <button type="button" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
            Mettre à jour
        </button>
    </x-slot>
</x-modal>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Image preview for add form
        const imageInput = document.getElementById('images');
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
        
        // Initialize any interactive elements
        const projectCards = document.querySelectorAll('.project-card');
        projectCards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.querySelector('.project-actions').classList.remove('opacity-0');
            });
            
            card.addEventListener('mouseleave', function() {
                this.querySelector('.project-actions').classList.add('opacity-0');
            });
        });
    });
</script>
@endpush