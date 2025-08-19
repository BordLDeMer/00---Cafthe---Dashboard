@extends('layouts.app')

@section('content')
    <h1>Liste des Vendeurs</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('vendeurs.create') }}" class="btn btn-primary mb-3">Ajouter un vendeur</a>

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
            @forelse($vendeurs as $vendeur)
                <tr>
                    <td>{{ $vendeur->ID_vendeur }}</td>
                    <td>{{ $vendeur->nom_prenom }}</td>
                    <td>{{ $vendeur->tel }}</td>
                    <td>{{ $vendeur->mail }}</td>
                    <td>
                        <a href="{{ route('vendeurs.show', ['vendeur' => $vendeur->ID_vendeur]) }}" class="btn btn-info btn-sm">Voir</a>
                        <a href="{{ route('vendeurs.edit', ['vendeur' => $vendeur->ID_vendeur]) }}" class="btn btn-warning btn-sm">Modifier</a>
                        <form action="{{ route('vendeurs.destroy', ['vendeur' => $vendeur->ID_vendeur]) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Aucun vendeur trouvé.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center">
        {{ $vendeurs->links() }}
    </div>
@endsection
