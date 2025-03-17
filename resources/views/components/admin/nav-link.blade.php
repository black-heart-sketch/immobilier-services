@props(['route', 'icon'])

@php
$isActive = request()->routeIs($route);
@endphp

<a href="{{ route($route) }}" 
   class="group flex items-center px-2 py-2 text-sm font-medium rounded-md {{ $isActive ? 'bg-primary-50 text-primary-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
    <i class="fas {{ $icon }} mr-3 flex-shrink-0 h-6 w-6 {{ $isActive ? 'text-primary-600' : 'text-gray-400 group-hover:text-gray-500' }}"></i>
    {{ $slot }}
</a> 