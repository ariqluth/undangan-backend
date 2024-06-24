<?php


use App\Http\Controllers\Api\AuthController;

use App\Http\Controllers\Api\ApiItemsController;

use App\Http\Controllers\Api\ApiManagementUserController;

use App\Http\Controllers\Api\ApiOrderListController;
use App\Http\Controllers\Api\ApiOrdersController;

use App\Http\Controllers\Api\ApiProfilesController;
use App\Http\Controllers\Api\ApiTamusController;
use App\Http\Controllers\Api\ApiUndangansController;
use App\Http\Controllers\Api\ApiVerifyOrderController;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;


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
Route::get('/visitor', [ApiItemsController::class, 'index']);
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
        Route::apiResource('management-user', ApiManagementUserController::class, ['as' => 'api']);
        Route::apiResource('item', ApiItemsController::class, ['as' => 'api']);
        Route::apiResource('order', ApiOrdersController::class, ['as' => 'api']);
        Route::apiResource('verify-order', ApiVerifyOrderController::class, ['as' => 'api']);
        Route::apiResource('order-list', ApiOrderListController::class, ['as' => 'api']);
        Route::apiResource('undangan', ApiUndangansController::class, ['as' => 'api']);
        Route::apiResource('tamu', ApiTamusController::class, ['as' => 'api']);

    }
);
