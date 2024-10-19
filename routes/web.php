<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistroController;

Route::get('/', function () {
    return view('index');
});

Route::get('/dashboard', function () {
    return redirect('/');  // Você pode redirecionar para a home ou para outra página
})->middleware(['auth', 'verified'])->name('dashboard');


// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// require __DIR__.'/auth.php';




Route::get('/registrar', [RegistroController::class, 'showForm'])->name('registrar');
Route::post('/registrar', [RegistroController::class, 'registrar'])->name('registrar.store');
