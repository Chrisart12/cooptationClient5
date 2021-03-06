<?php
use App\Mail\Test;

use App\Http\Middleware\CorsPassport;
// use App\Http\Middleware\Cors;
use Illuminate\Http\Request;

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

//Initialisation de mot de passe
Route::post('/emailToPassword', 'CreatePasswordController@emailToPassword');
Route::post('/createPassword', 'CreatePasswordController@createPassword');

//ROUTES CANDIDATS
Route::post('/storeCandidat', 'CandidatController@storeCandidat')->middleware('auth:api');

//ROUTES LIKES
Route::post('/storeLike', 'LikeController@storeLike')->middleware('auth:api');
Route::delete('/deleteLike/{story_id}/{user_id}', 'LikeController@deleteLike')->middleware('auth:api');
//Selectionne tous les likes de l'utilisateur
Route::get('/allProfilLikes/{id}', 'LikeController@allProfilLikes')->middleware('auth:api');

//ROUTE DES STORIES
Route::post('/storeStories/{id}', 'StorieController@storeStories')->middleware('auth:api');
// Route::get('/allStories/{id}', 'StorieController@allStories');//->middleware('auth:api'); //le middleware exige l'authent..A remmettre après
Route::post('/allStories', 'StorieController@allStories')->name("allStories")->middleware('auth:api');

Route::post('/gallerySearch/{id}/', 'StorieController@gallerySearch')->middleware('auth:api'); //le middleware exige l'authent..A remmettre après
Route::get('/stories/{story_id}/{user_id}', 'StorieController@show');//->middleware('auth:api');// A remettre après
//Route::post('/updateStories/{id}', 'StorieController@updateStories')->middleware('cors');
Route::post('/updateStories/{id}', 'StorieController@updateStories')->middleware('auth:api');
Route::post('/validateStories', 'StorieController@validateStories')->middleware('auth:api');
Route::get('/storiesIsActive/{id}', 'StorieController@storiesIsActive');
// Route::post('/suggestions', 'StorieController@suggestions');

Route::post('/showImage/{id}', 'StorieController@showImage')->middleware('auth:api');

//ROUTE USER 
Route::get('/userProfil/{id}', 'StorieController@userProfil')->middleware('auth:api'); 
Route::get('/user/{user_id}', 'StorieController@isActive');

//ROUTE JOBS
Route::get('/jobs', 'JobApiController@showJobs')->middleware('auth:api'); 
Route::get('/job/{jobId}', 'JobApiController@showJob')->middleware('auth:api');

//ROUTE COOPTATION
Route::post('/coopter', 'CooptationController@coopter')->name('coopter')->middleware('auth:api');
