<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use Illuminate\Http\Request;

class HospitalController extends Controller
{
    public function index()
    {
        return response()->json(Hospital::all());
    }

    public function store(Request $request)
    {
        $hospital = Hospital::create([
            'name' => $request->name,
            'location' => $request->location,
        ]);

        return response()->json($hospital, 201);
    }

    public function destroy($id)
    {
        $hospital = Hospital::find($id);

        if (!$hospital) {
            return response()->json([
                'message' => 'Hospital não encontrado'
            ], 404);
        }

        $hospital->delete();

        return response()->json([
            'message' => 'Hospital excluído com sucesso'
        ]);
    }
}
