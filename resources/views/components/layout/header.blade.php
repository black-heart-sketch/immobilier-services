<header x-data="{ mobileMenuOpen: false, dropdownOpen: false }" class="bg-white shadow-md">
    <!-- Top Bar -->
    <div class="bg-primary-600 text-white py-2">
        <div class="container mx-auto px-4 flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <a href="mailto:contact@example.com" class="text-sm hover:text-primary-200">
                    <i class="fas fa-envelope mr-2"></i>bikeledon@gmail.com
                </a>
                <a href="tel:+123456789" class="text-sm hover:text-primary-200">
                    <i class="fas fa-phone mr-2"></i>+123 456 789
                </a>
            </div>
            <div class="flex items-center space-x-4">
                <a href="https://www.facebook.com/share/15Wvy5VTP5/?mibextid=wwXIfr" class="hover:text-primary-200"><i class="fab fa-facebook"></i></a>
                <a href="https://www.instagram.com/wise_trust_group?igsh=MW1lNmpydHpyNmp2ZQ%3D%3D&utm_source=qr" class="hover:text-primary-200"><i class="fab fa-instagram"></i></a>
                <a href="#" class="hover:text-primary-200"><i class="fab fa-linkedin"></i></a>
            </div>
        </div>
    </div>

    <!-- Main Navigation -->
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center py-3 relative">
            <!-- Logo -->
            <div class="flex-shrink-0 w-48">
                <a href="{{ route('home') }}" class="flex items-center">
                    <img src="{{ asset('images/logo.jpeg') }}" alt="Logo" class="h-16 w-32 object-contain" width="128" height="64">
                </a>
            </div>

            <!-- Desktop Navigation -->
            <nav class="hidden lg:flex items-center space-x-4 ml-auto">
                <!-- Home Tab -->
                <a href="{{ route('home') }}" class="flex items-center px-3 py-1 hover:text-primary-600">
                    <i class="fas fa-home mr-1"></i>Home
                </a>

                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" @click.away="open = false" 
                            class="group inline-flex items-center px-3 py-1 hover:text-primary-600 relative">
                        <i class="fas fa-home mr-1"></i>Immobilier
                        <i class="fas fa-chevron-down ml-1 text-sm"></i>
                        <span class="absolute bottom-0 left-0 w-full h-0.5 bg-primary-600 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></span>
                    </button>
                    <div x-show="open" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 translate-y-1"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         class="absolute z-10 mt-2 transform w-screen max-w-md px-2">
                        <div class="rounded-lg shadow-lg ring-1 ring-black ring-opacity-5 overflow-hidden">
                            <div class="relative grid gap-4 bg-white px-4 py-4 sm:gap-6 sm:p-6">
                                <a href="{{ route('properties.terrains') }}" 
                                   class="flex items-start hover:bg-gray-50 -m-2 p-2 rounded-lg transition-all duration-300 group">
                                    <i class="fas fa-map-marked-alt text-primary-600 text-xl"></i>
                                    <div class="ml-3">
                                        <p class="text-base font-medium text-gray-900">Vente de Terrains</p>
                                        <p class="mt-1 text-sm text-gray-500">Trouvez le terrain idéal pour votre projet</p>
                                    </div>
                                    <div class="ml-auto opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        <i class="fas fa-arrow-right text-primary-600"></i>
                                    </div>
                                </a>
                                <a href="{{ route('properties.maisons') }}"
                                   class="flex items-start hover:bg-gray-50 -m-2 p-2 rounded-lg transition-all duration-300 group">
                                    <i class="fas fa-building text-primary-600 text-xl"></i>
                                    <div class="ml-3">
                                        <p class="text-base font-medium text-gray-900">Vente de Maisons</p>
                                        <p class="mt-1 text-sm text-gray-500">Découvrez nos maisons disponibles</p>
                                    </div>
                                    <div class="ml-auto opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        <i class="fas fa-arrow-right text-primary-600"></i>
                                    </div>
                                </a>
                                <a href="{{ route('properties.map') }}"
                                   class="flex items-start hover:bg-gray-50 -m-2 p-2 rounded-lg transition-all duration-300 group">
                                    <i class="fas fa-map-marked-alt text-primary-600 text-xl"></i>
                                    <div class="ml-3">
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
                            class="group inline-flex items-center px-3 py-1 hover:text-primary-600 relative">
                        <i class="fas fa-drafting-compass mr-1"></i>Topographie
                        <i class="fas fa-chevron-down ml-1 text-sm"></i>
                        <span class="absolute bottom-0 left-0 w-full h-0.5 bg-primary-600 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></span>
                    </button>
                    <div x-show="open" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 translate-y-1"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         @click.away="open = false"
                         class="absolute z-10 mt-2 transform w-screen max-w-md px-2">
                        <div class="rounded-lg shadow-lg ring-1 ring-black ring-opacity-5 overflow-hidden">
                            <div class="relative grid gap-4 bg-white px-4 py-4 sm:gap-6 sm:p-6">
                                <a href="{{ route('topography.index') }}#services" 
                                   class="flex items-start hover:bg-gray-50 -m-2 p-2 rounded-lg transition-all duration-300 group">
                                    <i class="fas fa-ruler text-primary-600 text-xl"></i>
                                    <div class="ml-3">
                                        <p class="text-base font-medium text-gray-900">Nos Services</p>
                                        <p class="mt-1 text-sm text-gray-500">Découvrez nos services de topographie</p>
                                    </div>
                                    <div class="ml-auto opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        <i class="fas fa-arrow-right text-primary-600"></i>
                                    </div>
                                </a>
                                <a href="{{ route('topography.index') }}#projects" 
                                   class="flex items-start hover:bg-gray-50 -m-2 p-2 rounded-lg transition-all duration-300 group">
                                    <i class="fas fa-project-diagram text-primary-600 text-xl"></i>
                                    <div class="ml-3">
                                        <p class="text-base font-medium text-gray-900">Réalisations</p>
                                        <p class="mt-1 text-sm text-gray-500">Nos projets récents</p>
                                    </div>
                                    <div class="ml-auto opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        <i class="fas fa-arrow-right text-primary-600"></i>
                                    </div>
                                </a>
                                <a href="{{ route('topography.index') }}#quote" 
                                   class="flex items-start hover:bg-gray-50 -m-2 p-2 rounded-lg transition-all duration-300 group">
                                    <i class="fas fa-calculator text-primary-600 text-xl"></i>
                                    <div class="ml-3">
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
                            class="group inline-flex items-center px-3 py-1 hover:text-primary-600 relative">
                        <i class="fas fa-hard-hat mr-1"></i>BTP
                        <i class="fas fa-chevron-down ml-1 text-sm"></i>
                        <span class="absolute bottom-0 left-0 w-full h-0.5 bg-primary-600 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></span>
                    </button>
                    <div x-show="open" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 translate-y-1"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         @click.away="open = false"
                         class="absolute z-10 mt-2 transform w-screen max-w-md px-2">
                        <div class="rounded-lg shadow-lg ring-1 ring-black ring-opacity-5 overflow-hidden">
                            <div class="relative grid gap-4 bg-white px-4 py-4 sm:gap-6 sm:p-6">
                                <a href="{{ route('btp.index') }}#services" 
                                   class="flex items-start hover:bg-gray-50 -m-2 p-2 rounded-lg transition-all duration-300 group">
                                    <i class="fas fa-building text-primary-600 text-xl"></i>
                                    <div class="ml-3">
                                        <p class="text-base font-medium text-gray-900">Services BTP</p>
                                        <p class="mt-1 text-sm text-gray-500">Construction, rénovation et aménagement</p>
                                    </div>
                                    <div class="ml-auto opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        <i class="fas fa-arrow-right text-primary-600"></i>
                                    </div>
                                </a>
                                <a href="{{ route('btp.index') }}#projects" 
                                   class="flex items-start hover:bg-gray-50 -m-2 p-2 rounded-lg transition-all duration-300 group">
                                    <i class="fas fa-hard-hat text-primary-600 text-xl"></i>
                                    <div class="ml-3">
                                        <p class="text-base font-medium text-gray-900">Nos Réalisations</p>
                                        <p class="mt-1 text-sm text-gray-500">Découvrez nos projets avant/après</p>
                                    </div>
                                    <div class="ml-auto opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        <i class="fas fa-arrow-right text-primary-600"></i>
                                    </div>
                                </a>
                                <a href="{{ route('btp.index') }}#quote" 
                                   class="flex items-start hover:bg-gray-50 -m-2 p-2 rounded-lg transition-all duration-300 group">
                                    <i class="fas fa-file-invoice-dollar text-primary-600 text-xl"></i>
                                    <div class="ml-3">
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
                            class="group inline-flex items-center px-3 py-1 hover:text-primary-600 relative">
                        <i class="fas fa-paint-brush mr-1"></i>Décoration
                        <i class="fas fa-chevron-down ml-1 text-sm"></i>
                        <span class="absolute bottom-0 left-0 w-full h-0.5 bg-primary-600 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></span>
                    </button>
                    <div x-show="open" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 translate-y-1"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         @click.away="open = false"
                         class="absolute z-10 mt-2 transform w-screen max-w-md px-2">
                        <div class="rounded-lg shadow-lg ring-1 ring-black ring-opacity-5 overflow-hidden">
                            <div class="relative grid gap-4 bg-white px-4 py-4 sm:gap-6 sm:p-6">
                                <a href="{{ route('decoration.index') }}#services" 
                                   class="flex items-start hover:bg-gray-50 -m-2 p-2 rounded-lg transition-all duration-300 group">
                                    <i class="fas fa-paint-brush text-primary-600 text-xl"></i>
                                    <div class="ml-3">
                                        <p class="text-base font-medium text-gray-900">Nos Services</p>
                                        <p class="mt-1 text-sm text-gray-500">Décoration intérieure et extérieure</p>
                                    </div>
                                    <div class="ml-auto opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        <i class="fas fa-arrow-right text-primary-600"></i>
                                    </div>
                                </a>
                                <a href="{{ route('decoration.index') }}#projects" 
                                   class="flex items-start hover:bg-gray-50 -m-2 p-2 rounded-lg transition-all duration-300 group">
                                    <i class="fas fa-palette text-primary-600 text-xl"></i>
                                    <div class="ml-3">
                                        <p class="text-base font-medium text-gray-900">Nos Réalisations</p>
                                        <p class="mt-1 text-sm text-gray-500">Découvrez nos projets de décoration</p>
                                    </div>
                                    <div class="ml-auto opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        <i class="fas fa-arrow-right text-primary-600"></i>
                                    </div>
                                </a>
                                <a href="{{ route('decoration.index') }}#consultation" 
                                   class="flex items-start hover:bg-gray-50 -m-2 p-2 rounded-lg transition-all duration-300 group">
                                    <i class="fas fa-comments text-primary-600 text-xl"></i>
                                    <div class="ml-3">
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
                            class="group inline-flex items-center px-3 py-1 hover:text-primary-600 relative">
                        <i class="fas fa-truck-monster mr-1"></i>Location d'Engins
                        <i class="fas fa-chevron-down ml-1 text-sm"></i>
                        <span class="absolute bottom-0 left-0 w-full h-0.5 bg-primary-600 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></span>
                    </button>
                    <div x-show="open" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 translate-y-1"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         @click.away="open = false"
                         class="absolute z-10 mt-2 transform w-screen max-w-md px-2">
                        <div class="rounded-lg shadow-lg ring-1 ring-black ring-opacity-5 overflow-hidden">
                            <div class="relative grid gap-4 bg-white px-4 py-4 sm:gap-6 sm:p-6">
                                <a href="{{ route('equipment.index') }}" 
                                   class="flex items-start hover:bg-gray-50 -m-2 p-2 rounded-lg transition-all duration-300 group">
                                    <i class="fas fa-truck text-primary-600 text-xl"></i>
                                    <div class="ml-3">
                                        <p class="text-base font-medium text-gray-900">Catalogue</p>
                                        <p class="mt-1 text-sm text-gray-500">Tous nos équipements disponibles</p>
                                    </div>
                                    <div class="ml-auto opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        <i class="fas fa-arrow-right text-primary-600"></i>
                                    </div>
                                </a>
                                <a href="{{ route('equipment.index', ['type' => 'excavator']) }}" 
                                   class="flex items-start hover:bg-gray-50 -m-2 p-2 rounded-lg transition-all duration-300 group">
                                    <i class="fas fa-truck-monster text-primary-600 text-xl"></i>
                                    <div class="ml-3">
                                        <p class="text-base font-medium text-gray-900">Pelles & Excavateurs</p>
                                        <p class="mt-1 text-sm text-gray-500">Équipements de terrassement</p>
                                    </div>
                                    <div class="ml-auto opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        <i class="fas fa-arrow-right text-primary-600"></i>
                                    </div>
                                </a>
                                @auth
                                    <a href="{{ route('equipment.index', ['filter' => 'rented']) }}" 
                                       class="flex items-start hover:bg-gray-50 -m-2 p-2 rounded-lg transition-all duration-300 group">
                                        <i class="fas fa-clipboard-list text-primary-600 text-xl"></i>
                                        <div class="ml-3">
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
                            class="group inline-flex items-center px-3 py-1 hover:text-primary-600 relative">
                        <i class="fas fa-seedling mr-1"></i>Pépinière
                        <i class="fas fa-chevron-down ml-1 text-sm"></i>
                        <span class="absolute bottom-0 left-0 w-full h-0.5 bg-primary-600 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></span>
                    </button>
                    <div x-show="open" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 translate-y-1"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         @click.away="open = false"
                         class="absolute z-10 mt-2 transform w-screen max-w-md px-2">
                        <div class="rounded-lg shadow-lg ring-1 ring-black ring-opacity-5 overflow-hidden">
                            <div class="relative grid gap-4 bg-white px-4 py-4 sm:gap-6 sm:p-6">
                                <a href="{{ route('nursery.index') }}" 
                                   class="flex items-start hover:bg-gray-50 -m-2 p-2 rounded-lg transition-all duration-300 group">
                                    <i class="fas fa-seedling text-primary-600 text-xl"></i>
                                    <div class="ml-3">
                                        <p class="text-base font-medium text-gray-900">Catalogue</p>
                                        <p class="mt-1 text-sm text-gray-500">Découvrez nos plantes et arbres</p>
                                    </div>
                                    <div class="ml-auto opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        <i class="fas fa-arrow-right text-primary-600"></i>
                                    </div>
                                </a>
                                <a href="{{ route('nursery.guide') }}" 
                                   class="flex items-start hover:bg-gray-50 -m-2 p-2 rounded-lg transition-all duration-300 group">
                                    <i class="fas fa-book text-primary-600 text-xl"></i>
                                    <div class="ml-3">
                                        <p class="text-base font-medium text-gray-900">Guide d'entretien</p>
                                        <p class="mt-1 text-sm text-gray-500">Conseils pour vos plantes</p>
                                    </div>
                                    <div class="ml-auto opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        <i class="fas fa-arrow-right text-primary-600"></i>
                                    </div>
                                </a>
                                <a href="{{ route('cart.index') }}" 
                                   class="flex items-start hover:bg-gray-50 -m-2 p-2 rounded-lg transition-all duration-300 group">
                                    <i class="fas fa-shopping-cart text-primary-600 text-xl"></i>
                                    <div class="ml-3">
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
                                       class="flex items-start hover:bg-gray-50 -m-2 p-2 rounded-lg transition-all duration-300 group">
                                        <i class="fas fa-list-alt text-primary-600 text-xl"></i>
                                        <div class="ml-3">
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

            <!-- Replace the "Nous Contacter" section with Account dropdown -->
            <div class="hidden lg:flex lg:items-center lg:space-x-4">
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="text-gray-700 hover:text-gray-900 flex items-center">
                        <i class="fas fa-user mr-1"></i>Compte
                        <svg class="ml-1 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                    <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-20">
                        @auth
                            <a href="{{ route('profile.show') }}" class="flex items-center px-3 py-1 text-gray-700 hover:bg-gray-100">
                                <i class="fas fa-cog mr-1"></i>Settings
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="flex items-center w-full text-left px-3 py-1 text-gray-700 hover:bg-gray-100">
                                    <i class="fas fa-sign-out-alt mr-1"></i>Logout
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="flex items-center px-3 py-1 text-gray-700 hover:bg-gray-100">
                                <i class="fas fa-sign-in-alt mr-1"></i>Login
                            </a>
                            <a href="{{ route('register') }}" class="flex items-center px-3 py-1 text-gray-700 hover:bg-gray-100">
                                <i class="fas fa-user-plus mr-1"></i>Register
                            </a>
                        @endauth
                    </div>
                </div>
            </div>

            <!-- Mobile menu button -->
            <div class="flex items-center -mr-2 lg:hidden">
                <button @click="mobileMenuOpen = !mobileMenuOpen" 
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-primary-500">
                    <span class="sr-only">Ouvrir le menu</span>
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
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
            <a href="{{ route('home') }}" class="block px-3 py-2 hover:bg-primary-50 hover:text-primary-600">
                <i class="fas fa-home mr-1"></i>Home
            </a>
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