<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\StateController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\PermissionRoleController;
use App\Http\Controllers\Admin\ClassifiedCategoryController;
use App\Http\Controllers\Admin\ClassifiedSubCategoryController;
use App\Http\Controllers\Admin\FreeClassifiedController;
use App\Http\Controllers\Admin\RatingSourceController;
use App\Http\Controllers\Admin\MovieRatingController;
use App\Http\Controllers\Admin\DesiMovieController;
use App\Http\Controllers\Admin\BusinessCategoryController;
use App\Http\Controllers\Admin\BusinessSubCategoryController;
use App\Http\Controllers\Admin\BusinessListingController;
use App\Http\Controllers\Admin\EventCategoryController;
use App\Http\Controllers\Admin\NationalEventController;
use App\Http\Controllers\Admin\StudentTalkCategoryController;
use App\Http\Controllers\Admin\UniversityController;
use App\Http\Controllers\Admin\StudentTalkController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });



Route::domain(config('app.domain'))->group(function () {

    
    Route::group(['middleware' =>'admin.guest'], function () {
        Route::get('/', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
        Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.dologin');
        
    });

    Route::group(['middleware' =>'admin.auth'], function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'showDashboard'])->name('admin.dashboard');
        Route::get('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

        Route::resource('country', CountryController::class);
        Route::post('/country/{id}/active-status', [CountryController::class, 'livePause'])->name('country.activeStatus');
        


        Route::resource('state', StateController::class);
        Route::post('/state/{id}/active-status', [StateController::class, 'livePause'])->name('state.activeStatus');

        Route::resource('city', CityController::class);
        Route::post('/city/{id}/active-status', [CityController::class, 'livePause'])->name('city.activeStatus');


        Route::resource('admin_user', AdminUserController::class);
        Route::post('/admin_user/{id}/active-status', [AdminUserController::class, 'livePause'])->name('admin_user.activeStatus');

        Route::resource('role', RoleController::class);
        Route::post('/role/{id}/active-status', [RoleController::class, 'livePause'])->name('role.activeStatus');

        Route::resource('permission', PermissionController::class);
        Route::post('/permission/{id}/active-status', [PermissionController::class, 'livePause'])->name('permission.activeStatus');

        Route::resource('permission_role', PermissionRoleController::class);
        Route::post('/permission_role/{id}/active-status', [PermissionRoleController::class, 'livePause'])->name('permission_role.activeStatus');
        Route::get('/get-permissions/{roleId}', [PermissionRoleController::class, 'getAllPermissions']);



        Route::resource('classified_category', ClassifiedCategoryController::class);
        Route::post('/classified_category/{id}/active-status', [ClassifiedCategoryController::class, 'livePause'])->name('classified_category.activeStatus');

        Route::resource('classified_sub_category', ClassifiedSubCategoryController::class);
        Route::post('/classified_sub_category/{id}/active-status', [ClassifiedSubCategoryController::class, 'livePause'])->name('classified_sub_category.activeStatus');

        Route::resource('free_classified', FreeClassifiedController::class);
        Route::post('/free_classified/{id}/active-status', [FreeClassifiedController::class, 'livePause'])->name('free_classified.activeStatus');

        Route::resource('rating_source', RatingSourceController::class);
        Route::post('/rating_source/{id}/active-status', [RatingSourceController::class, 'livePause'])->name('rating_source.activeStatus');

        Route::resource('movie_rating', MovieRatingController::class);
        Route::post('/movie_rating/{id}/active-status', [MovieRatingController::class, 'livePause'])->name('movie_rating.activeStatus');

        Route::resource('desi_movies', DesiMovieController::class);
        Route::post('/desi_movies/{id}/active-status', [DesiMovieController::class, 'livePause'])->name('desi_movies.activeStatus');

        Route::resource('business_listing', BusinessListingController::class);
        Route::post('/business_listing/{id}/active-status', [BusinessListingController::class, 'livePause'])->name('business_listing.activeStatus');

        Route::resource('business_category', BusinessCategoryController::class);
        Route::post('/business_category/{id}/active-status', [BusinessCategoryController::class, 'livePause'])->name('business_category.activeStatus');

        Route::resource('business_sub_category', BusinessSubCategoryController::class);
        Route::post('/business_sub_category/{id}/active-status', [BusinessSubCategoryController::class, 'livePause'])->name('business_sub_category.activeStatus');

        


        Route::resource('events_category', EventCategoryController::class);
        Route::post('/events_category/{id}/active-status', [EventCategoryController::class, 'livePause'])->name('events_category.activeStatus');

        Route::resource('national_events', NationalEventController::class);
        Route::post('/national_events/{id}/active-status', [NationalEventController::class, 'livePause'])->name('national_events.activeStatus');





        Route::resource('student_talk_category', StudentTalkCategoryController::class);
        Route::post('/student_talk_category/{id}/active-status', [StudentTalkCategoryController::class, 'livePause'])->name('student_talk_category.activeStatus');



        Route::resource('university', UniversityController::class);
        Route::post('/university/{id}/active-status', [UniversityController::class, 'livePause'])->name('university.activeStatus');




        Route::resource('student_talk', StudentTalkController::class);
        Route::post('/student_talk/{id}/active-status', [StudentTalkController::class, 'livePause'])->name('student_talk.activeStatus');







        
        Route::get('/get-state-by-country-id', [StateController::class, 'getStateByCountryId']);
        Route::get('/get-city-by-state-id', [CityController::class, 'getCityByStateId']);





        
    });
    
});



