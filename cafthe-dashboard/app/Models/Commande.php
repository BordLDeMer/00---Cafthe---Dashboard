<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;

    protected $table = 'commande';
    protected $primaryKey = 'ID_commande';

    public $timestamps = false; // Désactive les timestamps si nécessaire

    protected $fillable = [
        'ID_client',
        'montant_commande',
        'statut',
        'date_prise_commande',
        'NB_ligne_cmd',
        'ID_commande',
        'ID_Vendeur',
    ];

    // Relation avec le modèle Client
    public function client()
    {
        return $this->belongsTo(Client::class, 'ID_client');
    }

    // Relation avec les produits
    public function produits()
    {
        return $this->belongsToMany(
            Produit::class,
            'commande_produit',
            'commande_id',
            'produit_id'
        )->withPivot('quantite', 'prix_unitaire')
            ->withTimestamps();
    }
}
