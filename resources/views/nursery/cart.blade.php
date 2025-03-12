@extends('layouts.app')

@section('content')
<div class="bg-white">
    <div class="max-w-2xl mx-auto pt-16 pb-24 px-4 sm:px-6 lg:max-w-7xl lg:px-8">
        <h1 class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">Panier</h1>
        
        @if($cartItems->count() > 0)
            <form class="mt-12 lg:grid lg:grid-cols-12 lg:gap-x-12 lg:items-start xl:gap-x-16">
                <section aria-labelledby="cart-heading" class="lg:col-span-7">
                    <h2 id="cart-heading" class="sr-only">Articles dans votre panier</h2>

                    <ul role="list" class="border-t border-b border-gray-200 divide-y divide-gray-200">
                        @foreach($cartItems as $item)
                            <li class="flex py-6 sm:py-10" data-item-id="{{ $item->id }}">
                                <div class="flex-shrink-0">
                                    <img src="{{ asset($item->plant->image) }}" 
                                         alt="{{ $item->plant->name }}" 
                                         class="w-24 h-24 rounded-md object-center object-cover sm:w-48 sm:h-48">
                                </div>

                                <div class="ml-4 flex-1 flex flex-col justify-between sm:ml-6">
                                    <div class="relative pr-9 sm:grid sm:grid-cols-2 sm:gap-x-6 sm:pr-0">
                                        <div>
                                            <div class="flex justify-between">
                                                <h3 class="text-sm">
                                                    <a href="{{ route('nursery.show', $item->plant) }}" class="font-medium text-gray-700 hover:text-gray-800">
                                                        {{ $item->plant->name }}
                                                    </a>
                                                </h3>
                                            </div>
                                            <div class="mt-1 flex text-sm">
                                                <p class="text-gray-500">{{ $item->plant->category }}</p>
                                            </div>
                                            <p class="mt-1 text-sm font-medium text-gray-900">{{ number_format($item->price, 0, ',', ' ') }} FCFA</p>
                                        </div>

                                        <div class="mt-4 sm:mt-0 sm:pr-9">
                                            <label for="quantity-{{ $item->id }}" class="sr-only">Quantité</label>
                                            <select id="quantity-{{ $item->id }}" 
                                                    name="quantity-{{ $item->id }}" 
                                                    class="max-w-full rounded-md border border-gray-300 py-1.5 text-base leading-5 font-medium text-gray-700 text-left shadow-sm focus:outline-none focus:ring-1 focus:ring-green-500 focus:border-green-500 sm:text-sm"
                                                    data-action="update-quantity">
                                                @for($i = 1; $i <= min(10, $item->plant->stock); $i++)
                                                    <option value="{{ $i }}" {{ $item->quantity == $i ? 'selected' : '' }}>
                                                        {{ $i }}
                                                    </option>
                                                @endfor
                                            </select>

                                            <div class="absolute top-0 right-0">
                                                <button type="button" 
                                                        class="-m-2 p-2 inline-flex text-gray-400 hover:text-gray-500"
                                                        data-action="remove-item">
                                                    <span class="sr-only">Supprimer</span>
                                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <p class="mt-4 flex text-sm text-gray-700 space-x-2">
                                        <svg class="flex-shrink-0 h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                        </svg>
                                        <span>En stock</span>
                                    </p>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </section>

                <!-- Order summary -->
                <section aria-labelledby="summary-heading" class="mt-16 bg-gray-50 rounded-lg px-4 py-6 sm:p-6 lg:p-8 lg:mt-0 lg:col-span-5">
                    <h2 id="summary-heading" class="text-lg font-medium text-gray-900">Résumé de la commande</h2>

                    <dl class="mt-6 space-y-4">
                        <div class="flex items-center justify-between">
                            <dt class="text-sm text-gray-600">Sous-total</dt>
                            <dd class="text-sm font-medium text-gray-900">{{ number_format($total, 0, ',', ' ') }} FCFA</dd>
                        </div>
                        <div class="border-t border-gray-200 pt-4 flex items-center justify-between">
                            <dt class="text-base font-medium text-gray-900">Total</dt>
                            <dd class="text-base font-medium text-gray-900">{{ number_format($total, 0, ',', ' ') }} FCFA</dd>
                        </div>
                    </dl>

                    <div class="mt-6">
                        <button type="submit" class="w-full bg-green-600 border border-transparent rounded-md shadow-sm py-3 px-4 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-50 focus:ring-green-500">
                            Passer la commande
                        </button>
                    </div>
                </section>
            </form>
        @else
            <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">Votre panier est vide</h3>
                <p class="mt-1 text-sm text-gray-500">Commencez vos achats en visitant notre catalogue de plantes.</p>
                <div class="mt-6">
                    <a href="{{ route('nursery.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        Voir le catalogue
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Update quantity
    document.querySelectorAll('[data-action="update-quantity"]').forEach(select => {
        select.addEventListener('change', function() {
            const itemId = this.closest('li').dataset.itemId;
            fetch(`/cart/${itemId}`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    quantity: this.value
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.reload();
                }
            });
        });
    });

    // Remove item
    document.querySelectorAll('[data-action="remove-item"]').forEach(button => {
        button.addEventListener('click', function() {
            const itemId = this.closest('li').dataset.itemId;
            fetch(`/cart/${itemId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.reload();
                }
            });
        });
    });
});
</script>
@endpush
@endsection 