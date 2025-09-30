@extends('layouts.front')
<body class="bg-white text-gray-800 antialiased">
    <!-- Header -->
    @include('layouts.header')

    <main>
        <!-- Hero Section -->
        <section class="hero-gradient py-20 md:py-32 px-4">
            <div class="container mx-auto flex flex-col md:flex-row items-center">
                <div class="md:w-1/2 mb-10 md:mb-0">
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold leading-tight mb-6">
                        Découvrez <span class="text-blue-600">l'excellence</span> gustative
                    </h1>
                    <p class="text-lg md:text-xl text-gray-600 mb-8 max-w-lg">
                        Flavorium sélectionne avec passion les meilleurs produits pour éveiller vos sens et sublimer vos moments.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="#products" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg font-medium transition duration-300 transform hover:scale-105 shadow-lg">
                            Nos produits
                        </a>
                        <a href="contact" class="border-2 border-blue-600 text-blue-600 hover:bg-blue-50 px-8 py-3 rounded-lg font-medium transition duration-300">
                            Nous contacter
                        </a>
                    </div>
                </div>
                <div class="md:w-1/2 flex justify-center">
                    <img src="https://images.unsplash.com/photo-1550583724-b2692b85b150?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=774&q=80" 
                         alt="Produits Flavorium" 
                         class="rounded-xl shadow-2xl w-full max-w-md object-cover h-80 md:h-96">
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section class="py-16 bg-gray-50">
            <div class="container mx-auto px-4">
                <div class="text-center mb-16">
                    <h2 class="text-3xl md:text-4xl font-bold mb-4">Pourquoi choisir Flavorium</h2>
                    <p class="text-gray-600 max-w-2xl mx-auto">Notre engagement pour une qualité exceptionnelle</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="bg-white p-8 rounded-xl shadow-md hover:shadow-lg transition duration-300 text-center">
                        <div class="bg-blue-100 w-16 h-16 mx-auto rounded-full flex items-center justify-center mb-4">
                            <i class="fas fa-award text-blue-600 text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-3">Qualité Premium</h3>
                        <p class="text-gray-600">Des produits rigoureusement sélectionnés pour leur excellence gustative.</p>
                    </div>
                    <div class="bg-white p-8 rounded-xl shadow-md hover:shadow-lg transition duration-300 text-center">
                        <div class="bg-blue-100 w-16 h-16 mx-auto rounded-full flex items-center justify-center mb-4">
                            <i class="fas fa-leaf text-blue-600 text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-3">Ingrédients Naturels</h3>
                        <p class="text-gray-600">Respect de l'environnement et des méthodes de production traditionnelles.</p>
                    </div>
                    <div class="bg-white p-8 rounded-xl shadow-md hover:shadow-lg transition duration-300 text-center">
                        <div class="bg-blue-100 w-16 h-16 mx-auto rounded-full flex items-center justify-center mb-4">
                            <i class="fas fa-truck text-blue-600 text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-3">Livraison Rapide</h3>
                        <p class="text-gray-600">Expédition sous 24h pour une fraîcheur optimale de vos produits.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Products Section -->
        <section id="products" class="py-16">
            <div class="container mx-auto px-4">
                <div class="text-center mb-16">
                    <h2 class="text-3xl md:text-4xl font-bold mb-4">Nos produits phares</h2>
                    <p class="text-gray-600 max-w-2xl mx-auto">Découvrez notre sélection exclusive</p>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                            @foreach ($produits as $produit)
                                <div class="product-card bg-white rounded-xl overflow-hidden shadow-md transition duration-300">
                                    <div class="relative overflow-hidden h-60">
                                             <img  class="w-full h-full object-cover hover:scale-110 transition duration-500" src="{{ Storage::url($produit->photo) }}" alt="{{ $produit->nom }}">

                                        @if($produit->is_promo)
                                            <span class="absolute top-4 left-4 bg-red-500 text-white text-sm px-3 py-1 rounded-full">Promo</span>
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
                    </div>
                </div>
                <div class="text-center mt-12">
                    <a href="{{route('produits.front')}}" class="inline-block border-2 border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-white px-8 py-3 rounded-lg font-medium transition duration-300">
                        Voir tous nos produits
                    </a>
                </div>
            </div>
        </section>

        <!-- Testimonials Section -->
        {{-- <section class="py-16 bg-gray-50">
            <div class="container mx-auto px-4">
                <div class="text-center mb-16">
                    <h2 class="text-3xl md:text-4xl font-bold mb-4">Ce que disent nos clients</h2>
                    <p class="text-gray-600 max-w-2xl mx-auto">Découvrez les témoignages de ceux qui nous font confiance</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div class="bg-white p-8 rounded-xl shadow-md">
                        <div class="flex items-center mb-4">
                            <div class="text-yellow-400 mr-2">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                        <p class="text-gray-600 mb-6">"Les produits Flavorium ont transformé ma façon de cuisiner. La qualité est exceptionnelle et le goût incomparable."</p>
                        <div class="flex items-center">
                            <img src="https://randomuser.me/api/portraits/women/43.jpg" alt="Client" class="w-12 h-12 rounded-full mr-4">
                            <div>
                                <h4 class="font-semibold">Sophie Martin</h4>
                                <p class="text-gray-500 text-sm">Cheffe à domicile</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white p-8 rounded-xl shadow-md">
                        <div class="flex items-center mb-4">
                            <div class="text-yellow-400 mr-2">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                        </div>
                        <p class="text-gray-600 mb-6">"Je recommande vivement Flavorium pour leurs produits d'exception et leur service client irréprochable."</p>
                        <div class="flex items-center">
                            <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Client" class="w-12 h-12 rounded-full mr-4">
                            <div>
                                <h4 class="font-semibold">Thomas Leroy</h4>
                                <p class="text-gray-500 text-sm">Restaurateur</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white p-8 rounded-xl shadow-md">
                        <div class="flex items-center mb-4">
                            <div class="text-yellow-400 mr-2">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                        <p class="text-gray-600 mb-6">"Un véritable plaisir gustatif à chaque produit testé. Flavorium est devenu mon fournisseur attitré pour les produits premium."</p>
                        <div class="flex items-center">
                            <img src="https://randomuser.me/api/portraits/women/65.jpg" alt="Client" class="w-12 h-12 rounded-full mr-4">
                            <div>
                                <h4 class="font-semibold">Émilie Dubois</h4>
                                <p class="text-gray-500 text-sm">Bloggeuse culinaire</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> --}}

        <!-- Newsletter Section -->
        {{-- <section class="py-16 bg-blue-600 text-white">
            <div class="container mx-auto px-4 text-center">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">Abonnez-vous à notre newsletter</h2>
                <p class="text-blue-100 max-w-2xl mx-auto mb-8">Recevez en exclusivité nos nouveautés, offres spéciales et conseils d'utilisation.</p>
                <form class="max-w-md mx-auto flex flex-col sm:flex-row gap-4">
                    <input type="email" placeholder="Votre email" class="flex-grow px-4 py-3 rounded-lg focus:outline-none text-gray-800">
                    <button type="submit" class="bg-white text-blue-600 hover:bg-gray-100 px-6 py-3 rounded-lg font-medium transition duration-300">
                        S'abonner
                    </button>
                </form>
            </div>
        </section> --}}
    </main>

    <!-- Footer -->
    @include('layouts.footer')

    <!-- Back to Top Button -->
    <button id="backToTop" class="fixed bottom-8 right-8 bg-blue-600 text-white w-12 h-12 rounded-full shadow-lg flex items-center justify-center opacity-0 invisible transition-all duration-300">
        <i class="fas fa-arrow-up"></i>
    </button>

    <script>
        // Back to top button
        const backToTopButton = document.getElementById('backToTop');
        
        window.addEventListener('scroll', () => {
            if (window.pageYOffset > 300) {
                backToTopButton.classList.remove('opacity-0', 'invisible');
                backToTopButton.classList.add('opacity-100', 'visible');
            } else {
                backToTopButton.classList.remove('opacity-100', 'visible');
                backToTopButton.classList.add('opacity-0', 'invisible');
            }
        });
        
        backToTopButton.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    </script>
</body>
</html>