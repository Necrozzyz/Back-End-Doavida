<?php

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
}
