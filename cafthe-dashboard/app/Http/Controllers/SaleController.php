<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vente; // Remplace par ton modèle réel (par exemple, Commande, Transaction, etc.)

class VenteController extends Controller
{
    public function chiffreAffairesMois()
    {
        // Récupère le premier et le dernier jour du mois en cours
        $debutMois = now()->startOfMonth()->toDateString();
        $finMois = now()->endOfMonth()->toDateString();

        // Récupère la somme des ventes pour le mois en cours
        $total = Vente::whereBetween('created_at', [$debutMois, $finMois])
            ->sum('montant'); // Remplace 'montant' par le champ qui contient le montant de la vente

        return response()->json([
            'total' => $total,
        ]);
    }
}
