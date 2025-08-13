<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
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
