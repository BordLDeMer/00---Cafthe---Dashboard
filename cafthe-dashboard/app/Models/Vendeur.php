<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendeur extends Model
{
    use HasFactory;

    protected $table = 'vendeur';
    protected $primaryKey = 'ID_Vendeur';
    public $timestamps = false;

    protected $fillable = [
        'nom_prenom',
        'tel',
        'mail',
        'mdp',
    ];

    protected $hidden = [
        'mdp',
    ];

    public function getRouteKeyName()
    {
        return 'ID_Vendeur';
    }
}
