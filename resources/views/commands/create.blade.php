@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 py-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
        <h1 class="text-2xl font-bold text-gray-800">Liste des produits</h1>
        <a href="{{ route('cart.view') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors duration-200 w-full sm:w-auto text-center">
            Voir le Panier
        </a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
        @foreach ($produits as $produit)
            <form action="{{ route('cart.add') }}" method="POST" class="border border-gray-200 p-4 rounded-lg shadow-sm bg-white hover:shadow-md transition-shadow duration-200">
                @csrf
                <input type="hidden" name="id" value="{{ $produit->id }}">
                
                @if($produit->photo)
                    <div class="aspect-w-16 aspect-h-9 mb-4 overflow-hidden rounded-lg">
                        <img class="w-full h-48 object-cover" src="{{ Storage::url($produit->photo) }}" alt="{{ $produit->nom }}" loading="lazy">
                    </div>
                @endif
                
                <div class="space-y-2">
                    <h2 class="text-lg font-semibold text-gray-800">{{ $produit->nom }}</h2>
                    <p class="text-gray-600">Prix : <span class="font-medium">{{ $produit->prix_vente }} MAD</span></p>
                    
                    <div class="flex items-center gap-4 mt-3">
                        <input type="number" name="quantite" value="1" min="1" class="w-20 border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <button type="submit" class="flex-1 bg-green-600 text-white py-2 px-4 rounded-md hover:bg-green-700 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                            Ajouter
                        </button>
                    </div>
                </div>
            </form>
        @endforeach
    </div>
</div>
@endsection