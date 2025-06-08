@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Statistiques Globales</h1>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Revenue Card -->
            <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-blue-500">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-medium text-gray-500">Chiffre d'affaires total</h3>
                        <p class="text-2xl font-bold text-gray-800 mt-2">{{ number_format($totalChiffreAffaires, 2) }} DH</p>
                    </div>
                    <div class="bg-blue-100 p-3 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <div class="mt-4">
                    <span class="text-sm text-green-600 font-medium">+2.5% vs last month</span>
                </div>
            </div>

            <!-- Income Card -->
            <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-green-500">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-medium text-gray-500">Revenus totaux</h3>
                        <p class="text-2xl font-bold text-gray-800 mt-2">{{ number_format($totalRevenus, 2) }} DH</p>
                    </div>
                    <div class="bg-green-100 p-3 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l3.5-2 3.5 2 3.5-2 3.5 2z" />
                        </svg>
                    </div>
                </div>
                <div class="mt-4">
                    <span class="text-sm text-green-600 font-medium">+3.8% vs last month</span>
                </div>
            </div>
        </div>

        <!-- Additional Stats Section (optional) -->
        <div class="mt-8">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Aperçu des performances</h2>
            <div class="bg-white rounded-lg shadow-md p-6">
                <p class="text-gray-600">Vos indicateurs clés de performance montrent une croissance positive ce mois-ci.</p>
                <!-- You could add charts or more detailed stats here -->
            </div>
        </div>
    </div>
</div>
@endsection