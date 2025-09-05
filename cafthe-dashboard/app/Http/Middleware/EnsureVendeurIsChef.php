<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureVendeurIsChef
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::guard('vendeur')->user();

        // Rediriger vers la page de connexion si l'utilisateur n'est pas authentifié
        if (!$user) {
            return redirect()->route('login');
        }

        // Vérifier si l'utilisateur est un chef
        $isChef = $this->isChef($user);

        if (!$isChef) {
            // Option 1: Retourner une erreur 403
            abort(403, 'Accès réservé aux chefs vendeurs.');

            // Option 2: Rediriger avec un message d'erreur
            // return redirect()->back()->with('error', 'Accès réservé aux chefs vendeurs.');
        }

        return $next($request);
    }

    /**
     * Vérifie si l'utilisateur est un chef.
     *
     * @param mixed $user
     * @return bool
     */
    protected function isChef($user): bool
    {
        // Liste des clés possibles pour le statut de chef
        $possibleKeys = ['Chef', 'chef', 'is_chef'];

        foreach ($possibleKeys as $key) {
            if (isset($user->$key)) {
                $value = $user->$key;

                // Vérifier les différentes formes possibles de la valeur
                if (is_string($value)) {
                    return in_array(strtolower(trim($value)), ['oui', 'yes', '1']);
                } elseif (is_bool($value)) {
                    return $value === true;
                } elseif (is_numeric($value)) {
                    return (int)$value === 1;
                }
            }
        }

        return false;
    }
}
