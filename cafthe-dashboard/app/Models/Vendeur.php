<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Vendeur extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'vendeur';
    protected $primaryKey = 'ID_Vendeur';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'nom_prenom',
        'tel',
        'mail',
        'mdp',
    ];

    protected $hidden = [
        'mdp',
        'remember_token',
    ];

    public function getAuthIdentifierName()
    {
        return 'mail';
    }

    public function getAuthPassword()
    {
        return $this->mdp;
    }
}
