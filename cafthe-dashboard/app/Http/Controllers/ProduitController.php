<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProduitController extends Controller
{
    public function index(Request $request)
    {
        $query = Produit::query();

        // Filtres
        if ($request->filled('solde')) {
            $query->where('solde', $request->solde);
        }

        if ($request->filled('type_produit')) {
            $query->where('type_produit', $request->type_produit);
        }

        if ($request->filled('prix_max')) {
            $query->where('prix_ttc', '<=', $request->prix_max);
        }

        $produits = $query->get();

        return view('produits.index', compact('produits'));
    }

    public function ajouterAuPanier($id)
    {
        $produit = Produit::findOrFail($id);

        $panier = Session::get('panier', []);

        if (isset($panier[$id])) {
            $panier[$id]['quantite']++;
        } else {
            $panier[$id] = [
                "ID_produit" => $produit->ID_produit,
                "designation_produit" => $produit->designation_produit,
                "prix_ttc" => $produit->prix_ttc,
                "quantite" => 1
            ];
        }

        Session::put('panier', $panier);

        return redirect()->back()->with('success', 'produits ajouté au panier avec succès!');
    }

    public function voirPanier()
    {
        return view('panier.index');
    }

    public function supprimerDuPanier($id)
    {
        $panier = Session::get('panier');

        if (isset($panier[$id])) {
            unset($panier[$id]);
            Session::put('panier', $panier);
        }

        return redirect()->back()->with('success', 'produits supprimé du panier avec succès!');
    }
}
