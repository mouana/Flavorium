<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\Commande;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class CommandeController extends Controller
{

public function index()
{
    $user = Auth::user();

    if ($user && $user->role === 'admin') {
        $commandes = Commande::with(['produits.categorie', 'user'])
            ->latest()
            ->paginate(10);
    } else {
        $commandes = Commande::with(['produits.categorie', 'user'])
            ->where('user_id', $user->id)
            ->latest()
            ->paginate(10);
    }

    $commandes->getCollection()->transform(function ($commande) {
        $commande->total = $commande->produits->sum(function ($produit) {
            return $produit->pivot->quantite * $produit->prix_vente;
        });

        $commande->archive_status = $commande->Archive;
        $commande->order_status = $commande->status;

        return $commande;
    });

    return view('commands.index', compact('commandes'));
}

    

    public function show($id)
    {
    $commande = Commande::with('produits.categorie')
        ->where('user_id', Auth::id())
        ->findOrFail($id);

    // Calculate the total (same logic as in index())
    $commande->total = $commande->produits->sum(function ($produit) {
        return $produit->pivot->quantite * $produit->prix_vente;
    });

    return view('commands.show', compact('commande'));
}

public function store(Request $request)
{
    $request->validate([
        'client' => 'required|string|max:255',
        'phone' => 'string|max:20',
        'address' => 'required|string',
        'produits' => 'required|array',
        'produits.*' => 'integer|exists:produits,id',
        'quantites' => 'required|array',
        'quantites.*' => 'integer|min:1',
        'Archive' => 'in:oui,non',

    ]);

    $commande = Commande::create([
        'user_id' => Auth::id(),
        'client' => $request->client,
        'phone' => $request->phone,
        'address' => $request->address,
        'Archive' => $request->input('Archive'),
    ]);

    foreach ($request->produits as $index => $produitId) {
        $commande->produits()->attach($produitId, [
            'quantite' => $request->quantites[$index],
        ]);
    }

    return redirect()->route('commands.index')->with('success', 'Commande enregistrée.');
}

    public function create()
    {
       $user = Auth::user();

    if ($user->is_admin) {
        $produits = Produit::all();
    } else {
        $produits = Produit::where('user_id', $user->id)->get();
    }

    return view('commands.create', compact('produits'));

    }

    public function edit(Commande $commande)
{
    if ($commande->user_id != Auth::id()) {
        abort(403);
    }

    $produits = Produit::all();
    return view('commands.edit', compact('commande', 'produits'));
}

public function update(Request $request, Commande $commande)
{
    // Authorization check
    if ($commande->user_id != Auth::id()) {
        abort(403);
    }

    $request->validate([
        'client' => 'required|string|max:255',
        'phone' => 'string|max:20',
        'address' => 'required|string',
        'produits' => 'required|array',
        'produits.*' => 'integer|exists:produits,id',
        'quantites' => 'required|array',
        'quantites.*' => 'integer|min:1',
        'Archive' => 'in:oui,non',

    ]);

    // Update client info
    $commande->update([
        'client' => $request->client,
        'phone' => $request->phone,
        'address' => $request->address,
        'Archive' => $request->input('Archive'),

    ]);

    // Sync products with quantities
    $productsWithQuantities = [];
    foreach ($request->produits as $index => $produitId) {
        $productsWithQuantities[$produitId] = ['quantite' => $request->quantites[$index]];
    }
    $commande->produits()->sync($productsWithQuantities);

    return redirect()->route('commands.show', $commande)
        ->with('success', 'Commande mise à jour avec succès');
}




// Dans le contrôleur
public function print($id)
{
    $commande = Commande::with('produits')->findOrFail($id);
    $pdf = Pdf::loadView('commands.print', compact('commande'));
    return $pdf->stream('commande-'.$commande->id.'.pdf');
}
public function updateStatus(Request $request, Commande $commande)
{
    $request->validate([
        'status' => 'required|string',
    ]);

    $commande->status = $request->status;
    $commande->save();

    return back()->with('success', 'Statut mis à jour avec succès.');
}

public function updateArchive(Request $request, $id)
{
    $commande = Commande::findOrFail($id);

    $validated = $request->validate([
        'Archive' => 'required|in:oui,non',
    ]);

    $commande->archive = $validated['Archive'];
    $commande->save();

    return redirect()->back()->with('success', 'Le statut d’archivage a été mis à jour.');
}

// Add product to session cart
public function addToCart($id)
{
    $product = Produit::findOrFail($id);

    $cart = session()->get('cart', []);

    if (isset($cart[$id])) {
        $cart[$id]['quantity']++;
    } else {
        $cart[$id] = [
            "name" => $product->nom,
            "price" => $product->prix,
            "photo" => $product->photo,
            "quantity" => 1,
        ];
    }

    session()->put('cart', $cart);

    return back()->with('success', 'Produit ajouté au panier!');
}

// Show cart
public function showCart()
{
    $cart = session('cart', []);
    
    // Transform the cart array if needed
    $formattedCart = [];
    foreach ($cart as $id => $details) {
        $formattedCart[$id] = [
            'id' => $id,
            'name' => $details['nom'] ?? $details['name'] ?? 'Unknown Product', // Use correct key
            'price' => $details['prix'] ?? $details['price'] ?? 0,
            'quantity' => $details['quantity'] ?? 1
        ];
    }
    
    return view('commands.cart', ['cart' => $formattedCart]);
}

// Clear cart after successful order (optional)
public function clearCart()
{
    session()->forget('cart');
}


}