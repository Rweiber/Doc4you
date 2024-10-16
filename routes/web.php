<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EspecialidadeController;
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\ConsultaController;


Route::resource('especialidades', EspecialidadeController::class);
Route::resource('medicos', MedicoController::class);
Route::resource('pacientes', PacienteController::class);
Route::resource('consultas', ConsultaController::class);

Route::get('/', function () {
    return view('welcome');
});
