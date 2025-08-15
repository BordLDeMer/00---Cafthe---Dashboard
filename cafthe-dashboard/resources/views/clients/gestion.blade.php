@extends('layouts.app')

@section('title', 'Gestion des Clients')

@section('content')
    <div class="container mt-4">
        <!-- Titre et actions -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="mb-0">Gestion des Clients</h1>
        </div>

        <!-- Boutons et recherche -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ajouterClientModal">
                <i class="bi bi-person-plus-fill me-2"></i> Ajouter un client
            </button>
            <div class="input-group" style="width: 300px;">
                <input type="text" id="searchInput" class="form-control" placeholder="Rechercher un client...">
                <button class="btn btn-outline-secondary" type="button">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </div>

        <!-- Tableau des clients -->
        <div class="card shadow-sm">
            <div class="card-header bg-light">
                <h5 class="mb-0">Liste des clients</h5>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Nom et Prénom</th>
                            <th>Téléphone</th>
                            <th>Email</th>
                            <th class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($clients as $client)
                            <tr>
                                <td>{{ $client->ID_client }}</td>
                                <td>{{ $client->nom_prenom }}</td>
                                <td>{{ $client->tel ?? 'N/A' }}</td>
                                <td>{{ $client->mail }}</td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <button class="btn btn-sm btn-warning"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editerClientModal"
                                                data-id="{{ $client->ID_client }}"
                                                data-nom="{{ $client->nom_prenom }}"
                                                data-tel="{{ $client->tel ?? '' }}"
                                                data-mail="{{ $client->mail }}">
                                            <i class="bi bi-pencil-square"></i> Éditer
                                        </button>
                                        <form action="{{ route('clients.destroy', $client->ID_client) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce client ?')">
                                                <i class="bi bi-trash-fill"></i> Supprimer
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4">
                                    <i class="bi bi-exclamation-circle-fill me-2"></i>
                                    Aucun client trouvé.
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Modales (inchangées) -->
        @include('clients.modals.ajouter')
        @include('clients.modals.editer')
    </div>
@endsection
@section('scripts')
    <script>
        // Recherche en temps réel
        document.getElementById('searchInput').addEventListener('keyup', function() {
            const searchTerm = this.value.toLowerCase();
            const rows = document.querySelectorAll('tbody tr:not(.no-results)');

            rows.forEach(row => {
                const nomPrenom = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                const mail = row.querySelector('td:nth-child(4)').textContent.toLowerCase();
                const tel = row.querySelector('td:nth-child(3)').textContent.toLowerCase();

                if (nomPrenom.includes(searchTerm) || mail.includes(searchTerm) || tel.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        // Remplissage du formulaire d'édition
        const editerClientModal = document.getElementById('editerClientModal');
        editerClientModal.addEventListener('show.bs.modal', event => {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id');
            const nom = button.getAttribute('data-nom');
            const tel = button.getAttribute('data-tel');
            const mail = button.getAttribute('data-mail');

            const form = editerClientModal.querySelector('form');
            form.action = `/clients/${id}`;

            editerClientModal.querySelector('#editId').value = id;
            editerClientModal.querySelector('#editNom').value = nom;
            editerClientModal.querySelector('#editTel').value = tel;
            editerClientModal.querySelector('#editMail').value = mail;
            editerClientModal.querySelector('#editMdp').value = '';
        });
    </script>
@endsection
