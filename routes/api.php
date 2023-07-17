<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });




Route::group(['prefix' => 'v1', 'namespace' => 'Api\V1'], function () {


    // Route::post('get-all-country', [\App\Http\Controllers\Api\V1\CountryStateCityController::class, 'getAllCountry']);
    /*
        Country, State
        &
        Cities

    */

    Route::post('/get-all-country', [App\Http\Controllers\Api\V1\CountryStateCityController::class,'getAllCountry']);
    Route::post('/get-all-state-by-country', [App\Http\Controllers\Api\V1\CountryStateCityController::class,'getAllStateByCountry']);
    Route::post('/get-all-city-by-state-and-country', [App\Http\Controllers\Api\V1\CountryStateCityController::class,'getAllCityByStateAndCountry']);



});