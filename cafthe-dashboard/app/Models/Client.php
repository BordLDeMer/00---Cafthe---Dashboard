<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $table = 'client';
    protected $primaryKey = 'ID_client';
    protected $fillable = ['nom_prenom', 'tel', 'mail', 'mdp'];
}

