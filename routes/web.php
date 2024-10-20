<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\PacienteController;
use App\Http\Middleware\CustomAuth;
use App\Http\Controllers\ConsultaController;


Route::get('/', function () {
    return view('index');
});

Route::get('/dashboard', function () {
    return redirect('/');  // Você pode redirecionar para a home ou para outra página
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/registrar', [RegistroController::class, 'showForm'])->name('registrar');
Route::post('/registrar', [RegistroController::class, 'registrar'])->name('registrar.store');


Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

Route::middleware([CustomAuth::class])->group(function () {
    Route::get('/medico/dashboard', [MedicoController::class, 'index'])->name('medico.dashboard');
    Route::get('/paciente/dashboard', [PacienteController::class, 'index'])->name('paciente.dashboard');

    Route::get('/consulta', [ConsultaController::class, 'create'])->name('consulta');
    Route::post('/consulta', [ConsultaController::class, 'store'])->name('consulta.store');
    Route::get('/consulta/{consulta}/edit', [ConsultaController::class, 'edit'])->name('consulta.edit');
    Route::delete('/consulta/{consulta}', [ConsultaController::class, 'destroy'])->name('consulta.cancelar');
    Route::get('/consulta/buscar', [ConsultaController::class, 'buscarMedicos'])->name('consulta.buscar');

});




