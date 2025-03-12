@extends('layouts.app')

@section('content')
<div class="bg-gray-50">
    <!-- Hero Section -->
    <div class="relative py-16 bg-gray-900">
        <div class="absolute inset-0">
            <img src="{{ asset('images/decoration/portfolio-hero.jpg') }}" 
                 alt="Portfolio Décoration" 
                 class="w-full h-full object-cover opacity-40">
            <div class="absolute inset-0 bg-gradient-to-r from-gray-900 to-gray-900/50"></div>
        </div>
        <div class="relative container mx-auto px-4">
            <div class="max-w-3xl">
                <h1 class="text-4xl font-bold text-white mb-4">
                    Portfolio de nos Réalisations
                </h1>
                <p class="text-xl text-gray-300">
                    Découvrez nos projets de décoration intérieure
                </p>
            </div>
        </div>
    </div>

    <!-- Portfolio Grid -->
    <div class="py-24">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($projects as $project)
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="relative">
                        <!-- Before/After Slider -->
                        <div class="relative h-64 overflow-hidden">
                            <img src="{{ asset($project->after_image) }}" 
                                 alt="{{ $project->title }} - Après" 
                                 class="absolute inset-0 w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                        </div>
                        <div class="absolute bottom-4 left-4 right-4">
                            <h3 class="text-xl font-bold text-white mb-1">{{ $project->title }}</h3>
                            <p class="text-gray-200">{{ $project->type }}</p>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-600 mb-4">{{ $project->description }}</p>
                        <div class="flex items-center justify-between text-sm text-gray-500">
                            <span>{{ $project->completion_date->format('M Y') }}</span>
                            <span>{{ $project->client_name }}</span>
                        </div>
                        @if($project->testimonial)
                        <div class="mt-4 p-4 bg-gray-50 rounded-lg">
                            <p class="text-gray-600 italic">{{ $project->testimonial }}</p>
                        </div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-12">
                {{ $projects->links() }}
            </div>
        </div>
    </div>
</div>
@endsection 