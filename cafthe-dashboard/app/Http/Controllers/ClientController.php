<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
{
    /**
     * Affiche la page de gestion des clients.
     */
    public function gestion()
    {
        $clients = Client::orderBy('ID_client', 'desc')->get(); // Tri par ID décroissant
        return view('clients.gestion', compact('clients'));
    }

    /**
     * Enregistre un nouveau client.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom_prenom' => 'required|string|max:255',
            'tel' => 'nullable|string|max:20',
            'mail' => 'required|email|unique:clients,mail',
            'mdp' => 'required|string|min:6',
        ]);

        $validated['mdp'] = Hash::make($request->mdp); // Utilise Hash au lieu de bcrypt

        Client::create($validated);
        return redirect()->route('clients.gestion')
            ->with('success', 'Client ajouté avec succès !');
    }

    /**
     * Met à jour un client.
     */
    public function update(Request $request, $ID_client)
    {
        $client = Client::findOrFail($ID_client);

        $validated = $request->validate([
            'nom_prenom' => 'required|string|max:255',
            'tel' => 'nullable|string|max:20',
            'mail' => 'required|email|unique:clients,mail,'.$ID_client.',ID_client',
            'mdp' => 'nullable|string|min:6',
        ]);

        if ($request->filled('mdp')) {
            $validated['mdp'] = Hash::make($request->mdp);
        } else {
            unset($validated['mdp']); // Supprime le champ mdp si vide
        }

        $client->update($validated);
        return redirect()->route('clients.gestion')
            ->with('success', 'Client mis à jour avec succès !');
    }

    /**
     * Supprime un client.
     */
    public function destroy($ID_client)
    {
        $client = Client::findOrFail($ID_client);
        $client->delete();
        return redirect()->route('clients.gestion')
            ->with('success', 'Client supprimé avec succès !');
    }

    /**
     * Recherche des clients (AJAX).
     */
    public function search(Request $request)
    {
        $searchTerm = $request->input('q', ''); // Valeur par défaut si 'q' n'existe pas

        $clients = Client::where('nom_prenom', 'LIKE', "%{$searchTerm}%")
            ->orWhere('mail', 'LIKE', "%{$searchTerm}%")
            ->orWhere('tel', 'LIKE', "%{$searchTerm}%")
            ->orderBy('ID_client', 'desc')
            ->get(['ID_client', 'nom_prenom', 'tel', 'mail']); // Sélectionne seulement les champs nécessaires

        return response()->json($clients);
    }


}
