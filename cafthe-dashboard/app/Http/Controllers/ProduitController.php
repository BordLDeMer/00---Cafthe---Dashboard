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

    public function create()
    {
        // Optionally pass types for a select, reusing distinct types
        $typesProduits = Produit::select('type_produit')->distinct()->pluck('type_produit');
        return view('produits.create', compact('typesProduits'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'type_produit' => 'nullable|string|max:255',
            'designation_produit' => 'required|string|max:255',
            'prix_ttc' => 'required|numeric|min:0',
            'ID_rayon' => 'nullable|integer',
            'solde' => 'required|in:0,1',
            'stock' => 'required|integer|min:0',
        ], [
            'solde.in' => 'Le champ solde doit être vrai ou faux.',
        ]);

        // Normalize checkbox value ("0" or "1") to boolean
        $data['solde'] = $request->input('solde') === '1';

        Produit::create($data);

        return redirect()->route('produits.index')->with('success', 'Produit ajouté avec succès.');
    }
}
