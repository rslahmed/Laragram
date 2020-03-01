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
//welcome
Route::get('/', function () {
    return view('welcome');
});
//auth
Auth::routes();
//home
Route::get('/home', 'PostController@index')->name('home');
// profile route
Route::get('/profile/view/{id}', 'ProfileController@index');
//post route
Route::get('/post/view/{id}', 'PostController@view');

//auth middleware
Route::group(['middleware' => ['auth']], function () {
    // profile route
    Route::get('/profile/edit', 'ProfileController@edit');
    Route::post('/profile/update', 'ProfileController@update');
    Route::get('/password/change', 'ProfileController@editPassword');
    Route::post('/password/update', 'ProfileController@updatePassword');
    //post route
    Route::get('/post/add', 'PostController@create');
    Route::post('/post/store', 'PostController@store');
    Route::get('/post/edit/{id}', 'PostController@edit');
    Route::post('/post/update/{id}', 'PostController@update');
    Route::get('/post/delete/{id}', 'PostController@delete');
    //follow
    Route::get('/follow/{user}', 'FollowerController@follow');
    Route::get('/unfollow/{user}', 'FollowerController@unfollow');
    //heart
    Route::get('/like/{post}', 'HeartController@like');
    //comment
    Route::post('/comment/{post}', 'CommentController@comment');
});
