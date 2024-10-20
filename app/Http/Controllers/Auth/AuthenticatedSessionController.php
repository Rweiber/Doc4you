<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\Medico;
use App\Models\Paciente;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email',
            'senha' => 'required|string',
        ]);

        // Verifica se é um médico ou paciente
        $medico = Medico::where('email', $validatedData['email'])->first();
        $paciente = Paciente::where('email', $validatedData['email'])->first();

        if ($medico && Hash::check($validatedData['senha'], $medico->senha)) {
            
            Log::info('Médico logado: ' . $medico->email);
            // Loga como médico
            Auth::guard('medicos')->login($medico); // Loga o médico
            return redirect()->route('medico.dashboard'); // Redireciona para a página desejada
        } elseif ($paciente && Hash::check($validatedData['senha'], $paciente->senha)) {
            
            Log::info('Paciente logado: ' . $paciente->email);
            // Loga como paciente
            Auth::guard('pacientes')->login($paciente); // Loga o paciente
            return redirect()->route('paciente.dashboard'); // Redireciona para a página desejada
        } else {
            Log::warning('Tentativa de login falhou para o e-mail: ' . $validatedData['email']);
            return back()->withErrors(['email' => 'Credenciais inválidas.']);
        }
    }


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('medicos')->logout(); // Para médicos
        Auth::guard('pacientes')->logout(); // Para pacientes

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
