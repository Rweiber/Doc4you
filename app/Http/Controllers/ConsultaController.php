<?php

namespace App\Http\Controllers;
use App\Models\Medico;
use App\Models\Especialidade;
use App\Models\Consulta;
use Carbon\Carbon;


use Illuminate\Http\Request;

class ConsultaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Busca médicos com base nos critérios de busca e idade do paciente.
     * Se o paciente for menor de 12 anos, retorna apenas pediatras.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function buscarMedicos(Request $request)
    {
        $query = Medico::query();
        $paciente = auth()->guard('pacientes')->user();

        // Inicialize $mostrarBusca *antes* do bloco condicional
        $mostrarBusca = true; 

        if ($paciente->data_nascimento && \Carbon\Carbon::parse($paciente->data_nascimento)->age < 12) {
            $query->where('especialidade_id', 2); // Pediatra (ID 2, corrigido)
            $mostrarBusca = false; 
        } else {
            if ($request->especialidade_id) {
                $query->where('especialidade_id', $request->especialidade_id);
            }
            if ($request->crm) {
                $query->where('crm', 'like', '%' . $request->crm . '%');
            }
        }

        $medicos = $query->get();
        $especialidades = Especialidade::all();

        return view('consulta.dashboard', compact('medicos', 'especialidades', 'mostrarBusca'));
    }


    /**
     * Exibe o formulário para criar uma nova consulta.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $especialidades = Especialidade::all();
        return view('consulta.dashboard', compact('especialidades'));
    }

    /**
     * Armazena uma nova consulta no banco de dados.
     * Verifica se pacientes menores de 12 anos estão sendo agendados com pediatras.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'medico_id' => 'required|exists:medicos,id',
            'paciente_id' => 'required|exists:pacientes,id',
            'data_consulta' => 'required|date',
            'hora_consulta' => 'required|date_format:H:i',
        ]);

        // Obtenha o paciente e sua idade
        $paciente = auth()->guard('pacientes')->user();
        $idade = Carbon::parse($paciente->data_nascimento)->age;

        // Verifique a especialidade do médico
        $medico = Medico::findOrFail($validatedData['medico_id']);

        // Se o paciente tiver menos de 12 anos, só pode se consultar com pediatra (especialidade_id = 3)
        if ($idade < 12 && $medico->especialidade_id != 2) {
            return redirect()->back()->with('error', 'Pacientes com menos de 12 anos só podem se consultar com pediatras.');
        }

        // Criação da consulta
        $consulta = new Consulta;
        $consulta->medico_id = $validatedData['medico_id'];
        $consulta->paciente_id = $paciente->id;
        $consulta->data_consulta = $validatedData['data_consulta'];
        $consulta->hora_consulta = $validatedData['hora_consulta'];

        $consulta->save();

        return redirect()->route('paciente.dashboard')->with('success', 'Consulta agendada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Exibe o formulário para editar uma consulta existente.
     *
     * @param  int  $id
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function edit($id)
    {
        $consulta = Consulta::findOrFail($id);

        if ($consulta->paciente_id != auth()->guard('pacientes')->user()->id) {
            return redirect()->back()->with('error', 'Você não tem permissão para editar esta consulta.');
        }

        // Formata a data usando Carbon
        $consulta->data_consulta = Carbon::parse($consulta->data_consulta)->toDateString();

        return view('consulta.edit', compact('consulta'));
    }

    /**
     * Atualiza uma consulta existente no banco de dados.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'data_consulta' => 'nullable|date',
            'hora_consulta' => 'nullable|date_format:H:i',
        ]);

        $consulta = Consulta::findOrFail($id);

        if ($consulta->paciente_id != auth()->guard('pacientes')->user()->id) {
            return redirect()->back()->with('error', 'Você não tem permissão para editar esta consulta.');
        }

        if ($request->filled('data_consulta')) {
            
            $consulta->data_consulta = Carbon::parse($request->data_consulta)->toDateString();
        }

        if ($request->filled('hora_consulta')) {
            $consulta->hora_consulta = $request->hora_consulta;
        }

        $consulta->save();

        return redirect()->route('paciente.dashboard')->with('success', 'Consulta atualizada com sucesso!');
    }

     /**
     * Remove uma consulta do banco de dados.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // Busca a consulta pelo ID
        $consulta = Consulta::findOrFail($id);

        // Obtém o usuário logado, seja paciente ou médico
        $paciente = auth()->guard('pacientes')->user();
        $medico = auth()->guard('medicos')->user();

        // Verifica se o usuário logado é o dono da consulta ou o médico associado
        if ($paciente && $consulta->paciente_id == $paciente->id) {
            // O paciente pode cancelar a consulta
        } elseif ($medico && $consulta->medico_id == $medico->id) {
            // O médico pode cancelar a consulta
        } else {
            // Redireciona de volta com uma mensagem de erro se o usuário não tem permissão
            return redirect()->back()->with('error', 'Você não tem permissão para cancelar esta consulta.');
        }

        // Cancela a consulta
        $consulta->delete();

        // Redireciona para a página de dashboard do paciente ou do médico
        if ($paciente) {
            return redirect()->route('paciente.dashboard')->with('success', 'Consulta cancelada com sucesso!');
        } elseif ($medico) {
            return redirect()->route('medico.dashboard')->with('success', 'Consulta cancelada com sucesso!');
        }

        // Caso não seja paciente nem médico, redireciona de volta com mensagem de erro
        return redirect()->back()->with('error', 'Operação não permitida.');
    }

}
