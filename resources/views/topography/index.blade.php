@extends('layouts.app')

@section('content')
<div class="bg-gray-50">
    <!-- Hero Section with Parallax -->
    <div class="relative overflow-hidden bg-primary-900 h-[80vh] flex items-center" x-data="{ scroll: 0 }" @scroll.window="scroll = window.pageYOffset">
        <div class="absolute inset-0">
            <img src="{{ asset('images/topography/topo11.jpg') }}" 
                 alt="Topographie" 
                 class="w-full h-full object-cover opacity-50"
                 :style="{ transform: `translateY(${scroll * 0.5}px)` }">
            <div class="absolute inset-0 bg-gradient-to-b from-primary-900/30 to-primary-900/70"></div>
        </div>
        <div class="relative container mx-auto px-4">
            <div class="max-w-3xl mx-auto text-center">
                <h1 class="text-5xl md:text-6xl font-bold text-white mb-6 leading-tight">
                    Expertise Topographique <br>de Précision
                </h1>
                <p class="text-xl md:text-2xl text-gray-200 mb-8 leading-relaxed">
                    Des solutions professionnelles pour tous vos projets d'aménagement et de construction
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="#services" 
                       class="bg-white text-primary-600 px-8 py-4 rounded-lg font-semibold hover:bg-gray-50 transition-colors">
                        Découvrir nos services
                    </a>
                    <a href="#quote" 
                       class="bg-primary-600 text-white px-8 py-4 rounded-lg font-semibold hover:bg-primary-700 transition-colors">
                        Demander un devis
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Services Section -->
    <div id="services" class="py-24 sm:py-32 scroll-mt-16 bg-white">
        <div class="max-w-[95vw] mx-auto px-4">
            <div class="max-w-3xl mx-auto text-center mb-20">
                <span class="text-primary-600 font-semibold text-sm uppercase tracking-wider">Nos Services</span>
                <h2 class="text-4xl font-bold text-gray-900 mt-3 mb-6">
                    Solutions Topographiques Complètes
                </h2>
                <p class="text-xl text-gray-600 leading-relaxed">
                    Une expertise technique pointue au service de vos projets immobiliers et d'aménagement
                </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 xl:gap-8">
                @foreach($services as $service)
                    <div class="bg-white rounded-2xl p-6 xl:p-8 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 flex flex-col">
                        <div class="mb-6 relative">
                            <div class="absolute inset-0 bg-primary-100 rounded-full transform -rotate-6"></div>
                            <div class="relative bg-primary-600 text-white w-16 h-16 rounded-full flex items-center justify-center">
                                <i class="fas {{ $service['icon'] }} text-2xl"></i>
                            </div>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">{{ $service['title'] }}</h3>
                        <p class="text-gray-600 leading-relaxed flex-grow">{{ $service['description'] }}</p>
                        <div class="mt-4">
                            <a href="#quote" class="inline-flex items-center text-primary-600 hover:text-primary-700 font-medium">
                                En savoir plus
                                <i class="fas fa-arrow-right ml-2 text-sm"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Projects Gallery -->
    <div id="projects" class="py-24 sm:py-32 scroll-mt-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mx-auto text-center mb-20">
                <span class="text-primary-600 font-semibold text-sm uppercase tracking-wider">Réalisations</span>
                <h2 class="text-4xl font-bold text-gray-900 mt-3 mb-6">
                    Nos Projets Récents
                </h2>
                <p class="text-xl text-gray-600 leading-relaxed">
                    Découvrez quelques-unes de nos réalisations en topographie
                </p>
            </div>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($projects as $project)
                    <div class="bg-white rounded-2xl overflow-hidden shadow-lg group">
                        <div class="relative h-64 overflow-hidden">
                            <img src="{{ asset($project->images[0]) }}" 
                                 alt="{{ $project->title }}" 
                                 class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                            <div class="absolute bottom-4 left-4 right-4">
                                <span class="inline-block bg-primary-600 text-white text-sm px-3 py-1 rounded-full mb-2">
                                    {{ $project->type }}
                                </span>
                                <h3 class="text-xl font-bold text-white">{{ $project->title }}</h3>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center text-gray-600 mb-4">
                                <i class="fas fa-map-marker-alt text-primary-600 mr-2"></i>
                                {{ $project->location }}
                            </div>
                            <p class="text-gray-600 mb-4">{{ $project->description }}</p>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-500">
                                    <i class="far fa-calendar-alt mr-2"></i>
                                    {{ $project->completion_date->format('M Y') }}
                                </span>
                                <a href="#" class="text-primary-600 hover:text-primary-700 font-medium">
                                    Voir les détails
                                    <i class="fas fa-arrow-right ml-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Quote Request Form -->
    <div id="quote" class="py-24 sm:py-32 scroll-mt-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mx-auto">
                <div class="bg-white rounded-3xl overflow-hidden shadow-xl transform hover:scale-[1.01] transition-all duration-300">
                    <div class="p-8 md:p-12">
                        <form action="{{ route('topography.quote') }}" 
                              method="POST" 
                              class="space-y-6"
                              x-data="{ 
                                  formData: {
                                      name: '',
                                      email: '',
                                      phone: '',
                                      service_type: '',
                                      project_details: ''
                                  },
                                  step: 1,
                                  isSubmitting: false,
                                  success: false,
                                  error: null,
                                  
                                  nextStep() {
                                      if (this.step < 4) this.step++;
                                  },
                                  
                                  prevStep() {
                                      if (this.step > 1) this.step--;
                                  },
                                  
                                  async submitForm() {
                                      if (this.isSubmitting) return;
                                      
                                      this.isSubmitting = true;
                                      this.error = null;
                                      
                                      try {
                                          const response = await fetch('{{ route('topography.quote') }}', {
                                              method: 'POST',
                                              headers: {
                                                  'Content-Type': 'application/json',
                                                  'X-CSRF-TOKEN': document.querySelector('meta[name=\'csrf-token\']').content
                                              },
                                              body: JSON.stringify(this.formData)
                                          });
                                          
                                          if (!response.ok) {
                                              const errorData = await response.json();
                                              throw new Error(errorData.message || 'Une erreur est survenue');
                                          }
                                          
                                          const data = await response.json();
                                          
                                          // Reset form
                                          this.formData = {
                                              name: '',
                                              email: '',
                                              phone: '',
                                              service_type: '',
                                              project_details: ''
                                          };
                                          this.step = 1;
                                          this.success = true;
                                          
                                          // Hide success message after 5 seconds
                                          setTimeout(() => {
                                              this.success = false;
                                          }, 5000);
                                          
                                      } catch (error) {
                                          console.error('Error:', error);
                                          this.error = error.message || 'Une erreur est survenue. Veuillez réessayer.';
                                          
                                          // Hide error message after 5 seconds
                                          setTimeout(() => {
                                              this.error = null;
                                          }, 5000);
                                      } finally {
                                          this.isSubmitting = false;
                                      }
                                  }
                              }"
                              @submit.prevent="submitForm()">
                            @csrf
                            
                            <!-- Progress Bar -->
                            <div class="mb-8">
                                <div class="flex justify-between mb-2">
                                    <span class="text-sm text-gray-500">Progression</span>
                                    <span class="text-sm font-medium text-primary-600" x-text="`${step * 25}%`"></span>
                                </div>
                                <div class="h-2 bg-gray-200 rounded-full overflow-hidden">
                                    <div class="h-full bg-primary-600 transition-all duration-500"
                                         :style="`width: ${step * 25}%`"></div>
                                </div>
                            </div>

                            <!-- Step 1: Basic Info -->
                            <div x-show="step === 1" 
                                 x-transition:enter="transition ease-out duration-300"
                                 x-transition:enter-start="opacity-0 transform translate-y-4"
                                 x-transition:enter-end="opacity-100 transform translate-y-0">
                                <div class="space-y-4">
                                    <!-- Name Field -->
                                    <div class="relative group">
                                        <input type="text" 
                                               id="name"
                                               name="name" 
                                               required
                                               placeholder=" "
                                               x-model="formData.name"
                                               class="peer w-full px-4 py-3 rounded-xl border-2 border-gray-300 focus:border-primary-600 focus:ring-0 transition-colors duration-300 placeholder-transparent">
                                        <label for="name" 
                                               class="absolute left-4 -top-2.5 bg-white px-2 text-sm text-gray-600 transition-all duration-300
                                                      peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-3 
                                                      peer-focus:-top-2.5 peer-focus:text-sm peer-focus:text-primary-600">
                                            <i class="fas fa-user mr-2"></i>
                                            Nom complet
                                        </label>
                                    </div>

                                    <!-- Email Field -->
                                    <div class="relative group">
                                        <input type="email" 
                                               id="email"
                                               name="email" 
                                               required
                                               placeholder=" "
                                               x-model="formData.email"
                                               class="peer w-full px-4 py-3 rounded-xl border-2 border-gray-300 focus:border-primary-600 focus:ring-0 transition-colors duration-300 placeholder-transparent">
                                        <label for="email" 
                                               class="absolute left-4 -top-2.5 bg-white px-2 text-sm text-gray-600 transition-all duration-300
                                                      peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-3 
                                                      peer-focus:-top-2.5 peer-focus:text-sm peer-focus:text-primary-600">
                                            <i class="fas fa-envelope mr-2"></i>
                                            Email
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- Step 2: Contact -->
                            <div x-show="step === 2"
                                 x-transition:enter="transition ease-out duration-300"
                                 x-transition:enter-start="opacity-0 transform translate-y-4"
                                 x-transition:enter-end="opacity-100 transform translate-y-0">
                                <!-- Phone Field -->
                                <div class="relative group">
                                    <input type="tel" 
                                           id="phone"
                                           name="phone" 
                                           required
                                           placeholder=" "
                                           x-model="formData.phone"
                                           class="peer w-full px-4 py-3 rounded-xl border-2 border-gray-300 focus:border-primary-600 focus:ring-0 transition-colors duration-300 placeholder-transparent">
                                    <label for="phone" 
                                           class="absolute left-4 -top-2.5 bg-white px-2 text-sm text-gray-600 transition-all duration-300
                                                  peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-3 
                                                  peer-focus:-top-2.5 peer-focus:text-sm peer-focus:text-primary-600">
                                        <i class="fas fa-phone mr-2"></i>
                                        Téléphone
                                    </label>
                                </div>
                            </div>

                            <!-- Step 3: Service -->
                            <div x-show="step === 3"
                                 x-transition:enter="transition ease-out duration-300"
                                 x-transition:enter-start="opacity-0 transform translate-y-4"
                                 x-transition:enter-end="opacity-100 transform translate-y-0">
                                <!-- Service Type Field -->
                                <div class="grid grid-cols-2 gap-4">
                                    <template x-for="service in [
                                        {value: 'bornage', label: 'Bornage de terrain', icon: 'fa-map-marker-alt'},
                                        {value: 'nivellement', label: 'Nivellement', icon: 'fa-mountain'},
                                        {value: 'leve', label: 'Levé topographique', icon: 'fa-layer-group'},
                                        {value: 'implantation', label: 'Implantation', icon: 'fa-drafting-compass'}
                                    ]">
                                        <div class="relative">
                                            <input type="radio" 
                                                   :id="service.value"
                                                   name="service_type"
                                                   :value="service.value"
                                                   x-model="formData.service_type"
                                                   class="peer hidden">
                                            <label :for="service.value"
                                                   class="flex flex-col items-center p-4 rounded-xl border-2 border-gray-300 cursor-pointer
                                                          peer-checked:border-primary-600 peer-checked:bg-primary-50 transition-all duration-300">
                                                <i :class="'fas ' + service.icon" class="text-2xl mb-2 text-primary-600"></i>
                                                <span x-text="service.label" class="text-sm font-medium text-gray-900"></span>
                                            </label>
                                        </div>
                                    </template>
                                </div>
                            </div>

                            <!-- Step 4: Details -->
                            <div x-show="step === 4"
                                 x-transition:enter="transition ease-out duration-300"
                                 x-transition:enter-start="opacity-0 transform translate-y-4"
                                 x-transition:enter-end="opacity-100 transform translate-y-0">
                                <!-- Project Details Field -->
                                <div class="relative group">
                                    <textarea id="project_details"
                                              name="project_details" 
                                              rows="4" 
                                              required
                                              placeholder=" "
                                              x-model="formData.project_details"
                                              class="peer w-full px-4 py-3 rounded-xl border-2 border-gray-300 focus:border-primary-600 focus:ring-0 transition-colors duration-300 placeholder-transparent"></textarea>
                                    <label for="project_details" 
                                           class="absolute left-4 -top-2.5 bg-white px-2 text-sm text-gray-600 transition-all duration-300
                                                  peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-3 
                                                  peer-focus:-top-2.5 peer-focus:text-sm peer-focus:text-primary-600">
                                        <i class="fas fa-file-alt mr-2"></i>
                                        Description du projet
                                    </label>
                                </div>
                            </div>

                            <!-- Navigation Buttons -->
                            <div class="flex justify-between mt-8">
                                <button type="button"
                                        x-show="step > 1"
                                        @click="prevStep()"
                                        class="flex items-center px-6 py-3 text-primary-600 hover:text-primary-700 transition-colors">
                                    <i class="fas fa-arrow-left mr-2"></i>
                                    Précédent
                                </button>
                                
                                <button type="button"
                                        x-show="step < 4"
                                        @click="nextStep()"
                                        class="ml-auto flex items-center px-6 py-3 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition-colors">
                                    Suivant
                                    <i class="fas fa-arrow-right ml-2"></i>
                                </button>

                                <button type="submit"
                                        x-show="step === 4"
                                        :disabled="isSubmitting"
                                        class="ml-auto flex items-center px-6 py-3 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition-colors disabled:opacity-70 disabled:cursor-not-allowed">
                                    <span x-show="!isSubmitting">
                                        <i class="fas fa-paper-plane mr-2"></i>
                                        Envoyer la demande
                                    </span>
                                    <span x-show="isSubmitting">
                                        <i class="fas fa-circle-notch fa-spin mr-2"></i>
                                        Envoi en cours...
                                    </span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Success Message -->
                <div x-show="success"
                     x-cloak
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 transform translate-y-4"
                     x-transition:enter-end="opacity-100 transform translate-y-0"
                     class="fixed bottom-4 right-4 bg-green-500 text-white px-6 py-3 rounded-xl shadow-lg flex items-center">
                    <i class="fas fa-check-circle mr-2"></i>
                    Votre demande a été envoyée avec succès !
                </div>
                
                <!-- Error Message -->
                <div x-show="error"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 transform translate-y-4"
                     x-transition:enter-end="opacity-100 transform translate-y-0"
                     class="fixed bottom-4 right-4 bg-red-500 text-white px-6 py-3 rounded-xl shadow-lg flex items-center">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    <span x-text="error"></span>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    [x-cloak] { display: none !important; }
</style>
@endsection 