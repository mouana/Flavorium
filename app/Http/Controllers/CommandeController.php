<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\Commande;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class CommandeController extends Controller
{
    // Liste des commandes
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

    // On peut encore transformer chaque commande pour ajouter des infos supplémentaires
    $commandes->getCollection()->transform(function ($commande) {
        $commande->total = $commande->total;

        $commande->archive_status = $commande->Archive; // si nécessaire
        $commande->order_status = $commande->status;   // si nécessaire

        return $commande;
    });

    return view('commands.index', compact('commandes'));
}


    // Détails d'une commande
    public function show($id)
{
    $commande = Commande::with('produits.categorie')
        ->where('user_id', Auth::id())
        ->findOrFail($id);

    $total = $commande->total;

    return view('commands.show', compact('commande', 'total'));
}


    // Créer une commande
    public function store(Request $request)
    {
        $request->validate([
            'client' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
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

    // Formulaire création
    public function create()
    {
        $user = Auth::user();

        $produits = $user->is_admin
            ? Produit::all()
            : Produit::where('user_id', $user->id)->get();

        return view('commands.create', compact('produits'));
    }

    // Éditer commande
    public function edit(Commande $commande)
    {
        if ($commande->user_id != Auth::id()) {
            abort(403);
        }

        $produits = Produit::all();
        return view('commands.edit', compact('commande', 'produits'));
    }

    // Mettre à jour commande
    public function update(Request $request, Commande $commande)
    {
        if ($commande->user_id != Auth::id()) {
            abort(403);
        }

        $request->validate([
            'client' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'required|string',
            'produits' => 'required|array',
            'produits.*' => 'integer|exists:produits,id',
            'quantites' => 'required|array',
            'quantites.*' => 'integer|min:1',
            'Archive' => 'in:oui,non',
        ]);

        $commande->update([
            'client' => $request->client,
            'phone' => $request->phone,
            'address' => $request->address,
            'Archive' => $request->input('Archive'),
        ]);

        $productsWithQuantities = [];
        foreach ($request->produits as $index => $produitId) {
            $productsWithQuantities[$produitId] = ['quantite' => $request->quantites[$index]];
        }
        $commande->produits()->sync($productsWithQuantities);

        return redirect()->route('commands.show', $commande)->with('success', 'Commande mise à jour avec succès');
    }

    // Générer PDF
    public function print($id)
    {
        $commande = Commande::with('produits')->findOrFail($id);
        $pdf = Pdf::loadView('commands.print', compact('commande'));
        return $pdf->stream('commande-'.$commande->id.'.pdf');
    }
}