<?php

use App\Models\Organ;
use Illuminate\Http\Request;

class OrganController extends Controller
{
    public function index()
    {
        return response()->json(Organ::all());
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
