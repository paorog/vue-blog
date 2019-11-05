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
    return view('auth.login');
});

Auth::routes();

Route::group(['middleware' => 'auth', 'prefix' => 'post'], function (){
    Route::get('all', 'PostController@getAllPosts');
    Route::post('create_post', 'PostController@createPost');
    Route::get('view_post/{slug}', 'PostController@viewPost')->where('slug', '[\w\d\-\_]+');
    Route::get('check_slug/{slug}', 'PostController@checkSlugAvailability');
});

Route::get('/home', 'HomeController@index')->name('home');