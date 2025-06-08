@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Liste des produits</h1>
        <a href="{{ route('cart.view') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Voir le Panier</a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($produits as $produit)
            <form action="{{ route('cart.add') }}" method="POST" class="border p-4 rounded shadow-sm bg-white">
                @csrf
                <input type="hidden" name="id" value="{{ $produit->id }}">
                <h2 class="text-lg font-semibold">{{ $produit->nom }}</h2>
                <p class="text-gray-600">Prix : {{ $produit->prix }} MAD</p>
                <input type="number" name="quantite" value="1" min="1" class="w-20 mt-2 border rounded p-1">
                <button type="submit" class="mt-3 block w-full bg-green-600 text-white py-1 rounded hover:bg-green-700">Ajouter</button>
            </form>
        @endforeach
    </div>
</div>
@endsection
