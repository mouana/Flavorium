<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\Commande;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    public function products()
    {
        $user = Auth::user();

    if ($user->is_admin) {
        $produits = Produit::all();
    } else {
        $produits = Produit::where('user_id', $user->id)->get();
    }

    return view('produits.products', compact('produits'));
    }

    public function addToCart(Request $request)
    {
     
    $produit = Produit::findOrFail($request->id);

    if ($produit->user_id !== null && $produit->user_id !== Auth::id()) {
        return redirect()->back()->with('error', 'Vous ne pouvez pas ajouter ce produit au panier.');
    }

    $cart = session()->get('cart', []);

    if (isset($cart[$produit->id])) {
        $cart[$produit->id]['quantite'] += $request->quantite;
    } else {
        $cart[$produit->id] = [
            'id' => $produit->id,
            'nom' => $produit->nom,
            'prix' => $produit->prix_vente,
            'quantite' => $request->quantite,
            "photo" => $produit->photo,
        ];
    }

    session()->put('cart', $cart);

    return redirect()->back()->with('success', 'Produit ajouté au panier.');
    }


    public function viewCart()
    {
        return view('cart.cart');
    }

public function checkout(Request $request)
{
    $request->validate([
        'client' => 'required|string',
        'address' => 'required|string',
        'phone' => 'nullable|string',
        'quantites' => 'required|array',
        'prix' => 'required|array',
    ]);

    $cart = array_values(session('cart', [])); 

    if (count($cart) === 0) {
        return redirect()->back()->with('error', 'Votre panier est vide.');
    }

    $commande = Commande::create([
        'client' => $request->client,
        'phone' => $request->phone,
        'address' => $request->address,
        'user_id' => auth()->id(),
    ]);

    foreach ($cart as $index => $item) {
        $commande->produits()->attach($item['id'], [
            'quantite' => $request->quantites[$index],
            'prix' => $request->prix[$index], // 👈 this will now match correctly
        ]);
    }

    session()->forget('cart');

    return redirect()->route('commands.create')->with('success', 'Commande enregistrée avec succès.');
}



   public function remove($id)
{
    $cart = session()->get('cart', []);

    if (isset($cart[$id])) {
        unset($cart[$id]);
        session()->put('cart', $cart);
    }

    return redirect()->back()->with('success', 'Produit retiré du panier.');
}

    public function empty(Request $request)
    {
        $request->session()->forget('cart');
        return back()->with('success', 'Le panier a été vidé');
    }
}