<?php

use App\Http\Controllers\Api\UserPanel\Auth\AuthController;
use App\Http\Controllers\Api\UserPanel\ParcelController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware(['log.api.requests'])->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::group(['middleware' => ['auth:sanctum']], function () {
        Route::post('/logout', [AuthController::class, 'logout']);
    });

    Route::name('parcels.')->prefix('parcels')->group(function () {
        Route::post('/store', [ParcelController::class, 'store']);
        Route::put('/update/{parcel}', [ParcelController::class, 'update']);
    });
});
