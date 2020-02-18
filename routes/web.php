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

// profile route
Route::get('/profile/view/{id}', 'ProfileController@index');
Route::get('/profile/edit', 'ProfileController@edit')->middleware('auth');
Route::post('/profile/update', 'ProfileController@update')->middleware('auth');


//post route
Route::get('/post/add', 'PostController@create')->middleware('auth');
Route::post('/post/store', 'PostController@store')->middleware('auth');
Route::get('/post/view/{id}', 'PostController@view');
