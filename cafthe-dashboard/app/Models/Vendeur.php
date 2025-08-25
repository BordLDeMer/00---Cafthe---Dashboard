<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Vendeur extends Authenticatable
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
        'mdp', 'remember_token',
    ];

    public function getRouteKeyName()
    {
        return 'ID_Vendeur';
    }

    public function getAuthIdentifierName()
    {
        return 'mail';
    }

    // AJOUTEZ CES MÉTHODES IMPORTANTES :

    // Laravel cherche le mot de passe ici
    public function getAuthPassword()
    {
        return $this->mdp;
    }

    // Accesseur pour que Laravel trouve 'password' -> 'mdp'
    public function getPasswordAttribute()
    {
        return $this->mdp;
    }

    // Mutateur pour que Laravel écrive dans 'mdp' quand on utilise 'password'
    public function setPasswordAttribute($value)
    {
        $this->attributes['mdp'] = $value;
    }

    // Pour Passport si vous l'utilisez
    public function findForPassport($username)
    {
        return $this->where('mail', $username)->first();
    }
}
