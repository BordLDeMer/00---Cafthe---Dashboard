<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Produit extends Model
{
    protected $table = 'produit';

    /**
     * Calcule la balance mensuelle (différence entre le CA du mois en cours et celui du mois précédent).
     */
    public static function balanceMensuelle()
    {
        // Chiffre d'affaires du mois en cours
        $caMoisEnCours = self::chiffreAffairesMois()['total'];

        // Chiffre d'affaires du mois précédent
        $debutMoisPrecedent = now()->subMonth()->startOfMonth()->toDateString();
        $finMoisPrecedent = now()->subMonth()->endOfMonth()->toDateString();
        $caMoisPrecedent = self::whereBetween('date_vente', [$debutMoisPrecedent, $finMoisPrecedent])
            ->sum(DB::raw('prix_ttc * ventes'));

        // Calcul de la balance
        $balance = $caMoisEnCours - $caMoisPrecedent;

        return [
            'balance' => $balance,
            'ca_mois_en_cours' => $caMoisEnCours,
            'ca_mois_precedent' => $caMoisPrecedent ?? 0,
        ];
    }

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

    /**
     * Récupère les types de produits uniques pour les filtres.
     */
    public static function getTypesProduits()
    {
        return self::select('type_produit')->distinct()->pluck('type_produit');
    }
}
