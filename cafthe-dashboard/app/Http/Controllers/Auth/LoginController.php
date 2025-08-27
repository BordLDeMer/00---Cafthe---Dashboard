<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    // Redirection après une connexion réussie
    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest:vendeur')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    protected function guard()
    {
        return Auth::guard('vendeur');
    }

    public function username()
    {
        return 'mail';
    }

    protected function credentials(Request $request)
    {
        return [
            'mail' => $request->mail,
            'password' => $request->mdp,
        ];
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
            'mdp' => 'required|string',
        ]);
    }
}
