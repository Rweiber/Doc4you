<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Paciente;
    

class PacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paciente = Auth::guard('pacientes')->user();
        $consultas = $paciente->consultas()->orderBy('data_consulta', 'asc') ->orderBy('hora_consulta', 'asc')->get(); // Busca as consultas do paciente

        return view('paciente.dashboard', compact('paciente', 'consultas'));
    }

    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $paciente = Paciente::findOrFail($id);
        return view('paciente.edit', compact('paciente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $paciente = Paciente::findOrFail($id);

    // Validação dos dados de entrada (sem required nos campos opcionais)
    $validatedData = $request->validate([
        'nome' => 'nullable|string|max:255',
        'cpf' => 'nullable|string|max:255',
        'email' => 'nullable|email',
        'senha' => 'nullable|string|min:8',
        'cep' => 'nullable|string|max:10',
        'endereco' => 'nullable|string|max:255',
        'bairro' => 'nullable|string|max:255',
        'cidade' => 'nullable|string|max:255',
        'uf' => 'nullable|string|max:2',
        'numero' => 'nullable|string|max:20',
        'data_nascimento' => 'nullable|date',
        'responsavel_nome' => 'nullable|string|max:255',
        'responsavel_cpf' => 'nullable|string|max:255',
    ]);

    // Atualizar somente os campos preenchidos
    if (!empty($validatedData['nome'])) {
        $paciente->nome = $validatedData['nome'];
    }
    if (!empty($validatedData['cpf'])) {
        $paciente->cpf = $validatedData['cpf'];
    }
    if (!empty($validatedData['email'])) {
        $paciente->email = $validatedData['email'];
    }
    if (!empty($validatedData['senha'])) {
        $paciente->senha = bcrypt($validatedData['senha']);
    }
    if (!empty($validatedData['cep'])) {
        $paciente->cep = $validatedData['cep'];
    }
    if (!empty($validatedData['endereco'])) {
        $paciente->endereco = $validatedData['endereco'];
    }
    if (!empty($validatedData['bairro'])) {
        $paciente->bairro = $validatedData['bairro'];
    }
    if (!empty($validatedData['cidade'])) {
        $paciente->cidade = $validatedData['cidade'];
    }
    if (!empty($validatedData['uf'])) {
        $paciente->uf = $validatedData['uf'];
    }
    if (!empty($validatedData['numero'])) {
        $paciente->numero = $validatedData['numero'];
    }
    if (!empty($validatedData['data_nascimento'])) {
        $paciente->data_nascimento = $validatedData['data_nascimento'];
    }
    if (!empty($validatedData['responsavel_nome'])) {
        $paciente->responsavel_nome = $validatedData['responsavel_nome'];
    }
    if (!empty($validatedData['responsavel_cpf'])) {
        $paciente->responsavel_cpf = $validatedData['responsavel_cpf'];
    }

    // Salvar as alterações
    $paciente->save();

    return redirect()->route('paciente.dashboard')->with('success', 'Dados atualizados com sucesso.');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $paciente = Paciente::findOrFail($id);
        $paciente->delete();

        return redirect('/')->with('success', 'Conta excluída com sucesso.');
    }
}
