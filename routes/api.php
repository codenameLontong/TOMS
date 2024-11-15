<?php

use App\Http\Controllers\PegawaiController;
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

// Default route for authenticated user information
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Pegawai data export route
Route::get('/pegawai-data-for-export', [PegawaiController::class, 'getPegawaiDataForExport'])
    ->withoutMiddleware(['auth:sanctum']);
