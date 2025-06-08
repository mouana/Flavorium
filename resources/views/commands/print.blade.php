@extends('layouts.app')

@section('content')
<div class="invoice-container">
    <div class="header">
        <h1>Facture #{{ $commande->id ?? 'N/A' }}</h1>
        <p>Date: {{ $commande->created_at ? $commande->created_at->format('d/m/Y H:i') : 'Date non disponible' }}</p>
    </div>

    <div class="client-info">
        <h3>Informations client</h3>
        <p><strong>Nom:</strong> {{ $commande->client ?? 'N/A' }}</p>
        <p><strong>Téléphone:</strong> {{ $commande->phone ?? '-' }}</p>
        <p><strong>Adresse:</strong> {{ $commande->address ?? 'Non spécifiée' }}</p>
    </div>

    <table class="invoice-table">
        <thead>
            <tr>
                <th>Produit</th>
                <th class="text-right">Prix unitaire</th>
                <th class="text-right">Quantité</th>
                <th class="text-right">Total</th>
            </tr>
        </thead>
        <tbody>
            @if($commande->produits && $commande->produits->count() > 0)
                @foreach($commande->produits as $produit)
                <tr>
                    <td>{{ $produit->nom }}</td>
                    <td class="text-right">{{ number_format($produit->prix_vente, 2) }} MAD</td>
                    <td class="text-right">{{ $produit->pivot->quantite }}</td>
                    <td class="text-right">
                        {{ number_format($produit->pivot->quantite * $produit->prix_vente, 2) }} MAD
                    </td>
                </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="4" class="text-center">Aucun produit dans cette commande</td>
                </tr>
            @endif
        </tbody>
    </table>

    <div class="total-section">
        @php
            $total = 0;
            if($commande->produits) {
                foreach($commande->produits as $produit) {
                    $total += $produit->prix_vente * $produit->pivot->quantite;
                }
            }
        @endphp
        <h3>Total: {{ number_format($commande->total ?? $total, 2) }} MAD</h3>
    </div>

    <div class="footer">
        <p>Merci pour votre commande !</p>
    </div>
</div>

<style>
    .invoice-container {
        font-family: DejaVu Sans, sans-serif;
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
    }
    .header {
        text-align: center;
        margin-bottom: 30px;
    }
    .client-info {
        margin-bottom: 30px;
    }
    .invoice-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 30px;
    }
    .invoice-table th, 
    .invoice-table td {
        border: 1px solid #ddd;
        padding: 8px;
    }
    .invoice-table th {
        background-color: #f2f2f2;
        text-align: left;
    }
    .text-right {
        text-align: right;
    }
    .text-center {
        text-align: center;
    }
    .total-section {
        text-align: right;
        margin-top: 20px;
    }
    .footer {
        margin-top: 40px;
        text-align: center;
    }
</style>
@endsection