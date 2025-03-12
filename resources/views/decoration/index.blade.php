@extends('layouts.app')

@section('content')
<div class="bg-gray-50">
    <!-- Hero Section -->
    <div class="relative h-[80vh] bg-gray-900 overflow-hidden">
        <div class="absolute inset-0">
            <img src="{{ asset('images/decoration/hero.jpg') }}" 
                 alt="Décoration Intérieure" 
                 class="w-full h-full object-cover opacity-40">
            <div class="absolute inset-0 bg-gradient-to-r from-gray-900 to-gray-900/50"></div>
        </div>
        <div class="relative h-full flex items-center">
            <div class="container mx-auto px-4">
                <div class="max-w-3xl">
                    <span class="inline-block bg-primary-600 text-white text-sm px-4 py-1 rounded-full mb-4">
                        Design d'Intérieur
                    </span>
                    <h1 class="text-5xl font-bold text-white mb-6">
                        Transformez votre espace<br>
                        en un lieu unique
                    </h1>
                    <p class="text-xl text-gray-300 mb-8">
                        Des solutions créatives pour sublimer votre intérieur,<br>
                        du conseil à la réalisation
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <a href="#services" 
                           class="bg-primary-600 text-white px-8 py-4 rounded-lg hover:bg-primary-700 transition-colors">
                            Découvrir nos services
                        </a>
                        <a href="#consultation" 
                           class="bg-white text-gray-900 px-8 py-4 rounded-lg hover:bg-gray-100 transition-colors">
                            Consultation gratuite
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Services Section -->
    <div id="services" class="py-24">
        <div class="container mx-auto px-4">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Nos Services de Décoration</h2>
                <p class="text-lg text-gray-600">
                    Des solutions complètes pour tous vos projets de décoration intérieure
                </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($services as $service)
                <div class="bg-white rounded-xl shadow-lg overflow-hidden transform hover:scale-[1.02] transition-all duration-300">
                    <img src="{{ asset($service->image) }}" 
                         alt="{{ $service->title }}" 
                         class="w-full h-48 object-cover">
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <i class="fas {{ $service->icon }} text-primary-600 text-2xl"></i>
                            <h3 class="text-xl font-bold text-gray-900 ml-3">{{ $service->title }}</h3>
                        </div>
                        <p class="text-gray-600 mb-4">{{ $service->description }}</p>
                        <ul class="space-y-2 mb-6">
                            @foreach($service->features as $feature)
                            <li class="flex items-center text-gray-600">
                                <i class="fas fa-check text-primary-600 mr-2"></i>
                                {{ $feature }}
                            </li>
                            @endforeach
                        </ul>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-500">À partir de {{ $service->price_range }}</span>
                            <a href="#consultation" class="text-primary-600 hover:text-primary-700">
                                En savoir plus <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Projects Preview -->
    <div class="bg-gray-100 py-24">
        <div class="container mx-auto px-4">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Nos Réalisations</h2>
                <p class="text-lg text-gray-600">
                    Découvrez quelques-uns de nos projets de décoration intérieure
                </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                @foreach($projects as $project)
                <div class="group bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="relative">
                        <div class="aspect-w-16 aspect-h-9">
                            <img src="{{ asset($project->after_image) }}" 
                                 alt="{{ $project->title }}" 
                                 class="w-full h-full object-cover">
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="absolute bottom-4 left-4 right-4 transform translate-y-4 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-300">
                            <h3 class="text-xl font-bold text-white mb-2">{{ $project->title }}</h3>
                            <p class="text-gray-200">{{ $project->type }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="text-center">
                <a href="{{ route('decoration.portfolio') }}" 
                   class="inline-flex items-center bg-primary-600 text-white px-8 py-4 rounded-lg hover:bg-primary-700 transition-colors">
                    Voir tout le portfolio
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Blog Preview -->
    <div class="py-24">
        <div class="container mx-auto px-4">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Blog & Conseils Déco</h2>
                <p class="text-lg text-gray-600">
                    Inspirez-vous de nos articles et conseils en décoration
                </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
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
                                {{ Str::limit(strip_tags($article->content), 120) }}
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
            <div class="text-center">
                <a href="{{ route('decoration.blog') }}" 
                   class="inline-flex items-center bg-primary-600 text-white px-8 py-4 rounded-lg hover:bg-primary-700 transition-colors">
                    Voir tous les articles
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Consultation Form -->
    <div id="consultation" class="bg-gray-100 py-24">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mx-auto">
                <div class="bg-white rounded-3xl overflow-hidden shadow-xl">
                    <div class="p-8 md:p-12">
                        <h2 class="text-3xl font-bold text-gray-900 mb-2">Consultation Gratuite</h2>
                        <p class="text-gray-600 mb-8">
                            Prenez rendez-vous avec l'un de nos experts en décoration
                        </p>
                        <form action="{{ route('decoration.consultation') }}" 
                              method="POST" 
                              class="space-y-6"
                              x-data="{ 
                                  formData: {
                                      name: '',
                                      email: '',
                                      phone: '',
                                      project_type: '',
                                      description: '',
                                      preferred_date: '',
                                      preferred_time: '',
                                      budget_range: ''
                                  },
                                  isSubmitting: false,
                                  showSuccess: false,
                                  async submitForm() {
                                      this.isSubmitting = true;
                                      try {
                                          const response = await fetch('{{ route('decoration.consultation') }}', {
                                              method: 'POST',
                                              headers: {
                                                  'Content-Type': 'application/json',
                                                  'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
                                              },
                                              body: JSON.stringify(this.formData)
                                          });
                                          const result = await response.json();
                                          if (result.success) {
                                              this.showSuccess = true;
                                              this.formData = {
                                                  name: '',
                                                  email: '',
                                                  phone: '',
                                                  project_type: '',
                                                  description: '',
                                                  preferred_date: '',
                                                  preferred_time: '',
                                                  budget_range: ''
                                              };
                                              setTimeout(() => this.showSuccess = false, 5000);
                                          }
                                      } catch (error) {
                                          console.error('Error:', error);
                                          alert('Une erreur est survenue. Veuillez réessayer.');
                                      } finally {
                                          this.isSubmitting = false;
                                      }
                                  }
                              }"
                              @submit.prevent="submitForm()">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Name Field -->
                                <div class="relative">
                                    <input type="text" 
                                           id="name"
                                           name="name" 
                                           required
                                           placeholder=" "
                                           x-model="formData.name"
                                           class="peer w-full px-4 py-3 rounded-lg border-2 border-gray-300 focus:border-primary-600 focus:ring-0 placeholder-transparent">
                                    <label for="name"
                                           class="absolute left-4 -top-2.5 bg-white px-2 text-sm text-gray-600 transition-all duration-300
                                                  peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-3
                                                  peer-focus:-top-2.5 peer-focus:text-sm peer-focus:text-primary-600">
                                        Nom complet
                                    </label>
                                </div>

                                <!-- Email Field -->
                                <div class="relative">
                                    <input type="email" 
                                           id="email"
                                           name="email" 
                                           required
                                           placeholder=" "
                                           x-model="formData.email"
                                           class="peer w-full px-4 py-3 rounded-lg border-2 border-gray-300 focus:border-primary-600 focus:ring-0 placeholder-transparent">
                                    <label for="email"
                                           class="absolute left-4 -top-2.5 bg-white px-2 text-sm text-gray-600 transition-all duration-300
                                                  peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-3
                                                  peer-focus:-top-2.5 peer-focus:text-sm peer-focus:text-primary-600">
                                        Email
                                    </label>
                                </div>

                                <!-- Phone Field -->
                                <div class="relative">
                                    <input type="tel" 
                                           id="phone"
                                           name="phone" 
                                           required
                                           placeholder=" "
                                           x-model="formData.phone"
                                           class="peer w-full px-4 py-3 rounded-lg border-2 border-gray-300 focus:border-primary-600 focus:ring-0 placeholder-transparent">
                                    <label for="phone"
                                           class="absolute left-4 -top-2.5 bg-white px-2 text-sm text-gray-600 transition-all duration-300
                                                  peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-3
                                                  peer-focus:-top-2.5 peer-focus:text-sm peer-focus:text-primary-600">
                                        Téléphone
                                    </label>
                                </div>

                                <!-- Project Type Field -->
                                <div class="relative">
                                    <select id="project_type"
                                            name="project_type" 
                                            required
                                            x-model="formData.project_type"
                                            class="peer w-full px-4 py-3 rounded-lg border-2 border-gray-300 focus:border-primary-600 focus:ring-0">
                                        <option value="">Sélectionnez un type</option>
                                        <option value="residential">Résidentiel</option>
                                        <option value="commercial">Commercial</option>
                                        <option value="office">Bureau</option>
                                    </select>
                                    <label for="project_type"
                                           class="absolute left-4 -top-2.5 bg-white px-2 text-sm text-gray-600">
                                        Type de projet
                                    </label>
                                </div>

                                <!-- Preferred Date Field -->
                                <div class="relative">
                                    <input type="date" 
                                           id="preferred_date"
                                           name="preferred_date" 
                                           required
                                           x-model="formData.preferred_date"
                                           class="peer w-full px-4 py-3 rounded-lg border-2 border-gray-300 focus:border-primary-600 focus:ring-0">
                                    <label for="preferred_date"
                                           class="absolute left-4 -top-2.5 bg-white px-2 text-sm text-gray-600">
                                        Date souhaitée
                                    </label>
                                </div>

                                <!-- Preferred Time Field -->
                                <div class="relative">
                                    <select id="preferred_time"
                                            name="preferred_time" 
                                            required
                                            x-model="formData.preferred_time"
                                            class="peer w-full px-4 py-3 rounded-lg border-2 border-gray-300 focus:border-primary-600 focus:ring-0">
                                        <option value="">Sélectionnez une heure</option>
                                        <option value="morning">Matin (9h-12h)</option>
                                        <option value="afternoon">Après-midi (14h-17h)</option>
                                    </select>
                                    <label for="preferred_time"
                                           class="absolute left-4 -top-2.5 bg-white px-2 text-sm text-gray-600">
                                        Heure souhaitée
                                    </label>
                                </div>

                                <!-- Budget Range Field -->
                                <div class="relative">
                                    <select id="budget_range"
                                            name="budget_range" 
                                            required
                                            x-model="formData.budget_range"
                                            class="peer w-full px-4 py-3 rounded-lg border-2 border-gray-300 focus:border-primary-600 focus:ring-0">
                                        <option value="">Sélectionnez une fourchette</option>
                                        <option value="< 1M">Moins de 1M FCFA</option>
                                        <option value="1M-5M">1M - 5M FCFA</option>
                                        <option value="5M-10M">5M - 10M FCFA</option>
                                        <option value="> 10M">Plus de 10M FCFA</option>
                                    </select>
                                    <label for="budget_range"
                                           class="absolute left-4 -top-2.5 bg-white px-2 text-sm text-gray-600">
                                        Budget estimé
                                    </label>
                                </div>
                            </div>

                            <!-- Description Field -->
                            <div class="relative">
                                <textarea id="description"
                                          name="description" 
                                          required
                                          rows="4"
                                          placeholder=" "
                                          x-model="formData.description"
                                          class="peer w-full px-4 py-3 rounded-lg border-2 border-gray-300 focus:border-primary-600 focus:ring-0 placeholder-transparent"></textarea>
                                <label for="description"
                                       class="absolute left-4 -top-2.5 bg-white px-2 text-sm text-gray-600 transition-all duration-300
                                              peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-3
                                              peer-focus:-top-2.5 peer-focus:text-sm peer-focus:text-primary-600">
                                    Description du projet
                                </label>
                            </div>

                            <div class="flex items-center justify-between">
                                <button type="submit"
                                        class="w-full bg-primary-600 text-white py-4 rounded-lg hover:bg-primary-700 transition-colors disabled:opacity-50"
                                        :disabled="isSubmitting">
                                    <span x-show="!isSubmitting">
                                        Demander une consultation
                                    </span>
                                    <span x-show="isSubmitting">
                                        <i class="fas fa-circle-notch fa-spin mr-2"></i>
                                        Envoi en cours...
                                    </span>
                                </button>
                            </div>

                            <!-- Success Message -->
                            <div x-show="showSuccess"
                                 x-transition:enter="transition ease-out duration-300"
                                 x-transition:enter-start="opacity-0 transform translate-y-2"
                                 x-transition:enter-end="opacity-100 transform translate-y-0"
                                 x-transition:leave="transition ease-in duration-300"
                                 x-transition:leave-start="opacity-100 transform translate-y-0"
                                 x-transition:leave-end="opacity-0 transform translate-y-2"
                                 class="fixed bottom-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg">
                                <i class="fas fa-check-circle mr-2"></i>
                                Votre demande a été envoyée avec succès !
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 