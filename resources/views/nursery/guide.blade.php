@extends('layouts.app')

@section('content')
<div class="bg-white">
    <!-- Hero section -->
    <div class="relative bg-green-800">
        <div class="absolute inset-0">
            <img class="w-full h-full object-cover" src="{{ asset('images/nursery/guide-hero.jpg') }}" alt="Guide d'entretien des plantes">
            <div class="absolute inset-0 bg-green-800 mix-blend-multiply" aria-hidden="true"></div>
        </div>
        <div class="relative max-w-7xl mx-auto py-24 px-4 sm:py-32 sm:px-6 lg:px-8">
            <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl lg:text-6xl">Guide d'entretien</h1>
            <p class="mt-6 text-xl text-green-100 max-w-3xl">
                Découvrez nos conseils pour prendre soin de vos plantes et assurer leur croissance optimale.
            </p>
        </div>
    </div>

    <!-- Content section -->
    <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
        <!-- General care tips -->
        <div class="mb-16">
            <h2 class="text-3xl font-extrabold text-gray-900">Conseils généraux d'entretien</h2>
            <div class="mt-8 grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                <!-- Watering -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                            </svg>
                            <h3 class="ml-3 text-lg font-medium text-gray-900">Arrosage</h3>
                        </div>
                        <div class="mt-4 text-base text-gray-500">
                            <ul class="list-disc pl-5 space-y-2">
                                <li>Vérifiez l'humidité du sol avant d'arroser</li>
                                <li>Évitez l'excès d'eau</li>
                                <li>Arrosez tôt le matin ou en fin de journée</li>
                                <li>Adaptez la fréquence selon la saison</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Light -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                            <h3 class="ml-3 text-lg font-medium text-gray-900">Luminosité</h3>
                        </div>
                        <div class="mt-4 text-base text-gray-500">
                            <ul class="list-disc pl-5 space-y-2">
                                <li>Identifiez les besoins en lumière</li>
                                <li>Évitez l'exposition directe prolongée</li>
                                <li>Tournez régulièrement les plantes</li>
                                <li>Adaptez l'emplacement selon la saison</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Fertilization -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"/>
                            </svg>
                            <h3 class="ml-3 text-lg font-medium text-gray-900">Fertilisation</h3>
                        </div>
                        <div class="mt-4 text-base text-gray-500">
                            <ul class="list-disc pl-5 space-y-2">
                                <li>Utilisez un engrais adapté</li>
                                <li>Respectez les doses recommandées</li>
                                <li>Fertilisez pendant la période de croissance</li>
                                <li>Réduisez en période de repos</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Plant categories -->
        <div class="mt-16">
            <h2 class="text-3xl font-extrabold text-gray-900 mb-8">Guide par catégorie</h2>
            
            @foreach($plants->chunk(3) as $chunk)
            <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3 mb-8">
                @foreach($chunk as $category => $plantsInCategory)
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">{{ ucfirst($category) }}</h3>
                        @foreach($plantsInCategory->take(3) as $plant)
                        <div class="mb-4 last:mb-0">
                            <h4 class="font-medium text-green-600">{{ $plant->name }}</h4>
                            <p class="mt-1 text-sm text-gray-500">{{ Str::limit($plant->care_instructions, 100) }}</p>
                            <a href="{{ route('nursery.show', $plant) }}" class="mt-2 text-sm font-medium text-green-600 hover:text-green-500">
                                En savoir plus <span aria-hidden="true">&rarr;</span>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection 