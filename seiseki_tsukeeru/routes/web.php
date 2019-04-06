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

Auth::routes();

Route::get('/', 'JansoController@show')->name('janso_list');
Route::get('/create', 'JansoController@create')->name('janso_registration');
Route::post('/create', 'JansoController@store')->name('janso_registration');
Route::get('/{janso_id}/score', 'ScoreController@index')->name('score_detail');
Route::get('/{janso_id}/score_registration', 'ScoreController@create')->name('score_registration');
Route::post('/{janso_id}/score_registration', 'ScoreController@store')->name('score_registration');
Route::get('/{janso_id}/history', 'ScoreController@show')->name('game_history');
