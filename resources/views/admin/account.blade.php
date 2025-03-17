@extends('layouts.admin')

@section('title', 'Mon Compte')

@section('content')
<div class="grid grid-cols-1 gap-6">
    <!-- Profile Section -->
    <div class="bg-white shadow-sm rounded-lg">
        <div class="p-4 sm:px-6 lg:px-8 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-900">Profil</h2>
            <p class="mt-1 text-sm text-gray-500">Gérer vos informations personnelles</p>
        </div>

        <div class="p-4 sm:px-6 lg:px-8">
            <form action="{{ route('admin.profile.update') }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                    <div class="sm:col-span-3">
                        <label for="first_name" class="block text-sm font-medium text-gray-700">Prénom</label>
                        <div class="mt-1">
                            <input type="text" name="first_name" id="first_name" 
                                   value="{{ auth()->user()->first_name }}"
                                   class="shadow-sm focus:ring-primary-500 focus:border-primary-500 block w-full sm:text-sm border-gray-300 rounded-md">
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="last_name" class="block text-sm font-medium text-gray-700">Nom</label>
                        <div class="mt-1">
                            <input type="text" name="last_name" id="last_name" 
                                   value="{{ auth()->user()->last_name }}"
                                   class="shadow-sm focus:ring-primary-500 focus:border-primary-500 block w-full sm:text-sm border-gray-300 rounded-md">
                        </div>
                    </div>

                    <div class="sm:col-span-4">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <div class="mt-1">
                            <input type="email" name="email" id="email" 
                                   value="{{ auth()->user()->email }}"
                                   class="shadow-sm focus:ring-primary-500 focus:border-primary-500 block w-full sm:text-sm border-gray-300 rounded-md">
                        </div>
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit" 
                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                        Sauvegarder
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Security Section -->
    <div class="bg-white shadow-sm rounded-lg">
        <div class="p-4 sm:px-6 lg:px-8 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-900">Sécurité</h2>
            <p class="mt-1 text-sm text-gray-500">Mettre à jour votre mot de passe</p>
        </div>

        <div class="p-4 sm:px-6 lg:px-8">
            <form action="{{ route('admin.password.update') }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                    <div class="sm:col-span-4">
                        <label for="current_password" class="block text-sm font-medium text-gray-700">Mot de passe actuel</label>
                        <div class="mt-1">
                            <input type="password" name="current_password" id="current_password" 
                                   class="shadow-sm focus:ring-primary-500 focus:border-primary-500 block w-full sm:text-sm border-gray-300 rounded-md">
                        </div>
                    </div>

                    <div class="sm:col-span-4">
                        <label for="password" class="block text-sm font-medium text-gray-700">Nouveau mot de passe</label>
                        <div class="mt-1">
                            <input type="password" name="password" id="password" 
                                   class="shadow-sm focus:ring-primary-500 focus:border-primary-500 block w-full sm:text-sm border-gray-300 rounded-md">
                        </div>
                    </div>

                    <div class="sm:col-span-4">
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmer le mot de passe</label>
                        <div class="mt-1">
                            <input type="password" name="password_confirmation" id="password_confirmation" 
                                   class="shadow-sm focus:ring-primary-500 focus:border-primary-500 block w-full sm:text-sm border-gray-300 rounded-md">
                        </div>
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit" 
                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                        Mettre à jour le mot de passe
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 