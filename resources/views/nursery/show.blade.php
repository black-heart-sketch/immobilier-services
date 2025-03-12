@extends('layouts.app')

@section('content')
<div class="bg-white">
    <div class="max-w-2xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:max-w-7xl lg:px-8">
        <div class="lg:grid lg:grid-cols-2 lg:gap-x-8 lg:items-start">
            <!-- Image gallery -->
            <div class="flex flex-col">
                <div class="w-full aspect-w-1 aspect-h-1 bg-gray-200 rounded-lg overflow-hidden">
                    <img src="{{ asset($plant->image) }}" 
                         alt="{{ $plant->name }}" 
                         class="w-full h-full object-center object-cover">
                </div>

                <!-- Image gallery -->
                @if($plant->gallery)
                <div class="mt-4 grid grid-cols-4 gap-2">
                    @foreach($plant->gallery as $image)
                    <div class="aspect-w-1 aspect-h-1 rounded-lg overflow-hidden">
                        <img src="{{ asset($image) }}" 
                             alt="{{ $plant->name }}" 
                             class="w-full h-full object-center object-cover cursor-pointer hover:opacity-75">
                    </div>
                    @endforeach
                </div>
                @endif
            </div>

            <!-- Plant info -->
            <div class="mt-10 px-4 sm:px-0 sm:mt-16 lg:mt-0">
                <h1 class="text-3xl font-extrabold tracking-tight text-gray-900">{{ $plant->name }}</h1>
                <h2 class="mt-1 text-sm text-gray-500 italic">{{ $plant->scientific_name }}</h2>

                <div class="mt-3">
                    <p class="text-3xl text-gray-900">{{ number_format($plant->price, 0, ',', ' ') }} FCFA</p>
                </div>

                <div class="mt-6">
                    <h3 class="sr-only">Description</h3>
                    <div class="text-base text-gray-700 space-y-6">
                        {{ $plant->description }}
                    </div>
                </div>

                <!-- Specifications -->
                <div class="mt-8 border-t border-gray-200 pt-8">
                    <h3 class="text-sm font-medium text-gray-900">Spécifications</h3>
                    <div class="mt-4 prose prose-sm text-gray-500">
                        <ul role="list">
                            @foreach($plant->specifications as $spec => $value)
                            <li>{{ ucfirst($spec) }}: {{ $value }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <!-- Benefits -->
                <div class="mt-8 border-t border-gray-200 pt-8">
                    <h3 class="text-sm font-medium text-gray-900">Bénéfices</h3>
                    <div class="mt-4 prose prose-sm text-gray-500">
                        <ul role="list">
                            @foreach($plant->benefits as $benefit)
                            <li>{{ $benefit }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <!-- Care Instructions -->
                <div class="mt-8 border-t border-gray-200 pt-8">
                    <h3 class="text-sm font-medium text-gray-900">Instructions d'entretien</h3>
                    <div class="mt-4 prose prose-sm text-gray-500">
                        {{ $plant->care_instructions }}
                    </div>
                </div>

                <!-- Add to cart form -->
                <div class="mt-8">
                    <div class="flex items-center">
                        <label for="quantity" class="sr-only">Quantité</label>
                        <select id="quantity" name="quantity" class="rounded-md border border-gray-300 text-base font-medium text-gray-700 text-left shadow-sm focus:outline-none focus:ring-1 focus:ring-green-500 focus:border-green-500 sm:text-sm">
                            @for($i = 1; $i <= min(10, $plant->stock); $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>

                        <button type="button" class="ml-4 relative inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-green-600 shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            Ajouter au panier
                        </button>
                    </div>
                </div>

                <!-- Wholesale section -->
                @if($plant->available_wholesale)
                <div class="mt-8 border-t border-gray-200 pt-8">
                    <div class="rounded-md bg-green-50 p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-green-800">Disponible en gros</h3>
                                <div class="mt-2 text-sm text-green-700">
                                    <p>Quantité minimum: {{ $plant->wholesale_min_quantity }} unités</p>
                                    <p>Prix en gros: {{ number_format($plant->wholesale_price, 0, ',', ' ') }} FCFA/unité</p>
                                </div>
                                <div class="mt-4">
                                    <button type="button" 
                                            onclick="window.location.href='{{ route('nursery.quote') }}'"
                                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                        Demander un devis
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection 