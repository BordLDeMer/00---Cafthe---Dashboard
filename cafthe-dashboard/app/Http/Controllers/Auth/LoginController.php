<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Vendeur;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    use AuthenticatesUsers;

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

    protected function validateLogin(Request $request)
    {
        $request->validate([
            'mail' => 'required|string|email|exists:vendeur,mail|max:255',
            'mdp' => 'required|string|max:255',
        ]);
    }

    protected function credentials(Request $request)
    {
        return [
            'mail' => $request->input('mail'),
            'password' => $request->input('mdp'),
        ];
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        // First, try the standard (hashed) authentication
        if ($this->attemptLogin($request)) {
            if ($request->hasSession()) {
                $request->session()->put('auth.password_confirmed_at', time());
            }
            return $this->sendLoginResponse($request);
        }

        // Fallbacks: handle various storage cases (hashed, legacy plain-text)
        $user = Vendeur::where('mail', $request->input('mail'))->first();
        if ($user) {
            $inputPassword = (string) $request->input('mdp');
            $stored = (string) $user->mdp;

            // Case 1: stored is a hash compatible with Hash::check but attempt failed (be defensive)
            if (!empty($stored) && Hash::check($inputPassword, $stored)) {
                $this->guard()->login($user, $request->filled('remember'));
                if ($request->hasSession()) {
                    $request->session()->put('auth.password_confirmed_at', time());
                }
                return $this->sendLoginResponse($request);
            }

            // Case 2: legacy plain-text stored password -> migrate to hashed on-the-fly
            if ($stored !== '' && hash_equals($stored, $inputPassword)) {
                $user->mdp = Hash::make($inputPassword);
                $user->save();
                $this->guard()->login($user, $request->filled('remember'));
                if ($request->hasSession()) {
                    $request->session()->put('auth.password_confirmed_at', time());
                }
                return $this->sendLoginResponse($request);
            }
        }

        return $this->sendFailedLoginResponse($request);
    }

    protected function attemptLogin(Request $request)
    {
        return $this->guard()->attempt(
            $this->credentials($request),
            $request->filled('remember')
        );
    }
}
