@extends('layouts.app')
@section('content')
    <div class="container-fluid py-4" style="background-color: #f8f9fa;">
        <div class="row justify-content-center">
            <div class="col-12 text-center mb-4">
                <h1 style="color: #5a3e2b; font-weight: bold;">Mon Panier</h1>
            </div>

            <!-- Messages d'alerte -->
            @if(session('success'))
                <div class="col-12 mb-4">
                    <div class="alert alert-success" style="background-color: #d4edda; color: #155724; border: none; border-radius: 10px;">
                        {{ session('success') }}
                    </div>
                </div>
            @endif
            @if(session('error'))
                <div class="col-12 mb-4">
                    <div class="alert alert-danger" style="background-color: #f8d7da; color: #721c24; border: none; border-radius: 10px;">
                        {{ session('error') }}
                    </div>
                </div>
            @endif

            <!-- Boutons d'action -->
            <div class="col-12 mb-4 d-flex justify-content-between">
                <a href="{{ route('produits.index') }}" class="btn" style="background-color: #5a3e2b; color: white; border-radius: 10px; padding: 8px 20px; text-decoration: none;">
                    Continuer les achats
                </a>
                <form action="{{ route('panier.vider') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn" style="background-color: #dc3545; color: white; border-radius: 10px; padding: 8px 20px; border: none;" onclick="return confirm('Êtes-vous sûr de vouloir vider complètement votre panier ?')">
                        Vider le panier
                    </button>
                </form>
            </div>

            <!-- Liste des produits dans le panier -->
            <div class="col-12">
                @if(!empty($panier))
                    <div class="card" style="background-color: white; border: none; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); width:100%;">
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped mb-0" style="background-color: white; width: 100%;">
                                    <thead style="background-color: #5a3e2b; color: white;">
                                    <tr>
                                        <th style="padding: 12px; text-align: center;">Produit</th>
                                        <th style="padding: 12px; text-align: center;">Prix unitaire</th>
                                        <th style="padding: 12px; text-align: center;">Quantité</th>
                                        <th style="padding: 12px; text-align: center;">Total</th>
                                        <th style="padding: 12px; text-align: center;">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($panier as $id => $details)
                                        <tr>
                                            <td style="padding: 12px; text-align: center;">
                                                <div class="d-flex align-items-center justify-content-center">
                                                    @if(isset($details['image']))
                                                        <img src="{{ asset('storage/' . $details['image']) }}" alt="{{ $details['designation'] }}" style="width: 50px; height: 50px; object-fit: cover; margin-right: 10px;">
                                                    @endif
                                                    {{ $details['designation'] ?? 'Produit inconnu' }}
                                                </div>
                                            </td>
                                            <td style="padding: 12px; text-align: center;">{{ number_format($details['prix'] ?? 0, 2) }} €</td>
                                            <td style="padding: 12px; text-align: center;">
                                                <form action="{{ route('panier.mettre_a_jour', $id) }}" method="POST" class="d-flex justify-content-center align-items-center">
                                                    @csrf
                                                    <input type="number" name="quantite" value="{{ $details['quantite'] ?? 1 }}" min="1" style="width: 60px; text-align: center; border-radius: 5px; border: 1px solid #5a3e2b; padding: 5px;">
                                                    <button type="submit" class="btn ms-2" style="background-color: #82C46C; color: #5a3e2b; border-radius: 5px; padding: 5px 10px; border: none;">
                                                        <i class="bi bi-arrow-clockwise"></i>
                                                    </button>
                                                </form>
                                            </td>
                                            <td style="padding: 12px; text-align: center;">{{ number_format(($details['prix'] ?? 0) * ($details['quantite'] ?? 1), 2) }} €</td>
                                            <td style="padding: 12px; text-align: center;">
                                                <form action="{{ route('panier.supprimer', $id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    <button type="submit" class="btn" style="background-color: #dc3545; color: white; border-radius: 5px; padding: 5px 10px; border: none;" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit du panier ?')">
                                                        <i class="bi bi-trash"></i> Supprimer
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot style="background-color: #f8f9fa;">
                                    <tr>
                                        <td colspan="3" style="padding: 12px; text-align: right; font-weight: bold;">Total:</td>
                                        <td style="padding: 12px; text-align: center; font-weight: bold;">{{ number_format($total, 2) }} €</td>
                                        <td style="padding: 12px; text-align: center;">
                                            <form action="{{ route('panier.valider') }}" method="POST" style="display:inline;">
                                                @csrf
                                                <button type="submit" class="btn" style="background-color: #82C46C; color: #5a3e2b; border-radius: 5px; padding: 8px 15px; border: none; font-weight: bold;" onclick="return confirm('Êtes-vous sûr de vouloir valider cet achat ?')">
                                                    <i class="bi bi-check-lg"></i> Valider l'achat
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="card" style="background-color: #ccbba7; border: none; border-radius: 10px;">
                        <div class="card-body text-center" style="padding: 40px;">
                            <i class="bi bi-cart-x" style="font-size: 3rem; color: #5a3e2b; margin-bottom: 1rem;"></i>
                            <h3 style="color: #5a3e2b;">Votre panier est vide</h3>
                            <p style="color: #5a3e2b; margin-bottom: 2rem;">Ajoutez des produits à votre panier pour passer commande.</p>
                            <a href="{{ route('produits.index') }}" class="btn" style="background-color: #5a3e2b; color: white; border-radius: 5px; padding: 10px 20px; border: none; font-weight: bold;">
                                <i class="bi bi-bag-plus"></i> Voir nos produits
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <style>
        .btn:hover:not(:disabled) {
            opacity: 0.9;
            transform: translateY(-1px);
            transition: all 0.2s ease;
        }
        input[type="number"] {
            text-align: center;
        }
        input[type="number"]:focus {
            border-color: #5a3e2b;
            box-shadow: 0 0 0 0.2rem rgba(90, 62, 43, 0.25);
        }
    </style>
@endsection
