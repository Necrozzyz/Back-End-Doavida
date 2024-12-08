<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\OrganController;
use App\Http\Controllers\HospitalController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Rotas públicas para autenticação
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

// Rotas protegidas por JWT - autenticadas
Route::middleware('auth:jwt')->group(function () {
    // Rotas para usuários autenticados
    Route::get('/users', [UserController::class, 'index']);
    Route::post('/users', [UserController::class, 'store']);
    Route::get('/user', [UserController::class, 'user']);
    
    // Rotas para órgãos
    Route::get('/organs', [OrganController::class, 'index']);
    Route::post('/organs', [OrganController::class, 'store']);
    Route::get('/organs/waiting', [OrganController::class, 'waiting']);
    Route::get('/organs/available', [OrganController::class, 'available']);
    
    // Rotas para hospitais
    Route::get('/hospitals', [HospitalController::class, 'index']);
    Route::post('/hospitals', [HospitalController::class, 'store']);
});

// Rotas de dashboard (com foco em grupos seguros)
Route::middleware('auth:jwt')->group(function () {
    Route::get('/dashboard/users', [UserController::class, 'index']);
    Route::get('/dashboard/hospitals', [HospitalController::class, 'index']);
    Route::get('/dashboard/organs', [OrganController::class, 'index']);
});
