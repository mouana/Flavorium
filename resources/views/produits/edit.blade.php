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
                        <p class="text-blue-100 text-sm mt-1">ID: #{{ $produit->id }} | Dernière modification: {{ $produit->updated_at->format('d/m/Y H:i') }}</p>
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
            <form method="POST" action="{{ route('produits.update', $produit->id) }}" class="p-6 space-y-6">
                @csrf
                @method('PUT')

                <!-- Grid Layout for Form Fields -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Product Information -->
                    <div class="md:col-span-2">
                        <h3 class="text-lg font-medium text-gray-900 mb-4 border-b pb-2">Informations de base</h3>
                    </div>
                    
                    <div>
                        <label for="nom" class="block text-sm font-medium text-gray-700">Nom du Produit *</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <input type="text" name="nom" id="nom" value="{{ old('nom', $produit->nom) }}" required
                                class="focus:ring-blue-500 focus:border-blue-500 block w-full pl-3 pr-10 py-3 sm:text-sm border-gray-300 rounded-md"
                                placeholder="Nom complet du produit">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                                    <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label for="code" class="block text-sm font-medium text-gray-700">Code Produit *</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <input type="text" name="code" id="code" value="{{ old('code', $produit->code) }}" required
                                class="focus:ring-blue-500 focus:border-blue-500 block w-full pl-3 pr-10 py-3 sm:text-sm border-gray-300 rounded-md"
                                placeholder="Code unique du produit">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M12.316 3.051a1 1 0 01.633 1.265l-4 12a1 1 0 11-1.898-.632l4-12a1 1 0 011.265-.633zM5.707 6.293a1 1 0 010 1.414L3.414 10l2.293 2.293a1 1 0 11-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0zm8.586 0a1 1 0 011.414 0l3 3a1 1 0 010 1.414l-3 3a1 1 0 11-1.414-1.414L16.586 10l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="md:col-span-2">
                        <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                        <div class="mt-1">
                            <textarea name="description" id="description" rows="3"
                                class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border border-gray-300 rounded-md"
                                placeholder="Description détaillée du produit">{{ old('description', $produit->description) }}</textarea>
                        </div>
                    </div>

                    <!-- Pricing Section -->
                    <div class="bg-blue-50 p-4 rounded-md md:col-span-2">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Informations Financières</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="prix" class="block text-sm font-medium text-gray-700">Prix (MAD) *</label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 sm:text-sm">MAD</span>
                                    </div>
                                    <input type="number" name="prix" id="prix" value="{{ old('prix', $produit->prix) }}" step="0.01" min="0" required
                                        class="focus:ring-blue-500 focus:border-blue-500 block w-full pl-16 pr-12 py-3 sm:text-sm border-gray-300 rounded-md"
                                        placeholder="0.00">
                                </div>
                            </div>
                            <div>
                                <label for="chiffre_affaires" class="block text-sm font-medium text-gray-700">Chiffre d'affaires (MAD)</label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 sm:text-sm">MAD</span>
                                    </div>
                                    <input type="number" name="chiffre_affaires" id="chiffre_affaires" value="{{ old('chiffre_affaires', $produit->chiffre_affaires) }}" step="0.01" min="0"
                                        class="focus:ring-blue-500 focus:border-blue-500 block w-full pl-16 pr-12 py-3 sm:text-sm border-gray-300 rounded-md"
                                        placeholder="0.00">
                                </div>
                            </div>
                            <div>
                                <label for="revenus" class="block text-sm font-medium text-gray-700">Revenus (MAD)</label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 sm:text-sm">MAD</span>
                                    </div>
                                    <input type="number" name="revenus" id="revenus" value="{{ old('revenus', $produit->revenus) }}" step="0.01" min="0"
                                        class="focus:ring-blue-500 focus:border-blue-500 block w-full pl-16 pr-12 py-3 sm:text-sm border-gray-300 rounded-md"
                                        placeholder="0.00">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Inventory Section -->
                    <div class="bg-blue-50 p-4 rounded-md md:col-span-2">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Gestion de Stock</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="stock" class="block text-sm font-medium text-gray-700">Stock Actuel *</label>
                                <div class="mt-1">
                                    <input type="number" name="stock" id="stock" value="{{ old('stock', $produit->stock) }}" min="0" required
                                        class="focus:ring-blue-500 focus:border-blue-500 block w-full px-3 py-3 sm:text-sm border-gray-300 rounded-md"
                                        placeholder="Quantité en stock">
                                </div>
                            </div>
                            <div>
                                <label for="seuil_critique" class="block text-sm font-medium text-gray-700">Seuil Critique *</label>
                                <div class="mt-1">
                                    <input type="number" name="seuil_critique" id="seuil_critique" value="{{ old('seuil_critique', $produit->seuil_critique) }}" min="0" required
                                        class="focus:ring-blue-500 focus:border-blue-500 block w-full px-3 py-3 sm:text-sm border-gray-300 rounded-md"
                                        placeholder="Niveau d'alerte">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Category Selection -->
                    <div class="md:col-span-2">
                        <label for="categorie_id" class="block text-sm font-medium text-gray-700">Catégorie *</label>
                        <div class="mt-1">
                            <select name="categorie_id" id="categorie_id" required
                                class="focus:ring-blue-500 focus:border-blue-500 block w-full pl-3 pr-10 py-3 sm:text-sm border-gray-300 rounded-md">
                                <option value="">Choisir une catégorie</option>
                                @foreach ($categories as $categorie)
                                    <option value="{{ $categorie->id }}" {{ old('categorie_id', $produit->categorie_id) == $categorie->id ? 'selected' : '' }}>
                                        {{ $categorie->nom }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex flex-col sm:flex-row justify-end pt-6 border-t border-gray-200 space-y-3 sm:space-y-0 sm:space-x-3">
                    <a href="{{ route('produits.show', $produit->id) }}" class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                        </svg>
                        Aperçu
                    </a>
                    <button type="reset" class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Réinitialiser
                    </button>
                    <button type="submit" class="inline-flex items-center justify-center px-6 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                        Mettre à jour
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection