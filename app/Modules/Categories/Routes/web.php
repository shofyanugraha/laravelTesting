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

Route::group(['prefix' => 'category', 'middleware'=>'auth'], function () {
    Route::get('/', 'CategoryController@index');
    Route::get('/create', 'CategoryController@create');
    Route::post('/create', 'CategoryController@store');

    Route::get('/{id}/edit', 'CategoryController@edit');
    Route::post('/{id}/edit', 'CategoryController@update');
});
