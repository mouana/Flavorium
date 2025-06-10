<!DOCTYPE html>
<html lang="fr" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Product Management')</title>
    
    <!-- Tailwind CSS via CDN (for production, consider installing locally) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0f9ff',
                            600: '#0284c7',
                        }
                    }
                }
            }
        }
    </script>
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    
    <!-- For production, use this instead of Tailwind CDN -->
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    
    @stack('styles')
</head>
<body class="h-full bg-gray-50 dark:bg-gray-900 transition-colors duration-200">
    <header class="bg-primary-600 text-white shadow-md">
        <nav class="container mx-auto px-4 py-3 flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-2">
                    <i class="bi bi-speedometer2 text-xl"></i>
                    <span class="text-lg font-semibold">Dashboard</span>
                </a>
            </div>
            
            <div class="flex items-center space-x-4">
                <!-- Dark mode toggle -->
                <button id="theme-toggle" class="p-2 rounded-full hover:bg-primary-500">
                    <i class="bi bi-sun-fill hidden dark:block"></i>
                    <i class="bi bi-moon-fill block dark:hidden"></i>
                </button>
                
                <!-- User dropdown (example) -->
                <div class="relative">
                    <button class="flex items-center space-x-2 focus:outline-none">
                        <a href="{{ route('mon-compte') }}" class="hidden sm:inline">Mon compte</a>
                        <a href="{{ route('mon-compte') }}"><i class="bi bi-person-circle text-xl"></i></a>
                    </button>
                    <!-- Dropdown menu would go here -->
                </div>
            </div>
        </nav>
    </header>

    <main class="container mx-auto px-4 py-6 min-h-[calc(100vh-73px)]">
        @yield('content')
    </main>

    <footer class="bg-gray-800 text-white py-4 mt-8">
        <div class="container mx-auto px-4 text-center">
            <p>&copy; {{ date('Y') }} Product Management System. Tous droits réservés.</p>
        </div>
    </footer>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Dark mode script -->
    <script>
        const themeToggle = document.getElementById('theme-toggle');
        const html = document.documentElement;
        
        // Check for saved theme preference or use system preference
        if (localStorage.getItem('theme') === 'dark' || 
            (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            html.classList.add('dark');
        } else {
            html.classList.remove('dark');
        }
        
        // Toggle theme
        themeToggle.addEventListener('click', () => {
            html.classList.toggle('dark');
            localStorage.setItem('theme', html.classList.contains('dark') ? 'dark' : 'light');
        });
    </script>
    
    @stack('scripts')
</body>
</html>