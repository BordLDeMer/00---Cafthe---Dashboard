@extends('layouts.app')

@section('content')
    <h1>Modifier le vendeur : {{ $vendeur->nom_prenom }}</h1>
    <form action="{{ route('vendeurs.update', $vendeur->ID_vendeur) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nom_prenom" class="form-label">Nom et Prénom</label>
            <input type="text" class="form-control" id="nom_prenom" name="nom_prenom" value="{{ $vendeur->nom_prenom }}" required>
        </div>
        <div class="mb-3">
            <label for="tel" class="form-label">Téléphone</label>
            <input type="text" class="form-control" id="tel" name="tel" value="{{ $vendeur->tel }}" required>
        </div>
        <div class="mb-3">
            <label for="mail" class="form-label">Email</label>
            <input type="email" class="form-control" id="mail" name="mail" value="{{ $vendeur->mail }}" required>
        </div>
        <div class="mb-3">
            <label for="mdp" class="form-label">Mot de passe (laisser vide pour conserver)</label>
            <input type="password" class="form-control" id="mdp" name="mdp" placeholder="Laisser vide pour conserver le mot de passe actuel">
        </div>
        <button type="submit" class="btn btn-primary">Mettre à jour</button>
        <a href="{{ route('vendeurs.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
@endsection
