@extends('layouts.app')

@section('content')
<div class="bg-gray-50">
    <!-- Hero Section -->
    <div class="relative py-16 bg-gray-900">
        <div class="absolute inset-0">
            <img src="{{ asset('images/decoration/blog-hero.jpg') }}" 
                 alt="Blog Décoration" 
                 class="w-full h-full object-cover opacity-40">
            <div class="absolute inset-0 bg-gradient-to-r from-gray-900 to-gray-900/50"></div>
        </div>
        <div class="relative container mx-auto px-4">
            <div class="max-w-3xl">
                <h1 class="text-4xl font-bold text-white mb-4">
                    Blog & Conseils Déco
                </h1>
                <p class="text-xl text-gray-300">
                    Inspirations, tendances et astuces pour votre intérieur
                </p>
            </div>
        </div>
    </div>

    <!-- Blog Grid -->
    <div class="py-24">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($articles as $article)
                <article class="bg-white rounded-xl shadow-lg overflow-hidden transform hover:scale-[1.02] transition-all duration-300">
                    <a href="{{ route('decoration.article', $article->slug) }}">
                        <img src="{{ asset($article->image) }}" 
                             alt="{{ $article->title }}" 
                             class="w-full h-48 object-cover">
                        <div class="p-6">
                            <div class="flex items-center text-sm text-gray-500 mb-4">
                                <span class="flex items-center">
                                    <i class="fas fa-user-circle mr-2"></i>
                                    {{ $article->author_name }}
                                </span>
                                <span class="mx-2">•</span>
                                <span class="flex items-center">
                                    <i class="fas fa-clock mr-2"></i>
                                    {{ $article->reading_time }} min
                                </span>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $article->title }}</h3>
                            <p class="text-gray-600 mb-4">
                                {{ Str::limit(strip_tags($article->content), 150) }}
                            </p>
                            <div class="flex flex-wrap gap-2">
                                @foreach($article->tags as $tag)
                                <span class="bg-gray-100 text-gray-600 text-sm px-3 py-1 rounded-full">
                                    {{ $tag }}
                                </span>
                                @endforeach
                            </div>
                        </div>
                    </a>
                </article>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-12">
                {{ $articles->links() }}
            </div>
        </div>
    </div>
</div>
@endsection 