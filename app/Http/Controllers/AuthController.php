<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Show login form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Handle login logic
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'mot_de_passe' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->mot_de_passe, $user->mot_de_passe)) {
            Auth::login($user);
            return redirect()->intended('/dashboard'); // or wherever you want to redirect
        }

        return back()->withErrors([
            'email' => 'Identifiants invalides.',
        ])->onlyInput('email');
    }


    public function logout(Request $request)
    {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/');
    }




    public function showRegisterForm()
{
    return view('auth.register');
}

public function register(Request $request)
{
    $request->validate([
        'nom' => 'required|string|max:255',
        'email' => 'required|email|unique:utilisateurs,email',
        'mot_de_passe' => 'required|string|min:6|confirmed',
    ]);

    $user = User::create([
        'nom' => $request->nom,
        'email' => $request->email,
        'mot_de_passe' => bcrypt($request->mot_de_passe),
        'role' => 'utilisateur' // or default role
    ]);

    Auth::login($user);

    return redirect('/dashboard');
}

}