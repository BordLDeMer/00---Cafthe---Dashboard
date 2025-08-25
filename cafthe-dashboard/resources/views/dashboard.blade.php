@extends('layouts.app')

@section('content')
    <title>Café Dashboard</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <div class="container-fluid py-4" style="background-color: #f8f9fa;">
        <div class="row justify-content-center">
            <div class="col-12 text-center mb-4">
                <h1 style="color: #5a3e2b; font-weight: bold;">Tableau de bord Cafthé</h1>
            </div>
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="card h-100" style="background-color: #ccbba7; border: none; border-radius: 10px;">
                    <div class="card-body text-center">
                        <h5 class="card-title" style="color: #5a3e2b;">CA DU MOIS</h5>
                        <h2 class="card-text" style="color: #5a3e2b;">{{ number_format($chiffreAffairesMois['total'], 2, ',', ' ') }} €</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="card h-100" style="background-color: #ccbba7; border: none; border-radius: 10px;">
                    <div class="card-body text-center">
                        <h5 class="card-title" style="color: #5a3e2b;">BALANCE MENSUELLE</h5>
                        <p class="card-text" style="color: #5a3e2b;"><strong>CA mois dernier :</strong> {{ number_format($balanceMensuelle['ca_mois_precedent'], 2, ',', ' ') }} €</p>
                        <h2 class="card-text">
                            @if($balanceMensuelle['balance'] >= 0)
                                <span style="color: green; ">+{{ number_format($balanceMensuelle['balance'], 2, ',', ' ') }} €</span>
                            @else
                                <span style="color: red;">{{ number_format($balanceMensuelle['balance'], 2, ',', ' ') }} €</span>
                            @endif
                        </h2>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="card h-100" style="background-color: #ccbba7; border: none; border-radius: 10px;">
                    <div class="card-body text-center">
                        <h5 class="card-title" style="color: #5a3e2b;">MEILLEURE VENTE</h5>
                        @include('product-card', ['produit' => $meilleureVente ?? null, 'titre' => 'Meilleure vente'])
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="card h-100" style="background-color: #ccbba7; border: none; border-radius: 10px;">
                    <div class="card-body text-center">
                        <h5 class="card-title" style="color: #5a3e2b;">PRODUIT EN RECUL</h5>
                        @include('product-card', ['produit' => $mauvaiseVente ?? null, 'titre' => 'Produit en recul'])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
