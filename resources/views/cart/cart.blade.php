@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold mb-6">🛒 Votre Panier</h1>

    @if(session('cart') && count(session('cart')) > 0)
    <div class="flex justify-end mb-4">
        <!-- Formulaire POST pour vider le panier -->
        <form action="{{ route('cart.empty') }}" method="POST">
            @csrf
            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700">
                Vider le panier
            </button>
        </form>
    </div>

    <form action="{{ route('checkout') }}" method="POST" id="cart-form">
        @csrf

        <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow" id="cart-table">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th>Photo</th>
                    <th>Nom</th>
                    <th>Quantité</th>
                    <th>Prix (modifiable)</th>
                    <th>Sous-total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @php $total = 0; @endphp
                @foreach (session('cart', []) as $index => $item)
                    @php
                        $sous_total = $item['prix'] * $item['quantite'];
                        $total += $sous_total;
                    @endphp
                    <tr class="cart-item">
                        <td>
                            @if($item['photo'])
                                <img src="{{ Storage::url($item['photo']) }}" class="w-16 h-16 object-cover rounded" alt="{{ $item['nom'] }}">
                            @endif
                            <input type="hidden" name="produits[]" value="{{ $item['id'] }}">
                        </td>
                        <td>{{ $item['nom'] }}</td>

                        <td>
                            <input type="number" name="quantites[]" value="{{ $item['quantite'] }}" min="1" class="quantite w-20 border rounded-md p-1">
                        </td>

                        <td>
                            <input type="number" name="prix[]" value="{{ $item['prix'] }}" step="0.01" min="0" class="prix w-28 border rounded-md p-1">
                        </td>

                        <td class="sous-total">{{ number_format($sous_total, 2) }} MAD</td>

                        <td>
                            <!-- Formulaire POST pour supprimer le produit -->
                            <form action="{{ route('cart.remove', $item['id']) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="text-red-600 hover:underline">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="bg-gray-50">
                    <td colspan="4" class="text-right font-bold">Total :</td>
                    <td id="total" class="font-bold">{{ number_format($total, 2) }} MAD</td>
                    <td></td>
                </tr>
            </tfoot>
        </table>

        <div class="mt-6">
            <input type="text" name="client" placeholder="Nom du client" class="w-full border rounded-md p-2 mb-2" required>
            <input type="text" name="address" placeholder="Adresse" class="w-full border rounded-md p-2 mb-2" required>
            <input type="text" name="phone" placeholder="Téléphone" class="w-full border rounded-md p-2 mb-4">

            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700">
                Passer la commande
            </button>
        </div>
    </form>
    @else
        <div class="bg-yellow-100 text-yellow-800 px-4 py-3 rounded">
            Votre panier est vide.
        </div>
    @endif
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const rows = document.querySelectorAll('.cart-item');
    const totalCell = document.getElementById('total');

    function updateTotals() {
        let total = 0;
        rows.forEach(row => {
            const q = parseFloat(row.querySelector('.quantite').value) || 0;
            const p = parseFloat(row.querySelector('.prix').value) || 0;
            const st = q * p;
            row.querySelector('.sous-total').innerText = st.toFixed(2) + ' MAD';
            total += st;
        });
        totalCell.innerText = total.toFixed(2) + ' MAD';
    }

    rows.forEach(row => {
        row.querySelector('.quantite').addEventListener('input', updateTotals);
        row.querySelector('.prix').addEventListener('input', updateTotals);
    });
});
</script>
@endsection
