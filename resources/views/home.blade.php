@extends('layouts.app')

@section('content')
    <!-- Hero Section avec Slider -->
    <div class="relative">
        <x-home.slider :slides="$slides" />
    </div>

    <!-- Section Services -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12">Nos Services</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($services as $service)
                    <x-home.service-card :service="$service" />
                @endforeach
            </div>
        </div>
    </section>

    <!-- Services Showcase -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-center mb-4">Nos Services Professionnels</h2>
            <p class="text-xl text-gray-600 text-center mb-16 max-w-3xl mx-auto">
                Découvrez notre gamme complète de services professionnels pour tous vos projets immobiliers et de construction
            </p>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-16">
                @foreach($services as $service)
                    <div class="bg-white rounded-2xl overflow-hidden shadow-lg transform hover:-translate-y-1 transition-all duration-300">
                        <div class="relative h-64 overflow-hidden" 
                             x-data="{ 
                                 currentImage: 0,
                                 images: {{ json_encode($service['images']) }},
                                 autoplayInterval: null,
                                 
                                 init() {
                                     this.autoplayInterval = setInterval(() => {
                                         this.nextImage();
                                     }, 3000);
                                 },
                                 
                                 nextImage() {
                                     this.currentImage = (this.currentImage + 1) % this.images.length;
                                 },
                                 
                                 previousImage() {
                                     this.currentImage = (this.currentImage - 1 + this.images.length) % this.images.length;
                                 }
                             }"
                             @mouseenter="clearInterval(autoplayInterval)"
                             @mouseleave="autoplayInterval = setInterval(() => nextImage(), 3000)">
                            
                            <!-- Images -->
                            @foreach($service['images'] as $index => $image)
                                <div x-show="currentImage === {{ $index }}"
                                     x-transition:enter="transition ease-out duration-300"
                                     x-transition:enter-start="opacity-0 transform scale-95"
                                     x-transition:enter-end="opacity-100 transform scale-100"
                                     x-transition:leave="transition ease-in duration-200"
                                     x-transition:leave-start="opacity-100 transform scale-100"
                                     x-transition:leave-end="opacity-0 transform scale-95"
                                     class="absolute inset-0 group">
                                    <img src="{{ asset($image) }}" 
                                         alt="{{ $service['title'] }}" 
                                         class="w-full h-full object-cover transform transition-transform duration-500 group-hover:scale-110">
                                    <!-- Blur Overlay -->
                                    <div class="absolute inset-0 bg-black/30 backdrop-blur-[2px] transition-all duration-300 group-hover:bg-black/20 group-hover:backdrop-blur-none"></div>
                                    <!-- Content Overlay -->
                                    <div class="absolute inset-0 flex flex-col justify-end p-6 text-white">
                                        <h3 class="text-2xl font-bold mb-2 transform transition-transform duration-300 group-hover:translate-y-0">
                                            {{ $service['title'] }}
                                        </h3>
                                        <p class="text-gray-200 transform transition-transform duration-300 group-hover:translate-y-0">
                                            {{ $service['description'] }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                            
                            <!-- Navigation Arrows -->
                            <button @click.prevent="previousImage()" 
                                    class="absolute left-2 top-1/2 transform -translate-y-1/2 bg-black/50 hover:bg-black/70 text-white rounded-full p-3 transition-all duration-300 backdrop-blur-sm z-10">
                                <i class="fas fa-chevron-left"></i>
                            </button>
                            <button @click.prevent="nextImage()" 
                                    class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-black/50 hover:bg-black/70 text-white rounded-full p-3 transition-all duration-300 backdrop-blur-sm z-10">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                            
                            <!-- Indicators -->
                            <div class="absolute bottom-2 left-1/2 transform -translate-x-1/2 flex space-x-2 z-10">
                                @foreach($service['images'] as $index => $image)
                                    <button @click="currentImage = {{ $index }}"
                                            :class="{'bg-white': currentImage === {{ $index }}, 'bg-white/50': currentImage !== {{ $index }}}"
                                            class="w-2 h-2 rounded-full transition-all duration-300 hover:bg-white/90"></button>
                                @endforeach
                            </div>
                        </div>
                        
                        <div class="p-6">
                            <!-- Stats -->
                            <div class="grid grid-cols-3 gap-4 mb-6">
                                @foreach($service['stats'] as $stat)
                                    <div class="text-center">
                                        <p class="text-primary-600 font-semibold">{{ $stat }}</p>
                                    </div>
                                @endforeach
                            </div>
                            
                            <!-- Features -->
                            <div class="space-y-3 mb-6">
                                @foreach($service['features'] as $feature)
                                    <div class="flex items-center text-gray-700">
                                        <i class="fas fa-check-circle text-primary-600 mr-2"></i>
                                        <span>{{ $feature }}</span>
                                    </div>
                                @endforeach
                            </div>
                            
                            <!-- Action Button -->
                            <a href="{{ $service['link'] }}" 
                               class="block w-full text-center bg-primary-600 text-white py-3 rounded-lg font-semibold hover:bg-primary-700 transition-colors duration-300">
                                Découvrir Plus
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <!-- Bottom CTA -->
            <div class="text-center">
                <a href="/services" 
                   class="inline-flex items-center text-primary-600 font-semibold hover:text-primary-700 transition-colors duration-300">
                    Voir tous nos services 
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="relative bg-gradient-to-r from-gray-50 to-white py-20 overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23000000' fill-opacity='0.4'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');">
            </div>
        </div>
        
        <div class="container mx-auto px-4 text-center">
            <div class="max-w-3xl mx-auto relative">
                <h2 class="text-4xl md:text-5xl font-bold mb-6 leading-tight text-gray-900">
                    Prêt à démarrer votre projet ?
                </h2>
                <p class="text-xl md:text-2xl mb-12 text-primary-600">
                    Contactez-nous dès aujourd'hui pour une consultation gratuite
                </p>
                <div class="flex flex-col sm:flex-row justify-center items-center gap-4 sm:space-x-6">
                    <a href="/contact" 
                        class="w-full sm:w-auto bg-primary-600 text-white px-8 py-4 rounded-lg font-semibold hover:bg-primary-700 transform hover:scale-105 transition-all duration-300 shadow-lg">
                        Nous Contacter
                    </a>
                    <a href="/services" 
                        class="w-full sm:w-auto border-2 border-primary-600 text-primary-600 px-8 py-4 rounded-lg font-semibold hover:bg-primary-600 hover:text-white transform hover:scale-105 transition-all duration-300">
                        Voir les Offres
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection 