<header x-data="{ mobileMenuOpen: false, dropdownOpen: false }" class="bg-white shadow-md">
    <!-- Top Bar -->
    <div class="bg-primary-600 text-white py-2">
        <div class="container mx-auto px-4 flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <a href="mailto:contact@example.com" class="text-sm hover:text-primary-200">
                    <i class="fas fa-envelope mr-2"></i>contact@example.com
                </a>
                <a href="tel:+123456789" class="text-sm hover:text-primary-200">
                    <i class="fas fa-phone mr-2"></i>+123 456 789
                </a>
            </div>
            <div class="flex items-center space-x-4">
                <a href="#" class="hover:text-primary-200"><i class="fab fa-facebook"></i></a>
                <a href="#" class="hover:text-primary-200"><i class="fab fa-instagram"></i></a>
                <a href="#" class="hover:text-primary-200"><i class="fab fa-linkedin"></i></a>
            </div>
        </div>
    </div>

    <!-- Main Navigation -->
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center py-4 relative">
            <!-- Logo -->
            <div class="flex-shrink-0 w-48">
                <a href="{{ route('home') }}" class="flex items-center">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-12 w-auto">
                </a>
            </div>

            <!-- Desktop Navigation -->
            <nav class="hidden lg:flex items-center space-x-6 ml-auto">
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" @click.away="open = false" 
                            class="group inline-flex items-center px-4 py-2 hover:text-primary-600 relative">
                        Immobilier
                        <i class="fas fa-chevron-down ml-2 text-sm"></i>
                        <span class="absolute bottom-0 left-0 w-full h-0.5 bg-primary-600 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></span>
                    </button>
                    <div x-show="open" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 translate-y-1"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         class="absolute z-10 mt-3 transform w-screen max-w-md px-2">
                        <div class="rounded-lg shadow-lg ring-1 ring-black ring-opacity-5 overflow-hidden">
                            <div class="relative grid gap-6 bg-white px-5 py-6 sm:gap-8 sm:p-8">
                                <a href="{{ route('properties.terrains') }}" 
                                   class="flex items-start hover:bg-gray-50 -m-3 p-3 rounded-lg transition-all duration-300 group">
                                    <i class="fas fa-home text-primary-600 text-2xl"></i>
                                    <div class="ml-4">
                                        <p class="text-base font-medium text-gray-900">Vente de Terrains</p>
                                        <p class="mt-1 text-sm text-gray-500">Trouvez le terrain idéal pour votre projet</p>
                                    </div>
                                    <div class="ml-auto opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        <i class="fas fa-arrow-right text-primary-600"></i>
                                    </div>
                                </a>
                                <a href="{{ route('properties.maisons') }}"
                                   class="flex items-start hover:bg-gray-50 -m-3 p-3 rounded-lg transition-all duration-300 group">
                                    <i class="fas fa-building text-primary-600 text-2xl"></i>
                                    <div class="ml-4">
                                        <p class="text-base font-medium text-gray-900">Vente de Maisons</p>
                                        <p class="mt-1 text-sm text-gray-500">Découvrez nos maisons disponibles</p>
                                    </div>
                                    <div class="ml-auto opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        <i class="fas fa-arrow-right text-primary-600"></i>
                                    </div>
                                </a>
                                <a href="{{ route('properties.map') }}"
                                   class="flex items-start hover:bg-gray-50 -m-3 p-3 rounded-lg transition-all duration-300 group">
                                    <i class="fas fa-map-marked-alt text-primary-600 text-2xl"></i>
                                    <div class="ml-4">
                                        <p class="text-base font-medium text-gray-900">Carte Interactive</p>
                                        <p class="mt-1 text-sm text-gray-500">Visualisez tous nos biens sur la carte</p>
                                    </div>
                                    <div class="ml-auto opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        <i class="fas fa-arrow-right text-primary-600"></i>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" @click.away="open = false" 
                            class="group inline-flex items-center px-4 py-2 hover:text-primary-600 relative">
                        Topographie
                        <i class="fas fa-chevron-down ml-2 text-sm"></i>
                        <span class="absolute bottom-0 left-0 w-full h-0.5 bg-primary-600 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></span>
                    </button>
                    <div x-show="open" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 translate-y-1"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         @click.away="open = false"
                         class="absolute z-10 mt-3 transform w-screen max-w-md px-2">
                        <div class="rounded-lg shadow-lg ring-1 ring-black ring-opacity-5 overflow-hidden">
                            <div class="relative grid gap-6 bg-white px-5 py-6 sm:gap-8 sm:p-8">
                                <a href="{{ route('topography.index') }}#services" 
                                   class="flex items-start hover:bg-gray-50 -m-3 p-3 rounded-lg transition-all duration-300 group">
                                    <i class="fas fa-ruler text-primary-600 text-2xl"></i>
                                    <div class="ml-4">
                                        <p class="text-base font-medium text-gray-900">Nos Services</p>
                                        <p class="mt-1 text-sm text-gray-500">Découvrez nos services de topographie</p>
                                    </div>
                                    <div class="ml-auto opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        <i class="fas fa-arrow-right text-primary-600"></i>
                                    </div>
                                </a>
                                <a href="{{ route('topography.index') }}#projects" 
                                   class="flex items-start hover:bg-gray-50 -m-3 p-3 rounded-lg transition-all duration-300 group">
                                    <i class="fas fa-project-diagram text-primary-600 text-2xl"></i>
                                    <div class="ml-4">
                                        <p class="text-base font-medium text-gray-900">Réalisations</p>
                                        <p class="mt-1 text-sm text-gray-500">Nos projets récents</p>
                                    </div>
                                    <div class="ml-auto opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        <i class="fas fa-arrow-right text-primary-600"></i>
                                    </div>
                                </a>
                                <a href="{{ route('topography.index') }}#quote" 
                                   class="flex items-start hover:bg-gray-50 -m-3 p-3 rounded-lg transition-all duration-300 group">
                                    <i class="fas fa-calculator text-primary-600 text-2xl"></i>
                                    <div class="ml-4">
                                        <p class="text-base font-medium text-gray-900">Devis</p>
                                        <p class="mt-1 text-sm text-gray-500">Demandez un devis personnalisé</p>
                                    </div>
                                    <div class="ml-auto opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        <i class="fas fa-arrow-right text-primary-600"></i>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" @click.away="open = false" 
                            class="group inline-flex items-center px-4 py-2 hover:text-primary-600 relative">
                        BTP
                        <i class="fas fa-chevron-down ml-2 text-sm"></i>
                        <span class="absolute bottom-0 left-0 w-full h-0.5 bg-primary-600 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></span>
                    </button>
                    <div x-show="open" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 translate-y-1"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         @click.away="open = false"
                         class="absolute z-10 mt-3 transform w-screen max-w-md px-2">
                        <div class="rounded-lg shadow-lg ring-1 ring-black ring-opacity-5 overflow-hidden">
                            <div class="relative grid gap-6 bg-white px-5 py-6 sm:gap-8 sm:p-8">
                                <a href="{{ route('btp.index') }}#services" 
                                   class="flex items-start hover:bg-gray-50 -m-3 p-3 rounded-lg transition-all duration-300 group">
                                    <i class="fas fa-building text-primary-600 text-2xl"></i>
                                    <div class="ml-4">
                                        <p class="text-base font-medium text-gray-900">Services BTP</p>
                                        <p class="mt-1 text-sm text-gray-500">Construction, rénovation et aménagement</p>
                                    </div>
                                    <div class="ml-auto opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        <i class="fas fa-arrow-right text-primary-600"></i>
                                    </div>
                                </a>
                                <a href="{{ route('btp.index') }}#projects" 
                                   class="flex items-start hover:bg-gray-50 -m-3 p-3 rounded-lg transition-all duration-300 group">
                                    <i class="fas fa-hard-hat text-primary-600 text-2xl"></i>
                                    <div class="ml-4">
                                        <p class="text-base font-medium text-gray-900">Nos Réalisations</p>
                                        <p class="mt-1 text-sm text-gray-500">Découvrez nos projets avant/après</p>
                                    </div>
                                    <div class="ml-auto opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        <i class="fas fa-arrow-right text-primary-600"></i>
                                    </div>
                                </a>
                                <a href="{{ route('btp.index') }}#quote" 
                                   class="flex items-start hover:bg-gray-50 -m-3 p-3 rounded-lg transition-all duration-300 group">
                                    <i class="fas fa-file-invoice-dollar text-primary-600 text-2xl"></i>
                                    <div class="ml-4">
                                        <p class="text-base font-medium text-gray-900">Devis Gratuit</p>
                                        <p class="mt-1 text-sm text-gray-500">Demandez un devis personnalisé</p>
                                    </div>
                                    <div class="ml-auto opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        <i class="fas fa-arrow-right text-primary-600"></i>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" @click.away="open = false" 
                            class="group inline-flex items-center px-4 py-2 hover:text-primary-600 relative">
                        Décoration
                        <i class="fas fa-chevron-down ml-2 text-sm"></i>
                        <span class="absolute bottom-0 left-0 w-full h-0.5 bg-primary-600 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></span>
                    </button>
                    <div x-show="open" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 translate-y-1"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         @click.away="open = false"
                         class="absolute z-10 mt-3 transform w-screen max-w-md px-2">
                        <div class="rounded-lg shadow-lg ring-1 ring-black ring-opacity-5 overflow-hidden">
                            <div class="relative grid gap-6 bg-white px-5 py-6 sm:gap-8 sm:p-8">
                                <a href="{{ route('decoration.index') }}#services" 
                                   class="flex items-start hover:bg-gray-50 -m-3 p-3 rounded-lg transition-all duration-300 group">
                                    <i class="fas fa-paint-roller text-primary-600 text-2xl"></i>
                                    <div class="ml-4">
                                        <p class="text-base font-medium text-gray-900">Nos Services</p>
                                        <p class="mt-1 text-sm text-gray-500">Design d'intérieur et ameublement</p>
                                    </div>
                                    <div class="ml-auto opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        <i class="fas fa-arrow-right text-primary-600"></i>
                                    </div>
                                </a>
                                <a href="{{ route('decoration.portfolio') }}" 
                                   class="flex items-start hover:bg-gray-50 -m-3 p-3 rounded-lg transition-all duration-300 group">
                                    <i class="fas fa-images text-primary-600 text-2xl"></i>
                                    <div class="ml-4">
                                        <p class="text-base font-medium text-gray-900">Portfolio</p>
                                        <p class="mt-1 text-sm text-gray-500">Découvrez nos réalisations</p>
                                    </div>
                                    <div class="ml-auto opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        <i class="fas fa-arrow-right text-primary-600"></i>
                                    </div>
                                </a>
                                <a href="{{ route('decoration.blog') }}" 
                                   class="flex items-start hover:bg-gray-50 -m-3 p-3 rounded-lg transition-all duration-300 group">
                                    <i class="fas fa-book-open text-primary-600 text-2xl"></i>
                                    <div class="ml-4">
                                        <p class="text-base font-medium text-gray-900">Blog & Conseils</p>
                                        <p class="mt-1 text-sm text-gray-500">Articles et astuces déco</p>
                                    </div>
                                    <div class="ml-auto opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        <i class="fas fa-arrow-right text-primary-600"></i>
                                    </div>
                                </a>
                                <a href="{{ route('decoration.index') }}#consultation" 
                                   class="flex items-start hover:bg-gray-50 -m-3 p-3 rounded-lg transition-all duration-300 group">
                                    <i class="fas fa-comments text-primary-600 text-2xl"></i>
                                    <div class="ml-4">
                                        <p class="text-base font-medium text-gray-900">Consultation</p>
                                        <p class="mt-1 text-sm text-gray-500">Prenez rendez-vous avec un expert</p>
                                    </div>
                                    <div class="ml-auto opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        <i class="fas fa-arrow-right text-primary-600"></i>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" @click.away="open = false" 
                            class="group inline-flex items-center px-4 py-2 hover:text-primary-600 relative">
                        Location d'Engins
                        <i class="fas fa-chevron-down ml-2 text-sm"></i>
                        <span class="absolute bottom-0 left-0 w-full h-0.5 bg-primary-600 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></span>
                    </button>
                    <div x-show="open" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 translate-y-1"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         @click.away="open = false"
                         class="absolute z-10 mt-3 transform w-screen max-w-md px-2">
                        <div class="rounded-lg shadow-lg ring-1 ring-black ring-opacity-5 overflow-hidden">
                            <div class="relative grid gap-6 bg-white px-5 py-6 sm:gap-8 sm:p-8">
                                <a href="{{ route('equipment.index') }}" 
                                   class="flex items-start hover:bg-gray-50 -m-3 p-3 rounded-lg transition-all duration-300 group">
                                    <i class="fas fa-truck text-primary-600 text-2xl"></i>
                                    <div class="ml-4">
                                        <p class="text-base font-medium text-gray-900">Catalogue</p>
                                        <p class="mt-1 text-sm text-gray-500">Tous nos équipements disponibles</p>
                                    </div>
                                    <div class="ml-auto opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        <i class="fas fa-arrow-right text-primary-600"></i>
                                    </div>
                                </a>
                                <a href="{{ route('equipment.index', ['type' => 'excavator']) }}" 
                                   class="flex items-start hover:bg-gray-50 -m-3 p-3 rounded-lg transition-all duration-300 group">
                                    <i class="fas fa-truck-monster text-primary-600 text-2xl"></i>
                                    <div class="ml-4">
                                        <p class="text-base font-medium text-gray-900">Pelles & Excavateurs</p>
                                        <p class="mt-1 text-sm text-gray-500">Équipements de terrassement</p>
                                    </div>
                                    <div class="ml-auto opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        <i class="fas fa-arrow-right text-primary-600"></i>
                                    </div>
                                </a>
                                @auth
                                    <a href="{{ route('equipment.index', ['filter' => 'rented']) }}" 
                                       class="flex items-start hover:bg-gray-50 -m-3 p-3 rounded-lg transition-all duration-300 group">
                                        <i class="fas fa-clipboard-list text-primary-600 text-2xl"></i>
                                        <div class="ml-4">
                                            <p class="text-base font-medium text-gray-900">Mes Locations</p>
                                            <p class="mt-1 text-sm text-gray-500">Gérer vos locations en cours</p>
                                        </div>
                                        <div class="ml-auto opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                            <i class="fas fa-arrow-right text-primary-600"></i>
                                        </div>
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" @click.away="open = false" 
                            class="group inline-flex items-center px-4 py-2 hover:text-primary-600 relative">
                        Pépinière
                        <i class="fas fa-chevron-down ml-2 text-sm"></i>
                        <span class="absolute bottom-0 left-0 w-full h-0.5 bg-primary-600 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></span>
                    </button>
                    <div x-show="open" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 translate-y-1"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         @click.away="open = false"
                         class="absolute z-10 mt-3 transform w-screen max-w-md px-2">
                        <div class="rounded-lg shadow-lg ring-1 ring-black ring-opacity-5 overflow-hidden">
                            <div class="relative grid gap-6 bg-white px-5 py-6 sm:gap-8 sm:p-8">
                                <a href="{{ route('nursery.index') }}" 
                                   class="flex items-start hover:bg-gray-50 -m-3 p-3 rounded-lg transition-all duration-300 group">
                                    <i class="fas fa-seedling text-primary-600 text-2xl"></i>
                                    <div class="ml-4">
                                        <p class="text-base font-medium text-gray-900">Catalogue</p>
                                        <p class="mt-1 text-sm text-gray-500">Découvrez nos plantes et arbres</p>
                                    </div>
                                    <div class="ml-auto opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        <i class="fas fa-arrow-right text-primary-600"></i>
                                    </div>
                                </a>
                                <a href="{{ route('nursery.guide') }}" 
                                   class="flex items-start hover:bg-gray-50 -m-3 p-3 rounded-lg transition-all duration-300 group">
                                    <i class="fas fa-book text-primary-600 text-2xl"></i>
                                    <div class="ml-4">
                                        <p class="text-base font-medium text-gray-900">Guide d'entretien</p>
                                        <p class="mt-1 text-sm text-gray-500">Conseils pour vos plantes</p>
                                    </div>
                                    <div class="ml-auto opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        <i class="fas fa-arrow-right text-primary-600"></i>
                                    </div>
                                </a>
                                <a href="{{ route('cart.index') }}" 
                                   class="flex items-start hover:bg-gray-50 -m-3 p-3 rounded-lg transition-all duration-300 group">
                                    <i class="fas fa-shopping-cart text-primary-600 text-2xl"></i>
                                    <div class="ml-4">
                                        <p class="text-base font-medium text-gray-900">Mon Panier</p>
                                        @if(session('cart_count'))
                                            <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                {{ session('cart_count') }}
                                            </span>
                                        @endif
                                    </div>
                                    <div class="ml-auto opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        <i class="fas fa-arrow-right text-primary-600"></i>
                                    </div>
                                </a>
                                @auth
                                    <a href="{{ route('nursery.orders') }}" 
                                       class="flex items-start hover:bg-gray-50 -m-3 p-3 rounded-lg transition-all duration-300 group">
                                        <i class="fas fa-list-alt text-primary-600 text-2xl"></i>
                                        <div class="ml-4">
                                            <p class="text-base font-medium text-gray-900">Mes Commandes</p>
                                            <p class="mt-1 text-sm text-gray-500">Suivre vos commandes</p>
                                        </div>
                                        <div class="ml-auto opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                            <i class="fas fa-arrow-right text-primary-600"></i>
                                        </div>
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Contact Button -->
            <div class="hidden lg:flex items-center ml-6">
                <a href="{{ route('contact.index') }}" class="bg-primary-600 text-white px-6 py-2 rounded-lg hover:bg-primary-700 transition">
                    Nous Contacter
                </a>
            </div>

            <!-- Mobile menu button -->
            <div class="lg:hidden">
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-gray-500 hover:text-primary-600">
                    <i x-show="!mobileMenuOpen" class="fas fa-bars text-2xl"></i>
                    <i x-show="mobileMenuOpen" class="fas fa-times text-2xl"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Navigation -->
    <div x-show="mobileMenuOpen" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 transform -translate-y-2"
         x-transition:enter-end="opacity-100 transform translate-y-0"
         class="lg:hidden">
        <div class="px-2 pt-2 pb-3 space-y-1">
            <a href="/terrains" class="block px-3 py-2 hover:bg-primary-50 hover:text-primary-600">Vente de Terrains</a>
            <a href="/maisons" class="block px-3 py-2 hover:bg-primary-50 hover:text-primary-600">Vente de Maisons</a>
            <a href="/topographie" class="block px-3 py-2 hover:bg-primary-50 hover:text-primary-600">Topographie</a>
            <a href="/btp" class="block px-3 py-2 hover:bg-primary-50 hover:text-primary-600">BTP</a>
            <a href="/decoration" class="block px-3 py-2 hover:bg-primary-50 hover:text-primary-600">Décoration</a>
            <a href="/location-engins" class="block px-3 py-2 hover:bg-primary-50 hover:text-primary-600">Location d'Engins</a>
            <a href="/pepinieres" class="block px-3 py-2 hover:bg-primary-50 hover:text-primary-600">Pépinières</a>
            <a href="/contact" class="block px-3 py-2 bg-primary-600 text-white rounded-lg mt-2">Nous Contacter</a>
        </div>
    </div>
</header> 