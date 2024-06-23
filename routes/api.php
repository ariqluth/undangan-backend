<?php

use App\Http\Controllers\Api\ApiKabupatenController;
use App\Http\Controllers\Api\ApiKBliController;
use App\Http\Controllers\Api\ApiKecamatanController;
use App\Http\Controllers\Api\ApiKelurahanController;
use App\Http\Controllers\Api\ApiPerusahaanController;
use App\Http\Controllers\Api\ApiUraianJenisPerusahaanController;
use App\Http\Controllers\Api\ApiUraianResikoProyekController;
use App\Http\Controllers\Api\ApiUraianSkalaUsahaController;
use App\Http\Controllers\Api\ApiKbliPerusahaanController;
use App\Http\Controllers\Api\ApiVisitorController;
use App\Http\Controllers\Api\ApiMapController;
use App\Http\Controllers\Api\ApiPopUpController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ApiChartDataController;
use App\Http\Controllers\Api\ApiItemsController;
use App\Http\Controllers\Api\ApiKbliPerusahaanSearchController;
use App\Http\Controllers\Api\ApiKbliSearchController;
// use App\Http\Controllers\Api\ApiManagementUser;
use App\Http\Controllers\Api\ApiOrderListController;
use App\Http\Controllers\Api\ApiOrdersController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ApiProfilePengusahaController;
use App\Http\Controllers\Api\ApiProfilesController;
use App\Http\Controllers\Api\ApiTamusController;
use App\Http\Controllers\Api\ApiUndangansController;
use App\Http\Controllers\Api\ApiVerifyOrderController;
use App\Http\Controllers\ApiAssignApproveController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [AuthController::class, 'webLogin']);
Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/register', [AuthController::class, 'register']);
// Route::get('/profile-pengusaha/create', ProfilePengusahaController::class, 'create');

Route::group(
    ['middleware' => 'auth:sanctum'],
    function () {
        Route::get('/auth/token', function () {
            $token = auth()->user()->createToken('authToken')->plainTextToken;
            return response()->json(['token' => $token]);
            });
        Route::post('/auth/logout', [AuthController::class, 'logout']);
        Route::post('/reset-password', [AuthController::class, 'change_password']);
        Route::apiResource('profile', ApiProfilesController::class, ['as' => 'api']);
        // Route::apiResource('management-user', ApiManagementUser::class, ['as' => 'api']);
        Route::apiResource('item', ApiItemsController::class, ['as' => 'api']);
        Route::apiResource('order', ApiOrdersController::class, ['as' => 'api']);
        Route::apiResource('verify-order', ApiVerifyOrderController::class, ['as' => 'api']);
        Route::apiResource('order-list', ApiOrderListController::class, ['as' => 'api']);
        Route::apiResource('undangan', ApiUndangansController::class, ['as' => 'api']);
        Route::apiResource('tamu', ApiTamusController::class, ['as' => 'api']);

    }
);
