@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Mon Compte</h1>
            <p class="text-gray-600 dark:text-gray-300 mt-2">Gérez vos informations personnelles et vos paramètres</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 p-6">
            <!-- Left Column - Profile Info -->
            <div class="md:col-span-1">
                <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow">
                    <div class="flex flex-col items-center">
                        <div class="h-24 w-24 rounded-full bg-blue-100 dark:bg-blue-900 flex items-center justify-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-blue-600 dark:text-blue-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <h2 class="text-lg font-semibold text-gray-800 dark:text-white">{{ Auth::user()->name }}</h2>
                        <p class="text-gray-500 dark:text-gray-400">{{ Auth::user()->email }}</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">
                            Membre depuis {{ Auth::user()->created_at->format('d/m/Y') }}
                        </p>
                    </div>
                </div>

                <!-- Navigation -->
                <div class="mt-4 bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow">
                    <nav class="space-y-2">
                        <a href="#profile" class="block px-4 py-2 text-sm font-medium text-blue-700 dark:text-blue-300 bg-blue-100 dark:bg-blue-900 rounded-md">Profil</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left block px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600 rounded-md">
                                Déconnexion
                            </button>
                        </form>
                    </nav>
                </div>
            </div>
            

            <!-- Right Column - Forms -->
            <div class="md:col-span-2 space-y-6">
                <!-- Profile Information -->
                <div id="profile" class="bg-white dark:bg-gray-700 p-6 rounded-lg shadow">
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Informations du profil</h2>
                    
                    <form method="POST" action="{{ route('mon-compte.update') }}">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nom complet</label>
                                <input type="text" name="name" id="name" value="{{ old('name', Auth::user()->name) }}" 
                                    class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:text-white">
                                @error('name')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Adresse email</label>
                                <input type="email" name="email" id="email" value="{{ old('email', Auth::user()->email) }}" 
                                    class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:text-white">
                                @error('email')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Téléphone</label>
                                <input type="text" name="phone" id="phone" value="{{ old('phone', Auth::user()->phone) }}" 
                                    class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:text-white">
                                @error('phone')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-6">
                            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Enregistrer les modifications
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Change Password -->
                <div id="security" class="bg-white dark:bg-gray-700 p-6 rounded-lg shadow">
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Changer le mot de passe</h2>
                    
                    <form method="POST" action="{{ route('mon-compte.password') }}">
                        @csrf
                        @method('PUT')

                        <div class="space-y-4">
                            <div>
                                <label for="current_password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Mot de passe actuel</label>
                                <input type="password" name="current_password" id="current_password" 
                                    class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:text-white">
                                @error('current_password')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nouveau mot de passe</label>
                                <input type="password" name="password" id="password" 
                                    class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:text-white">
                                @error('password')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Confirmer le nouveau mot de passe</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" 
                                    class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:text-white">
                            </div>
                        </div>

                        <div class="mt-6">
                            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Mettre à jour le mot de passe
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<div class="bg-white dark:bg-gray-700 p-6 rounded-lg shadow">
    <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Historique des commandes</h2>

@forelse ($commandes ?? [] as $commande)
    <div class="mb-6 border border-gray-300 dark:border-gray-600 rounded-md p-4">
        <div class="mb-2">
            <strong class="text-gray-700 dark:text-gray-200">Commande ID:</strong> {{ $commande->id }} <br>
            <strong class="text-gray-700 dark:text-gray-200">Téléphone:</strong> {{ $commande->phone }} <br>
            <strong class="text-gray-700 dark:text-gray-200">Adresse:</strong> {{ $commande->address }} <br>
            <strong class="text-gray-700 dark:text-gray-200">Client:</strong> {{ $commande->client }} <br>
            <strong class="text-gray-700 dark:text-gray-200">Date:</strong> {{ $commande->created_at->format('d/m/Y H:i') }}
        </div>

        <div>
            <strong class="text-gray-700 dark:text-gray-200">Produits commandés:</strong>
            <ul class="list-disc pl-5 mt-2 text-gray-800 dark:text-gray-300">
                @foreach ($commande->produits as $produit)
                    <li>
                        {{ $produit->nom }} — Quantité: {{ $produit->pivot->quantite }}
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@empty
    <p class="text-gray-600 dark:text-gray-300">Aucune commande trouvée.</p>
@endforelse

</div>

</div>
@endsection