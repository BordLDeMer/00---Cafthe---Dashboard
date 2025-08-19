@extends('layouts.app')

@section('content')
    <h1>Détails du vendeur</h1>
    <div class="card">
        <div class="card-body">
            <p><strong>ID:</strong> {{ $vendeur->ID_Vendeur }}</p>
            <p><strong>Nom et Prénom:</strong> {{ $vendeur->nom_prenom }}</p>
            <p><strong>Téléphone:</strong> {{ $vendeur->tel }}</p>
            <p><strong>Email:</strong> {{ $vendeur->mail }}</p>
        </div>
    </div>
    <a href="{{ route('vendeurs.index') }}" class="btn btn-secondary mt-3">Retour</a>
@endsection
