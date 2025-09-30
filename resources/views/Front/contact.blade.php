@extends('layouts.front')

<body class="bg-white text-gray-800 antialiased">
    @include('layouts.header')


    <div class="min-h-screen bg-gray-50">
        <!-- Hero Section -->
        <div class="bg-blue-600 text-white py-16">
            <div class="container mx-auto px-4 text-center">
                <h1 class="text-4xl md:text-5xl font-bold mb-6">Contactez-nous</h1>
                <p class="text-xl max-w-2xl mx-auto">
                    Nous sommes à votre écoute pour toute question concernant nos produits et services.
                </p>
            </div>
        </div>

        <!-- Contact Content -->
        <div class="container mx-auto px-4 py-16">
            {{--<div class="flex flex-col lg:flex-row gap-12">

                <!-- Contact Form -->
                <div class="lg:w-1/2">
                    <div class="bg-white rounded-lg shadow-lg p-8">
                        <h2 class="text-2xl font-bold text-gray-800 mb-6">Envoyez-nous un message</h2>

                        @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                            {{ session('success') }}
                        </div>
                        @endif

                        <form action="" method="POST">
                            @csrf
                            <div class="mb-6">
                                <label for="name" class="block text-gray-700 font-medium mb-2">Nom complet</label>
                                <input type="text" id="name" name="name" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                @error('name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-6">
                                <label for="email" class="block text-gray-700 font-medium mb-2">Email</label>
                                <input type="email" id="email" name="email" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                @error('email')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-6">
                                <label for="phone" class="block text-gray-700 font-medium mb-2">Téléphone
                                    (optionnel)</label>
                                <input type="tel" id="phone" name="phone"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>

                            <div class="mb-6">
                                <label for="subject" class="block text-gray-700 font-medium mb-2">Sujet</label>
                                <select id="subject" name="subject" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <option value="" disabled selected>Sélectionnez un sujet</option>
                                    <option value="Demande d'information">Demande d'information</option>
                                    <option value="Commande spéciale">Commande spéciale</option>
                                    <option value="Service client">Service client</option>
                                    <option value="Partenariat">Partenariat</option>
                                    <option value="Autre">Autre</option>
                                </select>
                            </div>

                            <div class="mb-6">
                                <label for="message" class="block text-gray-700 font-medium mb-2">Message</label>
                                <textarea id="message" name="message" rows="5" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
                                @error('message')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <button type="submit"
                                class="w-full bg-blue-600 text-white py-3 px-6 rounded-lg hover:bg-blue-700 transition duration-300 font-medium">
                                Envoyer le message
                            </button>
                        </form>
                    </div>
                </div> --}}

                <!-- Contact Info -->
                    <div class="flex flex-col lg:flex-row gap-8">
        <div class="bg-white rounded-lg shadow-lg p-8 lg:w-100 w-full">
                        <h2 class="text-2xl font-bold text-gray-800 mb-6">Nos coordonnées</h2>

                        <div class="space-y-6 ">
                            <div class="flex items-start ">
                                <div class="bg-blue-100 p-3 rounded-full mr-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-800 mb-1">Adresse</h3>
                                    <p class="text-gray-600">40000 Marrakech, Maroc</p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <div class="bg-blue-100 p-3 rounded-full mr-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-800 mb-1">Téléphone</h3>
                                    <p class="text-gray-600">+212 7 08 69 75 66</p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <div class="bg-blue-100 p-3 rounded-full mr-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-800 mb-1">Email</h3>
                                    <p class="text-gray-600">bensouabni@gmail.com</p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <div class="bg-blue-100 p-3 rounded-full mr-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-800 mb-1">Heures d'ouverture</h3>
                                    <p class="text-gray-600">Lundi - Vendredi: 8h - 18h<br>Samedi: 9h - 13h<br>Dimanche:
                                        Fermé</p>
                                </div>
                            </div>
                        </div>


                        {{-- <div class="mt-8">
                            <h3 class="font-semibold text-gray-800 mb-4">Retrouvez-nous sur les réseaux sociaux</h3>
                            <div class="flex space-x-4">
                                <a href="#"
                                    class="bg-blue-100 text-blue-600 p-3 rounded-full hover:bg-blue-200 transition duration-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M22.675 0h-21.35c-.732 0-1.325.593-1.325 1.325v21.351c0 .731.593 1.324 1.325 1.324h11.495v-9.294h-3.128v-3.622h3.128v-2.671c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12v9.293h6.116c.73 0 1.323-.593 1.323-1.325v-21.35c0-.732-.593-1.325-1.325-1.325z" />
                                    </svg>
                                </a>
                                <a href="#"
                                    class="bg-blue-100 text-blue-600 p-3 rounded-full hover:bg-blue-200 transition duration-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                                    </svg>
                                </a>
                                <a href="#"
                                    class="bg-blue-100 text-blue-600 p-3 rounded-full hover:bg-blue-200 transition duration-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" />
                                    </svg>
                                </a>
                                <a href="#"
                                    class="bg-blue-100 text-blue-600 p-3 rounded-full hover:bg-blue-200 transition duration-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div> --}}
                </div>
                <!-- Map Section -->
                <div class="container mx-auto px-4 pb-16">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden  w-full" style="100%">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d108471.739911517!2d-8.0862128!3d31.6349323!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xdafee8d96179e51%3A0x5950b6534f87adb8!2sMarrakech%2C%20Morocco!5e0!3m2!1sen!2sus!4v1623258136833!5m2!1sen!2sus"
                            width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footer')

</body>