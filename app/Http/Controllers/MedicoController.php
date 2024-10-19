<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Consulta;

class MedicoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    // Obtém o médico logado
    $medico = Auth::guard('medicos')->user();

    // Captura todas as consultas agendadas para o médico
    $consultas = Consulta::where('medico_id', $medico->id)->get();

    // Retorna a view com os dados necessários
    return view('medico.dashboard', [
        'medico' => $medico,
        'consultas' => $consultas,
    ]);
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
