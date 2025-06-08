@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-6 bg-white rounded-xl shadow-md">
    <h2 class="text-2xl font-bold mb-6">Modifier la Commande #{{ $commande->id }}</h2>

    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 text-red-600 rounded">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('commands.update', $commande) }}">
        @csrf
        @method('PUT')

        <!-- Client Information Section -->
        <div class="mb-6 p-4 border rounded-lg bg-gray-50">
            <h3 class="text-lg font-semibold mb-3">Informations du Client</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nom complet</label>
                    <input type="text" name="client_name" value="{{ old('client_name', $commande->client_name) }}"
                        class="w-full border rounded p-2" required>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Téléphone</label>
                    <input type="tel" name="client_phone" value="{{ old('client_phone', $commande->client_phone) }}"
                        class="w-full border rounded p-2" required>
                </div>
                
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Adresse</label>
                    <textarea name="client_address" rows="2"
                        class="w-full border rounded p-2" required>{{ old('client_address', $commande->client_address) }}</textarea>
                </div>
            </div>
        </div>

        <!-- Products Section -->
        <div class="space-y-4 mb-6">
            <h3 class="text-lg font-semibold">Produits</h3>
            
            <!-- Product Search and Add -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Ajouter un produit</label>
                <div class="flex gap-2">
                    <select id="product-select" class="flex-1 border rounded p-2">
                        <option value="">Sélectionner un produit</option>
                        @foreach ($produits as $produit)
                            <option value="{{ $produit->id }}" 
                                    data-name="{{ $produit->nom }}"
                                    data-price="{{ $produit->prix }}">
                                {{ $produit->nom }} ({{ $produt->prix }} MAD)
                            </option>
                        @endforeach
                    </select>
                    <div class="flex items-center gap-2">
                        <input type="number" id="product-quantity" value="1" min="1" 
                               class="w-20 border rounded p-2 text-center" placeholder="Qté">
                        <button type="button" id="add-product-btn" 
                                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                            Ajouter
                        </button>
                    </div>
                </div>
            </div>

            <!-- Selected Products List -->
            <div id="selected-products" class="space-y-3">
                @foreach ($commande->produits as $produit)
                    <div class="selected-product flex items-center justify-between gap-4 border-b pb-3">
                        <div>
                            <p class="product-name font-medium">{{ $produit->nom }}</p>
                            <p class="text-sm text-gray-500">Prix: <span class="product-price">{{ $produit->prix }}</span> MAD</p>
                            <input type="hidden" name="produits[]" class="product-id" value="{{ $produit->id }}">
                        </div>
                        <div class="flex items-center gap-2">
                            <label class="text-sm text-gray-600">Quantité:</label>
                            <input type="number" name="quantites[]" value="{{ $produit->pivot->quantite }}" min="1"
                                   class="w-20 border rounded p-1 text-center product-quantity">
                            <button type="button" class="remove-product text-red-600 hover:text-red-800">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="flex justify-between mt-6">
            <a href="{{ route('commands.show', $commande) }}" class="text-gray-600 hover:text-gray-800">
                ← Annuler
            </a>
            <button type="submit"
                class="bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded">
                Enregistrer les modifications
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const productSelect = document.getElementById('product-select');
    const quantityInput = document.getElementById('product-quantity');
    const addProductBtn = document.getElementById('add-product-btn');
    const selectedProducts = document.getElementById('selected-products');

    // Track added product IDs to prevent duplicates
    const addedProductIds = new Set();
    // Initialize with existing products
    document.querySelectorAll('.product-id').forEach(input => {
        addedProductIds.add(input.value);
    });

    addProductBtn.addEventListener('click', function() {
        const selectedOption = productSelect.options[productSelect.selectedIndex];
        const productId = selectedOption.value;
        const quantity = parseInt(quantityInput.value) || 1;
        
        if (!productId) return;
        
        // Validate quantity
        if (quantity < 1) {
            alert('La quantité doit être au moins 1');
            return;
        }

        // Check if product already added
        if (addedProductIds.has(productId)) {
            alert('Ce produit est déjà ajouté');
            return;
        }

        // Add to tracking set
        addedProductIds.add(productId);

        // Create new product row
        const productRow = document.createElement('div');
        productRow.className = 'selected-product flex items-center justify-between gap-4 border-b pb-3';
        productRow.innerHTML = `
            <div>
                <p class="product-name font-medium">${selectedOption.dataset.name}</p>
                <p class="text-sm text-gray-500">Prix: <span class="product-price">${selectedOption.dataset.price}</span> MAD</p>
                <input type="hidden" name="produits[]" class="product-id" value="${productId}">
            </div>
            <div class="flex items-center gap-2">
                <label class="text-sm text-gray-600">Quantité:</label>
                <input type="number" name="quantites[]" value="${quantity}" min="1"
                       class="w-20 border rounded p-1 text-center product-quantity">
                <button type="button" class="remove-product text-red-600 hover:text-red-800">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        `;

        // Add remove functionality
        productRow.querySelector('.remove-product').addEventListener('click', function() {
            this.closest('.selected-product').remove();
            addedProductIds.delete(productId);
        });
        
        // Add to the list
        selectedProducts.appendChild(productRow);
        
        // Reset the form
        productSelect.selectedIndex = 0;
        quantityInput.value = 1;
    });

    // Add remove functionality to existing products
    document.querySelectorAll('.remove-product').forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.closest('.selected-product').querySelector('.product-id').value;
            this.closest('.selected-product').remove();
            addedProductIds.delete(productId);
        });
    });
});
</script>
@endpush
@endsection