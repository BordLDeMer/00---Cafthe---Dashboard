@extends('layouts.app')
@section('content')
    <div class="container-fluid py-4" style="background-color: #f8f9fa;">
        <div class="row justify-content-center">
            <div class="col-12 text-center mb-4">
                <h1 style="color: #5a3e2b; font-weight: bold;">Mon Panier</h1>
            </div>

            <!-- Message de succès -->
            @if(session('success'))
                <div class="col-12 mb-4">
                    <div class="alert alert-success" style="background-color: #d4edda; color: #155724; border: none; border-radius: 10px;">
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            <!-- Bouton Continuer les achats -->
            <div class="col-12 mb-4 text-end">
                <a href="{{ route('produits.index') }}" class="btn" style="background-color: #5a3e2b; color: white; border-radius: 10px; padding: 8px 20px; text-decoration: none;">
                    Continuer les achats
                </a>
            </div>

            <!-- ID client -->
            <form action="{{ route('panier.valider') }}" method="POST" style="display:inline;">
                @csrf
                <!-- Champ pour saisir manuellement l'ID_client -->
                <div class="input-group mb-3" style="max-width: 300px; margin-right: 10px;">
                    <input
                        type="text"
                        name="ID_client"
                        class="form-control"
                        placeholder="ID du client"
                        value="{{ auth()->check() ? auth()->user()->ID_client : '' }}"
                        style="border-radius: 5px 0 0 5px; border-right: none; background-color: white; padding: 8px 12px;"
                        required
                    >
                    <button type="submit" class="btn" style="background-color: #82C46C; color: #5a3e2b; border-radius: 0 5px 5px 0; padding: 8px 15px; border: none; font-weight: bold;" onclick="return confirm('Êtes-vous sûr de vouloir valider cet achat ?')">
                        <i class="bi bi-check-lg"></i> Valider l'achat
                    </button>
                </div>
            </form>


            <!-- Tableau des produits dans le panier -->
            <div class="col-12 d-flex justify-content-center">
                <div class="card w-100" style="max-width: 1200px; background-color: #ccbba7; border: none; border-radius: 10px; overflow: hidden; height: auto;">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            @if(Session::has('panier') && count(Session::get('panier')) > 0)
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
                                    @php $total = 0 @endphp
                                    @foreach(Session::get('panier') as $id => $details)
                                        @php $total += $details['prix_ttc'] * $details['quantite'] @endphp
                                        <tr>
                                            <td style="padding: 12px; text-align: center;">{{ $details['designation_produit'] }}</td>
                                            <td style="padding: 12px; text-align: center;">{{ number_format($details['prix_ttc'], 2) }} €</td>
                                            <td style="padding: 12px; text-align: center;">
                                                <span class="badge" style="background-color: #5a3e2b; color: white; padding: 5px 10px; border-radius: 5px;">
                                                    {{ $details['quantite'] }}
                                                </span>
                                            </td>
                                            <td style="padding: 12px; text-align: center;">{{ number_format($details['prix_ttc'] * $details['quantite'], 2) }} €</td>
                                            <td style="padding: 12px; text-align: center;">
                                                <form action="{{ route('panier.supprimer', $id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn" style="background-color: #dc3545; color: white; border-radius: 5px; padding: 5px 10px; border: none;" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit du panier ?')">
                                                        Supprimer
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
                            @else
                                <div class="card" style="background-color: white; border: none;">
                                    <div class="card-body text-center p-5">
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
            </div>
        </div>
    </div>
    <style>
        .btn:hover:not(:disabled) {
            opacity: 0.9;
            transform: translateY(-1px);
            transition: all 0.2s ease;
        }
    </style>
@endsection
