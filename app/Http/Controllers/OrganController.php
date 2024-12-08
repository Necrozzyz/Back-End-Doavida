<?php

namespace App\Http\Controllers;

use App\Models\Organ;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrganController extends Controller
{
    /**
     * List all organs.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => Organ::all(),
        ], 200);
    }

    /**
     * Store a new organ in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors(),
            ], 422);
        }

        $organ = Organ::create($request->only(['name', 'type']));

        return response()->json([
            'success' => true,
            'data' => $organ,
        ], 201);
    }

    /**
     * Update an existing organ.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $organ = Organ::find($id);

        if (!$organ) {
            return response()->json([
                'success' => false,
                'message' => 'Organ not found.',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:255',
            'type' => 'sometimes|required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors(),
            ], 422);
        }

        $organ->update($request->only(['name', 'type']));

        return response()->json([
            'success' => true,
            'data' => $organ,
        ], 200);
    }

    /**
     * Delete an existing organ.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $organ = Organ::find($id);

        if (!$organ) {
            return response()->json([
                'success' => false,
                'message' => 'Organ not found.',
            ], 404);
        }

        $organ->delete();

        return response()->json([
            'success' => true,
            'message' => 'Organ deleted successfully.',
        ], 200);
    }
}
