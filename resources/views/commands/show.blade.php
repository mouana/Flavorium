@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto p-4 sm:p-6">
    <!-- Order Header -->
    <div class="bg-white shadow-sm rounded-lg p-4 mb-6 border border-gray-200">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Commande #{{ $commande->id }}</h1>
                <p class="text-gray-600">Date: {{ $commande->created_at->format('d/m/Y H:i') }}</p>
            </div>
            <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-medium">
                {{ $commande->created_at->diffForHumans() }}
            </span>
        </div>
    </div>

    <!-- Main Table Container -->
    <div class="overflow-x-auto bg-white shadow-sm rounded-lg border border-gray-200 mb-6">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th colspan="2" class="px-6 py-3 text-left text-sm font-medium text-gray-700 border-b">
                        Détails de la commande
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                <!-- Client and Order Info Row -->
                <tr>
                    <td class="p-4 md:p-6 border-b">
                        <div class="mb-4">
                            <h2 class="text-lg font-semibold text-gray-700">Informations du client</h2>
                        </div>
                        <div class="space-y-3">
                            <div>
                                <p class="text-sm text-gray-500 font-medium">Nom complet</p>
                                <p class="text-gray-800">{{ $commande->client }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 font-medium">Téléphone</p>
                                <p class="text-gray-800">{{ $commande->phone }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 font-medium">Adresse</p>
                                <p class="text-gray-800 whitespace-pre-line">{{ $commande->address }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="p-4 md:p-6 border-b">
                        <div class="mb-4">
                            <h2 class="text-lg font-semibold text-gray-700">Résumé de la commande</h2>
                        </div>
                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Statut:</span>
                                <span class="font-medium {{ $commande->status === 'livre' ? 'text-green-600' : ($commande->status === 'annule' ? 'text-red-600' : 'text-blue-600') }}">
                                    {{ ucfirst($commande->status) }}
                                </span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Articles:</span>
                                <span class="font-medium">{{ $commande->produits->count() }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Méthode de paiement:</span>
                                <span class="font-medium">À la livraison</span>
                            </div>
                            <div class="border-t mt-4 pt-4">
                                <div class="flex justify-between font-bold text-lg">
                                    <span>Total:</span>
                                    <span>{{ number_format($commande->total, 2) }} MAD</span>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>

                <!-- Products Header Row -->
                <tr>
                    <td colspan="2" class="px-6 py-3 text-left text-sm font-medium text-gray-700 border-b">
                        Produits commandés
                    </td>
                </tr>

                <!-- Products List -->
                @foreach($commande->produits as $produit)
                <tr class="hover:bg-gray-50">
                    <td colspan="2" class="p-4">
                        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                            <div class="flex items-center gap-4">
                                <div class="flex-shrink-0 h-16 w-16 bg-gray-200 rounded-md overflow-hidden">
                                    @if($produit->image)
                                        <img src="{{ asset('storage/'.$produit->image) }}" alt="{{ $produit->nom }}" class="h-full w-full object-cover">
                                    @else
                                        <div class="h-full w-full bg-gray-300 flex items-center justify-center">
                                            <svg class="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                <div>
                                    <h3 class="font-medium text-gray-900">{{ $produit->nom }}</h3>
                                    <p class="text-sm text-gray-500">{{ $produit->categorie->nom }}</p>
                                    <p class="text-sm text-gray-500 mt-1">Quantité: {{ $produit->pivot->quantite }}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="font-medium">{{ number_format($produit->pivot->quantite * $produit->prix_vente, 2) }} MAD</p>
                                <p class="text-sm text-gray-500">{{ number_format($produit->prix_vente, 2) }} MAD × {{ $produit->pivot->quantite }}</p>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach

                <!-- Order Summary Row -->
                <tr>
                    <td colspan="2" class="p-4 bg-gray-50">
                        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                            <div>
                                <a href="{{ route('commands.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800">
                                    <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                    </svg>
                                    Retour aux commandes
                                </a>
                            </div>
                            <div class="text-right">
                                <p class="text-sm text-gray-500">Sous-total: {{ number_format($commande->total, 2) }} MAD</p>
                                <p class="text-sm text-gray-500">Livraison: 0.00 MAD</p>
                                <p class="text-lg font-bold mt-1">Total: {{ number_format($commande->total, 2) }} MAD</p>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

</div>
@endsection