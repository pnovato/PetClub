<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required','email'],
            'password' => ['required'],
        ]);

        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) 
        {
        $request->session()->regenerate();
        $redirect = $request->input('redirect');
            if ($redirect && !str_starts_with($redirect, '/')) 
            {
                $redirect = route('dashboard');
            }
            return redirect()->intended($redirect ?? route('dashboard'));
        }
        return back()->withErrors(['email' => 'Credenciais inválidas.'])->onlyInput('email');
    }

    public function destroy(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
