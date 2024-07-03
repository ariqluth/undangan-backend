<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Profiles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiProfilesController extends Controller
{
    public function index()
    {
        try {
            $items = Profiles::all();
            return response()->json($items, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve profiles', 'message' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'username' => 'required|string',
            'nomer_telepon' => 'required|string',
            'alamat' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Validation failed', 'messages' => $validator->errors()], 422);
        }

        try {
            $item = Profiles::create($validator->validated());
            return response()->json($item, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create profile', 'message' => $e->getMessage()], 500);
        }
    }

    public function show($user_id)
    {
        try {
            $item = Profiles::where('user_id', $user_id)->firstOrFail();
            return response()->json($item, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Profile not found', 'message' => $e->getMessage()], 404);
        }
    }

    public function update(Request $request, $user_id)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'username' => 'required|string',
            'nomer_telepon' => 'required|string',
            'alamat' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Validation failed', 'messages' => $validator->errors()], 422);
        }

        try {
            $item = Profiles::where('user_id', $user_id)->firstOrFail();
            $item->update($validator->validated());
            return response()->json($item, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update profile', 'message' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $item = Profiles::findOrFail($id);
            $item->delete();
            return response()->json(null, 204);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete profile', 'message' => $e->getMessage()], 500);
        }
    }
}
