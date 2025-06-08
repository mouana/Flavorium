<header class="bg-white shadow-lg sticky top-0 z-50">
    <div class="container mx-auto px-4 sm:px-6 py-3">
        <!-- Mobile menu button and logo -->
        <div class="flex justify-between items-center">
            <!-- Logo -->
            <div class="flex items-center">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-10 w-auto">
            </div>
            
            <!-- Mobile menu button -->
            <div class="md:hidden">
                <button type="button" class="text-gray-500 hover:text-blue-600 focus:outline-none" aria-controls="mobile-menu" aria-expanded="false" id="mobile-menu-button">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
            
            <!-- Desktop Navigation -->
            <nav class="hidden md:flex items-center space-x-1 lg:space-x-6">
                <a href="{{ route('Front.Acceuil') }}" 
                   class="px-3 py-2 text-sm font-medium relative group
                          {{ request()->routeIs('Front.Acceuil') ? 'text-blue-600' : 'text-gray-700 hover:text-blue-600' }}
                          transition duration-300">
                    <span>Accueil</span>
                    <span class="absolute bottom-0 left-1/2 w-0 h-0.5 bg-blue-600 group-hover:w-4/4 transition-all duration-300 
                              {{ request()->routeIs('Front.Acceuil') ? 'w-4/4' : '' }}"></span>
                    <span class="absolute bottom-0 right-1/2 w-0 h-0.5 bg-blue-600 group-hover:w-4/4 transition-all duration-300 
                              {{ request()->routeIs('Front.Acceuil') ? 'w-4/4' : '' }}"></span>
                </a>
                
                <a href="{{ route('produits.front') }}" 
                   class="px-3 py-2 text-sm font-medium relative group
                          {{ request()->routeIs('produits.front') ? 'text-blue-600' : 'text-gray-700 hover:text-blue-600' }}
                          transition duration-300">
                    <span>Produits</span>
                    <span class="absolute bottom-0 left-1/2 w-0 h-0.5 bg-blue-600 group-hover:w-4/4 transition-all duration-300 
                              {{ request()->routeIs('produits.front') ? 'w-4/4' : '' }}"></span>
                    <span class="absolute bottom-0 right-1/2 w-0 h-0.5 bg-blue-600 group-hover:w-4/4 transition-all duration-300 
                              {{ request()->routeIs('produits.front') ? 'w-4/4' : '' }}"></span>
                </a>
                
                <a href="{{ route('Front.contact') }}" 
                   class="px-3 py-2 text-sm font-medium relative group
                          {{ request()->routeIs('Front.contact') ? 'text-blue-600' : 'text-gray-700 hover:text-blue-600' }}
                          transition duration-300">
                    <span>Contact</span>
                    <span class="absolute bottom-0 left-1/2 w-0 h-0.5 bg-blue-600 group-hover:w-4/4 transition-all duration-300 
                              {{ request()->routeIs('Front.contact') ? 'w-4/4' : '' }}"></span>
                    <span class="absolute bottom-0 right-1/2 w-0 h-0.5 bg-blue-600 group-hover:w-4/4 transition-all duration-300 
                              {{ request()->routeIs('Front.contact') ? 'w-4/4' : '' }}"></span>
                </a>
                
                <a href="{{ route('Front.about') }}" 
                   class="px-3 py-2 text-sm font-medium relative group
                          {{ request()->routeIs('Front.about') ? 'text-blue-600' : 'text-gray-700 hover:text-blue-600' }}
                          transition duration-300">
                    <span>À propos</span>
                    <span class="absolute bottom-0 left-1/2 w-0 h-0.5 bg-blue-600 group-hover:w-4/4 transition-all duration-300 
                              {{ request()->routeIs('Front.about') ? 'w-4/4' : '' }}"></span>
                    <span class="absolute bottom-0 right-1/2 w-0 h-0.5 bg-blue-600 group-hover:w-4/4 transition-all duration-300 
                              {{ request()->routeIs('Front.about') ? 'w-4/4' : '' }}"></span>
                </a>
            </nav>
        </div>
        
        <!-- Mobile Navigation -->
        <div class="md:hidden hidden" id="mobile-menu">
            <div class="pt-2 pb-3 space-y-1">
                <a href="{{ route('Front.Acceuil') }}" 
                   class="block px-3 py-2 rounded-md text-base font-medium 
                          {{ request()->routeIs('Front.Acceuil') ? 'bg-blue-50 text-blue-600' : 'text-gray-700 hover:bg-blue-50 hover:text-blue-600' }}">
                    Accueil
                </a>
                <a href="{{ route('produits.front') }}" 
                   class="block px-3 py-2 rounded-md text-base font-medium 
                          {{ request()->routeIs('produits.front') ? 'bg-blue-50 text-blue-600' : 'text-gray-700 hover:bg-blue-50 hover:text-blue-600' }}">
                    Produits
                </a>
                <a href="{{ route('Front.contact') }}" 
                   class="block px-3 py-2 rounded-md text-base font-medium 
                          {{ request()->routeIs('Front.contact') ? 'bg-blue-50 text-blue-600' : 'text-gray-700 hover:bg-blue-50 hover:text-blue-600' }}">
                    Contact
                </a>
                <a href="{{ route('Front.about') }}" 
                   class="block px-3 py-2 rounded-md text-base font-medium 
                          {{ request()->routeIs('Front.about') ? 'bg-blue-50 text-blue-600' : 'text-gray-700 hover:bg-blue-50 hover:text-blue-600' }}">
                    À propos
                </a>
            </div>
        </div>
    </div>
</header>

<script>
    // Mobile menu toggle
    document.getElementById('mobile-menu-button').addEventListener('click', function() {
        const menu = document.getElementById('mobile-menu');
        const expanded = this.getAttribute('aria-expanded') === 'true';
        this.setAttribute('aria-expanded', !expanded);
        menu.classList.toggle('hidden');
    });
</script>