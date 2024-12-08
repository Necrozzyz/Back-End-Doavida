<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Realiza o login de um usuário.
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Erro na validação de dados.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            return response()->json([
                'success' => true,
                'message' => 'Login realizado com sucesso!',
                'user' => $user,
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Credenciais inválidas.',
        ], 401);
    }

    /**
     * Realiza o logout do usuário autenticado.
     */
    public function logout(Request $request)
    {
        try {
            Auth::logout();
            return response()->json([
                'success' => true,
                'message' => 'Logout realizado com sucesso.',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao realizar logout.',
            ], 500);
        }
    }

    /**
     * Realiza o cadastro de um novo usuário.
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role' => 'required|string|in:admin,receptor,doador',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Erro na validação de dados.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $roleMap = [
            'receptor' => 1, // Substitua pelos IDs no banco
            'doador' => 2,
            'admin' => 3,
        ];

        try {
            $user = User::create([
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Usuário criado com sucesso!',
                'user' => $user,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao criar usuário.',
            ], 500);
        }
    }

    /**
     * Retorna informações do usuário autenticado.
     */
    public function me(Request $request)
    {
        if (Auth::check()) {
            return response()->json([
                'success' => true,
                'data' => Auth::user(),
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Usuário não autenticado.',
        ], 401);
    }

    /**
     * Atualiza a role de um usuário autenticado.
     */
    public function updateRole(Request $request)
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Usuário não autenticado.',
            ], 401);
        }

        $validator = Validator::make($request->all(), [
            'role' => 'required|string|in:receptor,doador',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Erro na validação de dados.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $user = Auth::user();
        $user->role = $request->role;
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Função atualizada com sucesso!',
            'user' => $user,
        ], 200);
    }
}
