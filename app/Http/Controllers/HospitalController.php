<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use Illuminate\Http\Request;

class HospitalController extends Controller
{
    /**
     * Listar todos os hospitais.
     */
    public function index()
    {
        try {
            // Recuperar todos os hospitais da base de dados
            $hospitals = Hospital::all();
            return response()->json($hospitals, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao buscar hospitais'], 500);
        }
    }

    /**
     * Criar um novo hospital.
     */
    public function store(Request $request)
    {
        // Validação de dados de entrada
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
        ]);

        try {
            // Criar o novo hospital no banco de dados
            $hospital = Hospital::create($validatedData);

            return response()->json($hospital, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao criar hospital'], 500);
        }
    }
}
