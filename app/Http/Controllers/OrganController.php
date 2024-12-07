<?php

namespace App\Http\Controllers;

use App\Models\Organ;
use Illuminate\Http\Request;

class OrganController extends Controller
{
    public function index()
    {
        $organs = Organ::all();
        return response()->json($organs);
    }

    public function waiting()
    {
        return response()->json(Organ::where('status', 'waiting')->get());
    }

    public function available()
    {
        return response()->json(Organ::where('status', 'available')->get());
    }

    public function store(Request $request)
    {
        $organ = Organ::create([
            'name' => $request->name,
            'status' => $request->status,
            'hospital_id' => $request->hospital_id,
        ]);

        return response()->json($organ, 201);
    }
}
