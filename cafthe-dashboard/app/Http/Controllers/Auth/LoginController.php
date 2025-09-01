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

        // Fallback: handle legacy plain-text passwords by migrating them to hashed
        $user = Vendeur::where('mail', $request->input('mail'))->first();
        if ($user) {
            $inputPassword = (string) $request->input('mdp');

            // If the stored password is not a valid hash and matches plain-text input
            $stored = (string) $user->mdp;
            $looksHashed = preg_match('/^\$2y\$\d{2}\$.{53}$/', $stored) === 1; // bcrypt format

            if (!$looksHashed && hash_equals($stored, $inputPassword)) {
                // Rehash and login the user seamlessly
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
