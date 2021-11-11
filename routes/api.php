<?php

use App\Http\Controllers\DailyLogController;
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

Route::middleware('api')->group(function () {
    Route::middleware('janedoe')->group(function () {
        Route::post('/daily-logs-store', [DailyLogController::class, 'store'])->name('daily-logs.store');
    });
    Route::put('/daily-logs-update/{id}', [DailyLogController::class, 'update'])->name('daily-logs.update');
    Route::delete('/daily-logs-delete/{id}', [DailyLogController::class, 'destroy'])->name('daily-logs.delete');
});