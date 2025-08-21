@props(['produit', 'titre'])

<div class="product-card">
    <div class="product-card-header">
        <h3 class="product-card-title">{{ $titre ?? 'Produit' }}</h3>
    </div>
    <div class="product-card-image">
        @if($produit && $produit->image)
            <img src="{{ asset('images/' . $produit->image) }}" alt="{{ $produit->nom ?? 'Image du produit' }}" class="img-fluid">
        @else
            <img src="{{ asset('images/coffee-8861674.png') }}" alt="Image par défaut" class="img-fluid">
        @endif
    </div>
    <div class="product-card-body">
        <p>{{ $produit->nom_prenom ?? 'Nom du produit' }}</p>
    </div>
    <div class="product-card-footer">
        <span class="product-card-price">{{ number_format($produit->prix ?? 0, 2, ',', ' ') }} €</span>
        <button class="product-card-button">Ajouter</button>
    </div>
</div>
