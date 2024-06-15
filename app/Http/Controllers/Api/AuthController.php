<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\LoginResource;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required',
        ];

        $customMessages = [
            'required' => 'Kolom :attribute tidak boleh kosong.',
            'email' => 'Format email tidak valid.',
        ];

        try {
            $validator = Validator::make($request->all(), $rules, $customMessages);

            if ($validator->fails()) {
                $errorMessages = [];
                foreach ($validator->errors()->messages() as $field => $messages) {
                    $errorMessages[] = "$field : " . implode(', ', $messages);
                }
                throw ValidationException::withMessages(['message' => $errorMessages]);
            }

            $credentials = $request->only('email', 'password');
            if (Auth::attempt($credentials)) {
                $user = Auth::user();
                $roleName = Auth::user()->getRoleNames();
                $token = $user->createToken('')->plainTextToken;
                Log::addLog(getUserId(), 'login', 'mencoba login', 'Web Surveyor', $user);

                return response()->json([
                    'success' => true,
                    'message' => 'Berhasil masuk.',
                    'data' => [
                        'token' => $token,
                        'id' => $user->id,
                        'role' => $roleName
                    ]
                ], Response::HTTP_OK);
            }

            $errorMessages = ['Akun Tidak Terdaftar'];
            throw ValidationException::withMessages(['message' => $errorMessages]);
        } catch (ValidationException $e) {
            $errorResponse = [
                'success' => false,
                'message' => $e->errors(),
            ];
            return response()->json($errorResponse, Response::HTTP_BAD_REQUEST);
        }
    }



    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => ['required', 'string', 'min:8', 'confirmed', Password::defaults()],
            'device_name' => 'required',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        // Log::addLog('register', 'operator ' . $user->name . ' sedang melakukan pendaftaran ke dalam sistem', null, $request);
        return response()->json(
            [
                'token' => $user->createToken($request->device_name)->plainTextToken,
            ],
            200
        );
    }



    public function logout(Request $request)
    {
        try {
            Log::addLog(getUserId(), 'logout', 'mencoba logout', 'Web Surveyor', $request->all());

            auth()->user()->tokens()->delete();
            return response()->json([
                "success" => true,
                'message' => 'Berhasil keluar.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "success" => false,
                'message' => 'Gagal keluar. Silakan coba lagi.'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    public function forgot_password(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            return response()->json(['message' => 'Reset password link has been sent to your email']);
        } else {
            throw ValidationException::withMessages(['email' => trans($status)]);
        }
    }

    public function change_password(Request $request)
    {
        $input = $request->all();
        $userid = Auth::guard('api')->user()->id;
        $rules = array(
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|same:new_password',
        );
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            $arr = array("status" => 400, "message" => $validator->errors()->first(), "data" => array());
        } else {
            try {
                if ((Hash::check(request('new_password'), Auth::guard('api')->user()->password)) == true) {
                    $arr = array("status" => 400, "message" => "Please enter a password which is not similar then current password.", "data" => array());
                } else {
                    User::where('id', $userid)->update(['password' => Hash::make($input['new_password'])]);
                    $arr = array("status" => 200, "message" => "Password updated successfully.", "data" => array());
                }
            } catch (\Exception $ex) {
                if (isset($ex->errorInfo[2])) {
                    $msg = $ex->errorInfo[2];
                } else {
                    $msg = $ex->getMessage();
                }
                $arr = array("status" => 400, "message" => $msg, "data" => array());
            }
        }
        return Response::json($arr);
    }

    public function editProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users,email,' . $user->id,
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return response([
            'status' => 'OK',
            'message' => 'Edit Profile Sukses',
        ], 200);
    }
}
