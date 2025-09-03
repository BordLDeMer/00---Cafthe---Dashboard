<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Client;
use Illuminate\Http\Request;

class CommandeController extends Controller
{
    public function commandesParClient($id_client)
    {
        // Récupère les commandes pour le client donné
        $commandes = Commande::where('ID_client', $id_client)
            ->orderBy('ID_commande', 'desc')
            ->get();

        // Récupère les informations du client
        $client = Client::findOrFail($id_client);

        // Passe les commandes et le client à la vue
        return view('commandes.par_client', compact('commandes', 'client'));
    }
    public function details(Commande $commande)
    {
        return view('commandes.details', compact('commande'));
    }

}
