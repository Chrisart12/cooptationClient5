<?php

use App\Http\Middleware\CorsPassport;
use App\Http\Middleware\Cors;
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

//ROUTES OFFRES
//Route::apiResource('/offres', 'OffreController')->middleware('cors');
Route::get('/offres', 'OffreController@index');
Route::get('/offres/{offre}', 'OffreController@show');

//ROUTES CANDIDATS
//Route::apiResource('/candidats', 'CandidatController');//->middleware('cors');
Route::post('/storeCandidat', 'CandidatController@storeCandidat');

//ROUTES LIKES
//Route::apiResource('/likes', 'LikeController')->middleware('cors');
Route::post('/storeLike', 'LikeController@storeLike');
Route::delete('/deleteLike/{id}', 'LikeController@deleteLike');
//Selectionne tous les likes de l'utilisateur
Route::get('/allProfilLikes/{id}', 'LikeController@allProfilLike');

//ROUTE DES STORIES
//Route::apiResource('/stories', 'StorieController')->middleware('corspassport');
Route::post('/storeStories/{id}', 'StorieController@storeStories');//->middleware('cors');
Route::get('/allStories', 'StorieController@allStories');//->middleware('cors');
Route::get('/stories/{id}', 'StorieController@show');//->middleware('cors');
//Route::post('/updateStories/{id}', 'StorieController@updateStories')->middleware('cors');
Route::post('/updateStories/{id}', 'StorieController@updateStories');
Route::post('/validateStories/{id}', 'StorieController@validateStories');
Route::get('/storiesIsActive/{id}', 'StorieController@storiesIsActive');

