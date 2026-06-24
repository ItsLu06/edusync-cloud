<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MateriaController;
use App\Http\Controllers\ProgresoController;
use App\Http\Controllers\CertificadoController;

// Rutas públicas
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Rutas protegidas
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/logout', [AuthController::class, 'logout']);

    // Materias
    Route::get('/materias', [MateriaController::class, 'index']);
    Route::get('/materias/{id}', [MateriaController::class, 'show']);

    // Progreso
    Route::get('/progreso', [ProgresoController::class, 'index']);
    Route::post('/progreso/toggle', [ProgresoController::class, 'toggle']);

    // Certificados
    Route::get('/certificados', [CertificadoController::class, 'index']);
});