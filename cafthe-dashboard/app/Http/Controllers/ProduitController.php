<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use Illuminate\Http\Request;

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
        $typesProduits = Produit::select('type_produit')->distinct()->pluck('type_produit');

        return view('produits.index', compact('produits', 'typesProduits'));
    }
}
