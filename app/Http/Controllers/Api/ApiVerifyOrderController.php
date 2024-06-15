<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\VerifyOrder;
use Illuminate\Http\Request;

class ApiVerifyOrderController extends Controller
{
    public function index()
    {
        $undangans = VerifyOrder::all();
        return response()->json($undangans);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'order_id' => 'required',
            'profile_id' => 'required|string',
          
        ]);

        $undangans = VerifyOrder::create($validatedData);
        return response()->json($undangans, 201);
    }

 
    public function show($id)
    {
        $undangans = VerifyOrder::findOrFail($id);
        return response()->json($undangans);
    }

 
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'order_id' => 'required',
            'profile_id' => 'required|string',
        ]);

        $undangans = VerifyOrder::findOrFail($id);
        $undangans->update($validatedData);
        return response()->json($undangans);
    }

   
    public function destroy($id)
    {
        $undangans = VerifyOrder::findOrFail($id);
        $undangans->delete();
        return response()->json(null, 204);
    }
}
