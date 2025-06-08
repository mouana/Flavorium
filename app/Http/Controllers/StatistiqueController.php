<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Produit;
use App\Models\MouvementStock;
use Illuminate\Support\Facades\DB;

class StatistiqueController extends Controller
{
    public function globales()
    {
        $produits = Produit::all();

        $totalChiffreAffaires = MouvementStock::where('type', 'sortie')
        ->join('produits', 'mouvement_stock.produit_id', '=', 'produits.id')
        ->select(DB::raw('SUM(mouvement_stock.quantite * produits.prix_vente) as total'))
        ->value('total');
        $totalRevenus = DB::table('mouvement_stock')
    ->where('type', 'sortie')
    ->join('produits', 'mouvement_stock.produit_id', '=', 'produits.id')
    ->select(DB::raw('SUM(mouvement_stock.quantite * (produits.prix_vente - mouvement_stock.prix)) as total'))
    ->value('total');

        return view('statistiques.globales', compact('totalChiffreAffaires', 'totalRevenus'));
    }

    public function parUtilisateur($id)
    {
        $user = User::with('produits')->findOrFail($id);
        $totalCA = $user->produits->sum(fn($p) => $p->chiffre_affaires);
        $totalRevenus = $user->produits->sum(fn($p) => $p->revenus);
        return view('statistiques.utilisateur', compact('user', 'totalCA', 'totalRevenus'));
    }
}