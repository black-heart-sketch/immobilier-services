<a href="{{ route('cart.index') }}" class="group -m-2 p-2 flex items-center">
    <svg class="flex-shrink-0 h-6 w-6 text-gray-400 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
    </svg>
    @if($count > 0)
        <span class="ml-2 text-sm font-medium text-gray-700 group-hover:text-gray-800">{{ $count }}</span>
    @endif
    <span class="sr-only">articles dans le panier</span>
</a> 