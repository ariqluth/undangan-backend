<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\LoginResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class ApiManagementUser extends Controller
{
    public function index()
    {
        $user = User::all();
        return response()->json($user);
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

   
}
