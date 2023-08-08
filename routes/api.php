<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1;
use App\Http\Controllers\Api\V1\CountryStateCityController;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\Api\V1\LoginRegisterController;
use App\Http\Controllers\Api\V1\NrisTalkController;
use App\Http\Controllers\Api\V1\ClasifiedCategoryController;
use App\Http\Controllers\Api\V1\MovieRelatedController;

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



    /*
        Free Clasiffied category & Sub Category

    */

    Route::get('/get-all-category', [ClasifiedCategoryController::class,'getAllCategory']);
    Route::get('/get-all-sub-category', [ClasifiedCategoryController::class,'getAllSubCategory']);
    Route::post('/get-all-sub-category-by-id', [ClasifiedCategoryController::class,'getAllSubCategoryById']);
    
    Route::post('/get-free-clasified-by-id', [ClasifiedCategoryController::class,'getFreeClasifiedById']);
    Route::get('/get-recent-ads', [ClasifiedCategoryController::class,'getRecentAds']);



    /*

        Movie Rating
        Movie Source
        Desi Movies
    
    */

    Route::get('/get-movie-ratings', [MovieRelatedController::class,'getMovieRatings']);
    Route::get('/get-all-movie-ratings', [MovieRelatedController::class,'getAllMovieRatings']);
    Route::post('/get-all-desi-movies', [MovieRelatedController::class,'getAllDesiMovies']);
    Route::post('/get-latest-desi-movies', [MovieRelatedController::class,'getLatestDesiMovies']);


    
    /*
        Country, State
        &
        Cities

    */

    Route::get('/get-all-country', [CountryStateCityController::class,'getAllCountry']);
    Route::post('/get-all-state-by-country', [CountryStateCityController::class,'getAllStateByCountry']);
    Route::post('/get-all-city-by-state-and-country', [CountryStateCityController::class,'getAllCityByStateAndCountry']);


    Route::get('/get-all-nris-talk', [NrisTalkController::class,'getAllNrisTalk']);
    Route::post('/get-nris-talk-reply-by-id', [NrisTalkController::class,'getNrisTalkReplyById']);




    /*
        Login & Register
    */
    
    Route::post('/register', [LoginRegisterController::class,'register']);
    Route::post('/login', [LoginRegisterController::class,'login']);
    Route::post('/forgot-pass', [LoginRegisterController::class,'forgotPass']);
    Route::post('/forgot-password-change', [LoginRegisterController::class,'changeForgotPassword']); 




    /*
        After Login Start
    */

    Route::group(['middleware' => ['jwtAuth']], function($router) {
        
        $router->post('/get-user-profile', [UserController::class,'getUserProfile']);
        $router->post('/change-password', [UserController::class,'changePassword']); 

        $router->post('/create-nris-talk', [NrisTalkController::class,'createNrisTalk']); 
        $router->post('/create-nris-talk-reply', [NrisTalkController::class,'createNrisTalkReply']); 
        $router->post('/get-nris-talk', [NrisTalkController::class,'getNrisTalk']); 
        $router->post('/create-free-clasified', [ClasifiedCategoryController::class,'createFreeClasified']);
        $router->post('/create-free-clasified-bid', [ClasifiedCategoryController::class,'createFreeClasifiedBid']);
        $router->post('/create-free-clasified-comment', [ClasifiedCategoryController::class,'createFreeClasifiedComment']);
    
    });

    

});