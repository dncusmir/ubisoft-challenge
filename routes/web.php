<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('sports/create', 'SportsController@create')->name('sports.create');
Route::post('sports', 'SportsController@store')->name('sports.store');
Route::get('sports', 'SportsController@index')->name('sports.index');
Route::get('sports/{id}', 'SportsController@show')->name('sports.show');

Route::get('teams/create', 'TeamsController@create')->name('teams.create');
Route::post('teams', 'TeamsController@store')->name('teams.store');
Route::get('teams', 'TeamsController@index')->name('teams.index');
Route::get('teams/{team}', 'TeamsController@show')->name('teams.show');

Route::get('tournaments/create', 'TournamentsController@create')->name('tournaments.create');
Route::post('tournaments', 'TournamentsController@store')->name('tournaments.store');
Route::get('tournaments', 'TournamentsController@index')->name('tournaments.index');
Route::get('tournaments/{id}', 'TournamentsController@show')->name('tournaments.show');
