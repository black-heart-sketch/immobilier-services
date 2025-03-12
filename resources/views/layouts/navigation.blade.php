<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <!-- Properties Dropdown -->
                    <x-nav-dropdown>
                        <x-slot name="trigger">
                            {{ __('Propriétés') }}
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('properties.index')">
                                {{ __('Toutes les propriétés') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('properties.terrains')">
                                {{ __('Terrains') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('properties.maisons')">
                                {{ __('Maisons') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('properties.map')">
                                {{ __('Carte') }}
                            </x-dropdown-link>
                        </x-slot>
                    </x-nav-dropdown>

                    <!-- Services Dropdown -->
                    <x-nav-dropdown>
                        <x-slot name="trigger">
                            {{ __('Services') }}
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('topography.index')">
                                {{ __('Topographie') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('btp.index')">
                                {{ __('BTP') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('decoration.index')">
                                {{ __('Décoration') }}
                            </x-dropdown-link>
                        </x-slot>
                    </x-nav-dropdown>

                    <!-- Equipment Dropdown -->
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
                                        <i class="fas fa-digger text-primary-600 text-2xl"></i>
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

                    <!-- Pépinière Dropdown -->
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

                    <x-nav-link :href="route('contact.index')" :active="request()->routeIs('contact.*')">
                        {{ __('Contact') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <!-- Cart dropdown -->
                <div class="ml-4 flow-root lg:ml-6">
                    <x-cart-icon />
                </div>

                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>

                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                    this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <x-nav-link :href="route('login')" :active="request()->routeIs('login')">
                        {{ __('Login') }}
                    </x-nav-link>
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <!-- Add responsive menu items here -->
        <div class="pt-4 pb-3 border-t border-gray-200">
            <div class="flex items-center px-4">
                <!-- Cart link for mobile -->
                <div class="flex-shrink-0">
                    <x-cart-icon />
                </div>
                <!-- Equipment Section -->
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800">{{ __('Location d\'Engins') }}</div>
                    <div class="pl-3 pt-2 space-y-1">
                        <x-responsive-nav-link :href="route('equipment.index')">
                            {{ __('Catalogue') }}
                        </x-responsive-nav-link>
                        <x-responsive-nav-link :href="route('equipment.index', ['type' => 'excavator'])">
                            {{ __('Pelles & Excavateurs') }}
                        </x-responsive-nav-link>
                        <x-responsive-nav-link :href="route('equipment.index', ['type' => 'loader'])">
                            {{ __('Chargeuses') }}
                        </x-responsive-nav-link>
                        <x-responsive-nav-link :href="route('equipment.index', ['type' => 'crane'])">
                            {{ __('Grues') }}
                        </x-responsive-nav-link>
                        <x-responsive-nav-link :href="route('equipment.index', ['type' => 'truck'])">
                            {{ __('Camions') }}
                        </x-responsive-nav-link>
                        @auth
                            <x-responsive-nav-link :href="route('equipment.index', ['filter' => 'rented'])">
                                {{ __('Mes Locations') }}
                            </x-responsive-nav-link>
                            <x-responsive-nav-link :href="route('equipment.index', ['filter' => 'maintenance'])">
                                {{ __('Maintenance') }}
                            </x-responsive-nav-link>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav> 