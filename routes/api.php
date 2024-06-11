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
use App\Http\Controllers\Api\ApiKbliPerusahaanSearchController;
use App\Http\Controllers\Api\ApiKbliSearchController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ApiProfilePengusahaController;
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
Route::apiResource('kelurahan', ApiKelurahanController::class, ['as' => 'api'])->except(['destroy']);
Route::apiResource('kecamatan', ApiKecamatanController::class, ['as' => 'api'])->except(['destroy']);
Route::apiResource('perusahaan', ApiPerusahaanController::class, ['as' => 'api'])->except(['destroy']);
Route::apiResource('visitormap', ApiVisitorController::class, ['as' => 'api']);
Route::apiResource('kblisearch', ApiKbliSearchController::class, ['as' => 'api']);
Route::apiResource('popup', ApiPopUpController::class, ['as' => 'api']);
Route::get('popup/{id}', [ApiPopUpController::class, 'showPopup'], ['as' => 'api'])->name('api.popup.showPopup');
Route::apiResource('map', ApiMapController::class, ['as' => 'api']);
Route::apiResource('kbliperusahaansearch', ApiKbliPerusahaanSearchController::class, ['as' => 'api']);
Route::apiResource('chartdata', ApiChartDataController::class, ['as' => 'api']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/forgot-password', [AuthController::class, 'forgot_password']);

// Route::get('/profile-pengusaha/create', ProfilePengusahaController::class, 'create');

Route::group(
    ['middleware' => 'auth:sanctum'],
    function () {
        Route::post('/auth/logout', [AuthController::class, 'logout']);
        Route::post('/reset-password', [AuthController::class, 'change_password']);
        Route::post('/edit-profile', [AuthController::class, 'editProfile']);

        //master table
        Route::apiResource('kabupaten', ApiKabupatenController::class, ['as' => 'api'])->except(['destroy']);

        Route::apiResource('kbli-perusahaan', ApiKbliPerusahaanController::class, ['as' => 'api']);

        Route::apiResource('kbli', ApiKBliController::class, ['as' => 'api'])->except(['destroy']);
        Route::apiResource('uraian-jenis-perusahaan', ApiUraianJenisPerusahaanController::class, ['as' => 'api'])->except(['destroy']);
        Route::apiResource('uraian-resiko-proyek', ApiUraianResikoProyekController::class, ['as' => 'api'])->except(['destroy']);
        Route::apiResource('uraian-skala-usaha', ApiUraianSkalaUsahaController::class, ['as' => 'api'])->except(['destroy']);
        Route::apiResource('profile-pengusaha', ApiProfilePengusahaController::class, ['as' => 'api'])->except(['destroy']);

        //data table
        Route::apiResource('/category', CategoryController::class);

        Route::apiResource('assign-approve', ApiAssignApproveController::class, ['as' => 'api']);
        // Route::put('assign-approve/{assign_approve}', [ApiAssignApproveController::class, 'update'], ['as' => 'api']);
        Route::get('assign-approve/get-assign/{user_id}', [ApiAssignApproveController::class, 'getAssignApproveByUser'], ['as' => 'api'])->name('api.assign.approve.getAssignApproveByUser');
        Route::get('assign-approve/list-wait-assign/{user_id}', [ApiAssignApproveController::class, 'getListWaitApproveByUser'], ['as' => 'api'])->name('api.assign.approve.getListWaitApproveByUser');
        Route::PUT('/assign-approve/{assignApprove}/upload-foto', [ApiAssignApproveController::class, 'uploadFoto']);
    }
);
