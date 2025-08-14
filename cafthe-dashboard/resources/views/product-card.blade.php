<div style="margin-bottom : 50px; display: flex; justify-content: center; align-items: center; min-height: 100%;">
@if($produit)
    <div class="product-card">
        <div class="product-card-header">
            <h3 class="product-card-title">{{ $produit->designation_produit }}</h3>
        </div>

        <div class="product-card-image">
            @if($produit->image && file_exists(public_path('images/produits/' . $produit->image)))
                <img src="{{ asset('images/produits/' . $produit->image) }}"
                     alt="{{ $produit->designation_produit }}">
            @else
                <img src="https://via.placeholder.com/150/8B4513/FFFFFF?text=Pas+d'image"
                     alt="Image non disponible">
            @endif
        </div>

        <div class="product-card-body">
            <p><strong>Nom :</strong> {{ $produit->designation_produit }}</p>
            <p><strong>Ventes :</strong> {{ $produit->ventes }}</p>
            @if(!empty($produit->description))
                <p class="product-card-description">
                    {{ Str::limit($produit->description, 100) }}
                </p>
            @endif
        </div>

        <div class="product-card-footer">
            <div class="product-card-price">
                {{ number_format($produit->prix_ttc, 2, ',', ' ') }} €
            </div>
            <div class="product-card-button">Ajouter</div>
        </div>
    </div>

        @else
             <p class="text-center">Aucun produit trouvé.</p>
        @endif
</div>
<style>
    .product-card {
        width: 200px;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        background: linen;
        margin: 10px;
        font-family: Arial, sans-serif;
    }

    .product-card-header {
        background: linear-gradient(to right, #8B4513, #D2691E);
        color: white;
        padding: 10px;
        text-align: center;
        border-bottom: 1px solid #D2691E;
    }

    .product-card-title {
        margin: 0;
        font-size: 1.1em;
    }

    .product-card-image {
        width: 100%;
        height: 120px;
        overflow: hidden;
        display: flex;
        justify-content: center;
        align-items: center;
        background: #f9f9f9;
        padding: 5px;
    }

    .product-card-image img {
        max-width: 100%;
        max-height: 100%;
        object-fit: cover;
        border-radius: 4px;
        border: 1px solid #ddd;
    }

    .product-card-body {
        padding: 10px;
        color: #333;
        font-size: 0.85em;
        text-align: left;
    }

    .product-card-description {
        font-style: italic;
        color: #555;
        margin: 5px 0;
    }

    .product-card-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 8px 10px;
        background: #f5f5f5;
        border-top: 1px solid #ddd;
    }

    .product-card-price {
        font-weight: bold;
        color: #8B4513;
        font-size: 1.1em;
    }

    .product-card-button {
        background: #D2691E;
        color: white;
        padding: 5px 10px;
        border-radius: 4px;
        font-size: 0.8em;
        cursor: pointer;
        transition: background 0.3s;
    }

    .product-card-button:hover {
        background: #8B4513;
    }

    .text-center {
        text-align: center;
        font-style: italic;
        color: #666;
    }
</style>
