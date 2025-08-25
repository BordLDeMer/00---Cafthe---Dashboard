<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    // Utiliser 'mail' comme champ de connexion
    public function username()
    {
        return 'mail';
    }

    // Surcharger la méthode credentials pour utiliser 'mdp' comme champ de mot de passe
    protected function credentials(Request $request)
    {
        return [
            'mail' => $request->mail,
            'password' => $request->mdp, // Utiliser 'mdp' comme champ de mot de passe
        ];
    }

    // Surcharger la méthode attemptLogin pour gérer la connexion
    protected function attemptLogin(Request $request)
    {
        $credentials = $this->credentials($request);

        // Debug
        $vendeur = \App\Models\Vendeur::where('mail', $credentials['mail'])->first();

        if ($vendeur) {
            Log::info('Vendeur trouvé:', ['mail' => $vendeur->mail]);

            $hashCheck = Hash::check($credentials['password'], $vendeur->mdp);
            Log::info('Hash check:', ['result' => $hashCheck]);

            if (!$hashCheck) {
                Log::warning('Mot de passe incorrect pour le vendeur:', ['mail' => $vendeur->mail]);
            }
        } else {
            Log::info('Aucun vendeur trouvé avec ce mail : ' . $credentials['mail']);
        }

        return $this->guard()->attempt($credentials, $request->filled('remember'));
    }

    // Surcharger la méthode sendFailedLoginResponse pour gérer les erreurs de connexion
    protected function sendFailedLoginResponse(Request $request)
    {
        Log::warning('Échec de la connexion pour : ' . $request->mail);
        return redirect()->back()
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors([
                $this->username() => trans('auth.failed'),
            ]);
    }
}
