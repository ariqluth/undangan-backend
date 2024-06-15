<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Profiles;

class ApiProfilesController extends Controller
{
    public function index()
    {
        $items = Profiles::all();
        return response()->json($items);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required',
            'username' => 'required|string',
            'nomer_telepon' => 'required|string',
            'alamat' => 'required|string',
            'gambar' => 'required|string',
        ]);

        $item = Profiles::create($validatedData);
        return response()->json($item, 201);
    }

 
    public function show($id)
    {
        $item = Profiles::findOrFail($id);
        return response()->json($item);
    }

 
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'user_id' => 'required',
            'username' => 'required|string',
            'nomer_telepon' => 'required|string',
            'alamat' => 'required|string',
            'gambar' => 'required|string',
        ]);

        $item = Profiles::findOrFail($id);
        $item->update($validatedData);
        return response()->json($item);
    }

   
    public function destroy($id)
    {
        $item = Profiles::findOrFail($id);
        $item->delete();
        return response()->json(null, 204);
    }

}
