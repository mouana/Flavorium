<?php

namespace App\Http\Controllers;

use App\Models\MouvementStock;
use App\Models\Produit;
use App\Models\User;
use Illuminate\Http\Request;

class MouvementStockController extends Controller
{
    // Lister tous les mouvements de stock
    public function index()
    {
        $mouvements = MouvementStock::with(['produit', 'user'])
                        ->latest('date')
                        ->take(10)
                        ->get();

        return view('dashboard', compact('mouvements'));
    }

    // Afficher un seul mouvement par ID
    public function show($id)
    {
        $mouvement = MouvementStock::with(['produit', 'user'])->findOrFail($id);
        return view('mouvements.show', compact('mouvement'));
    }

    // Enregistrer un nouveau mouvement de stock
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required',
            'quantite' => 'required|numeric|min:1',
            'produit_id' => 'required|exists:produits,id',
            'prix' => 'required|numeric|min:0',
        ]);

        $mouvement = MouvementStock::create($validated);

        // Update product stock
        $produit = Produit::find($validated['produit_id']);
        if ($validated['type'] === 'entree') {
            $produit->increment('stock', $validated['quantite']);
        } else {
            $produit->decrement('stock', $validated['quantite']);
        }

        return response()->json($mouvement, 201);
    }

    public function update(Request $request, $id)
    {
        $mouvement = MouvementStock::findOrFail($id);

        $validated = $request->validate([
            'type' => 'required',
            'quantite' => 'required|numeric|min:1',
            'produit_id' => 'required|exists:produits,id',
            'prix' => 'required|numeric|min:0',
        ]);

        $mouvement->update($validated);

        return response()->json($mouvement);
    }

    // Supprimer un mouvement de stock
    public function destroy($id)
    {
        $mouvement = MouvementStock::findOrFail($id);
        $mouvement->delete();

        return response()->json(['message' => 'Mouvement supprimé avec succès.']);
    }

    /**
     * Display movements for a specific product
     */
    public function productMovements($productId)
    {
        $produit = Produit::findOrFail($productId);

        $mouvements = $produit->mouvements()
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('produits.mouvements', compact('produit', 'mouvements'));
    }

    /**
     * Handle manual stock adjustment for a product
     */
    public function adjustStock(Request $request, $productId)
    {
        $request->validate([
            'type' => 'required|in:entree,sortie',
            'quantite' => 'required|integer|min:1',
            'prix' => 'required|numeric|min:0',
        ]);

        $produit = Produit::findOrFail($productId);
        $quantite = $request->quantite;

        if ($request->type === 'entree') {
            $produit->increment('stock', $quantite);
        } else {
            if ($produit->stock < $quantite) {
                return back()->withErrors(['quantite' => 'Stock insuffisant pour effectuer une sortie.']);
            }
            $produit->decrement('stock', $quantite);
        }

        MouvementStock::create([
            'produit_id' => $produit->id,
            'type' => $request->type,
            'prix' => $request->prix,
            'quantite' => $quantite,
            'date' => now(),
            'utilisateur_id' => auth()->id(),
        ]);

        return back()->with('success', 'Mouvement de stock enregistré avec succès.');
    }
}