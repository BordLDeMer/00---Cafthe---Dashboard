<?php
namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Controllers\BaseController;

class ClientController extends BaseController
{
    public function index()
    {
        $clients = Client::paginate(10); // Charge 10 clients par page
        return view('clients.index', compact('clients'));
    }

    public function create()
    {
        return view('clients.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom_prenom' => 'required|string|max:255',
            'tel' => 'required|string|max:20',
            'mail' => 'required|email|unique:client,mail',
            'mdp' => 'required|string|min:8',
        ]);

        Client::create([
            'nom_prenom' => $request->nom_prenom,
            'tel' => $request->tel,
            'mail' => $request->mail,
            'mdp' => bcrypt($request->mdp),
        ]);

        return redirect()->route('clients.index')->with('success', 'Client créé avec succès.');
    }

    public function show(Client $client)
    {
        return view('clients.show', compact('client'));
    }

    public function edit(Client $client)
    {
        return view('clients.edit', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        $request->validate([
            'nom_prenom' => 'required|string|max:255',
            'tel' => 'required|string|max:20',
            'mail' => 'required|email|unique:client,mail,'.$client->ID_client.',ID_client',
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

        $client->update($data);

        return redirect()->route('clients.index')->with('success', 'Client mis à jour avec succès.');
    }

    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('clients.index')->with('success', 'Client supprimé avec succès.');
    }
}
