@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
        <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
            <div class="mt-8 space-y-6">
                <!-- Notifications Settings -->
                <div>
                    <h3 class="text-lg font-medium text-gray-900">Notifications</h3>
                    <div class="mt-4 space-y-4">
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input type="checkbox" id="email_notifications" name="email_notifications"
                                       class="focus:ring-primary-500 h-4 w-4 text-primary-600 border-gray-300 rounded">
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="email_notifications" class="font-medium text-gray-700">Notifications par email</label>
                                <p class="text-gray-500">Recevoir des notifications par email pour les mises à jour importantes.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Privacy Settings -->
                <div class="pt-6">
                    <h3 class="text-lg font-medium text-gray-900">Confidentialité</h3>
                    <div class="mt-4 space-y-4">
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input type="checkbox" id="profile_visibility" name="profile_visibility"
                                       class="focus:ring-primary-500 h-4 w-4 text-primary-600 border-gray-300 rounded">
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="profile_visibility" class="font-medium text-gray-700">Profil public</label>
                                <p class="text-gray-500">Rendre votre profil visible pour les autres utilisateurs.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pt-6">
                    <button type="submit" 
                            class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                        Sauvegarder les paramètres
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 