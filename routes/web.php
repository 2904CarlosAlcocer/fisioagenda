<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\RecordatorioController;
use App\Http\Controllers\SalaController;
use App\Http\Controllers\FisioterapeutaController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('fisioterapeutas', FisioterapeutaController::class);
    Route::resource('salas', SalaController::class);
    Route::patch('/recordatorios/{recordatorio}/marcar-enviado', [RecordatorioController::class, 'marcarEnviado'])
    ->name('recordatorios.marcarEnviado');

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::get('/calendario-citas', [CitaController::class, 'calendario'])
        ->name('citas.calendario');

    Route::get('/citas-eventos', [CitaController::class, 'eventos'])
        ->name('citas.eventos');

    Route::put('/citas/{cita}/mover', [CitaController::class, 'mover'])
        ->name('citas.mover');

    Route::resource('pacientes', PacienteController::class);
    Route::resource('citas', CitaController::class);
    Route::resource('recordatorios', RecordatorioController::class);
    Route::resource('salas', SalaController::class);
    Route::resource('fisioterapeutas', FisioterapeutaController::class);

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

require __DIR__.'/auth.php';