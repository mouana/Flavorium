<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\User;
use App\Models\Categorie;
use App\Models\Commande;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $counts = [
            'productCount' => Produit::count(),
            'categoryCount' => Categorie::count(),
            'userCount' => User::count(),
        ];

        // Fetch recent commandes for authenticated user or admin
        $query = Commande::with('produits')->latest()->take(5);

        if (!Auth::user()->is_admin) {
            $query->where('user_id', Auth::id());
        }

        $commandes = $query->get();

        $financials = [
            'totalChiffreAffaires' => $this->calculateChiffreAffaires(),
            'netProfit' => $this->calculateNetProfit(),
        ];

        return view('dashboard', array_merge($counts, [
            'commandes' => $commandes,
        ], $financials));
    }

    protected function calculateChiffreAffaires(): float
{
    return DB::table('commandes')
        ->join('commande_produit', 'commandes.id', '=', 'commande_produit.commande_id')
        ->join('produits', 'commande_produit.produit_id', '=', 'produits.id')
        ->where('commandes.status', '!=', 'annule')
        ->sum(DB::raw('commande_produit.quantite * produits.prix_vente'));
}

    

protected function calculateNetProfit(): float
{
    return DB::table('commandes')
        ->join('commande_produit', 'commandes.id', '=', 'commande_produit.commande_id')
        ->join('produits', 'commande_produit.produit_id', '=', 'produits.id')
        ->where('commandes.status', '!=', 'annule')
        ->sum(DB::raw('commande_produit.quantite * (produits.prix_vente - produits.prix)'));
}


}