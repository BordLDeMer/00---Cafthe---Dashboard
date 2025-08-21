@extends('layouts.app')

@section('content')
    <h1>Liste des Clients</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('clients.create') }}" class="btn-add">Ajouter un client</a>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nom Prénom</th>
                <th>Téléphone</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($clients as $client)
                <tr>
                    <td>{{ $client->ID_client }}</td>
                    <td>{{ $client->nom_prenom }}</td>
                    <td>{{ $client->tel }}</td>
                    <td>{{ $client->mail }}</td>
                    <td>
                        <a href="{{ route('clients.show', $client->ID_client) }}" class="btn btn-info btn-sm">Voir</a>
                        <a href="{{ route('clients.edit', $client->ID_client) }}" class="btn btn-warning btn-sm">Modifier</a>
                        <form action="{{ route('clients.destroy', $client->ID_client) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Aucun client trouvé.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <!-- Liens de pagination -->
    <div class="d-flex justify-content-center">
        {{ $clients->links() }}
    </div>

@endsection
