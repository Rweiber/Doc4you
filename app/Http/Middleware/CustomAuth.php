<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CustomAuth
{
    /**
     * Lida com uma requisição de entrada.
     * Verifica a autenticação do usuário como médico ou paciente.
     * Redireciona para o login se não estiver autenticado.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        Log::info('Verificando autenticação do usuário.');

        if (Auth::guard('medicos')->check()) {
            Log::info('Médico autenticado: ' . Auth::guard('medicos')->user()->email);
            return $next($request);
        }

        if (Auth::guard('pacientes')->check()) {
            Log::info('Paciente autenticado: ' . Auth::guard('pacientes')->user()->email);
            return $next($request);
        }

        Log::warning('Usuário não autenticado, redirecionando para a página de login.');
        return redirect()->route('login')->withErrors(['Você precisa estar logado para acessar essa página.']);
    }

}
