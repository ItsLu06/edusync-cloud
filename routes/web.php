<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MateriaController;
use App\Http\Controllers\CertificadoController;
use App\Http\Controllers\ProgresoController;
use App\Http\Controllers\SemanaController;
use App\Http\Controllers\TareaController;

Route::get('/', function () {
    if (auth()->check()) {
        return redirect('/dashboard');
    }
    return redirect('/login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/materias', [MateriaController::class, 'webIndex'])->name('materias');

    // Materias CRUD
    Route::post('/materias', [MateriaController::class, 'store'])->name('materias.store');
    Route::delete('/materias/{id}', [MateriaController::class, 'destroy'])->name('materias.destroy');

    // Unirse a materia
    Route::get('/materias/confirmar', [MateriaController::class, 'confirmar'])->name('materias.confirmar');
    Route::post('/materias/confirmar', [MateriaController::class, 'confirmarStore'])->name('materias.confirmar.store');

    // Semanas
    Route::get('/materias/{materia}/tareas', [ProgresoController::class, 'showSemanas'])->name('materias.tareas');
    Route::post('/progreso/toggle', [ProgresoController::class, 'toggleWeb'])->name('progreso.toggle');

    Route::post('/semana/store', [SemanaController::class, 'store'])->name('semana.store');
    Route::put('/semana/{id}', [SemanaController::class, 'update'])->name('semana.update');
    Route::delete('/semana/{id}', [SemanaController::class, 'destroy'])->name('semana.destroy');

    // Tareas
    Route::get('/semanas/{progreso}/tareas', [TareaController::class, 'index'])->name('tareas.index');
    Route::get('/semanas/{progreso}/tareas/create', [TareaController::class, 'create'])->name('tareas.create');
    Route::post('/semanas/{progreso}/tareas', [TareaController::class, 'store'])->name('tareas.store');
    Route::get('/tareas/{id}/edit', [TareaController::class, 'edit'])->name('tareas.edit');
    Route::put('/tareas/{id}', [TareaController::class, 'update'])->name('tareas.update');
    Route::delete('/tareas/{id}', [TareaController::class, 'destroy'])->name('tareas.destroy');
    Route::post('/tareas/{id}/toggle', [TareaController::class, 'toggle'])->name('tareas.toggle'); // ← AGREGADA

    // Certificados
    Route::get('/certificados', [CertificadoController::class, 'webIndex'])->name('certificados');
});

require __DIR__.'/auth.php';