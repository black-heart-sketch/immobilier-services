@extends('layouts.app')

@section('content')
<div class="bg-gray-50">
    <!-- Article Header -->
    <div class="relative py-16 bg-gray-900">
        <div class="absolute inset-0">
            <img src="{{ asset($article->image) }}" 
                 alt="{{ $article->title }}" 
                 class="w-full h-full object-cover opacity-40">
            <div class="absolute inset-0 bg-gradient-to-r from-gray-900 to-gray-900/50"></div>
        </div>
        <div class="relative container mx-auto px-4">
            <div class="max-w-3xl">
                <div class="flex flex-wrap gap-2 mb-4">
                    @foreach($article->tags as $tag)
                    <span class="bg-primary-600 text-white text-sm px-4 py-1 rounded-full">
                        {{ $tag }}
                    </span>
                    @endforeach
                </div>
                <h1 class="text-4xl font-bold text-white mb-6">
                    {{ $article->title }}
                </h1>
                <div class="flex items-center text-gray-300 space-x-6">
                    <span class="flex items-center">
                        <i class="fas fa-user-circle mr-2"></i>
                        {{ $article->author_name }}
                    </span>
                    <span class="flex items-center">
                        <i class="fas fa-clock mr-2"></i>
                        {{ $article->reading_time }} min de lecture
                    </span>
                    <span class="flex items-center">
                        <i class="fas fa-calendar mr-2"></i>
                        {{ $article->created_at->format('d M Y') }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Article Content -->
    <div class="py-16">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
                <!-- Main Content -->
                <div class="lg:col-span-8">
                    <article class="prose prose-lg max-w-none">
                        {!! $article->content !!}
                    </article>

                    <!-- Share Buttons -->
                    <div class="mt-12 pt-6 border-t border-gray-200">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Partager cet article</h3>
                        <div class="flex space-x-4">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" 
                               target="_blank"
                               class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                                <i class="fab fa-facebook-f mr-2"></i>
                                Facebook
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($article->title) }}" 
                               target="_blank"
                               class="bg-blue-400 text-white px-4 py-2 rounded-lg hover:bg-blue-500 transition-colors">
                                <i class="fab fa-twitter mr-2"></i>
                                Twitter
                            </a>
                            <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(request()->url()) }}&title={{ urlencode($article->title) }}" 
                               target="_blank"
                               class="bg-blue-700 text-white px-4 py-2 rounded-lg hover:bg-blue-800 transition-colors">
                                <i class="fab fa-linkedin-in mr-2"></i>
                                LinkedIn
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-4">
                    <!-- Related Articles -->
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-6">Articles Similaires</h3>
                        <div class="space-y-6">
                            @foreach($relatedArticles as $relatedArticle)
                            <a href="{{ route('decoration.article', $relatedArticle->slug) }}" 
                               class="block group">
                                <div class="flex items-start">
                                    <img src="{{ asset($relatedArticle->image) }}" 
                                         alt="{{ $relatedArticle->title }}"
                                         class="w-20 h-20 rounded-lg object-cover">
                                    <div class="ml-4">
                                        <h4 class="text-gray-900 font-medium group-hover:text-primary-600 transition-colors">
                                            {{ $relatedArticle->title }}
                                        </h4>
                                        <p class="text-sm text-gray-500 mt-1">
                                            {{ $relatedArticle->reading_time }} min de lecture
                                        </p>
                                    </div>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>

                    <!-- Newsletter Signup -->
                    <div class="bg-primary-50 rounded-xl shadow-lg p-6 mt-8">
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Newsletter Déco</h3>
                        <p class="text-gray-600 mb-4">
                            Recevez nos derniers articles et conseils déco directement dans votre boîte mail.
                        </p>
                        <form action="#" method="POST" class="space-y-4">
                            @csrf
                            <div>
                                <input type="email" 
                                       name="email" 
                                       placeholder="Votre email"
                                       class="w-full px-4 py-2 rounded-lg border-gray-300 focus:border-primary-600 focus:ring-primary-600">
                            </div>
                            <button type="submit" 
                                    class="w-full bg-primary-600 text-white px-6 py-2 rounded-lg hover:bg-primary-700 transition-colors">
                                S'abonner
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 