@extends('layouts.app')

@section('content')
<div class="container mx-auto px-2 sm:px-4 py-4">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 gap-4">
        <h1 class="text-xl sm:text-2xl font-bold">Mes Commandes</h1>
        
        <div class="flex space-x-2">
            <a href="{{ route('commands.index', ['Archive' => false]) }}" 
               class="px-3 py-1 text-sm rounded-md {{ !request()->has('Archive') ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800' }}">
                Commandes actives
            </a>
            <a href="{{ route('commands.index', ['Archive' => true]) }}" 
               class="px-3 py-1 text-sm rounded-md {{ request()->has('Archive') ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800' }}">
                Archives
            </a>
        </div>
    </div>

    <div class="overflow-x-auto rounded-lg border border-gray-200 shadow-xs">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Commande</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Client</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Téléphone</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                   
                    <th class="px-4 py-2 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                    <th class="px-4 py-2 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Archive</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($commandes as $commande)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900">#{{ $commande->id }}</td>
                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">{{ $commande->client ?? 'N/A' }}</td>
                    <td class="px-4 py-3 whitespace-nowrap">
                        @php
                            $statusColors = [
                                'nouveau' => 'bg-yellow-100 text-yellow-800',
                                'retour' => 'bg-purple-100 text-purple-800',
                                'livre' => 'bg-green-100 text-green-800',
                                'annule' => 'bg-red-100 text-red-800',
                            ];
                            $colorClass = $statusColors[strtolower($commande->status)] ?? 'bg-gray-100 text-gray-800';
                        @endphp
                        <span class="px-2 py-1 text-xs rounded-full {{ $colorClass }}">
                            {{ ucfirst($commande->status) }}
                        </span>
                    </td>
                    <td class="px-4 py-3 whitespace-nowrap text-sm text-blue-600">{{ $commande->phone ?? '-' }}</td>
                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">{{ $commande->created_at->format('d/m/Y H:i') }}</td>
                    <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-right text-blue-700">{{ number_format($commande->total, 2) }} MAD</td>
                    <td class="px-4 py-3 whitespace-nowrap text-right text-sm font-medium">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-end space-y-2 sm:space-y-0 sm:space-x-2">
                            <form action="{{ route('commands.updateStatus', $commande->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <select name="status" onchange="this.form.submit()" class="text-xs border-gray-300 rounded">
                                    @foreach(['Nouveau', 'Retour', 'Livre', 'Annule'] as $statut)
                                        <option value="{{ $statut }}" {{ $commande->status === $statut ? 'selected' : '' }}>
                                            {{ ucfirst($statut) }}
                                        </option>
                                    @endforeach
                                </select>
                            </form>
                    </td>
                    <td>
                        <form action="{{ route('commands.updateArchive', $commande->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <select name="archive" class="text-xs border-gray-300 rounded" onchange="this.form.submit()">
                                <option value="non" {{ old('archive', $commande->archive ?? '') == 'non' ? 'selected' : '' }}>Non</option>
                                <option value="oui" {{ old('archive', $commande->archive ?? '') == 'oui' ? 'selected' : '' }}>Oui</option>
                            </select>
                        </form>
                    </td>
                    <td>
                        <a href="{{ route('commands.show', $commande->id) }}" class="text-blue-600 hover:text-blue-900 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                            <span class="hidden sm:inline ml-1">Détails</span>
                        </a>

                        <a href="{{ route('commands.print', $commande->id) }}" class="text-gray-600 hover:text-gray-900 flex items-center" target="_blank">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                            </svg>
                            <span class="hidden sm:inline ml-1">Imprimer</span>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-4 py-6 text-center text-sm text-gray-500">
                        Aucune commande trouvée.
                        <a href="{{ route('home') }}" class="ml-2 text-blue-600 hover:underline">Retour à l'accueil</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{-- Pagination if needed --}}
        {{-- {{ $commandes->links() }} --}}
    </div>
</div>
@endsection
