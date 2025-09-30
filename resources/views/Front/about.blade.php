@extends('layouts.front')
<body class="bg-white text-gray-800 antialiased">
    @include('layouts.header')


    <!-- À Propos Section -->
<main class="py-12 bg-gray-50">
    <!-- Hero Title -->
    <section class="container mx-auto px-4 mb-16">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">Notre Histoire</h1>
            <div class="w-20 h-1 bg-red-500 mx-auto mb-8"></div>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Flavorium, votre partenaire de confiance dans la distribution de produits alimentaires depuis 2010.
            </p>
        </div>
    </section>

    <!-- About Content -->
    <section class="container mx-auto px-4 mb-20">
        <div class="flex flex-col lg:flex-row items-center gap-12">
            <div class="lg:w-1/2">
                <img src="https://images.unsplash.com/photo-1606787366850-de6330128bfc?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" 
                     alt="Entrepôt Flavorium"
                     class="rounded-lg shadow-xl w-full h-auto">
            </div>
            <div class="lg:w-1/2">
                <h2 class="text-3xl font-bold text-gray-800 mb-6">Qui sommes-nous ?</h2>
                <p class="text-gray-600 mb-6">
                    Fondée en 2021, Flavorium est devenue un acteur majeur dans la distribution de produits alimentaires en gros, 
                    spécialisée dans les boissons gazeuses, biscuits, et produits d'épicerie fine.
                </p>
                <p class="text-gray-600 mb-6">
                    Notre mission est de fournir à nos clients des produits de qualité à des prix compétitifs, 
                    avec un service personnalisé et une livraison fiable.
                </p>
                <ul class="space-y-3 mb-8">
                    <li class="flex items-center">
                        <span class="bg-red-100 text-red-500 p-1 rounded-full mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </span>
                        <span class="text-gray-600">Plus de 500 références de produits</span>
                    </li>
                    <li class="flex items-center">
                        <span class="bg-red-100 text-red-500 p-1 rounded-full mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </span>
                        <span class="text-gray-600">Livraison dans toute la région</span>
                    </li>
                    <li class="flex items-center">
                        <span class="bg-red-100 text-red-500 p-1 rounded-full mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </span>
                        <span class="text-gray-600">Partenaire des plus grandes marques</span>
                    </li>
                </ul>
                <a href="{{route('produits.front')}}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-300">
                    Découvrir nos produits
                </a>
            </div>
        </div>
    </section>

    <!-- Values Section -->
    <section class="bg-white py-16">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-16">Nos Valeurs</h2>
            
            <div class="grid md:grid-cols-3 gap-10">
                <!-- Value 1 -->
                <div class="text-center px-6">
                    <div class="bg-red-100 w-20 h-20 mx-auto rounded-full flex items-center justify-center mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-3 text-gray-800">Qualité</h3>
                    <p class="text-gray-600">
                        Nous sélectionnons rigoureusement nos produits pour garantir leur qualité et leur fraîcheur.
                    </p>
                </div>
                
                <!-- Value 2 -->
                <div class="text-center px-6">
                    <div class="bg-red-100 w-20 h-20 mx-auto rounded-full flex items-center justify-center mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-3 text-gray-800">Fiabilité</h3>
                    <p class="text-gray-600">
                        Des livraisons ponctuelles et un service client disponible pour répondre à vos besoins.
                    </p>
                </div>
                
                <!-- Value 3 -->
                <div class="text-center px-6">
                    <div class="bg-red-100 w-20 h-20 mx-auto rounded-full flex items-center justify-center mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-3 text-gray-800">Relation client</h3>
                    <p class="text-gray-600">
                        Nous construisons des relations durables avec nos clients basées sur la confiance et le respect.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    {{-- <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-4">Notre Équipe</h2>
            <p class="text-xl text-center text-gray-600 max-w-2xl mx-auto mb-16">
                Des professionnels dévoués à votre service
            </p>
            
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Member 1 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" 
                         alt="Directeur Général" class="w-full h-64 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-800">Jean Dupont</h3>
                        <p class="text-red-500 mb-3">Directeur Général</p>
                        <p class="text-gray-600 text-sm">
                            Fondateur de Flavorium, Jean apporte 20 ans d'expérience dans la distribution alimentaire.
                        </p>
                    </div>
                </div>
                
                <!-- Member 2 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" 
                         alt="Responsable Commercial" class="w-full h-64 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-800">Marie Lambert</h3>
                        <p class="text-red-500 mb-3">Responsable Commercial</p>
                        <p class="text-gray-600 text-sm">
                            Marie gère les relations clients et développe notre réseau de distribution.
                        </p>
                    </div>
                </div>
                
                <!-- Member 3 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" 
                         alt="Responsable Logistique" class="w-full h-64 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-800">Thomas Martin</h3>
                        <p class="text-red-500 mb-3">Responsable Logistique</p>
                        <p class="text-gray-600 text-sm">
                            Thomas supervise nos entrepôts et garantit des livraisons efficaces.
                        </p>
                    </div>
                </div>
                
                <!-- Member 4 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" 
                         alt="Chef de Produit" class="w-full h-64 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-800">Sophie Leroy</h3>
                        <p class="text-red-500 mb-3">Chef de Produit</p>
                        <p class="text-gray-600 text-sm">
                            Sophie sélectionne et négocie les meilleurs produits pour notre catalogue.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
</main>

    @include('layouts.footer')


</body>