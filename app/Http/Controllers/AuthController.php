<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required|string|unique:users',
            'password' => 'required|string|min:6',
            'role' => 'required|in:admin,receptor,doador',
        ]);

        $user = User::create([
            'username' => $validatedData['username'],
            'password' => Hash::make($validatedData['password']),
            'role' => $validatedData['role'],
        ]);

        return response()->json(['message' => 'Usuário registrado com sucesso!'], 201);
    }
}
