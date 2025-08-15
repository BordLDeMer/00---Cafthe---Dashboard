<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable; // Pour les notifications (optionnel)

class Client extends Authenticatable // Utilise Authenticatable pour l'authentification
{
    use Notifiable; // Permet d'envoyer des notifications (ex: réinitialisation de mot de passe)

    /**
     * Nom de la table associée.
     */
    protected $table = 'client';

    /**
     * Clé primaire personnalisée.
     */
    protected $primaryKey = 'ID_client';

    /**
     * Champs remplissables en masse.
     */
    protected $fillable = [
        'nom_prenom',
        'tel',
        'mail',
        'password', // Utilisez 'password' au lieu de 'mdp' pour la compatibilité avec Auth
    ];

    /**
     * Champs cachés (ne seront pas sérialisés dans les réponses JSON).
     */
    protected $hidden = [
        'password', // Masque le mot de passe
        'remember_token', // Si vous utilisez l'authentification
    ];

    /**
     * Mutateur pour hacher automatiquement le mot de passe.
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    /**
     * Accesseur pour le nom complet (optionnel).
     */
    public function getNomCompletAttribute()
    {
        return $this->nom_prenom;
    }

    /**
     * Relation avec d'autres modèles (exemple : commandes).
     */
    public function commandes()
    {
        return $this->hasMany(Commande::class, 'ID_client', 'ID_client');
    }
}
