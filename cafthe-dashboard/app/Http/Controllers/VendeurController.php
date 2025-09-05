<?php

namespace App\Http\Controllers;

use App\Models\Vendeur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class VendeurController extends Controller
{
    /**
     * Affiche la liste des vendeurs (réservé aux chefs).
     */
    public function index()
    {
        $vendeurs = Vendeur::paginate(15);
        return view('vendeurs.index', compact('vendeurs'));
    }

    /**
     * Affiche le formulaire de création d'un nouveau vendeur (réservé aux chefs).
     */
    public function create()
    {
        return view('vendeurs.create');
    }

    /**
     * Enregistre un nouveau vendeur (réservé aux chefs).
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom_prenom' => 'required|string|max:255',
            'mail' => 'required|email|unique:vendeur,mail',
            'tel' => 'nullable|string|max:20',
            'mdp' => 'required|string|min:6',
        ]);
        $data = $validated;
        $data['mdp'] = Hash::make($validated['mdp']);
        Vendeur::create($data);
        return redirect()
            ->route('vendeurs.index')
            ->with('success', 'Vendeur créé avec succès.');
    }

    /**
     * Affiche les détails d'un vendeur (réservé aux chefs).
     */
    public function show(Vendeur $vendeur)
    {
        return view('vendeurs.show', compact('vendeur'));
    }

    /**
     * Affiche le formulaire d'édition d'un vendeur (réservé aux chefs).
     */
    public function edit(Vendeur $vendeur)
    {
        return view('vendeurs.edit', compact('vendeur'));
    }

    /**
     * Met à jour un vendeur (réservé aux chefs).
     */
    public function update(Request $request, Vendeur $vendeur)
    {
        $validated = $request->validate([
            'nom_prenom' => 'required|string|max:255',
            'mail' => 'required|email|unique:vendeur,mail,' . $vendeur->ID_Vendeur . ',ID_Vendeur',
            'tel' => 'nullable|string|max:20',
            'mdp' => 'nullable|string|min:6',
        ]);
        $data = $validated;
        if (!empty($validated['mdp'])) {
            $data['mdp'] = Hash::make($validated['mdp']);
        } else {
            unset($data['mdp']);
        }
        $vendeur->update($data);
        return redirect()
            ->route('vendeurs.index')
            ->with('success', 'Vendeur mis à jour avec succès.');
    }

    /**
     * Supprime un vendeur (réservé aux chefs).
     */
    public function destroy(Vendeur $vendeur)
    {
        $vendeur->delete();
        return redirect()
            ->route('vendeurs.index')
            ->with('success', 'Vendeur supprimé avec succès.');
    }

    /**
     * Affiche le profil du vendeur connecté.
     */
    public function monProfil()
    {
        $vendeur = Auth::guard('vendeur')->user();
        return view('vendeurs.profil', compact('vendeur'));
    }

    /**
     * Affiche le formulaire d'édition du profil du vendeur connecté.
     */
    public function editMonProfil()
    {
        $vendeur = Auth::guard('vendeur')->user();
        return view('vendeurs.edit_mon_profil', compact('vendeur'));
    }

    /**
     * Met à jour le profil du vendeur connecté.
     */
    public function mettreAJourMonProfil(Request $request)
    {
        $vendeur = Auth::guard('vendeur')->user();

        $validated = $request->validate([
            'nom_prenom' => 'required|string|max:255',
            'mail' => 'required|email|unique:vendeur,mail,' . $vendeur->ID_Vendeur . ',ID_Vendeur',
            'tel' => 'nullable|string|max:20',
            'mdp' => 'nullable|string|min:6',
        ]);

        $data = $validated;
        if (!empty($validated['mdp'])) {
            $data['mdp'] = Hash::make($validated['mdp']);
        } else {
            unset($data['mdp']);
        }

        $vendeur->update($data);

        return redirect()
            ->route('vendeurs.mon_profil')
            ->with('success', 'Profil mis à jour avec succès !');
    }
}
