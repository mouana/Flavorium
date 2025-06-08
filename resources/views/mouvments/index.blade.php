@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Liste des Mouvements de Stock</h2>
    <a href="{{ route('mouvements.create') }}" class="btn btn-primary mb-3">Ajouter un mouvement</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Date</th>
                <th>Produit</th>
                <th>Type</th>
                <th>Quantité</th>
                <th>Prix</th>
                <th>Utilisateur</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mouvements as $mouvement)
            <tr>
                <td>{{ \Carbon\Carbon::parse($mouvement->date)->format('d/m/Y') }}</td>
                <td>{{ $mouvement->produit->nom ?? '-' }}</td>
                <td>{{ $mouvement->type }}</td>
                <td>{{ $mouvement->quantite }}</td>
                <td>{{ $mouvement->prix }} DH</td>
                <td>{{ $mouvement->user->name ?? '-' }}</td>
                <td>
                    <a href="{{ route('mouvements.show', $mouvement->id) }}" class="btn btn-info btn-sm">Voir</a>
                    <a href="{{ route('mouvements.edit', $mouvement->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                    <form action="{{ route('mouvements.destroy', $mouvement->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Confirmer la suppression ?')">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
