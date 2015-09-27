<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
//backend
//Route::get('/@min', ['as' => 'admin', 'uses' => 'backend\BackendController@index']);

// Authentication routes...
Route::get('auth/login', ['as' => 'login', 'uses' => 'backend\BackendController@login']);
Route::post('auth/authen', ['as' => 'authen', 'uses' => 'backend\BackendController@authen']);
Route::get('auth/register', ['as' => 'register', 'uses' => 'backend\BackendController@register']);
Route::get('auth/logout', ['as' => 'admin/logout', 'uses' => 'backend\BackendController@logout']);
//Route::get('auth/login', 'Auth\AuthController@getLogin');
//Route::post('auth/login', 'Auth\AuthController@postLogin');
//Route::get('auth/logout', 'Auth\AuthController@getLogout');

Route::group(['prefix' => '@min'], function () {
  
    Route::get('/', ['middleware' => 'auth', 'uses' => 'backend\BackendController@index']);
});
