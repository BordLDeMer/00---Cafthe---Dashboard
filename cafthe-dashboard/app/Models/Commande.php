<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Commande extends Model
{
    use HasFactory;

    protected $table = 'commande';
    protected $primaryKey = 'ID_commande';

    protected $fillable = [
        'ID_client',
        'montant_commande',
        'statut',
        'date_prise_commande',
    ];

    protected $dates = [
        'date_prise_commande',
        'created_at',
        'updated_at',
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

    // Accessor pour s'assurer que date_prise_commande est un objet Carbon
    public function getDatePriseCommandeAttribute($value)
    {
        return $value ? Carbon::parse($value) : null;
    }
}
