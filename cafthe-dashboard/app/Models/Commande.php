<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;

    protected $table = 'commande'; // Nom de la table
    protected $primaryKey = 'ID_commande'; // Clé primaire personnalisée

    protected $fillable = [
        'ID_client',
        'montant_total',
        'statut',
    ];

    // Relation avec le modèle Client
    public function client()
    {
        return $this->belongsTo(Client::class, 'ID_client');
    }

    // Relation avec les produits (si nécessaire)
    public function produits()
    {
        return $this->belongsToMany(
            Produit::class,
            'commande_produit',
            'commande_id', // Clé étrangère dans la table pivot
            'produit_id'
        )->withPivot('quantite', 'prix_unitaire')
            ->withTimestamps();
    }
}
