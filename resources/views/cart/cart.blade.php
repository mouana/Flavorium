@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8 px-2">
    <h1 class="text-2xl font-bold mb-6 text-gray-800 dark:text-gray-100"> Votre Panier</h1>

    @if(session('cart') && count(session('cart')) > 0)
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 space-y-2 sm:space-y-0">
        <!-- Vider le panier -->
        <form action="{{ route('cart.empty') }}" method="POST" class="w-full sm:w-auto">
            @csrf
            <button type="submit" class="w-full sm:w-auto bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700 transition">
                Vider le panier
            </button>
        </form>

        <!-- Poursuivre la commande -->
       <a href="{{ route('commands.create') }}"">
    @csrf
    <button type="submit" class="w-full sm:w-auto bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 transition">
        Poursuivre la commande
    </button>
</a>

    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow">
            <thead class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 uppercase tracking-wider">
                <tr>
                    <th class="px-2 sm:px-4 py-2 text-left">Photo</th>
                    <th class="px-2 sm:px-4 py-2 text-left">Nom</th>
                    <th class="px-2 sm:px-4 py-2 text-left">Quantité</th>
                    <th class="px-2 sm:px-4 py-2 text-left">Prix (MAD)</th>
                    <th class="px-2 sm:px-4 py-2 text-left">Sous-total</th>
                    <th class="px-2 sm:px-4 py-2 text-left">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                @php $total = 0; @endphp
                @foreach (session('cart', []) as $index => $item)
                    @php
                        $sous_total = $item['prix'] * $item['quantite'];
                        $total += $sous_total;
                    @endphp
                    <tr class="cart-item hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                        <td class="px-2 sm:px-4 py-2">
                            @if($item['photo'])
                                <img src="{{ Storage::url($item['photo']) }}" class="w-12 h-12 sm:w-16 sm:h-16 object-cover rounded" alt="{{ $item['nom'] }}">
                            @endif
                            <input type="hidden" name="produits[]" value="{{ $item['id'] }}">
                        </td>
                        <td class="px-2 sm:px-4 py-2">{{ $item['nom'] }}</td>
                        <td class="px-2 sm:px-4 py-2">
                            <input type="number" name="quantites[]" value="{{ $item['quantite'] }}" min="1" class="quantite w-16 sm:w-20 border rounded-md p-1">
                        </td>
                        <td class="px-2 sm:px-4 py-2">
                            <input type="number" name="prix[]" value="{{ $item['prix'] }}" step="0.01" min="0" class="prix w-20 sm:w-28 border rounded-md p-1">
                        </td>
                        <td class="px-2 sm:px-4 py-2 sous-total font-medium">{{ number_format($sous_total, 2) }} MAD</td>
                        <td class="px-2 sm:px-4 py-2">
                            <form action="{{ route('cart.remove', $item['id']) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="text-red-600 hover:underline">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
         <div class="flex justify-between items-center bg-gray-50 dark:bg-gray-700 font-bold rounded-md px-2 sm:px-4 py-2 mt-2">
    <span>Total :</span>
    <span id="total">{{ number_format($total, 2) }} MAD</span>
</div>

    </div>

    <form action="{{ route('checkout') }}" method="POST" id="cart-form" class="mt-6 space-y-3 w-full sm:w-1/2">
        @csrf
        <input type="text" name="client" placeholder="Nom du client" class="w-full border rounded-md p-2" required>
        <input type="text" name="address" placeholder="Adresse" class="w-full border rounded-md p-2" required>
        <input type="text" name="phone" placeholder="Téléphone" class="w-full border rounded-md p-2">

        <button type="submit" class="bg-blue-600 text-white w-70 p-2 rounded-md hover:bg-blue-700 transition">
            Passer la commande
        </button>
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
