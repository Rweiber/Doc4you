<?php

namespace App\Http\Controllers;

use App\Models\Especialidade;
use App\Models\Medico;
use App\Models\Paciente;
use App\Rules\Cpf;
use Illuminate\Http\Request;

class RegistroController extends Controller
{
    // Exibe o formulário de registro
    public function showForm()
    {
        $especialidades = Especialidade::all(); // Carregar especialidades para o formulário
        return view('auth.register', compact('especialidades'));
    }

    // Processa o registro do formulário
    public function registrar(Request $request)
    {
        
        $validatedData = $request->validate([
            'tipo' => 'required|in:medico,paciente',
            'nome' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'senha' => 'required|string|min:8',
            'cpf' => ['required_if:tipo,paciente|unique:pacientes,cpf', new Cpf], 
            'cep' => 'required_if:tipo,paciente|string|max:9',
            'endereco' => 'required_if:tipo,paciente|string|max:255',
            'bairro' => 'required_if:tipo,paciente|string|max:255',
            'cidade' => 'required_if:tipo,paciente|string|max:255',
            'uf' => 'required_if:tipo,paciente|string|max:10',
            'numero' => 'required_if:tipo,paciente|string|max:10',
            'data_nascimento' => 'required_if:tipo,paciente|date',
            'responsavel_nome' => 'nullable|string|max:255',
            'responsavel_cpf' => ['nullable', new Cpf],
            'crm' => 'required_if:tipo,medico|unique:medicos,crm',
            'especialidade_id' => 'required_if:tipo,medico|exists:especialidades,id'
        ]);
        

        // Salvamento do médico ou paciente com base no tipo
        if ($request->tipo === 'medico') {
            Medico::create([
                'nome' => $request->nome,
                'crm' => $request->crm,
                'email' => $request->email,
                'senha' => bcrypt($request->senha),
                'especialidade_id' => $request->especialidade_id
            ]);
        } elseif ($request->tipo === 'paciente') {
            Paciente::create([
                'nome' => $request->nome,
                'email' => $request->email,
                'senha' => bcrypt($request->senha),
                'cpf' => $request->cpf,
                'cep' => $request->cep,
                'endereco' => $request->endereco,
                'numero' => $request->numero,
                'bairro' => $request->bairro,
                'cidade' => $request->cidade,
                'uf' => $request->uf,
                'data_nascimento' => $request->data_nascimento,
                'responsavel_nome' => $request->responsavel_nome,
                'responsavel_cpf' => $request->responsavel_cpf,
            ]);
            
        }

        // Redireciona com mensagem de sucesso
        return redirect('/')->with('success', 'Registro realizado com sucesso!');
    }
}

