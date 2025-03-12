@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="px-4 py-6 sm:px-0">
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    Commande #{{ $order->id }}
                </h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500">
                    Passée le {{ $order->created_at->format('d/m/Y à H:i') }}
                </p>
            </div>
            <div class="border-t border-gray-200">
                <dl>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Statut</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ ucfirst($order->status) }}
                        </dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Total</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ number_format($order->total_amount, 0, ',', ' ') }} FCFA
                        </dd>
                    </div>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Articles</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            <ul class="border border-gray-200 rounded-md divide-y divide-gray-200">
                                @foreach($order->items as $item)
                                <li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
                                    <div class="w-0 flex-1 flex items-center">
                                        <span class="ml-2 flex-1 w-0 truncate">
                                            {{ $item->plant->name }} x {{ $item->quantity }}
                                        </span>
                                    </div>
                                    <div class="ml-4 flex-shrink-0">
                                        {{ number_format($item->unit_price * $item->quantity, 0, ',', ' ') }} FCFA
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>
</div>
@endsection 