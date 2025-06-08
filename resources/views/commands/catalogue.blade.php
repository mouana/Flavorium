@extends('layouts.app')
<body class="bg-white text-gray-800 antialiased">
    <main>

@foreach ($produit as $produitItem)
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">

<form action="{{ route('cart.add', $produitItem->id) }}" method="POST">
    @csrf
    <button type="submit" class="w-full text-left focus:outline-none">
        <div class="product-card bg-white rounded-xl overflow-hidden shadow-md transition duration-300 hover:scale-[1.02] hover:shadow-lg">
            <!-- Image container with fixed aspect ratio -->
            <div class="relative overflow-hidden aspect-square">
                <img class="w-full h-full object-cover transition duration-300 hover:scale-110" 
                     src="{{ Storage::url($produitItem->photo) }}" 
                     alt="{{ $produitItem->nom }}"
                     loading="lazy">
                @if($produitItem->is_promo)
                    <span class="absolute top-3 left-3 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full shadow-sm">PROMO</span>
                @endif
            </div>
            
            <!-- Product info -->
            <div class="p-4 space-y-2">
                <h3 class="text-lg font-semibold text-gray-800 line-clamp-1">{{ $produitItem->nom }}</h3>
                <p class="text-gray-600 text-sm line-clamp-2">{{ $produitItem->description }}</p>
                
                <!-- Price section -->
                <div class="flex items-center justify-between pt-2">
                    <span class="text-blue-600 font-bold text-lg">
                        {{ number_format($produitItem->prix, 2) }} Dh
                        @if($produitItem->is_promo && $produitItem->ancien_prix)
                            <span class="text-gray-400 text-sm line-through ml-1">{{ number_format($produitItem->ancien_prix, 2) }} Dh</span>
                        @endif
                    </span>
                    <span class="text-green-500 text-sm font-medium">
                        @if($produitItem->stock > 0)
                            En stock
                        @else
                            Rupture
                        @endif
                    </span>
                </div>
            </div>
        </div>
    </button>
</form>
</div>
    </main>
</body>
@endforeach