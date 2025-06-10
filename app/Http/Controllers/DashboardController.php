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
        $user = Auth::user();

        $counts = [
            'productCount' => $user->is_admin ? Produit::count() : Produit::where('user_id', $user->id)->count(),
            'categoryCount' => Categorie::count(),
            'userCount' => User::count(),
        ];

        $query = Commande::with('produits')->latest()->take(5);
        if (!$user->is_admin) {
            $query->where('user_id', $user->id);
        }
        $commandes = $query->get();

        $userProductCount = Produit::where('user_id', $user->id)->count();

        if ($user->is_admin || $userProductCount > 0) {
            $financials = [
                'totalChiffreAffaires' => $this->calculateChiffreAffaires($user),
                'netProfit' => $this->calculateNetProfit($user),
            ];
        } else {
            $financials = [
                'totalChiffreAffaires' => 0,
                'netProfit' => 0,
                'message' => 'Aucun produit trouvé. Aucun chiffre d\'affaires ou bénéfice.'
            ];
        }

        return view('dashboard', array_merge($counts, [
            'commandes' => $commandes,
        ], $financials));
    }

    protected function calculateChiffreAffaires($user): float
    {
        $query = DB::table('commandes')
            ->join('commande_produit', 'commandes.id', '=', 'commande_produit.commande_id')
            ->join('produits', 'commande_produit.produit_id', '=', 'produits.id')
            ->where('commandes.status', '!=', 'annule');

        if (!$user->is_admin) {
            $query->where('produits.user_id', $user->id);
        }

        return (float) $query->sum(DB::raw('commande_produit.quantite * produits.prix_vente'));
    }

    protected function calculateNetProfit($user): float
    {
        $query = DB::table('commandes')
            ->join('commande_produit', 'commandes.id', '=', 'commande_produit.commande_id')
            ->join('produits', 'commande_produit.produit_id', '=', 'produits.id')
            ->where('commandes.status', '!=', 'annule');

        if (!$user->is_admin) {
            $query->where('produits.user_id', $user->id);
        }

        return (float) $query->sum(DB::raw('commande_produit.quantite * (produits.prix_vente - produits.prix)'));
    }
}