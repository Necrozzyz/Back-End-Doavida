<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\OrganController;
use App\Http\Controllers\HospitalController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Rota teste
Route::get('/test', function () {
    return response()->json(['message' => 'API funcionando corretamente']);
});

// Rotas públicas para autenticação
Route::prefix('/auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
});

// Rotas protegidas por autenticação usando Sanctum
Route::middleware('auth:sanctum')->group(function () {
    
    /** 
     * Gerenciamento de Usuários 
     */
    Route::prefix('/users')->group(function () {
        Route::get('', [UserController::class, 'index']); // Listar todos os usuários
        Route::post('', [UserController::class, 'store']); // Criar usuário
        Route::get('/me', [UserController::class, 'user']); // Dados do usuário autenticado
        Route::put('/{id}', [UserController::class, 'update']); // Atualizar usuário
        Route::delete('/{id}', [UserController::class, 'destroy']); // Excluir usuário
    });

    /** 
     * Gerenciamento de Órgãos 
     */
    Route::prefix('/organs')->group(function () {
        Route::get('', [OrganController::class, 'index']); // Listar todos os órgãos
        Route::post('', [OrganController::class, 'store']); // Criar órgão
        Route::get('/waiting', [OrganController::class, 'waiting']); // Órgãos aguardando
        Route::get('/available', [OrganController::class, 'available']); // Órgãos disponíveis
        Route::patch('/{id}', [OrganController::class, 'update']); // Atualização parcial de órgão
        Route::delete('/{id}', [OrganController::class, 'destroy']); // Excluir órgão
    });

    /** 
     * Gerenciamento de Hospitais 
     */
    Route::prefix('/hospitals')->group(function () {
        Route::get('', [HospitalController::class, 'index']); // Listar todos os hospitais
        Route::post('', [HospitalController::class, 'store']); // Criar hospital
        Route::put('/{id}', [HospitalController::class, 'update']); // Atualizar hospital
        Route::delete('/{id}', [HospitalController::class, 'destroy']); // Excluir hospital
    });

});
