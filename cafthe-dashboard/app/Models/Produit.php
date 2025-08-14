<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Produit extends Model
{
    protected $table = 'produit';

    /**
     * Calcule le chiffre d'affaires du mois en cours à partir des ventes.
     */
    public static function chiffreAffairesMois()
    {
        $debutMois = now()->startOfMonth()->toDateString();
        $finMois = now()->endOfMonth()->toDateString();

        // Calcule la somme de (prix_ttc * ventes) pour le mois en cours
        $total = self::whereBetween('date_vente', [$debutMois, $finMois])
            ->sum(DB::raw('prix_ttc * ventes'));

        return [
            'total' => $total ?? 0,
        ];
    }

    /**
     * Récupère le produit avec le plus gros chiffre de vente.
     */
    public static function MeilleureVente()
    {
        return self::orderBy('ventes', 'desc')->first(); // Utilise 'ventes' et non 'vente'
    }

    /**
     * Récupère le produit avec le plus petit chiffre de vente.
     */
    public static function MauvaiseVente()
    {
        return self::orderBy('ventes', 'asc')->first(); // Utilise 'ventes' et non 'vente'
    }
}
