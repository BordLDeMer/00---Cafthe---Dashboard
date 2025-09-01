@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Mon Panier</h1>

        @if(Session::has('panier') && count(Session::get('panier')) > 0)
            <table class="table">
                <thead>
                <tr>
                    <th>Produit</th>
                    <th>Prix</th>
                    <th>Quantité</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @php $total = 0 @endphp
                @foreach(Session::get('panier') as $id => $details)
                    @php $total += $details['prix_ttc'] * $details['quantite'] @endphp
                    <tr>
                        <td>{{ $details['designation_produit'] }}</td>
                        <td>{{ $details['prix_ttc'] }} €</td>
                        <td>{{ $details['quantite'] }}</td>
                        <td>{{ $details['prix_ttc'] * $details['quantite'] }} €</td>
                        <td>
                            <form action="{{ route('panier.supprimer', $id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th colspan="3">Total</th>
                    <th>{{ $total }} €</th>
                    <th></th>
                </tr>
                </tfoot>
            </table>
        @else
            <p>Votre panier est vide.</p>
        @endif
    </div>
@endsection
