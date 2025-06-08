@extends('layouts.app')

@section('title', 'Liste des Produits')

@section('content')
    <div class="container mx-auto px-4 py-4">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 gap-2">
            <h1 class="text-xl md:text-2xl font-bold text-gray-800 dark:text-white">Liste des Produits</h1>
            
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('produits.create') }}"
                    class="flex items-center gap-1 bg-blue-600 hover:bg-blue-700 text-white px-3 py-1.5 rounded-lg text-sm transition-colors duration-200">
                    <i class="bi bi-plus-circle text-sm"></i>
                    <span>Ajouter</span>
                </a>
                
                <div class="relative">
                    <input type="text" placeholder="Rechercher..." 
                        class="pl-8 pr-3 py-1.5 text-sm border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 w-32 sm:w-auto">
                    <i class="bi bi-search absolute left-2 top-2 text-gray-400 text-sm"></i>
                </div>
            </div>
        </div>

        @if($produits->isEmpty())
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 text-center">
                <i class="bi bi-box-seam text-3xl text-gray-400 mb-2"></i>
                <h3 class="text-md font-medium text-gray-700 dark:text-gray-300">Aucun produit trouvé</h3>
                <p class="text-gray-500 dark:text-gray-400 mb-3 text-sm">Commencez par ajouter votre premier produit</p>
                <a href="{{ route('produits.create') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-3 py-1.5 rounded-lg text-sm">
                    Ajouter un produit
                </a>
            </div>
        @else
            <div class="overflow-x-auto bg-white dark:bg-gray-800 rounded-lg shadow">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700" id="productsTable">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Produit</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Prix</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Statut</th>
                            <th scope="col" class="px-4 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach ($produits as $produit)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700" data-status="{{ $produit->status }}" data-id="{{ $produit->id }}">
                            <!-- Product Info (First column) -->
                            <td class="px-4 py-3 whitespace-nowrap">
                                <div class="flex items-center">
                                    @if($produit->photo)
                                        <div class="flex-shrink-0 h-10 w-10 mr-3">
                                            <img class="h-10 w-10 rounded-full object-cover" src="{{ Storage::url($produit->photo) }}" alt="{{ $produit->nom }}">
                                        </div>
                                    @else
                                        <div class="flex-shrink-0 h-10 w-10 mr-3 bg-gray-100 dark:bg-gray-600 rounded-full flex items-center justify-center">
                                            <i class="bi bi-box text-gray-400"></i>
                                        </div>
                                    @endif
                                    <div>
                                        <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $produit->nom }}</div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400">
                                            <span class="bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 px-1 rounded">{{ $produit->categorie->nom ?? 'N/A' }}</span>
                                            <span class="ml-1">{{ $produit->code }}</span>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            
                            <td class="px-4 py-3 whitespace-nowrap">
                                <div class="text-sm text-gray-900 dark:text-white">
                                    <div class="font-medium">{{ number_format($produit->prix_vente, 2) }} MAD</div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400">
                                        <span>Achat: {{ number_format($produit->prix, 2) }} MAD</span>
                                        <span class="ml-1 text-green-600 dark:text-green-400">(+{{ number_format($produit->prix_vente - $produit->prix, 2) }})</span>
                                    </div>
                                </div>
                            </td>
                            
                            <td class="px-4 py-3 whitespace-nowrap">
                                <select onchange="handleStatusChange(this)" 
        class="status-dropdown px-2 py-1 text-xs font-medium rounded-full
            {{ $loop->index % 2 == 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
        <option value="active">Actif</option>
        <option value="inactive">inactive</option>
    </select>
                                
                            </td>
                            
                            <td class="px-4 py-3 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex justify-end space-x-1">
                                    <!-- View button -->
                                    <a href="{{ route('produits.show', $produit->id) }}" 
                                        class="p-1 text-blue-600 dark:text-blue-400 hover:text-blue-900 dark:hover:text-blue-300"
                                        title="Voir">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    
                                    <a href="{{ route('produits.edit', $produit->id) }}" 
                                        class="p-1 text-yellow-600 dark:text-yellow-400 hover:text-yellow-900 dark:hover:text-yellow-300"
                                        title="Modifier">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    
                                    <form action="{{ route('produits.destroy', $produit->id) }}" method="POST" 
                                        onsubmit="return confirm('Voulez-vous vraiment supprimer ce produit ?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                            class="p-1 text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-300"
                                            title="Supprimer">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                           
                        </tr>
                        @endforeach
                       
                    </tbody>
                </table>

            </div>

            <div class="mt-6 flex justify-center">
                {{ $produits->links() }}
            </div>

        @endif
    </div>

    <script>
        function handleStatusChange(select) {
            const value = select.value;
    
            select.classList.remove('bg-green-100', 'text-green-800', 'bg-red-100', 'text-red-800');
    
            if (value === 'active') {
                select.classList.add('bg-green-100', 'text-green-800');
            } else {
                select.classList.add('bg-red-100', 'text-red-800');
            }
        }
    
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.status-dropdown').forEach(select => {
                handleStatusChange(select);
            });
        });
    </script>
    

    <style>
        tr {
            transition: background-color 0.3s ease;
        }
    </style>
@endsection