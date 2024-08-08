<?php

use App\Http\Controllers\API\SpotController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

/** Endpoint spot */
Route::prefix('v1')->group(function(){
    Route::resource('spot',SpotController::class);
});
