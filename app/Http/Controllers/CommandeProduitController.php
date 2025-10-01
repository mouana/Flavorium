<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commande;
use App\Models\Produit;
use App\Models\CommandeProduit;

class CommandeProduitController extends Controller
{
    public function store(Request $request, $commandeId)
    {
        $request->validate([
            'produits' => 'required|array|min:1',
            'produits.*.produit_id' => 'required|exists:produits,id',
            'produits.*.quantite' => 'required|integer|min:1',
        ]);

        $commande = Commande::findOrFail($commandeId);
        $total = 0;

        foreach ($request->produits as $item) {
            $produit = Produit::findOrFail($item['produit_id']);
            $quantite = (int) $item['quantite'];
            $prixUnitaire = $produit->prix_vente; 
            $sousTotal = $prixUnitaire * $quantite;

            CommandeProduit::create([
                'commande_id' => $commande->id,
                'produit_id' => $produit->id,
                'quantite' => $quantite,
                'prix' => $prixUnitaire,
                'sous_total' => $sousTotal,
            ]);

            $total += $sousTotal;
        }

        $commande->update(['total' => $total]);

        return response()->json([
            'message' => 'Produits ajoutés à la commande avec succès',
            'commande' => $commande->load('produits'),
        ]);
    }
}