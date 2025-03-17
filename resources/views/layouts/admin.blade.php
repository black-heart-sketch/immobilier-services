<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Admin</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @stack('head-scripts')

    <script>
        // Define global functions
        function toggleModal(id) {
            const modal = document.getElementById(id);
            if (modal.classList.contains('hidden')) {
                modal.classList.remove('hidden');
            } else {
                modal.classList.add('hidden');
            }
        }
        
        function openEditModal(id) {
            // Set the form action
            document.getElementById('editForm').action = `/admin/properties/${id}`;
            
            // For testing, populate with placeholder data
            document.getElementById('edit_title').value = "Property #" + id;
            document.getElementById('edit_description').value = "Description for property #" + id;
            document.getElementById('edit_location').value = "Abidjan";
            document.getElementById('edit_surface_area').value = "500";
            document.getElementById('edit_price').value = "25000000";
            document.getElementById('edit_status').value = "available";
            document.getElementById('current_image_container').classList.add('hidden');
            
            // Show the modal
            toggleModal('editModal');
        }
        
        function openDeleteModal(id) {
            document.getElementById('deleteForm').action = `/admin/properties/${id}`;
            toggleModal('deleteModal');
        }
    </script>
</head>
<body class="font-sans antialiased">
    <div x-data="{ sidebarOpen: false }" class="min-h-screen bg-gray-100">
        <!-- Sidebar -->
        <div x-show="sidebarOpen" 
             class="fixed inset-0 z-40 lg:hidden" 
             x-description="Off-canvas menu for mobile" 
             role="dialog" 
             aria-modal="true">
            <!-- Sidebar overlay -->
            <div x-show="sidebarOpen"
                 x-transition:enter="transition-opacity ease-linear duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition-opacity ease-linear duration-300"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="fixed inset-0 bg-gray-600 bg-opacity-75"
                 @click="sidebarOpen = false"
                 aria-hidden="true"></div>

            <!-- Sidebar panel -->
            <div x-show="sidebarOpen"
                 x-transition:enter="transition ease-in-out duration-300 transform"
                 x-transition:enter-start="-translate-x-full"
                 x-transition:enter-end="translate-x-0"
                 x-transition:leave="transition ease-in-out duration-300 transform"
                 x-transition:leave-start="translate-x-0"
                 x-transition:leave-end="-translate-x-full"
                 class="relative flex-1 flex flex-col max-w-xs w-full bg-white">
                
                <div class="flex-1 h-0 pt-5 pb-4 overflow-y-auto">
                    <nav class="mt-5 px-2 space-y-1">
                        <x-admin.nav-link route="admin.dashboard" icon="fa-dashboard">
                            Dashboard
                        </x-admin.nav-link>
                        <x-admin.nav-link 
                            :route="'admin.terrains'"
                            icon="fa-map-marker-alt">
                            Terrains
                        </x-admin.nav-link>
                        <x-admin.nav-link route="admin.maisons" icon="fa-home">
                            Maisons
                        </x-admin.nav-link>
                        <x-admin.nav-link route="admin.topographie" icon="fa-mountain">
                            Topographie
                        </x-admin.nav-link>
                        <x-admin.nav-link route="admin.btp" icon="fa-building">
                            BTP
                        </x-admin.nav-link>
                        <x-admin.nav-link route="admin.decoration" icon="fa-paint-brush">
                            Décoration
                        </x-admin.nav-link>
                        <x-admin.nav-link route="admin.location-engins" icon="fa-truck">
                            Location d'Engins
                        </x-admin.nav-link>
                        <x-admin.nav-link route="admin.pepinieres" icon="fa-leaf">
                            Pépinières
                        </x-admin.nav-link>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Static sidebar for desktop -->
        <div class="hidden lg:flex lg:w-64 lg:flex-col lg:fixed lg:inset-y-0">
            <div class="flex-1 flex flex-col min-h-0 bg-white border-r border-gray-200">
                <div class="flex-1 flex flex-col pt-5 pb-4 overflow-y-auto">
                    <div class="flex items-center flex-shrink-0 px-4">
                        <img src="{{ asset('images/logo.jpeg') }}" alt="Logo" class="h-8 w-auto">
                    </div>
                    <nav class="mt-5 flex-1 px-2 space-y-1">
                        <x-admin.nav-link route="admin.dashboard" icon="fa-dashboard">
                            Dashboard
                        </x-admin.nav-link>
                        <x-admin.nav-link 
                            :route="'admin.terrains'"
                            icon="fa-map-marker-alt">
                            Terrains
                        </x-admin.nav-link>
                        <x-admin.nav-link route="admin.maisons" icon="fa-home">
                            Maisons
                        </x-admin.nav-link>
                        <x-admin.nav-link route="admin.topographie" icon="fa-mountain">
                            Topographie
                        </x-admin.nav-link>
                        <x-admin.nav-link route="admin.btp" icon="fa-building">
                            BTP
                        </x-admin.nav-link>
                        <x-admin.nav-link route="admin.decoration" icon="fa-paint-brush">
                            Décoration
                        </x-admin.nav-link>
                        <x-admin.nav-link route="admin.location-engins" icon="fa-truck">
                            Location d'Engins
                        </x-admin.nav-link>
                        <x-admin.nav-link route="admin.pepinieres" icon="fa-leaf">
                            Pépinières
                        </x-admin.nav-link>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <div class="lg:pl-64 flex flex-col">
            <!-- Top header -->
            <div class="sticky top-0 z-10 flex-shrink-0 flex h-16 bg-white shadow">
                <button @click.stop="sidebarOpen = true" class="px-4 border-r border-gray-200 text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-primary-500 lg:hidden">
                    <span class="sr-only">Open sidebar</span>
                    <i class="fas fa-bars"></i>
                </button>
                <div class="flex-1 px-4 flex justify-between">
                    <div class="flex-1 flex">
                        <h1 class="text-2xl font-semibold text-gray-900 my-auto">
                            @yield('title', 'Dashboard')
                        </h1>
                    </div>
                    <div class="ml-4 flex items-center md:ml-6">
                        <!-- Profile dropdown -->
                        <div x-data="{ open: false }" class="ml-3 relative">
                            <div>
                                <button @click="open = !open" class="max-w-xs bg-white flex items-center text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                                    <span class="sr-only">Open user menu</span>
                                    <img src="{{ asset('images/default-avatar.png') }}" alt="Avatar" class="h-8 w-8 rounded-full">
                                </button>
                            </div>
                            <div x-show="open" 
                                 @click.away="open = false"
                                 class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none">
                                <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Your Profile
                                </a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        Sign out
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <main class="flex-1">
                <div class="py-6">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                        @yield('content')
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html> 