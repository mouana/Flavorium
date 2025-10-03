<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\Commande;
use App\Models\CommandeProduit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Afficher les produits
    public function products()
    {
        $user = Auth::user();

        $produits = Produit::all();
            // : Produit::where('user_id', $user->id)->get();

        return view('produits.products', compact('produits'));
    }

    // Ajouter au panier
    public function addToCart(Request $request)
    {
        $produit = Produit::findOrFail($request->id);

        // if ($produit->user_id !== null && $produit->user_id !== Auth::id()) {
        //     return redirect()->back()->with('error', 'Vous ne pouvez pas ajouter ce produit au panier.');
        // }

        $cart = session()->get('cart', []);
        $quantite = (int) $request->quantite;
        $prix = $produit->prix_vente;
        $sousTotal = $prix * $quantite;

        if (isset($cart[$produit->id])) {
            $cart[$produit->id]['quantite'] += $quantite;
            $cart[$produit->id]['sous_total'] = $cart[$produit->id]['quantite'] * $prix;
        } else {
            $cart[$produit->id] = [
                'id' => $produit->id,
                'nom' => $produit->nom,
                'prix' => $prix,
                'quantite' => $quantite,
                'sous_total' => $sousTotal,
                'photo' => $produit->photo,
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Produit ajouté au panier.');
    }

    // Voir panier
    public function viewCart()
    {
        return view('cart.cart');
    }

    // Passer commande depuis le panier
public function checkout(Request $request)
{
    $request->validate([
        'client' => 'required|string',
        'address' => 'required|string',
        'phone' => 'nullable|string',
        'produits' => 'required|array',
        'quantites' => 'required|array',
        'prix' => 'required|array',
    ]);

    if (!session()->has('cart')) {
        return redirect()->back()->with('error', 'Votre panier est vide.');
    }

    $commande = Commande::create([
        'client' => $request->client,
        'address' => $request->address,
        'phone' => $request->phone,
        'user_id' => Auth::id(), 
        'total' => 0,
    ]);

    $total_commande = 0;

    foreach ($request->produits as $index => $produit_id) {
        $qte = (int) $request->quantites[$index];
        $prix_unitaire = (float) $request->prix[$index];
        $sous_total = $qte * $prix_unitaire;

        CommandeProduit::create([
            'commande_id' => $commande->id,
            'produit_id' => $produit_id,
            'quantite' => $qte,
            'prix' => $prix_unitaire,
            'sous_total' => $sous_total,
        ]);

        $total_commande += $sous_total;
    }

    $commande->update(['total' => $total_commande]);

    session()->forget('cart');

    return redirect()->route('cart.view')->with('success', 'Commande créée avec succès !');
}



    // Retirer un produit du panier
    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Produit retiré du panier.');
    }

    // Vider panier
    public function empty(Request $request)
    {
        $request->session()->forget('cart');
        return back()->with('success', 'Le panier a été vidé');
    }
}