<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; // Correct import for Log facade
use Illuminate\Support\Facades\Validator; // Correct import for Validator facade
use Symfony\Component\HttpFoundation\Response;

class ApiManagementUserController extends Controller
{
    public function index()
    {
        $user = User::all();
        return response()->json($user);
    }

    public function store(Request $request)
    {
        // Implement store logic if needed
    }

    public function show($id)
    {
        // Implement show logic if needed
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'email_verified_at' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            $user = User::findOrFail($id);

            if ($request->has('email_verified_at')) {
                $user->email_verified_at = $request->input('email_verified_at');
            }

            $user->save();
            Log::info('User email_verified_at updated', ['user_id' => $user->id]);

            return response()->json([
                'success' => true,
                'message' => 'Data has been verified',
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            Log::error('Error updating user email_verified_at', ['error' => $e->getMessage()]);

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while verifying data.',
                'error' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
