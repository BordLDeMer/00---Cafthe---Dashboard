@extends('layouts.app')

@section('content')
    <h1>Modifier le client : {{ $client->nom_prenom }}</h1>
    <form action="{{ route('clients.update', $client->ID_client) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nom_prenom" class="form-label">Nom et Prénom</label>
            <input type="text" class="form-control" id="nom_prenom" name="nom_prenom" value="{{ $client->nom_prenom }}" required>
        </div>
        <div class="mb-3">
            <label for="tel" class="form-label">Téléphone</label>
            <input type="text" class="form-control" id="tel" name="tel" value="{{ $client->tel }}" required>
        </div>
        <div class="mb-3">
            <label for="mail" class="form-label">Email</label>
            <input type="email" class="form-control" id="mail" name="mail" value="{{ $client->mail }}" required>
        </div>
        <div class="mb-3">
            <label for="mdp" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" id="mdp" name="mdp" required>
        </div>
        <button type="submit" class="btn btn-primary">Mettre à jour</button>
        <a href="{{ route('clients.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
@endsection
