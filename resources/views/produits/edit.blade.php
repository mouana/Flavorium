@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white shadow-xl rounded-lg overflow-hidden">

            <!-- Form Header -->
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 px-6 py-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-white">Modifier le Produit</h1>
                        <p class="text-blue-100 text-sm mt-1">
    ID: #{{ $produit->id }} | Dernière modification: {{ $produit->updated_at?->format('d/m/Y H:i') ?? 'Non défini' }}
</p>

                    </div>
                    <a href="{{ route('produits.index') }}" class="text-white hover:text-blue-200 flex items-center text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                        </svg>
                        Retour
                    </a>
                </div>
            </div>

            <!-- Form Content -->
            <form method="POST" action="{{ route('produits.update', $produit->id) }}" class="p-6 space-y-6" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <!-- Basic Info -->
                    <div class="md:col-span-2">
                        <h3 class="text-lg font-medium text-gray-900 mb-4 border-b pb-2">Informations de base</h3>
                    </div>

                    <div>
                        <label for="nom" class="block text-sm font-medium text-gray-700">Nom du Produit *</label>
                        <input type="text" name="nom" id="nom" value="{{ old('nom', $produit->nom) }}" required
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm py-3 px-3"
                               placeholder="Nom complet du produit">
                    </div>

                    <div>
                        <label for="code" class="block text-sm font-medium text-gray-700">Code Produit *</label>
                        <input type="text" name="code" id="code" value="{{ old('code', $produit->code) }}" required
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm py-3 px-3"
                               placeholder="Code unique du produit">
                    </div>

                    <div class="md:col-span-2">
                        <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea name="description" id="description" rows="3"
                                  class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm px-3 py-3"
                                  placeholder="Description détaillée du produit">{{ old('description', $produit->description) }}</textarea>
                    </div>

                    <!-- Pricing -->
                    <div class="bg-blue-50 p-4 rounded-md md:col-span-2">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Informations Financières</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                            <div>
                                <label for="prix" class="block text-sm font-medium text-gray-700">Prix d'achat (MAD) *</label>
                                <input type="number" name="prix" id="prix" value="{{ old('prix', $produit->prix) }}" step="0.01" min="0" required
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm py-3 px-3"
                                       placeholder="0.00">
                            </div>

                            <div>
                                <label for="prix_vente" class="block text-sm font-medium text-gray-700">Prix de vente (MAD) *</label>
                                <input type="number" name="prix_vente" id="prix_vente" value="{{ old('prix_vente', $produit->prix_vente) }}" step="0.01" min="0" required
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm py-3 px-3"
                                       placeholder="0.00">
                            </div>
                        </div>
                    </div>

                    <!-- Photo -->
                    <div class="md:col-span-2">
                        <label for="photo" class="block text-sm font-medium text-gray-700">Photo du produit</label>
                        <input type="file" name="photo" id="photo" accept="image/*"
                               class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        @if($produit->photo)
                            <img src="{{ asset('storage/' . $produit->photo) }}" alt="Photo du produit" class="mt-2 w-32 h-32 object-cover rounded-md">
                        @endif
                    </div>

                    <!-- Category -->
                    <div class="md:col-span-2">
                        <label for="categorie_id" class="block text-sm font-medium text-gray-700">Catégorie *</label>
                        <select name="categorie_id" id="categorie_id" required
                                class="mt-1 block w-full pl-3 pr-10 py-3 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            <option value="">Choisir une catégorie</option>
                            @foreach ($categories as $categorie)
                                <option value="{{ $categorie->id }}" {{ old('categorie_id', $produit->categorie_id) == $categorie->id ? 'selected' : '' }}>
                                    {{ $categorie->nom }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                </div>

                <!-- Actions -->
                <div class="flex flex-col sm:flex-row justify-end pt-6 border-t border-gray-200 space-y-3 sm:space-y-0 sm:space-x-3">
                    <a href="{{ route('produits.show', $produit->id) }}" class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                        Aperçu
                    </a>
                    <button type="reset" class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                        Réinitialiser
                    </button>
                    <button type="submit" class="inline-flex items-center justify-center px-6 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700">
                        Mettre à jour
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
