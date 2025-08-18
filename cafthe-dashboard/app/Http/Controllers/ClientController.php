<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
{
    /**
     * Affiche la liste des clients.
     */
    public function gestion()
    {
        $clients = Client::all();
        return view('clients.gestion', compact('clients'));
    }

    /**
     * Stocke un nouveau client.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom_prenom' => 'required|string|max:255',
            'tel' => 'required|string|max:20',
            'mail' => 'required|email|unique:client,mail',
            'mdp' => 'required|string|min:8',
        ]);

        $client = Client::create($validated);

        return redirect()->route('clients.gestion')
            ->with('success', 'Client créé avec succès !');
    }

    /**
     * Met à jour un client existant.
     */
    public function update(Request $request, $ID_client)
    {
        $validated = $request->validate([
            'nom_prenom' => 'sometimes|string|max:255',
            'tel' => 'sometimes|string|max:20',
            'mail' => 'sometimes|email|unique:client,mail,'.$ID_client.',ID_client',
            'mdp' => 'sometimes|string|min:8',
        ]);

        $client = Client::findOrFail($ID_client);
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
     * Recherche des clients.
     */
    public function search(Request $request)
    {
        $query = $request->input('query');
        $clients = Client::where('nom_prenom', 'like', "%{$query}%")
            ->orWhere('mail', 'like', "%{$query}%")
            ->get();

        return view('clients.search', compact('clients', 'query'));
    }
}
