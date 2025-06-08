@extends('layouts.front')

<body class="bg-white text-gray-800 antialiased">
    @include('layouts.header')

    <main>
        <section class="px-6 py-12 bg-gray-100">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">Nos produits phares</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Découvrez notre sélection exclusive</p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                @foreach ($produits as $produit)
                    <div class="product-card bg-white rounded-xl overflow-hidden shadow-md transition duration-300">
                        <div class="relative overflow-hidden h-60">
                            <img class="w-full h-full object-cover hover:scale-110 transition duration-500"
                                src="{{ Storage::url($produit->photo) }}" alt="{{ $produit->nom }}">

                            @if($produit->is_promo)
                                <span
                                    class="absolute top-4 left-4 bg-red-500 text-white text-sm px-3 py-1 rounded-full">Promo</span>
                            @endif
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-semibold mb-2">{{ $produit->nom }}</h3>
                            <p class="text-gray-600 mb-4">{{ $produit->description }}</p>
                            <div class="flex justify-between items-center">
                                <div>
                                    @if ($produit->prix_original)
                                        <span class="text-gray-400 line-through mr-2">{{ $produit->prix_original }} Dh</span>
                                    @endif
                                    <span class="text-blue-600 font-bold text-lg">{{ $produit->prix }} Dh</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </main>
    @include('layouts.footer')

</body>