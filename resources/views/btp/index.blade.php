@extends('layouts.app')

@section('content')


<div class="bg-gray-50">
    <!-- Hero Section -->
    <div class="relative h-[80vh] bg-gray-900 overflow-hidden">
        <div class="absolute inset-0">
            <img src="{{ asset('images/btp/hero.jpg') }}" 
                 alt="BTP Construction" 
                 class="w-full h-full object-cover opacity-40">
            <div class="absolute inset-0 bg-gradient-to-r from-gray-900 to-gray-900/50"></div>
        </div>
        <div class="relative h-full flex items-center">
            <div class="container mx-auto px-4">
                <div class="max-w-3xl">
                    <span class="inline-block bg-primary-600 text-white text-sm px-4 py-1 rounded-full mb-4">
                        Expertise BTP
                    </span>
                    <h1 class="text-5xl font-bold text-white mb-6">
                        Construction et Rénovation<br>
                        de Qualité Supérieure
                    </h1>
                    <p class="text-xl text-gray-300 mb-8">
                        Des solutions sur mesure pour tous vos projets de construction,<br>
                        de la conception à la réalisation
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <a href="#calculator" 
                           class="bg-primary-600 text-white px-8 py-4 rounded-lg hover:bg-primary-700 transition-colors">
                            Estimer mon projet
                        </a>
                        <a href="#quote" 
                           class="bg-white text-gray-900 px-8 py-4 rounded-lg hover:bg-gray-100 transition-colors">
                            Demander un devis
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Services Section -->
    <div id="services" class="py-24">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold mb-4">Nos Services BTP</h2>
                <p class="text-xl text-gray-600">
                    Une expertise complète pour tous vos projets de construction
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                @foreach($services as $service)
                    <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-shadow">
                        <div class="w-16 h-16 bg-primary-600 text-white rounded-xl flex items-center justify-center mb-6">
                            <i class="fas {{ $service['icon'] }} text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold mb-4">{{ $service['title'] }}</h3>
                        <p class="text-gray-600 mb-6">{{ $service['description'] }}</p>
                        <ul class="space-y-3">
                            @foreach($service['features'] as $feature)
                                <li class="flex items-center text-gray-700">
                                    <i class="fas fa-check text-primary-600 mr-3"></i>
                                    {{ $feature }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Projects Showcase -->
    <div id="projects" class="py-24 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold mb-4">Nos Réalisations</h2>
                <p class="text-xl text-gray-600">
                    Découvrez nos projets avant/après
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($projects as $project)
                    <div class="bg-white rounded-2xl overflow-hidden shadow-lg">
                        <!-- Before/After Slider -->
                        <div class="relative h-64" x-data="{ showAfter: false }">
                            <img src="{{ asset($project->before_image) }}" 
                                 alt="Avant" 
                                 class="absolute inset-0 w-full h-full object-cover transition-opacity duration-500"
                                 :class="{ 'opacity-0': showAfter }">
                            <img src="{{ asset($project->after_image) }}" 
                                 alt="Après" 
                                 class="absolute inset-0 w-full h-full object-cover">
                            <div class="absolute inset-0 flex items-center justify-center">
                                <button @mouseenter="showAfter = true" 
                                        @mouseleave="showAfter = false"
                                        class="bg-white/90 text-gray-900 px-4 py-2 rounded-lg text-sm font-medium">
                                    Voir avant/après
                                </button>
                            </div>
                        </div>

                        <div class="p-6">
                            <h3 class="text-xl font-bold mb-2">{{ $project->title }}</h3>
                            <p class="text-gray-600 mb-4">{{ $project->description }}</p>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-500">
                                    <i class="far fa-calendar-alt mr-2"></i>
                                    {{ $project->completion_date->format('M Y') }}
                                </span>
                                <a href="#" class="text-primary-600 hover:text-primary-700">
                                    En savoir plus
                                    <i class="fas fa-arrow-right ml-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Cost Calculator -->
    <div id="calculator" class="py-24 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mx-auto">
                <div class="text-center mb-12">
                    <h2 class="text-4xl font-bold mb-4">Calculateur de Coût</h2>
                    <p class="text-xl text-gray-600">
                        Estimez le coût de votre projet de construction
                    </p>
                </div>

                <div class="bg-white rounded-2xl p-8 shadow-lg"
                     x-data="{ 
                         surface: 100,
                         type: 'residential',
                         quality: 'standard',
                         options: [],
                         estimate: null,
                         calculating: false,
                         
                         async calculate() {
                             this.calculating = true;
                             try {
                                 const response = await fetch('{{ route('btp.calculate') }}', {
                                     method: 'POST',
                                     headers: {
                                         'Content-Type': 'application/json',
                                         'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
                                     },
                                     body: JSON.stringify({
                                         surface: this.surface,
                                         type: this.type,
                                         quality: this.quality,
                                         options: this.options
                                     })
                                 });
                                 
                                 const data = await response.json();
                                 this.estimate = data;
                             } catch (error) {
                                 console.error('Error:', error);
                             } finally {
                                 this.calculating = false;
                             }
                         }
                     }">
                    <form @submit.prevent="calculate" class="space-y-6">
                        <!-- Surface -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Surface (m²)
                            </label>
                            <input type="number" 
                                   x-model="surface"
                                   min="20"
                                   class="w-full rounded-lg border-gray-300 focus:border-primary-600 focus:ring-primary-600">
                        </div>

                        <!-- Type -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Type de construction
                            </label>
                            <select x-model="type"
                                    class="w-full rounded-lg border-gray-300 focus:border-primary-600 focus:ring-primary-600">
                                <option value="residential">Résidentiel</option>
                                <option value="commercial">Commercial</option>
                            </select>
                        </div>

                        <!-- Quality -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Niveau de finition
                            </label>
                            <select x-model="quality"
                                    class="w-full rounded-lg border-gray-300 focus:border-primary-600 focus:ring-primary-600">
                                <option value="standard">Standard</option>
                                <option value="premium">Premium</option>
                                <option value="luxury">Luxe</option>
                            </select>
                        </div>

                        <!-- Options -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Options
                            </label>
                            <div class="space-y-2">
                                <label class="flex items-center">
                                    <input type="checkbox" 
                                           value="pool" 
                                           x-model="options"
                                           class="rounded border-gray-300 text-primary-600 focus:ring-primary-600">
                                    <span class="ml-2">Piscine</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" 
                                           value="solar" 
                                           x-model="options"
                                           class="rounded border-gray-300 text-primary-600 focus:ring-primary-600">
                                    <span class="ml-2">Panneaux solaires</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" 
                                           value="security" 
                                           x-model="options"
                                           class="rounded border-gray-300 text-primary-600 focus:ring-primary-600">
                                    <span class="ml-2">Système de sécurité</span>
                                </label>
                            </div>
                        </div>

                        <button type="submit" 
                                class="w-full bg-primary-600 text-white py-3 rounded-lg hover:bg-primary-700 transition-colors"
                                :disabled="calculating">
                            <span x-show="!calculating">Calculer l'estimation</span>
                            <span x-show="calculating">
                                <i class="fas fa-circle-notch fa-spin mr-2"></i>
                                Calcul en cours...
                            </span>
                        </button>
                    </form>

                    <!-- Results -->
                    <div x-show="estimate" 
                         x-transition
                         class="mt-8 p-6 bg-gray-50 rounded-xl">
                        <h3 class="text-xl font-bold mb-4">Estimation du coût</h3>
                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span>Coût de base</span>
                                <span x-text="new Intl.NumberFormat('fr-FR').format(estimate.breakdown.base_cost) + ' FCFA'"></span>
                            </div>
                            <div class="flex justify-between">
                                <span>Options</span>
                                <span x-text="new Intl.NumberFormat('fr-FR').format(estimate.breakdown.options_cost) + ' FCFA'"></span>
                            </div>
                            <div class="border-t pt-3">
                                <div class="flex justify-between font-bold">
                                    <span>Total estimé</span>
                                    <span x-text="new Intl.NumberFormat('fr-FR').format(estimate.breakdown.total) + ' FCFA'"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Testimonials -->
    <div id="testimonials" class="py-24 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold mb-4">Témoignages Clients</h2>
                <p class="text-xl text-gray-600">
                    Ce que nos clients disent de nous
                </p>
            </div>

            <div class="grid md:grid-cols-2 gap-8">
                @foreach($testimonials as $testimonial)
                    <div class="bg-gray-50 rounded-2xl p-8">
                        <div class="flex items-center mb-6">
                            <div class="w-16 h-16 rounded-full bg-gray-200 flex-shrink-0">
                                <img src="{{ asset($testimonial->client_image) }}" 
                                     alt="{{ $testimonial->client_name }}"
                                     class="w-full h-full rounded-full object-cover">
                            </div>
                            <div class="ml-4">
                                <h4 class="font-bold">{{ $testimonial->client_name }}</h4>
                                <p class="text-gray-600">{{ $testimonial->project->title }}</p>
                            </div>
                        </div>
                        <p class="text-gray-700 mb-4">{{ $testimonial->content }}</p>
                        <div class="flex text-primary-600">
                            @for($i = 0; $i < 5; $i++)
                                <i class="fas fa-star"></i>
                            @endfor
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Quote Form -->
    <div id="quote" class="py-24 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mx-auto">
                <div class="text-center mb-12">
                    <h2 class="text-4xl font-bold mb-4">Demander un Devis</h2>
                    <p class="text-xl text-gray-600">
                        Décrivez votre projet et nous vous contacterons rapidement
                    </p>
                </div>

                <div class="bg-white rounded-2xl p-8 shadow-lg">
                    <form action="{{ route('btp.quote') }}"
                          method="POST"
                          x-data="{ 
                              formData: {
                                  name: '',
                                  email: '',
                                  phone: '',
                                  project_type: '',
                                  surface: '',
                                  budget: '',
                                  description: '',
                                  timeline: ''
                              },
                              isSubmitting: false,
                              success: false,
                              async submitForm() {
                                  if (this.isSubmitting) return;
                                  
                                  this.isSubmitting = true;
                                  try {
                                      const response = await fetch('{{ route('btp.quote') }}', {
                                          method: 'POST',
                                          headers: {
                                              'Content-Type': 'application/json',
                                              'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
                                          },
                                          body: JSON.stringify(this.formData)
                                      });
                                      
                                      if (!response.ok) throw new Error('Network response was not ok');
                                      
                                      const data = await response.json();
                                      this.success = true;
                                      this.formData = {
                                          name: '',
                                          email: '',
                                          phone: '',
                                          project_type: '',
                                          surface: '',
                                          budget: '',
                                          description: '',
                                          timeline: ''
                                      };
                                      
                                      setTimeout(() => {
                                          this.success = false;
                                      }, 5000);
                                      
                                  } catch (error) {
                                      console.error('Error:', error);
                                      alert('Une erreur est survenue. Veuillez réessayer.');
                                  } finally {
                                      this.isSubmitting = false;
                                  }
                              }
                          }"
                          @submit.prevent="submitForm"
                          class="space-y-6">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Name -->
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

                            <!-- Email -->
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
                        </div>

                        <!-- Project Details -->
                        <div class="space-y-6">
                            <div class="relative">
                                <select id="project_type"
                                        name="project_type"
                                        required
                                        x-model="formData.project_type"
                                        class="peer w-full px-4 py-3 rounded-lg border-2 border-gray-300 focus:border-primary-600 focus:ring-0">
                                    <option value="">Sélectionnez un type de projet</option>
                                    <option value="construction">Construction neuve</option>
                                    <option value="renovation">Rénovation</option>
                                    <option value="extension">Extension</option>
                                </select>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="relative">
                                    <input type="number"
                                           id="surface"
                                           name="surface"
                                           required
                                           placeholder=" "
                                           x-model="formData.surface"
                                           class="peer w-full px-4 py-3 rounded-lg border-2 border-gray-300 focus:border-primary-600 focus:ring-0 placeholder-transparent">
                                    <label for="surface"
                                           class="absolute left-4 -top-2.5 bg-white px-2 text-sm text-gray-600 transition-all duration-300
                                                  peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-3
                                                  peer-focus:-top-2.5 peer-focus:text-sm peer-focus:text-primary-600">
                                        Surface (m²)
                                    </label>
                                </div>

                                <div class="relative">
                                    <input type="number"
                                           id="budget"
                                           name="budget"
                                           required
                                           placeholder=" "
                                           x-model="formData.budget"
                                           class="peer w-full px-4 py-3 rounded-lg border-2 border-gray-300 focus:border-primary-600 focus:ring-0 placeholder-transparent">
                                    <label for="budget"
                                           class="absolute left-4 -top-2.5 bg-white px-2 text-sm text-gray-600 transition-all duration-300
                                                  peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-3
                                                  peer-focus:-top-2.5 peer-focus:text-sm peer-focus:text-primary-600">
                                        Budget estimé (FCFA)
                                    </label>
                                </div>
                            </div>

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
                        </div>

                        <button type="submit"
                                class="w-full bg-primary-600 text-white py-4 rounded-lg hover:bg-primary-700 transition-colors"
                                :disabled="isSubmitting">
                            <span x-show="!isSubmitting">
                                Envoyer la demande
                            </span>
                            <span x-show="isSubmitting">
                                <i class="fas fa-circle-notch fa-spin mr-2"></i>
                                Envoi en cours...
                            </span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 