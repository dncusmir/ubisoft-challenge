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

Route::get('tournaments/{id}', 'Api\TournamentsController@show');
Route::get('tournaments/{id}/games', 'Api\TournamentsController@games');

Route::get('users/{id}', 'Api\UsersController@show');
Route::patch('users/{id}', 'Api\UsersController@edit');
