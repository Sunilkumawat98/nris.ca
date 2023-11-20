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
use App\Http\Controllers\Api\V1\StudentTalkController;
use App\Http\Controllers\Api\V1\TrainingPlacementController;
use App\Http\Controllers\Api\V1\SearchController;
use App\Http\Controllers\Api\V1\SubscribeNewsLetterController;
use App\Http\Controllers\Api\V1\BlogController;
use App\Http\Controllers\Api\V1\ForumController;
use App\Http\Controllers\Api\V1\MovieVideoController;

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
    Route::get('/get-all-sub-sub-category', [ClasifiedCategoryController::class,'getAllSubSubCategory']);

    Route::post('/get-all-subsub-category-under-sub-category', [ClasifiedCategoryController::class,'getAllSubSubCategoryUnderSubCategory']);
    Route::post('/get-free-clasified-by-id', [ClasifiedCategoryController::class,'getFreeClasifiedById']);
    
    Route::post('/get-recent-ads-list', [ClasifiedCategoryController::class,'getRecentAdsList']);
    Route::post('/get-recent-ads', [ClasifiedCategoryController::class,'getRecentAds']);
    Route::post('/search-free-ads', [ClasifiedCategoryController::class,'searchFreeAds']);
    Route::post('/get-free-ads-by-category', [ClasifiedCategoryController::class,'getFreeAdsByCategory']);
    

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
    Route::get('/get-all-source', [MovieRelatedController::class,'getAllRatingSource']);


    
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
    Route::post('/get-all-nris-talk-list', [NrisTalkController::class,'getAllNrisTalkList']);
    Route::post('/get-nris-talk-list', [NrisTalkController::class,'getNrisTalkList']);
    Route::post('/get-nris-talk-reply-by-id', [NrisTalkController::class,'getNrisTalkReplyById']);
    Route::post('/like-nris-talk-by-id', [NrisTalkController::class,'likeNrisTalkById']);



        /*
        Student talk, university
        &
        Its Reply

    */
    
    Route::get('/get-all-student-talk-category', [StudentTalkController::class,'getAllStudentTalkCategory']);
    Route::post('/get-all-university', [StudentTalkController::class,'getAllUniversity']);
    Route::post('/get-all-student-talk', [StudentTalkController::class,'getAllStudentTalk']);
    Route::post('/get-student-talk-by-category', [StudentTalkController::class,'getStudentTalkByCategory']);
    





    /*
        Login & Register
    */
    
    Route::post('/register', [LoginRegisterController::class,'register']);
    Route::post('/login', [LoginRegisterController::class,'login']);
    Route::post('/forgot-pass', [LoginRegisterController::class,'forgotPass']);
    Route::post('/forgot-password-change', [LoginRegisterController::class,'changeForgotPassword']); 

    // Route::get('google-login', [LoginRegisterController::class,'googleLogin']);
    // Route::any('google-callback', [LoginRegisterController::class,'handleGoogleCallback']);

    // Route::get('facebook-login', [LoginRegisterController::class,'facebookLogin']);
    // Route::any('facebook-callback', [LoginRegisterController::class,'handleCallback']);






    /**
     * 
     *  BLOG
     * 
    */

    Route::get('/get-all-blog-category', [BlogController::class,'getAllCategory']);
    Route::get('/get-homepage-blog', [BlogController::class,'getHomepageBlog']);
    Route::get('/get-all-blog', [BlogController::class,'getAllBlog']);
    Route::post('/get-blog-by-id', [BlogController::class,'getBlogById']);
    Route::post('/get-blog-by-category', [BlogController::class,'getBlogByCategory']);
    


    /**
     * 
     *  MOVIEVIDEO
     * 
    */

    Route::get('/get-all-movie-video-category', [MovieVideoController::class,'getAllCategory']);
    Route::get('/get-all-movie-video-language', [MovieVideoController::class,'getAllLanguage']);
    Route::get('/get-all-movie-video', [MovieVideoController::class,'getAllMovieVideo']);
    Route::post('/get-movie-video-by-category', [MovieVideoController::class,'getMovieVideoByCategory']);
    Route::post('/get-movie-video-by-language', [MovieVideoController::class,'getMovieVideoByLanguage']);
    Route::post('/search-movie-video', [MovieVideoController::class,'searchMovieVideo']);

    
    
    /*
    
    Training & Placements and itsCategory
    
    
    */



    Route::get('/get-all-training-category', [TrainingPlacementController::class,'getAllCategory']);
    Route::post('/get-training-list-by-category', [TrainingPlacementController::class,'getTraningPlacementListByCat']);
    Route::post('/get-all-training-list-by-category-id', [TrainingPlacementController::class,'getAllTrainingPlacementListByCategoryId']);
    Route::post('/get-training-by-id', [TrainingPlacementController::class,'getTrainingPlacementById']);



    /*

        Search 

    */
    Route::post('/country-search', [SearchController::class,'getCountrySearch']);
    Route::post('/state-search', [SearchController::class,'getStateSearch']);

    /*

        Subscribe NewsLetter 

    */
    Route::post('/subscribe-us', [SubscribeNewsLetterController::class,'subscribeNewsLetter']);


    

 /*
       Forum Listing category & Sub Category


    */

    Route::get('/get-all-forum-category', [ForumController::class,'getAllCategory']);
    Route::get('/get-all-forum-sub-category', [ForumController::class,'getAllSubCategory']);
    Route::post('/get-all-forum-sub-category-by-id', [ForumController::class,'getAllSubCategoryById']);
    Route::post('/get-all-forum-list-by-category-id', [ForumController::class,'getAllForumListByCategoryId']);
    Route::post('/get-forum-by-id', [ForumController::class,'getForumById']);
    


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
        $router->post('/comment-training-list', [TrainingPlacementController::class,'commentTrainingList']);
        $router->post('/get-training-list-by-user-id', [TrainingPlacementController::class,'getTrainingListByUserId']);

        $router->post('/add-student-university', [StudentTalkController::class,'addUniversityStudent']);
        $router->post('/create-student-talk', [StudentTalkController::class,'createStudentTalk']);

        $router->post('/create-forum', [ForumController::class,'createForum']);
        $router->post('/comment-forum', [ForumController::class,'commentForum']);

        $router->post('/blog-like', [BlogController::class,'blogLike']);
        $router->post('/blog-dislike', [BlogController::class,'blogDisLike']);

        $router->post('/movie-video-like', [MovieVideoController::class,'movieVideoLike']);
        $router->post('/movie-video-dislike', [MovieVideoController::class,'movieVideoDisLike']);
    });

    

});