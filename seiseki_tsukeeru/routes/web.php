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

Route::get('/', 'JansoController@index')->name('janso_list');
Route::get('/create', 'JansoController@create')->name('janso_registration');
Route::post('/create', 'JansoController@store')->name('janso_registration');

