<?php

namespace App\Http\Controllers;

use App\Models\Organ;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrganController extends Controller
{
    /**
     * Listar todos os órgãos.
     */
    public function index()
    {
        try {
            return response()->json(Organ::all(), 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao buscar órgãos'], 500);
        }
    }

    /**
     * Listar todos os órgãos com status 'waiting'.
     */
    public function waiting()
    {
        try {
            return response()->json(Organ::where('status', 'waiting')->get(), 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao buscar órgãos aguardando'], 500);
        }
    }

    /**
     * Listar todos os órgãos com status 'available'.
     */
    public function available()
    {
        try {
            return response()->json(Organ::where('status', 'available')->get(), 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao buscar órgãos disponíveis'], 500);
        }
    }

    /**
     * Armazenar um novo órgão no banco de dados.
     */
    public function store(Request $request)
    {
        // Validar dados de entrada
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'status' => 'required|string|in:waiting,available',
            'hospital_id' => 'required|integer|exists:hospitals,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        try {
            $organ = Organ::create([
                'name' => $request->name,
                'status' => $request->status,
                'hospital_id' => $request->hospital_id,
            ]);

            return response()->json($organ, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao criar órgão'], 500);
        }
    }
}
