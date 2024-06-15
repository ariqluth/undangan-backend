<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tamus;
use Illuminate\Http\Request;

class ApiTamusController extends Controller
{
    public function index()
    {
        $tamus = Tamus::all();
        return response()->json($tamus);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'undangan_id' => 'required',
            'nama_tamu' => 'required|string',
            'email_tamu' => 'required|string',
            'alamat_tamu' => 'required|string',
            'nomer_tamu' => 'required|string',
            'status' => 'required|string',
            'kategori' => 'required|string',
            'kodeqr' => 'required|string',
        ]);

        $tamus = Tamus::create($validatedData);
        return response()->json($tamus, 201);
    }

 
    public function show($id)
    {
        $tamus = Tamus::findOrFail($id);
        return response()->json($tamus);
    }

 
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'undangan_id' => 'required',
            'nama_tamu' => 'required|string',
            'email_tamu' => 'required|string',
            'alamat_tamu' => 'required|string',
            'nomer_tamu' => 'required|string',
            'status' => 'required|string',
            'kategori' => 'required|string',
            'kodeqr' => 'required|string',
        ]);

        $tamus = Tamus::findOrFail($id);
        $tamus->update($validatedData);
        return response()->json($tamus);
    }

   
    public function destroy($id)
    {
        $tamus = Tamus::findOrFail($id);
        $tamus->delete();
        return response()->json(null, 204);
    }

}
