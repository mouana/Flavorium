@extends('layouts.app')

@section('title', 'Liste des Catégories')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
        <h1 class="text-2xl md:text-3xl font-bold text-gray-800 dark:text-white">Liste des Catégories</h1>
        
        <div class="flex gap-3">
            <a href="{{ route('categories.create') }}" 
               class="flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors duration-200">
                <i class="bi bi-plus-circle"></i>
                <span>Ajouter une catégorie</span>
            </a>
            
            <!-- Search input (optional) -->
            <div class="relative">
                <input type="text" placeholder="Rechercher..." 
                       class="pl-10 pr-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                <i class="bi bi-search absolute left-3 top-2.5 text-gray-400"></i>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg dark:bg-green-900 dark:border-green-400 dark:text-green-100">
            <div class="flex items-center">
                <i class="bi bi-check-circle-fill mr-2"></i>
                <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif

    @if($categories->isEmpty())
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-8 text-center">
            <i class="bi bi-tag text-4xl text-gray-400 mb-3"></i>
            <h3 class="text-lg font-medium text-gray-700 dark:text-gray-300">Aucune catégorie trouvée</h3>
            <p class="text-gray-500 dark:text-gray-400 mb-4">Commencez par créer votre première catégorie</p>
            <a href="{{ route('categories.create') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                Créer une catégorie
            </a>
        </div>
    @else
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow overflow-hidden border border-gray-100 dark:border-gray-700">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Nom
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Description
                            </th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach ($categories as $categorie)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-150">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900 dark:text-white">
                                    {{ $categorie->nom }}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-500 dark:text-gray-400 max-w-xs truncate">
                                    {{ $categorie->description ?? 'N/A' }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('categories.edit', $categorie->id) }}" 
                                       class="flex items-center gap-1 bg-yellow-100 dark:bg-yellow-900 hover:bg-yellow-200 dark:hover:bg-yellow-800 text-yellow-800 dark:text-yellow-200 px-3 py-1 rounded-lg text-sm transition-colors duration-200">
                                        <i class="bi bi-pencil text-xs"></i>
                                        <span>Modifier</span>
                                    </a>
                                    
                                    <form action="{{ route('categories.destroy', $categorie->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="flex items-center gap-1 bg-red-100 dark:bg-red-900 hover:bg-red-200 dark:hover:bg-red-800 text-red-800 dark:text-red-200 px-3 py-1 rounded-lg text-sm transition-colors duration-200"
                                                onclick="return confirm('Supprimer cette catégorie ?')">
                                            <i class="bi bi-trash text-xs"></i>
                                            <span>Supprimer</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            {{-- @if($categories->hasPages())
                <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">
                    {{ $categories->links() }}
                </div>
            @endif --}}
        </div>
    @endif
</div>
@endsection