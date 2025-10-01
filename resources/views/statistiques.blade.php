@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-3xl font-bold mb-8 text-gray-800 dark:text-gray-100">📊 Statistiques des achats</h1>

    {{-- Totaux par commande --}}
    <div class="mb-12">
        <h2 class="text-2xl font-semibold mb-4 text-gray-700 dark:text-gray-200">Totaux par commande</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-md">
                <thead class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 uppercase tracking-wider">
                    <tr>
                        <th class="px-6 py-3 text-left">Commande ID</th>
                        <th class="px-6 py-3 text-left">Chiffre d'affaires (MAD)</th>
                        <th class="px-6 py-3 text-left">Bénéfice Net (MAD)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($totalsParCommande as $commandeId => $totals)
                    <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                        <td class="px-6 py-3">{{ $commandeId }}</td>
                        <td class="px-6 py-3 font-medium text-green-600 dark:text-green-400">{{ number_format($totals['total_achat'], 2) }}</td>
                        <td class="px-6 py-3 font-medium text-blue-600 dark:text-blue-400">{{ number_format($totals['net_profit'], 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Totaux par mois --}}
    <div class="mb-12">
        <h2 class="text-2xl font-semibold mb-4 text-gray-700 dark:text-gray-200">Totaux par mois</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-md">
                <thead class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 uppercase tracking-wider">
                    <tr>
                        <th class="px-6 py-3 text-left">Année</th>
                        <th class="px-6 py-3 text-left">Mois</th>
                        <th class="px-6 py-3 text-left">Chiffre d'affaires (MAD)</th>
                        <th class="px-6 py-3 text-left">Bénéfice Net (MAD)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($totalsParMois as $row)
                    <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                        <td class="px-6 py-3">{{ $row->annee }}</td>
                        <td class="px-6 py-3">{{ $row->mois }}</td>
                        <td class="px-6 py-3 font-medium text-green-600 dark:text-green-400">{{ number_format($row->total_achat, 2) }}</td>
                        <td class="px-6 py-3 font-medium text-blue-600 dark:text-blue-400">{{ number_format($row->net_profit, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Totaux par année --}}
    <div class="mb-8">
        <h2 class="text-2xl font-semibold mb-4 text-gray-700 dark:text-gray-200">Totaux par année</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-md">
                <thead class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 uppercase tracking-wider">
                    <tr>
                        <th class="px-6 py-3 text-left">Année</th>
                        <th class="px-6 py-3 text-left">Chiffre d'affaires (MAD)</th>
                        <th class="px-6 py-3 text-left">Bénéfice Net (MAD)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($totalsParAnnee as $row)
                    <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                        <td class="px-6 py-3">{{ $row->annee }}</td>
                        <td class="px-6 py-3 font-medium text-green-600 dark:text-green-400">{{ number_format($row->total_achat, 2) }}</td>
                        <td class="px-6 py-3 font-medium text-blue-600 dark:text-blue-400">{{ number_format($row->net_profit, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
