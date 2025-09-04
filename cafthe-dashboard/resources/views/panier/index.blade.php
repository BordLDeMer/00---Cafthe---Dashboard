@extends('layouts.app')
@section('content')
    <div class="container-fluid py-4" style="background-color: #f8f9fa;">
        <div class="row justify-content-center">
            <div class="col-12 text-center mb-4">
                <h1 style="color: #5a3e2b; font-weight: bold;">Résumé de la commande #{{ $commande->ID_commande }}</h1>
            </div>

            <!-- Informations générales de la commande -->
            <div class="col-12 d-flex justify-content-center">
                <div class="card w-100" style="max-width: 800px; background-color: #ccbba7; border: none; border-radius: 10px; overflow: hidden;">
                    <div class="card-body p-4">
                        <!-- Informations de base -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h5 style="color: #5a3e2b;">Date de la commande</h5>
                                <p>{{ $commande->date_prise_commande ? $commande->date_prise_commande->format('d/m/Y H:i') : 'N/A' }}</p>
                            </div>
                            <div class="col-md-6">
                                <h5 style="color: #5a3e2b;">Statut</h5>
                                <p>{{ ucfirst(str_replace('_', ' ', $commande->statut)) }}</p>
                            </div>
                        </div>

                        <!-- Informations client -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 style="color: #5a3e2b;">Client</h5>
                                <p>{{ $commande->client->nom_prenom }} (ID: {{ $commande->client->ID_client }})</p>
                            </div>
                        </div>

                        <!-- Montant total -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 style="color: #5a3e2b;">Montant total</h5>
                                <p style="font-size: 1.2rem; font-weight: bold;">{{ number_format($commande->montant_commande, 2, ',', ' ') }} €</p>
                            </div>
                        </div>

                        <!-- Liste des produits -->
                        <div class="row">
                            <div class="col-12">
                                <h5 style="color: #5a3e2b;">Produits commandés</h5>
                                <div class="table-responsive">
                                    <table class="table table-striped" style="background-color: white;">
                                        <thead style="background-color: #5a3e2b; color: white;">
                                        <tr>
                                            <th style="padding: 12px; text-align: center;">Produit</th>
                                            <th style="padding: 12px; text-align: center;">Prix unitaire</th>
                                            <th style="padding: 12px; text-align: center;">Quantité</th>
                                            <th style="padding: 12px; text-align: center;">Total</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($commande->produits as $produit)
                                            <tr>
                                                <td style="padding: 12px; text-align: center;">{{ $produit->designation_produit }}</td>
                                                <td style="padding: 12px; text-align: center;">{{ number_format($produit->pivot->prix_unitaire, 2, ',', ' ') }} €</td>
                                                <td style="padding: 12px; text-align: center;">{{ $produit->pivot->quantite }}</td>
                                                <td style="padding: 12px; text-align: center;">{{ number_format($produit->pivot->prix_unitaire * $produit->pivot->quantite, 2, ',', ' ') }} €</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr style="background-color: #f8f9fa;">
                                            <td colspan="3" style="padding: 12px; text-align: right; font-weight: bold;">Total:</td>
                                            <td style="padding: 12px; text-align: center; font-weight: bold;">{{ number_format($commande->montant_commande, 2, ',', ' ') }} €</td>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Bouton de retour -->
                        <div class="row mt-4">
                            <div class="col-12 d-flex justify-content-center">
                                <a href="{{ route('commandes.client', $commande->ID_client) }}" class="btn" style="background-color: #5a3e2b; color: #fff; border-radius: 10px; padding: 8px 20px; text-decoration: none;">
                                    Retour aux commandes
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
