<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illluminate\Support\Facades\og;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        try {
            // Validação dos dados
            $credentials = $request->validate([
                'email' => 'required|email',
                'password' => 'required|min:6',
            ]);
    
            // Tentando autenticar
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                return redirect()->intended('/grafico');
            }
    
            return back()->withErrors([
                'email' => 'Email ou senha inválidos.',
            ]);
        } catch (\Exception $e) {
            return back()->withErrors(['email' => 'Erro interno, tente novamente.']);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        // Invalidando a sessão e removendo o token CSRF
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function __construct()
    {
        $this->middleware('auth')->except(['showLoginForm', 'login']); 
    }
}
