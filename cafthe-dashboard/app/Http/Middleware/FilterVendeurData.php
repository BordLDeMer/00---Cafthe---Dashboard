<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class FilterVendeurData
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::guard('vendeur')->user();
        // Si l'utilisateur est un vendeur non-chef, ajouter un filtre pour ses données
        if ($user && !$this->isChef($user)) {
            // Ajouter un paramètre à la requête pour filtrer les données
            $request->merge(['vendeur_id' => $user->id]);
        }
        return $next($request);
    }
    protected function isChef($user): bool
    {
        $possibleKeys = ['Chef', 'chef', 'is_chef'];
        foreach ($possibleKeys as $key) {
            if (isset($user->$key)) {
                $value = $user->$key;
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
