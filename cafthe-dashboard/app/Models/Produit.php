<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    protected $table = 'produit';
    /**
     * Récupère le produit avec le plus gros chiffre de vente.
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    public static function MeilleureVente()
    {
        return self::orderBy('vente', 'desc')->firstOrFail();
    }

    /**
     * Récupère le produit avec le plus petit chiffre de vente.
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    public static function MauvaiseVente()
    {
        return self::orderBy('vente', 'asc')->firstOrFail();
    }

}
