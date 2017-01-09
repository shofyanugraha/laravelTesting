<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your module. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
Route::get('/', 'AuthenticationController@index');
Route::group(['prefix' => 'auth'], function () {
    Route::get('/login', 'AuthenticationController@index');
    Route::post('/session', 'AuthenticationController@session');
});
Route::group(['middleware' => 'auth'], function () {
	Route::get('/logout', 'AuthenticationController@logout');
});
