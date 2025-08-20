<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendeur extends Model
{
    use HasFactory;

    protected $table = 'vendeur';
    protected $username = 'mail';
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
    public function findForPassport($username)
    {
        return $this->where('mail', $username)->first();  // Use your actual column name
    }
}
