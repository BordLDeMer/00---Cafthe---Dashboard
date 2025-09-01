@extends('layouts.app')

@section('content')
    <div class="container-fluid py-4" style="background-color: #f8f9fa;">
        <div class="row justify-content-center">
            <div class="col-12 text-center mb-4">
                <h1 style="color: #5a3e2b; font-weight: bold;">Liste des Produits</h1>
            </div>

            <!-- Barre de filtrage -->
            <div class="col-12 mb-4">
                <div class="card" style="background-color: #ccbba7; border: none; border-radius: 10px; width:100%; height: auto;">
                    <div class="card-body">
                        <form method="GET" action="{{ route('produits.index') }}">
                            <div class="row g-3">
                                <div class="col-md-3">
                                    <select name="solde" class="form-control" style="border-radius: 5px; border: 1px solid #5a3e2b;">
                                        <option value="">Tous les produits</option>
                                        <option value="1" {{ request('solde') == '1' ? 'selected' : '' }}>En solde</option>
                                        <option value="0" {{ request('solde') == '0' ? 'selected' : '' }}>Pas en solde</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select name="type_produit" class="form-control" style="border-radius: 5px; border: 1px solid #5a3e2b;">
                                        <option value="">Tous les types</option>
                                        @foreach($typesProduits as $type)
                                            <option value="{{ $type }}" {{ request('type_produit') == $type ? 'selected' : '' }}>
                                                {{ $type }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <input type="number" name="prix_max" class="form-control" placeholder="Prix maximum" value="{{ request('prix_max') }}" step="10" min="0" style="border-radius: 5px; border: 1px solid #5a3e2b;">
                                </div>
                                <div class="col-md-3">
                                    <button type="submit" class="btn w-100" style="background-color: #5a3e2b; color: white; border-radius: 5px; padding: 8px 20px; border: none;">
                                        Filtrer
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Liste des produits -->
            <div class="col-12">
                <div class="row g-4">
                    @forelse($produits as $produit)
                        <div class="col-md-4 col-lg-3">
                            <div class="card h-100" style="background-color: white; border: none; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); overflow: hidden;">
                                <div class="card-header" style="background-color: #5a3e2b; color: white; border: none; padding: 15px;">
                                    <h5 class="card-title mb-0" style="font-weight: bold; text-align: center;">{{ $produit->designation_produit }}</h5>
                                </div>
                                <div class="card-body d-flex flex-column" style="padding: 15px;">
                                    <div class="flex-grow-1">
                                        <p class="card-text mb-2">
                                            <strong>Type:</strong> <span style="color: #5a3e2b;">{{ $produit->type_produit }}</span>
                                        </p>
                                        <p class="card-text mb-2">
                                            <strong>Prix:</strong> <span style="color: #5a3e2b; font-weight: bold; font-size: 1.1em;">{{ $produit->prix_ttc }} €</span>
                                        </p>
                                        <p class="card-text mb-2">
                                            <strong>Stock:</strong>
                                            <span class="{{ $produit->stock > 0 ? 'text-success' : 'text-danger' }}" style="font-weight: bold;">
                                                {{ $produit->stock }}
                                            </span>
                                        </p>
                                        @if($produit->solde)
                                            <div class="mb-3">
                                                <span class="badge" style="background-color: #dc3545; color: white; padding: 5px 10px; border-radius: 5px;">
                                                    En solde
                                                </span>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="mt-auto">
                                        @if($produit->stock > 0)
                                            <form action="{{ route('panier.ajouter', $produit->ID_produit) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn w-100" style="background-color: #28a745; color: white; border-radius: 5px; padding: 8px; border: none; font-weight: bold;">
                                                    Ajouter au panier
                                                </button>
                                            </form>
                                        @else
                                            <button class="btn w-100" disabled style="background-color: #6c757d; color: white; border-radius: 5px; padding: 8px; border: none;">
                                                Stock épuisé
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="card" style="background-color: #ccbba7; border: none; border-radius: 10px;">
                                <div class="card-body text-center" style="padding: 40px;">
                                    <h3 style="color: #5a3e2b;">Aucun produit trouvé</h3>
                                    <p style="color: #5a3e2b;">Essayez de modifier vos filtres pour voir plus de produits.</p>
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Pagination (seulement si $produits est paginé) -->
            @if(method_exists($produits, 'hasPages') && $produits->hasPages())
                <div class="col-12 mt-4 d-flex justify-content-center">
                    <div class="pagination-wrapper">
                        {{ $produits->appends(request()->query())->links('vendor.pagination.bootstrap-4') }}
                    </div>
                </div>
            @endif
        </div>
    </div>

    <style>
        /* Style pour la pagination */
        .pagination-wrapper .pagination {
            margin: 0;
        }
        .pagination-wrapper .page-link {
            color: #5a3e2b;
            background-color: white;
            border-color: #ccbba7;
            border-radius: 5px;
            margin: 0 2px;
        }
        .pagination-wrapper .page-link:hover {
            color: white;
            background-color: #5a3e2b;
            border-color: #5a3e2b;
        }
        .pagination-wrapper .page-item.active .page-link {
            color: white;
            background-color: #5a3e2b;
            border-color: #5a3e2b;
        }
        .pagination-wrapper .page-item.disabled .page-link {
            color: #6c757d;
            background-color: #e9ecef;
            border-color: #dee2e6;
        }

        /* Effet hover sur les cartes */
        .card:hover {
            transform: translateY(-5px);
            transition: transform 0.3s ease;
            box-shadow: 0 4px 15px rgba(0,0,0,0.15) !important;
        }

        /* Style pour les filtres */
        .form-control:focus {
            border-color: #5a3e2b;
            box-shadow: 0 0 0 0.2rem rgba(90, 62, 43, 0.25);
        }
    </style>
@endsection
