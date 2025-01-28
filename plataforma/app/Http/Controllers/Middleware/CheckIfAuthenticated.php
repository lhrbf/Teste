<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckIfAuthenticated
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            // Redireciona para a rota que exibe o gráfico, por exemplo.
            return redirect()->route('grafico');  // Usando a rota nomeada
        }

        return $next($request);
    }
}