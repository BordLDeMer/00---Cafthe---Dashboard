<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    public function __construct()
    {
        $this->middleware('guest');
    }

    // Spécifier que le champ d'email est 'mail'
    public function username()
    {
        return 'mail';
    }

    // Override pour utiliser 'mail' au lieu de 'email'
    protected function credentials(Request $request)
    {
        return $request->only('mail');
    }
    protected function guard()
    {
        return Auth::guard('vendeur');
    }

}
