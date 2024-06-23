<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;


class ApiManagementUserController extends Controller
{
    public function index()
    {
        $user = User::all();
        return response()->json($user);
    }

    public function store(Request $request)
    {
       
    }

 
    public function show($id)
    {
     
    }



    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'email_verify_at' => 'required|string',
        ]);

        $user = User::findOrFail($id);
        $user->update($validatedData);
        return response()->json($user);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(null, 204);
    }
}
