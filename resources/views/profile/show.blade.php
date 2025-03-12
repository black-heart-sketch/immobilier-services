@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
        <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
            <div class="flex items-center">
                <img src="{{ auth()->user()->profile_photo_url ?? asset('images/default-avatar.png') }}" 
                     alt="Profile photo" 
                     class="h-20 w-20 rounded-full">
                <div class="ml-4">
                    <h2 class="text-2xl font-bold">{{ auth()->user()->name }}</h2>
                    <p class="text-gray-600">{{ auth()->user()->email }}</p>
                </div>
            </div>

            <div class="mt-8">
                <div class="space-y-6">
                    <!-- Profile Information Form -->
                    <form action="{{ route('profile.update') }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')
                        
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Nom</label>
                            <input type="text" name="name" id="name" value="{{ auth()->user()->name }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="email" id="email" value="{{ auth()->user()->email }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                        </div>

                        <div>
                            <button type="submit" 
                                    class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                                Mettre à jour le profil
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 