<?php

namespace App\Http\Controllers;
use App\Models\Medico;
use App\Models\Especialidade;
use App\Models\Consulta;


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

    public function buscarMedicos(Request $request)
    {
        $query = Medico::query();

        // Filtro por especialidade
        if ($request->especialidade_id) {
            $query->where('especialidade_id', $request->especialidade_id);
        }

        // Filtro por CRM
        if ($request->crm) {
            $query->where('crm', 'like', '%' . $request->crm . '%');
        }

        // Verificação da idade do paciente
        $paciente = auth()->guard('pacientes')->user();
        if ($paciente->data_nascimento && \Carbon\Carbon::parse($paciente->data_nascimento)->age < 12) {
            // Se for menor de 12, filtra apenas médicos pediatras (especialidade_id 3)
            $query->where('especialidade_id', 3);
        }

        $medicos = $query->get();
        $especialidades = Especialidade::all(); // Obter todas as especialidades

        return view('consulta.dashboard', compact('medicos', 'especialidades'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $especialidades = Especialidade::all();
        return view('consulta.dashboard', compact('especialidades'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'medico_id' => 'required|exists:medicos,id',
            'paciente_id' => 'required|exists:pacientes,id',
            'data_consulta' => 'required|date',
            'hora_consulta' => 'required|date_format:H:i', // Validação para o formato de hora
        ]);


        $consulta = new Consulta;
        $consulta->medico_id = $validatedData['medico_id'];
        $consulta->paciente_id = $request->paciente_id; //Paciente_id esta vindo da sessão
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
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
