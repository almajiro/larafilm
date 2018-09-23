<?php

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

Route::get('/', 'LaraFilmController@version');
Route::resource('companies', 'Companies\CompaniesController');
Route::resource('tvs', 'Tvs\TvsController');
Route::resource('genres', 'Genres\GenresController');
Route::resource('persons', 'Persons\PersonsController');
Route::resource('actors', 'Actors\ActorsController');
