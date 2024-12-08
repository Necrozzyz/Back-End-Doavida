<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\OrganController;
use App\Http\Controllers\HospitalController;

// Rotas para usuários
Route::middleware('auth:sanctum')->get('/users', [UserController::class, 'index']);
Route::middleware('auth:sanctum')->post('/users', [UserController::class, 'store']);

// Rotas para órgãos
Route::middleware('auth:sanctum')->get('/organs', [OrganController::class, 'index']);
Route::middleware('auth:sanctum')->post('/organs', [OrganController::class, 'store']);

// Rotas para hospitais
Route::middleware('auth:sanctum')->get('/hospitals', [HospitalController::class, 'index']);
Route::middleware('auth:sanctum')->post('/hospitals', [HospitalController::class, 'store']);

// Rota para autenticação de login
Route::post('/login', [UserController::class, 'login']);

// Rota para obter informações do usuário autenticado
Route::middleware('auth:sanctum')->get('/user', [UserController::class, 'user']);

// Rotas de Dashboard - apenas para usuários autenticados
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/hospitals', [HospitalController::class, 'index']);
    Route::get('/organs', [OrganController::class, 'index']);
});

// Rotas específicas
Route::middleware('auth:sanctum')->get('/organs/waiting', [OrganController::class, 'waiting']);
Route::middleware('auth:sanctum')->get('/organs/available', [OrganController::class, 'available']);