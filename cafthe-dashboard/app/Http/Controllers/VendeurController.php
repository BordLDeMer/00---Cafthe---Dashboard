<?php
namespace App\Http\Controllers;

use App\Models\Vendeur;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Controllers\BaseController;

class VendeurController extends BaseController
{
    public function index()
    {
        $vendeurs = Vendeur::paginate(10);
        return view('vendeurs.index', compact('vendeurs'));
    }

    public function create()
    {
        return view('vendeurs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom_prenom' => 'required|string|max:255',
            'tel' => 'required|string|max:20',
            'mail' => 'required|email|unique:vendeur,mail',
            'mdp' => 'required|string|min:8',
        ]);

        Vendeur::create([
            'nom_prenom' => $request->nom_prenom,
            'tel' => $request->tel,
            'mail' => $request->mail,
            'mdp' => bcrypt($request->mdp),
        ]);

        return redirect()->route('vendeurs.index')->with('success', 'Vendeur créé avec succès.');
    }

    public function show(Vendeur $vendeur)
    {
        return view('vendeurs.show', compact('vendeur'));
    }

    public function edit(Vendeur $vendeur)
    {
        return view('vendeurs.edit', compact('vendeur'));
    }

    public function update(Request $request, Vendeur $vendeur)
    {
        $request->validate([
            'nom_prenom' => 'required|string|max:255',
            'tel' => 'required|string|max:20',
            'mail' => 'required|email|unique:vendeur,mail,' . $vendeur->ID_vendeur . ',ID_vendeur',
            'mdp' => 'nullable|string|min:8',
        ]);

        $data = [
            'nom_prenom' => $request->nom_prenom,
            'tel' => $request->tel,
            'mail' => $request->mail,
        ];

        if ($request->filled('mdp')) {
            $data['mdp'] = bcrypt($request->mdp);
        }

        $vendeur->update($data);

        return redirect()->route('vendeurs.index')->with('success', 'Vendeur mis à jour avec succès.');
    }

    public function destroy(Vendeur $vendeur)
    {
        $vendeur->delete();
        return redirect()->route('vendeurs.index')->with('success', 'Vendeur supprimé avec succès.');
    }
}
