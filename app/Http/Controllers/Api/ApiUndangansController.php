<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Undangans;

class ApiUndangansController extends Controller
{
    public function index()
    {
        $undangans = Undangans::all();
        return response()->json($undangans);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'orders_id' => 'required',
            'order_list_id' => 'required|string',
            'nama_pengantin_pria' => 'required|string',
            'nama_pengantin_wanita' => 'required|string',
            'tanggal_pernikahan' => 'required|string',
            'lokasi_pernikahan' => 'required|string',
          
        ]);

        $undangans = Undangans::create($validatedData);
        return response()->json($undangans, 201);
    }

 
    public function show($id)
    {
        $undangans = Undangans::findOrFail($id);
        return response()->json($undangans);
    }

 
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'orders_id' => 'required',
            'order_list_id' => 'required|string',
            'nama_pengantin_pria' => 'required|string',
            'nama_pengantin_wanita' => 'required|string',
            'tanggal_pernikahan' => 'required|string',
            'lokasi_pernikahan' => 'required|string',
        ]);

        $undangans = Undangans::findOrFail($id);
        $undangans->update($validatedData);
        return response()->json($undangans);
    }

   
    public function destroy($id)
    {
        $undangans = Undangans::findOrFail($id);
        $undangans->delete();
        return response()->json(null, 204);
    }
}
