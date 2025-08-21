<?php

namespace App\Http\Controllers;

use App\Models\Vendeur;
use Illuminate\Http\Request;

class VendeurController extends Controller
{
    /**
     * Display a listing of the vendeurs.
     */
    public function index()
    {
        $vendeurs = Vendeur::paginate(15);
        return view('vendeurs.index', compact('vendeurs'));
    }

    /**
     * Show the form for creating a new vendeur.
     */
    public function create()
    {
        return view('vendeurs.create');
    }

    /**
     * Store a newly created vendeur in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:vendeur,email',
            'phone' => 'nullable|string|max:20',
            // Add other validation rules as needed
        ]);

        Vendeur::create($validated);

        return redirect()->route('vendeurs.index')
            ->with('success', 'Vendeur créé avec succès.');
    }

    /**
     * Display the specified vendeur.
     */
    public function show(Vendeur $vendeur)
    {
        return view('vendeurs.show', compact('vendeur'));
    }

    /**
     * Show the form for editing the specified vendeur.
     */
    public function edit(Vendeur $vendeur)
    {
        return view('vendeurs.edit', compact('vendeur'));
    }

    /**
     * Update the specified vendeur in storage.
     */
    public function update(Request $request, Vendeur $vendeur)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:vendeur,email,' . $vendeur->id,
            'phone' => 'nullable|string|max:20',
            // Add other validation rules as needed
        ]);

        $vendeur->update($validated);

        return redirect()->route('vendeurs.index')
            ->with('success', 'Vendeur mis à jour avec succès.');
    }

    /**
     * Remove the specified vendeur from storage.
     */
    public function destroy(Vendeur $vendeur)
    {
        $vendeur->delete();

        return redirect()->route('vendeurs.index')
            ->with('success', 'Vendeur supprimé avec succès.');
    }
}
