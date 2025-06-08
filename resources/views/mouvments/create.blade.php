@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Ajouter un Mouvement</h2>

    <form action="{{ route('mouvements.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Type</label>
            <select name="type" class="form-control" required>
                <option value="entrée">Entrée</option>
                <option value="sortie">Sortie</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Quantité</label>
            <input type="number" name="quantite" class="form-control" required min="1">
        </div>

        <div class="mb-3">
            <label>Prix</label>
            <input type="number" name="prix" class="form-control" required min="0">
        </div>

        <div class="mb-3">
            <label>Produit</label>
            <select name="produit_id" class="form-control" required>
                @foreach ($produits as $produit)
                    <option value="{{ $produit->id }}">{{ $produit->nom }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Utilisateur</label>
            <select name="utilisateur_id" class="form-control" required>
                @foreach ($utilisateurs as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-success">Enregistrer</button>
    </form>
</div>
@endsection
