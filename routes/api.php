<?php

use App\Models\info_perusahaan;
use App\Models\invoice_info;
use App\Models\invoice_ProductDetail;
use App\Http\Controllers\Api\InfoPerusahaanController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Api\InvoiceController;
use App\Http\Controllers\Api\PenawaranController;
use App\Http\Controllers\Api\AkadController;
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

Route::middleware('auth:sanctum')->group(function () {
    Route::get('auth/logout', [AuthController::class, 'logout']);

    Route::Resource('/penawaran', PenawaranController::class);

    Route::Resource('/info-perusahaan', InfoPerusahaanController::class);

    Route::Resource('/invoice', InvoiceController::class);

    Route::Resource('/perjanjian', AkadController::class);

});


Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
