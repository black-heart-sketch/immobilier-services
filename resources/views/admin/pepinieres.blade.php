@extends('layouts.admin')

@section('title', 'Gestion des Pépinières')

@section('content')
<div class="grid grid-cols-1 gap-6">
    <!-- Plants Inventory -->
    <div class="bg-white shadow-sm rounded-lg">
        <div class="p-4 sm:px-6 lg:px-8 border-b border-gray-200">
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h2 class="text-xl font-semibold text-gray-900">Inventaire des Plantes</h2>
                    <p class="mt-2 text-sm text-gray-700">Gérer le stock de plantes disponibles</p>
                </div>
                <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                    <button type="button" 
                            onclick="document.getElementById('addModal').classList.remove('hidden');"
                            class="inline-flex items-center justify-center rounded-md border border-transparent bg-primary-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 sm:w-auto">
                        <i class="fas fa-plus mr-2"></i>
                        Ajouter une plante
                    </button>
                </div>
            </div>
        </div>

        <!-- Filters -->
        <div class="p-4 sm:px-6 lg:px-8 border-b border-gray-200">
            <div class="flex flex-col sm:flex-row gap-4">
                <div class="flex-1">
                    <input type="text" 
                           placeholder="Rechercher une plante..." 
                           class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                </div>
                <div class="flex gap-4">
                    <select class="rounded-md border-gray-300 focus:ring-primary-500 focus:border-primary-500">
                        <option value="">Catégorie</option>
                        <option value="trees">Arbres</option>
                        <option value="shrubs">Arbustes</option>
                        <option value="flowers">Fleurs</option>
                    </select>
                    <select class="rounded-md border-gray-300 focus:ring-primary-500 focus:border-primary-500">
                        <option value="">Stock</option>
                        <option value="in_stock">En stock</option>
                        <option value="low_stock">Stock faible</option>
                        <option value="out_of_stock">Rupture</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Plants Grid -->
        <div class="p-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
                @foreach($plants as $plant)
                <div class="bg-white overflow-hidden shadow-sm rounded-lg border border-gray-200">
                    <div class="aspect-w-3 aspect-h-4 bg-gray-200">
                        <img src="{{ asset($plant['image']) }}" 
                             alt="{{ $plant['name'] }}" 
                             class="object-cover">
                    </div>
                    <div class="p-4">
                        <h3 class="text-lg font-medium text-gray-900">{{ $plant['name'] }}</h3>
                        <p class="text-sm text-gray-500">{{ $plant['scientific_name'] }}</p>
                        <div class="mt-2 flex items-center justify-between">
                            <span class="text-sm font-medium text-gray-900">
                                {{ number_format($plant['price'], 0, ',', ' ') }} FCFA
                            </span>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ 
                                $plant['stock'] > 10 ? 'bg-green-100 text-green-800' : 
                                ($plant['stock'] > 0 ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') 
                            }}">
                                Stock: {{ $plant['stock'] }}
                            </span>
                        </div>
                        <div class="mt-4 flex justify-end space-x-2">
                            <button class="text-primary-600 hover:text-primary-900">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="text-red-600 hover:text-red-900">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Pagination -->
        <div class="px-4 py-3 border-t border-gray-200 sm:px-6">
            {{ $plants->links() }}
        </div>
    </div>

    <!-- Orders Section -->
    <div class="bg-white shadow-sm rounded-lg">
        <div class="p-4 sm:px-6 lg:px-8 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-900">Commandes Récentes</h2>
            <p class="mt-2 text-sm text-gray-700">Dernières commandes de plantes</p>
        </div>

        <div class="overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Commande
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Client
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Date
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Total
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Statut
                        </th>
                        <th scope="col" class="relative px-6 py-3">
                            <span class="sr-only">Actions</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($orders as $order)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            #{{ $order['id'] }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $order['customer_name'] }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $order['created_at']->format('d/m/Y') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ number_format($order['total'], 0, ',', ' ') }} FCFA
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex rounded-full px-2 text-xs font-semibold leading-5 {{ 
                                $order['status'] === 'completed' ? 'bg-green-100 text-green-800' : 
                                ($order['status'] === 'processing' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800') 
                            }}">
                                {{ $order['status'] }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="#" class="text-primary-600 hover:text-primary-900">Détails</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modals with inline JS for the cancel buttons -->
<x-modal id="addModal" title="Ajouter une plante">
    <!-- Form content -->
    <x-slot name="footer">
        <button type="button" onclick="document.getElementById('addModal').classList.add('hidden');">Annuler</button>
        <!-- etc. -->
    </x-slot>
</x-modal>
@endsection 