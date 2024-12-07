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
