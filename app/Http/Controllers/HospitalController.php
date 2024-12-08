<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HospitalController extends Controller
{
    /**
     * Listar todos os hospitais.
     */
    public function index()
    {
        try {
            $hospitals = Hospital::all();

            return response()->json([
                'success' => true,
                'data' => $hospitals,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao buscar hospitais.',
            ], 500);
        }
    }

    /**
     * Criar um novo hospital.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors(),
            ], 422);
        }

        try {
            $hospital = Hospital::create($request->only(['name', 'location']));

            return response()->json([
                'success' => true,
                'message' => 'Hospital criado com sucesso!',
                'data' => $hospital,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao criar hospital.',
            ], 500);
        }
    }
}
