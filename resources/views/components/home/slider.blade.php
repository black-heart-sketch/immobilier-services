<div x-data="{ 
    currentSlide: 0,
    slides: {{ json_encode($slides) }},
    autoplayInterval: null,
    
    init() {
        this.autoplayInterval = setInterval(() => {
            this.nextSlide();
        }, 8000);
    },
    
    nextSlide() {
        this.currentSlide = (this.currentSlide + 1) % this.slides.length;
    },
    
    previousSlide() {
        this.currentSlide = (this.currentSlide - 1 + this.slides.length) % this.slides.length;
    }
}" 
class="relative overflow-hidden"
@mouseenter="clearInterval(autoplayInterval)"
@mouseleave="autoplayInterval = setInterval(() => nextSlide(), 8000)">

    <div class="relative h-[600px]">
        @foreach($slides as $index => $slide)
            <div x-show="currentSlide === {{ $index }}"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 transform translate-x-full"
                 x-transition:enter-end="opacity-100 transform translate-x-0"
                 x-transition:leave="transition ease-in duration-300"
                 x-transition:leave-start="opacity-100 transform translate-x-0"
                 x-transition:leave-end="opacity-0 transform -translate-x-full"
                 class="absolute inset-0 bg-cover bg-center bg-no-repeat"
                 style="background-image: url('{{ asset($slide['image']) }}')">
                <div class="absolute inset-0 {{ $slide['overlay'] }} flex items-center justify-center">
                    <!-- Middle Text (First Appearance) -->
                    <div class="text-center text-white"
                         x-show="currentSlide === {{ $index }}"
                         x-transition:enter="transition ease-out duration-1000"
                         x-transition:enter-start="transform translate-y-8 opacity-0"
                         x-transition:enter-end="transform translate-y-0 opacity-100"
                         x-transition:leave="transition ease-in duration-300"
                         x-transition:leave-start="opacity-100"
                         x-transition:leave-end="opacity-0"
                         style="animation: fadeOutUp 0.5s ease-out 3s forwards;">
                       <h2 class="text-4xl md:text-6xl font-bold mb-4">
                           {{ $slide['title'] }}
                       </h2>
                       <p class="text-xl md:text-2xl">
                           {{ $slide['description'] }}
                       </p>
                   </div>

                   <!-- Bottom Right Text (Second Appearance) -->
                    <div class="absolute bottom-20 right-10 text-right text-white max-w-2xl opacity-0"
                         x-show="currentSlide === {{ $index }}"
                         style="animation: fadeInBottomRight 0.8s ease-out 3.5s forwards;">
                        <h2 class="text-4xl md:text-6xl font-bold mb-4"
                            style="text-shadow: 2px 2px 4px rgba(0,0,0,0.5);">
                            {{ $slide['title'] }}
                        </h2>
                        <p class="text-xl md:text-2xl mb-8"
                            style="text-shadow: 1px 1px 3px rgba(0,0,0,0.5);">
                            {{ $slide['description'] }}
                        </p>
                        <div class="mt-8">
                            <a href="/contact" 
                               class="inline-block bg-primary-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-primary-700 transition-all duration-300 transform hover:scale-105">
                                En savoir plus
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Navigation -->
    <button @click="previousSlide()"
            class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-white bg-opacity-50 rounded-full p-2 hover:bg-opacity-75 transition-all duration-300 hover:scale-110">
        <i class="fas fa-chevron-left text-2xl"></i>
    </button>
    <button @click="nextSlide()"
            class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-white bg-opacity-50 rounded-full p-2 hover:bg-opacity-75 transition-all duration-300 hover:scale-110">
        <i class="fas fa-chevron-right text-2xl"></i>
    </button>

    <!-- Indicators -->
    <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-2">
        @foreach($slides as $index => $slide)
            <button @click="currentSlide = {{ $index }}"
                    :class="{'bg-white': currentSlide === {{ $index }}, 'bg-white/50': currentSlide !== {{ $index }}}"
                    class="w-3 h-3 rounded-full transition-all duration-300 hover:bg-white"></button>
        @endforeach
    </div>
</div> 