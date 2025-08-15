<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Café Dashboard</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body>
<div class="navbar">
    <div>
        <a class="nav-link" href="{{ route('dashboard') }}">Accueil</a>
        <a class="nav-link" href="{{ route('clients.gestion') }}">Gestion des Clients</a>
        <a href="#">Nos produits</a>
        <a href="#">Actualités</a>
    </div>
    <div>
        <a href="#">Espace Vendeur</a>
    </div>
</div>
<div class="dashboard">
    <div class="card">
        <h2>CHIFFRE AFFAIRE MOIS</h2>
        <h1>{{ number_format($chiffreAffairesMois['total'], 2, ',', ' ') }} €</h1>
    </div>
    <div class="card">
        <h2>BALANCE MENSUELLE</h2>
        <p><strong>CA mois dernier :</strong> {{ number_format($balanceMensuelle['ca_mois_precedent'], 2, ',', ' ') }} €</p>
        <h1>
            @if($balanceMensuelle['balance'] >= 0)
                <span style="color: green;">+{{ number_format($balanceMensuelle['balance'], 2, ',', ' ') }} €</span>
            @else
                <span style="color: red;">{{ number_format($balanceMensuelle['balance'], 2, ',', ' ') }} €</span>
            @endif
        </h1>
    </div>

    <div class="card">
        <h2>MEILLEURE VENTE</h2>
        @include('product-card', ['produit' => $meilleureVente ?? null, 'titre' => 'Meilleure vente'])
    </div>

    <div class="card">
        <h2>PRODUIT EN RECUL</h2>
        @include('product-card', ['produit' => $mauvaiseVente ?? null, 'titre' => 'Produit en recul'])
    </div>

</div>
</div>

</body>
</html>
