@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-md overflow-hidden">
        <div class="bg-gray-50 px-6 py-4 border-b">
            <h1 class="text-2xl font-bold text-gray-800">Détails du Mouvement #{{ $mouvement->id }}</h1>
        </div>

        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="text-sm font-medium text-gray-500">Type</h3>
                    <p class="mt-1">
                        <span class="px-2 py-1 rounded-full text-xs font-medium 
                            {{ $mouvement->type === 'entree' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $mouvement->type === 'entree' ? 'Entrée' : 'Sortie' }}
                        </span>
                    </p>
                </div>

                <div>
                    <h3 class="text-sm font-medium text-gray-500">Quantité</h3>
                    <p class="mt-1">{{ $mouvement->quantite }}</p>
                </div>

                <div>
                    <h3 class="text-sm font-medium text-gray-500">Produit</h3>
                    <p class="mt-1">{{ $mouvement->produit->nom ?? 'N/A' }}</p>
                </div>

                <div>
                    <h3 class="text-sm font-medium text-gray-500">Prix</h3>
                    <p class="mt-1">{{ number_format($mouvement->prix, 2) }} MAD</p>
                </div>

                <div>
                    <h3 class="text-sm font-medium text-gray-500">Utilisateur</h3>
                    <p class="mt-1">{{ $mouvement->user->name ?? 'Système' }}</p>
                </div>

                <div>
                    <h3 class="text-sm font-medium text-gray-500">Date</h3>
                    <p class="mt-1">{{ $mouvement->created_at->format('d/m/Y H:i') }}</p>
                </div>
            </div>

            <div class="mt-8 flex space-x-3">
                <a href="{{ route('mouvements.index') }}" 
                   class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                   ← Retour à la liste
                </a>
            </div>
        </div>
    </div>
</div>
@endsection