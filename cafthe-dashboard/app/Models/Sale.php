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
        $total = produit::whereBetween('date_vente', [$debutMois, $finMois])
            ->sum('prix_ttc');

        return ([
            'total' => $total,
        ]);
    }
}
