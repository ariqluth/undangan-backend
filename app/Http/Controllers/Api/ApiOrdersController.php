<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Orders;
use Illuminate\Http\Request;

class ApiOrdersController extends Controller
{
    public function index()
    {
        $orders = Orders::all();
        return response()->json($orders);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'profile_id' => 'required',
            'item_id' => 'required|string',
            'tanggal_terakhir' => 'required|string',
            'kode' => 'required|string',
            'status' => 'required|string',
        ]);

        $orders = Orders::create($validatedData);
        return response()->json($orders, 201);
    }

 
    public function show($id)
    {
        $orders = Orders::findOrFail($id);
        return response()->json($orders);
    }

 
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
           'profile_id' => 'required',
            'item_id' => 'required|string',
            'tanggal_terakhir' => 'required|string',
            'kode' => 'required|string',
            'status' => 'required|string',
        ]);

        $orders = Orders::findOrFail($id);
        $orders->update($validatedData);
        return response()->json($orders);
    }

   
    public function destroy($id)
    {
        $orders = Orders::findOrFail($id);
        $orders->delete();
        return response()->json(null, 204);
    }
}
