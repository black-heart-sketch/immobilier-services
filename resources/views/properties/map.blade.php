@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen">
    <!-- Map Header -->
    <div class="bg-white shadow-sm">
        <div class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-bold text-gray-900">Carte des biens immobiliers</h1>
                <a href="{{ url()->previous() }}" class="text-gray-600 hover:text-primary-600">
                    <i class="fas fa-th-large mr-2"></i>Vue grille
                </a>
            </div>
        </div>
    </div>

    <!-- Map Container -->
    <div class="relative h-[calc(100vh-4rem)]">
        <!-- Map will be rendered here -->
        <div id="map" class="w-full h-full z-0"></div>

        <!-- Property List Sidebar -->
        <div class="absolute top-4 left-4 w-96 bg-white rounded-xl shadow-lg max-h-[calc(100vh-6rem)] overflow-y-auto z-10">
            <div class="p-4">
                <h2 class="text-lg font-semibold mb-4">{{ count($properties) }} biens trouvés</h2>
                
                <!-- Property List -->
                <div class="space-y-4">
                    @foreach($properties as $property)
                        <div class="flex gap-4 p-3 hover:bg-gray-50 rounded-lg cursor-pointer property-card"
                             data-lat="{{ $property->latitude }}"
                             data-lng="{{ $property->longitude }}"
                             onclick="focusProperty({{ $property->latitude }}, {{ $property->longitude }}, {{ $property->id }})">
                            <div class="w-24 h-24 flex-shrink-0">
                                <img src="{{ asset($property->images[0]) }}" 
                                     alt="{{ $property->title }}"
                                     class="w-full h-full object-cover rounded-lg">
                            </div>
                            <div class="flex-1">
                                <h3 class="font-semibold text-gray-900">{{ $property->title }}</h3>
                                <p class="text-sm text-gray-600">{{ $property->location }}</p>
                                <div class="mt-2 flex justify-between items-center">
                                    <span class="text-primary-600 font-semibold">
                                        {{ number_format($property->price, 0, ',', ' ') }} FCFA
                                    </span>
                                    <span class="text-sm text-gray-600">{{ $property->surface_area }} m²</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
let map;
let markers = {};
let activeMarker = null;

// Custom icon for markers
const createIcon = (type) => {
    return L.divIcon({
        className: 'custom-marker',
        html: `<div class="w-8 h-8 rounded-full bg-white shadow-lg flex items-center justify-center">
                <i class="fas ${type === 'terrain' ? 'fa-map' : 'fa-home'} text-primary-600"></i>
               </div>`,
        iconSize: [32, 32],
        iconAnchor: [16, 32],
        popupAnchor: [0, -32]
    });
};

// Initialize map
document.addEventListener('DOMContentLoaded', function() {
    // Create map centered on Abidjan
    map = L.map('map').setView([5.359952, -3.996633], 12);

    // Add OpenStreetMap tiles
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    // Add markers for each property
    const properties = @json($properties);
    const bounds = L.latLngBounds();

    properties.forEach(property => {
        const latLng = [parseFloat(property.latitude), parseFloat(property.longitude)];
        bounds.extend(latLng);

        const marker = L.marker(latLng, {
            icon: createIcon(property.type)
        }).addTo(map);

        // Create popup content
        const popupContent = `
            <div class="p-2 min-w-[200px]">
                <img src="${property.images[0]}" alt="${property.title}" 
                     class="w-full h-32 object-cover mb-2 rounded">
                <h3 class="font-semibold">${property.title}</h3>
                <p class="text-sm text-gray-600">${property.location}</p>
                <p class="text-primary-600 font-semibold mt-1">
                    ${new Intl.NumberFormat('fr-FR').format(property.price)} FCFA
                </p>
                <a href="/properties/${property.id}" 
                   class="mt-2 block text-center bg-primary-600 text-white py-1 px-3 rounded text-sm hover:bg-primary-700">
                    Voir les détails
                </a>
            </div>
        `;

        marker.bindPopup(popupContent);
        markers[property.id] = marker;
    });

    // Fit map to show all markers
    map.fitBounds(bounds, { padding: [50, 50] });
});

function focusProperty(lat, lng, propertyId) {
    map.setView([lat, lng], 16);
    
    // Close any open popup
    map.closePopup();
    
    // Open the popup for this property
    if (markers[propertyId]) {
        markers[propertyId].openPopup();
    }
}

// Add custom styles for markers
const style = document.createElement('style');
style.textContent = `
    .custom-marker {
        background: transparent;
        border: none;
    }
`;
document.head.appendChild(style);
</script>
@endpush
@endsection 