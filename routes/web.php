<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\InvoiceController;
use App\Http\Controllers\Api\PenawaranController;
use App\Http\Controllers\Api\AkadController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/{action}/invoice/{invoice}',[InvoiceController::class, 'makeInvoice']);

Route::get('/{action}/akad/{no_akad}',[AkadController::class, 'makeAkad']);

Route::get('/{action}/penawaran/{no_surat_penawaran}',[PenawaranController::class, 'makePenawaran']);
