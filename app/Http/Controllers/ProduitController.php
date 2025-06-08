<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\Categorie;
use Illuminate\Http\Request;

class ProduitController extends Controller
{
    public function index()
    {
        $produits = Produit::with('categorie')->paginate(10);
        return view('produits.index', compact('produits'));
    }
    public function front()
{
    $produits = Produit::paginate(9);
    return view('produits.front', compact('produits'));
}


    public function create()
    {
        $categories = Categorie::all();
        return view('produits.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:produits,code',
            'description' => 'nullable|string',
            'prix' => 'required|numeric|min:0',
            'prix_vente' => 'required|numeric|min:0',
            'categorie_id' => 'required|exists:categories,id',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $produitData = [
            'nom' => $request->nom,
            'code' => $request->code,
            'description' => $request->description,
            'prix' => $request->prix,
            'prix_vente' => $request->prix_vente,
            'categorie_id' => $request->categorie_id,
        ];

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('produits', 'public');
            $produitData['photo'] = $photoPath;
        }

        Produit::create($produitData);

        return redirect()->route('produits.index')->with('success', 'Produit ajouté avec succès.');
    }

    public function edit($id)
    {
        $produit = Produit::findOrFail($id);
        $categories = Categorie::all();
        return view('produits.edit', compact('produit', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:produits,code,' . $id,
            'description' => 'nullable|string',
            'prix' => 'required|numeric',
            'prix_vente' => 'required|numeric',
            'categorie_id' => 'required|exists:categories,id',
        ]);

        $produit = Produit::findOrFail($id);

        $updateData = $request->only([
            'nom', 'code', 'description', 'prix', 'prix_vente', 'categorie_id'
        ]);

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('produits', 'public');
            $updateData['photo'] = $photoPath;
        }

        $produit->update($updateData);

        return redirect()->route('produits.index')->with('success', 'Produit mis à jour avec succès.');
    }

    public function destroy($id)
    {
        $produit = Produit::findOrFail($id);
        $produit->delete();

        return redirect()->route('produits.index')->with('success', 'Produit supprimé avec succès.');
    }

    public function show($id)
    {
        $produit = Produit::with('categorie')->findOrFail($id);
        return view('produits.show', compact('produit'));
    }

    public function catalogue()
{
    $produit = Produit::all(); 
    return view('commands.catalogue', compact('produit'));
}

}