<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Data
Route::post('/v1/business-data/create', [\App\Http\Controllers\Api\Business\BusinessDataController::class, 'store']);
Route::post('/v1/personal-data/create', [\App\Http\Controllers\Api\Personal\PersonalDataController::class, 'store']);