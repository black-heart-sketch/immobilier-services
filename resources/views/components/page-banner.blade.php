@props(['title', 'description' => '', 'image'])

<div class="relative bg-gray-800">
    <div class="absolute inset-0">
        <img class="w-full h-full object-cover opacity-70" src="{{ asset($image) }}" alt="{{ $title }}">
        <div class="absolute inset-0 bg-gray-800/50 mix-blend-multiply" aria-hidden="true"></div>
    </div>
    <div class="relative max-w-7xl mx-auto py-24 px-4 sm:py-32 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-extrabold tracking-tight text-white drop-shadow-lg sm:text-5xl lg:text-6xl">{{ $title }}</h1>
        @if($description)
            <p class="mt-6 text-xl text-white drop-shadow-md max-w-3xl">
                {{ $description }}
            </p>
        @endif
        {{ $slot }}
    </div>
</div> 