<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Commande;
use Illuminate\Http\Request;

class CommandeController extends Controller
{
    public function commandesParClient($id_client)
    {
        // Récupère les commandes pour le client donné, triées par date_prise_commande
        $commandes = Commande::where('ID_client', $id_client)
            ->orderBy('date_prise_commande', 'desc')
            ->get();

        // Récupère les informations du client
        $client = Client::findOrFail($id_client);

        // Passe les commandes et le client à la vue
        return view('commandes.par_client', compact('commandes', 'client'));
    }

    public function details($id_commande)
    {
        // Récupère les détails de la commande
        $commande = Commande::with('produits')->findOrFail($id_commande);

        // Passe la commande à la vue des détails
        return view('commandes.details', compact('commande'));
    }
}
