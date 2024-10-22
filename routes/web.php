<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\PacienteController;
use App\Http\Middleware\CustomAuth;
use App\Http\Controllers\ConsultaController;


// Rota principal
Route::get('/', function () {
    return view('index');
});

// Rotas de registro
Route::get('/registrar', [RegistroController::class, 'showForm'])->name('registrar');
Route::post('/registrar', [RegistroController::class, 'registrar'])->name('registrar.store');

// Rotas de autenticação
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// Rotas protegidas por autenticação
Route::middleware([CustomAuth::class])->group(function () {
    // Dashboards
    Route::get('/medico/dashboard', [MedicoController::class, 'index'])->name('medico.dashboard');
    Route::get('/paciente/dashboard', [PacienteController::class, 'index'])->name('paciente.dashboard');

    // Rotas de consultas
    Route::get('/consulta', [ConsultaController::class, 'create'])->name('consulta');
    Route::post('/consulta', [ConsultaController::class, 'store'])->name('consulta.store');
    Route::get('/consulta/{consulta}/edit', [ConsultaController::class, 'edit'])->name('consulta.edit');
    Route::put('/consulta/{consulta}', [ConsultaController::class, 'update'])->name('consulta.update');
    Route::delete('/consulta/{consulta}', [ConsultaController::class, 'destroy'])->name('consulta.cancelar');
    Route::get('/consulta/buscar', [ConsultaController::class, 'buscarMedicos'])->name('consulta.buscar');

    // Rotas de paciente
    Route::get('/paciente/{id}/edit', [PacienteController::class, 'edit'])->name('paciente.edit');
    Route::delete('/paciente/{id}', [PacienteController::class, 'destroy'])->name('paciente.destroy');
    Route::put('/paciente/{id}', [PacienteController::class, 'update'])->name('paciente.update');

    // Rotas de médico
    Route::get('/medico/{id}/edit', [MedicoController::class, 'edit'])->name('medico.edit');
    Route::delete('/medico/{id}', [MedicoController::class, 'destroy'])->name('medico.destroy');
    Route::put('/medico/{id}', [MedicoController::class, 'update'])->name('medico.update');
});