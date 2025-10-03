<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Produit;
use App\Models\Commande;
use App\Models\Categorie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
public function index()
{
    $productCount = Produit::count();
    $now = Carbon::now();

    $chiffreAffaireQuery = Commande::with('produits')
        ->where('status', '!=', 'annule')
        ->whereYear('created_at', $now->year)
        ->whereMonth('created_at', $now->month);

    if (Auth::user()->role !== 'admin') {
        $chiffreAffaireQuery->where('user_id', Auth::id());
    }

    $commandes = $chiffreAffaireQuery->get();

    $totalChiffreAffaires = 0;
    foreach ($commandes as $commande) {
        foreach ($commande->produits as $produit) {
            $totalChiffreAffaires += $produit->pivot->prix * $produit->pivot->quantite;
        }
    }

    $allCommandes = Commande::with('produits')
        ->where('status', '!=', 'annule')
        ->whereYear('created_at', $now->year)
        ->whereMonth('created_at', $now->month)
        ->get();

    $netProfit = 0;
    foreach ($allCommandes as $commande) {
        foreach ($commande->produits as $produit) {
            $netProfit += ($produit->pivot->prix - $produit->prix) * $produit->pivot->quantite;
        }
    }

    return view('dashboard', compact('productCount', 'totalChiffreAffaires', 'netProfit'));
}



public function statistiquesAchats()
{
    setlocale(LC_TIME, 'fr_FR.UTF-8'); 

    // Totaux par commande
    $totalsParCommande = Commande::with('produits')->get()->mapWithKeys(function ($commande) {
        $totalAchat = 0;
        $netProfit = 0;

        foreach ($commande->produits as $produit) {
            $totalAchat += $produit->pivot->prix * $produit->pivot->quantite;
            $netProfit += ($produit->pivot->prix - $produit->prix) * $produit->pivot->quantite;
        }

        return [$commande->id => [
            'total_achat' => $totalAchat,
            'net_profit' => $netProfit
        ]];
    });

    // Totaux par mois
    $totalsParMois = DB::table('commandes')
        ->join('commande_produit', 'commandes.id', '=', 'commande_produit.commande_id')
        ->join('produits', 'commande_produit.produit_id', '=', 'produits.id')
        ->select(
            DB::raw('YEAR(commandes.created_at) as annee'),
            DB::raw('MONTH(commandes.created_at) as mois_num'),
            DB::raw('SUM(commande_produit.prix * commande_produit.quantite) as total_achat'),
            DB::raw('SUM((commande_produit.prix - produits.prix) * commande_produit.quantite) as net_profit')
        )
        ->groupBy('annee', 'mois_num')
        ->orderBy('annee')
        ->orderBy('mois_num')
        ->get()
        ->map(function($row) {
            $row->mois = strftime('%B', mktime(0, 0, 0, $row->mois_num, 1)); // nom du mois en français
            return $row;
        });

    // Totaux par année
    $totalsParAnnee = DB::table('commandes')
        ->join('commande_produit', 'commandes.id', '=', 'commande_produit.commande_id')
        ->join('produits', 'commande_produit.produit_id', '=', 'produits.id')
        ->select(
            DB::raw('YEAR(commandes.created_at) as annee'),
            DB::raw('SUM(commande_produit.prix * commande_produit.quantite) as total_achat'),
            DB::raw('SUM((commande_produit.prix - produits.prix) * commande_produit.quantite) as net_profit')
        )
        ->groupBy('annee')
        ->orderBy('annee')
        ->get();

    return view('statistiques', compact(
        'totalsParCommande',
        'totalsParMois',
        'totalsParAnnee'
    ));
}

}