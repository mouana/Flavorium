@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-md overflow-hidden">
        <!-- Product Header -->
        <div class="bg-gray-50 px-6 py-4 border-b">
            <p class="text-gray-600 mt-1">{{ $produit->code }}</p>
        </div>

        <!-- Product Content -->
        <div class="md:flex">
            <!-- Product Image -->
            <div class="md:w-1/3 p-6">
                @if($produit->photo)
                    <img src="{{ asset('storage/'.$produit->photo) }}" alt="{{ $produit->nom }}" 
                         class="w-full h-auto rounded-lg shadow-sm">
                @else
                    <div class="bg-gray-200 h-64 flex items-center justify-center rounded-lg">
                        <span class="text-gray-400">Pas d'image disponible</span>
                    </div>
                @endif
            </div>

            <!-- Product Details -->
            <div class="md:w-2/3 p-6">
                <div class="space-y-4">
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">Catégorie</h3>
                        <p class="mt-1 text-gray-900">{{ $produit->categorie->nom }}</p>
                    </div>

                    <div>
                        <h3 class="text-sm font-medium text-gray-500">Description</h3>
                        <p class="mt-1 text-gray-900">{{ $produit->description ?? 'Non renseignée' }}</p>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Prix d'achat</h3>
                            <p class="mt-1 text-gray-900">{{ number_format($produit->prix, 2) }} DH</p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Prix de vente</h3>
                            <p class="mt-1 text-gray-900">{{ number_format($produit->prix_vente, 2) }} DH</p>
                        </div>
                    </div>

                    
                </div>

                <!-- Action Buttons -->
                <div class="mt-8 flex space-x-3">
                    <a href="{{ route('produits.edit', $produit->id) }}" 
                       class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Modifier
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection