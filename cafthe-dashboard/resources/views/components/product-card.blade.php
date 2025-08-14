@if($produit)
    <div class="card produit-card">
        @if($produit->image)
            <img src="{{ asset('images/produits/' . $produit->image) }}"
                 alt="{{ $produit->designation_produit }}"
                 style="max-width: 100%; height: auto; border-radius: 5px; margin-bottom: 10px;">
        @else
            <p>(Pas d'image disponible)</p>
        @endif
        <p><strong>Nom :</strong> {{ $produit->designation_produit }}</p>
        <p><strong>Ventes :</strong> {{ $produit->ventes }}</p>
        <p><strong>Prix :</strong> {{ $produit->prix_ttc }} €</p>
    </div>
@else
    <p>Aucun produit trouvé.</p>
@endif
