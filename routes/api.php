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
use App\Http\Controllers\Api\V1\BusinessListingController;
use App\Http\Controllers\Api\V1\NationalEventController;

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
    
    Route::post('/get-recent-ads-list', [ClasifiedCategoryController::class,'getRecentAdsList']);
    Route::post('/get-recent-ads', [ClasifiedCategoryController::class,'getRecentAds']);
    

 /*
       Business Listing category & Sub Category


    */

    Route::get('/get-all-business-category', [BusinessListingController::class,'getAllCategory']);
    Route::get('/get-all-business-sub-category', [BusinessListingController::class,'getAllSubCategory']);
    Route::post('/get-all-business-sub-category-by-id', [BusinessListingController::class,'getAllSubCategoryById']);
    Route::post('/get-business-list-by-category', [BusinessListingController::class,'getBusinessListByCat']);
    Route::post('/get-all-business-list-by-category-id', [BusinessListingController::class,'getAllBusinessListByCategoryId']);
    Route::post('/get-business-by-id', [BusinessListingController::class,'getBusinessById']);
    




    /*
    
    National Event & Category
    
    
    */



    Route::get('/get-all-events-category', [NationalEventController::class,'getAllCategory']);
    Route::post('/get-events-list-by-category', [NationalEventController::class,'getEventListByCat']);
    Route::post('/get-all-events-list-by-category-id', [NationalEventController::class,'getAllEventListByCategoryId']);
    Route::post('/get-event-by-id', [NationalEventController::class,'geteventById']);


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

    
    
    /*
        Nris talk 
        &
        Its Reply

    */
    Route::post('/get-all-nris-talk', [NrisTalkController::class,'getAllNrisTalk']);
    Route::post('/get-nris-talk-list', [NrisTalkController::class,'getNrisTalkList']);
    Route::post('/get-nris-talk-reply-by-id', [NrisTalkController::class,'getNrisTalkReplyById']);
    Route::post('/like-nris-talk-by-id', [NrisTalkController::class,'likeNrisTalkById']);




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
        $router->post('/review-business-list', [BusinessListingController::class,'reviewBusinessList']);
        $router->post('/comment-event-list', [NationalEventController::class,'commentEventList']);
    
    });

    

});