<?php

use App\Mail\Test;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Je fais une redirection vers la page login
Route::get('/', function () {
	return redirect()->route('login');
});


Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
Route::get('/gallery', 'GalleryController@index')->name('gallery')->middleware(['auth', 'role:admin']);
Route::get('/top30', 'GalleryController@top30')->name('top30')->middleware(['auth', 'role:admin']);
Route::get('/gallery/{id}', 'GalleryController@show')->name('story')->middleware(['auth', 'role:admin']);
Route::get('/jobs', 'JobController@showjobs')->name('jobs')->middleware(['auth', 'role:admin']);
Route::get('/job/{jobId}', 'JobController@showjob')->name('job')->middleware(['auth', 'role:admin']);
Route::get('/cooptation', 'CooptationController@index')->name('cooptation')->middleware(['auth', 'role:admin']);
Route::get('/cooptants', 'CooptationController@cooptants')->name('cooptants')->middleware(['auth', 'role:admin']);
Route::get('/cooptant/{id}', 'CooptationController@cooptant')->name('cooptant')->middleware(['auth', 'role:admin']);
Route::get('/cooptant/candidat/{candidatId}', 'CooptationController@candidat')->name('candidat')->middleware(['auth', 'role:admin']);
Route::post('/cooptant/candidat/etapes', 'CooptationController@etapes')->name('etapes')->middleware(['auth', 'role:admin']);

Route::get('/historic', 'HistoricController@index')->name('historic')->middleware('role:super_admin');
                                                    // ->middleware(['auth', 'SuperAdmin:superAdmin@gmail.com']);

// Route::get('/foundUserRegion', 'DatabaseController@foundUserRegion')->name('foundUserRegion');
// Route::get('/foundUserResponsible', 'DatabaseController@foundUserResponsible')->name('foundUserResponsible');

