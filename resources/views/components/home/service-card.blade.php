<div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition-shadow duration-300">
    <div class="text-primary-600 text-3xl mb-4">
        <i class="fas {{ $service['icon'] }}"></i>
    </div>
    <h3 class="text-xl font-semibold mb-3">{{ $service['title'] }}</h3>
    <p class="text-gray-600 mb-4">{{ $service['description'] }}</p>
    <a href="{{ $service['link'] }}" class="text-primary-600 hover:text-primary-700 font-medium">
        En savoir plus <i class="fas fa-arrow-right ml-2"></i>
    </a>
</div> 