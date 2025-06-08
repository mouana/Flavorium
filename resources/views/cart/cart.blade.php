@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-lg">
    <h2 class="text-3xl font-bold mb-6 text-gray-800 border-b pb-2">Votre Panier</h2>

    @if (session('cart') && count(session('cart')) > 0)
        <div class="mb-6">
            <form method="POST" action="{{ route('cart.empty') }}" class="inline-block">
                @csrf
                <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium">
                    <i class="fas fa-trash mr-1"></i> Vider le panier
                </button>
            </form>
        </div>

        <form method="POST" action="{{ route('cart.checkout') }}">
            @csrf
            <div class="space-y-4 mb-8">
                @foreach (session('cart') as $id => $item)
                    <div class="border p-4 rounded-lg flex justify-between items-start">
                        <div class="flex-1">
                            <input type="hidden" name="produits[]" value="{{ $item['id'] }}">
                            <h3 class="font-semibold text-lg text-gray-800">{{ $item['nom'] }}</h3>
                            <p class="text-gray-600">Prix unitaire : {{ number_format($item['prix'], 2) }} MAD</p>
                            <div class="mt-2 flex items-center">
                                <label class="mr-2 text-gray-700">Quantité:</label>
                                <input type="number" name="quantites[]" value="{{ $item['quantite'] }}" min="1"
                                       class="border p-1 w-20 rounded">
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="font-bold text-gray-800">{{ number_format($item['prix'] * $item['quantite'], 2) }} MAD</p>

                            <button type="button"
                                    class="mt-2 text-red-500 hover:text-red-700 text-sm remove-from-cart"
                                    data-id="{{ $id }}">
                                <i class="fas fa-times mr-1"></i> Supprimer
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>

           <div class="bg-gray-50 p-6 rounded-lg">
                <h3 class="text-xl font-semibold mb-4 text-gray-800">Informations du client</h3>
                <div class="space-y-4">
                    <div>
                        <label class="block text-gray-700 mb-1">Nom complet</label>
                        <input type="text" name="client" placeholder="Votre nom complet" required 
                               class="w-full border border-gray-300 p-2 rounded focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-gray-700 mb-1">Téléphone</label>
                        <input type="tel" name="phone" placeholder="Votre numéro de téléphone" 
                               class="w-full border border-gray-300 p-2 rounded focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-gray-700 mb-1">Adresse</label>
                        <textarea name="address" placeholder="Votre adresse de livraison" rows="3" required 
                                  class="w-full border border-gray-300 p-2 rounded focus:ring-2 focus:ring-blue-500"></textarea>
                    </div>
                </div>

                <div class="mt-6 flex justify-between items-center">
                    <a href="{{ route('commands.create') }}" class="text-blue-600 hover:underline">
                        <i class="fas fa-arrow-left mr-1"></i> Continuer vos achats
                    </a>
                    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors font-medium">
                        Valider la commande <i class="fas fa-check ml-1"></i>
                    </button>
                </div>
            </div>

        </form>
    @else
        <div class="text-center py-12">
            <div class="text-gray-400 text-5xl mb-4">
                <i class="fas fa-shopping-cart"></i>
            </div>
            <h3 class="text-xl font-medium text-gray-700 mb-2">Votre panier est vide</h3>
            <p class="text-gray-500 mb-6">Ajoutez des produits à votre panier avant de passer commande</p>
            <a href="{{ route('commands.create') }}"
               class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 inline-block font-medium">
                <i class="fas fa-store mr-2"></i> Continuer vos achats
            </a>
        </div>
    @endif
</div>

<script>
    document.querySelectorAll('.remove-from-cart').forEach(button => {
        button.addEventListener('click', function () {
            const id = this.dataset.id;

            fetch(`{{ url('cart/remove') }}/${id}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
            })
            .then(res => {
                if (res.ok) {
                    location.reload(); 
                } else {
                    alert("Une erreur ");
                }
            });
        });
    });
</script>
@endsection
