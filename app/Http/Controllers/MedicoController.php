<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Consulta;
use App\Models\Medico;
use App\Models\Especialidade;

class MedicoController extends Controller
{
    /**
     * Exibe o dashboard do médico com suas consultas.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Obtém o médico logado
        $medico = Auth::guard('medicos')->user();

        // Captura todas as consultas agendadas para o médico
        $consultas = Consulta::where('medico_id', $medico->id)
                ->with(['paciente', 'paciente.telefones']) // Carregar o paciente e seus telefones
                ->get();

        // Retorna a view com os dados necessários
        return view('medico.dashboard', [
            'medico' => $medico,
            'consultas' => $consultas,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Exibe o formulário para editar os dados do médico.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $medico = Medico::findOrFail($id);
        $especialidades = Especialidade::all(); // Obtém todas as especialidades

        return view('medico.edit', compact('medico', 'especialidades'));
    }

    /**
     * Atualiza os dados do médico no banco de dados.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $medico = Medico::findOrFail($id);

        // Validação dos dados de entrada
        $validatedData = $request->validate([
            'nome' => 'nullable|string|max:255', // Agora é opcional
            'email' => 'nullable|email|unique:medicos,email,' . $medico->id,
            'especialidade_id' => 'nullable|exists:especialidades,id',
            'crm' => 'nullable|string|unique:medicos,crm,' . $medico->id,
            'senha' => 'nullable|string|min:8', // Agora é opcional
        ]);

        // Atualizar os dados do médico apenas se o campo não estiver vazio
        if (!empty($validatedData['nome'])) {
            $medico->nome = $validatedData['nome'];
        }

        if (!empty($validatedData['email'])) {
            $medico->email = $validatedData['email'];
        }

        if (!empty($validatedData['especialidade_id'])) {
            $medico->especialidade_id = $validatedData['especialidade_id'];
        }

        if (!empty($validatedData['crm'])) {
            $medico->crm = $validatedData['crm'];
        }

        // Se a senha for fornecida, atualize-a
        if (!empty($validatedData['senha'])) {
            $medico->senha = bcrypt($validatedData['senha']); // Hash a senha
        }

        // Salvar as alterações
        $medico->save();

        return redirect()->route('medico.dashboard')->with('success', 'Dados atualizados com sucesso.');
    }


    /**
     * Remove o médico do banco de dados.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $medico = Medico::findOrFail($id);
        $medico->delete();

        return redirect('/')->with('success', 'Conta excluída com sucesso.');
    }
}
