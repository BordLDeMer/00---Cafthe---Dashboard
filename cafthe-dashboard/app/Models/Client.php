<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $table = 'client';
    protected $primaryKey = 'ID_client';
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
        return 'ID_client';
    }
}
