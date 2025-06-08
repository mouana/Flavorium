@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Statistiques de {{ $user->name }}</h2>
    <p><strong>Chiffre d'affaires :</strong> {{ $totalCA }} DH</p>
    <p><strong>Revenus :</strong> {{ $totalRevenus }} DH</p>
</div>
@endsection
