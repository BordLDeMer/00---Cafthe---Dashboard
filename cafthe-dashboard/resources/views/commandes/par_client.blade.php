@extends('layouts.app')
@section('content')
    <div class="container-fluid py-4" style="background-color: #f8f9fa;">
        <div class="row justify-content-center">
            <div class="col-12 text-center mb-4">
                <h1 style="color: #5a3e2b; font-weight: bold;">Commandes de {{ $client->nom_prenom }}</h1>
            </div>
            @if(session('success'))
                <div class="col-12 mb-4">
                    <div class="alert alert-success" style="background-color: #d4edda; color: #155724; border: none; border-radius: 10px;">
                        {{ session('success') }}
                    </div>
                </div>
            @endif
            <div class="col-12 d-flex justify-content-center">
                <div class="card w-100" style="max-width: 1200px; background-color: #ccbba7; border: none; border-radius: 10px; overflow: hidden; height: 100%;">
                    <div class="card-body p-0">
                        @if($commandes->isEmpty())
                            <div class="p-4 text-center" style="background-color: white;">Aucune commande trouvée pour ce client.</div>
                        @else
                            <div class="table-responsive">
                                <table class="table table-striped mb-0" style="background-color: white; width: 100%;">
                                    <thead style="background-color: #5a3e2b; color: white;">
                                    <tr>
                                        <th style="padding: 12px; text-align: center;">ID Commande</th>
                                        <th style="padding: 12px; text-align: center;">Date</th>
                                        <th style="padding: 12px; text-align: center;">Montant</th>
                                        <th style="padding: 12px; text-align: center;">Statut</th>
                                        <th style="padding: 12px; text-align: center;">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($commandes as $commande)
                                        <tr>
                                            <td style="padding: 12px; text-align: center;">{{ $commande->ID_commande }}</td>
                                            <td style="padding: 12px; text-align: center;">
                                                @if($commande->date_prise_commande)
                                                    @php
                                                        $date = $commande->date_prise_commande;
                                                        if (is_string($date)) {
                                                            $date = \Carbon\Carbon::parse($date);
                                                        }
                                                    @endphp
                                                    {{ $date->format('d/m/Y H:i') }}
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                            <td style="padding: 12px; text-align: center;">{{ number_format($commande->montant_commande, 2, ',', ' ') }} €</td>
                                            <td style="padding: 12px; text-align: center;">
                                                <div class="d-flex align-items-center justify-content-center" style="gap:8px;">
                                                    <span>{{ ucfirst(str_replace('_', ' ', $commande->statut)) }}</span>
                                                    <form action="{{ route('commandes.updateStatut', $commande->ID_commande) }}" method="POST" style="margin:0;">
                                                        @csrf
                                                        @method('PATCH')
                                                        <select name="statut" class="form-select form-select-sm" onchange="this.form.submit()" style="min-width: 130px; display:inline-block;">
                                                            <option value="annulée" {{ $commande->statut === 'annulée' ? 'selected' : '' }}>annulée</option>
                                                            <option value="en_cours" {{ $commande->statut === 'en_cours' ? 'selected' : '' }}>en_cours</option>
                                                            <option value="payée" {{ $commande->statut === 'payée' ? 'selected' : '' }}>payée</option>
                                                        </select>
                                                    </form>
                                                </div>
                                            </td>
                                            <td style="padding: 12px; text-align: center;">
                                                <a href="{{ route('commandes.details', $commande->ID_commande) }}" class="btn" style="background-color: #8b7355; color: white; border-radius: 5px; padding: 5px 10px; text-decoration: none;">
                                                    Détails
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-12 mt-4 d-flex justify-content-center">
                <a href="{{ route('clients.index') }}" class="btn" style="background-color: #5a3e2b; color: #fff; border-radius: 10px; padding: 8px 20px; text-decoration: none;">Retour à la liste des clients</a>
            </div>
        </div>
    </div>
@endsection
