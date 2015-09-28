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

Route::group(['prefix' => '@min', 'middleware' => 'auth'], function () {
  
    //dashboard
    Route::get('/', [ 'as' => 'dashboard', 'uses' => 'backend\BackendController@index']);
    Route::post('/system-info', ['as' => 'update/system', 'uses' => 'backend\BackendController@updateSystem']);
    
    //user
    Route::get('/user/index', ['as' => 'user/index', 'uses' => 'backend\UserController@index']);
    Route::get('/user/add', ['as' => 'user/add', 'uses' => 'backend\UserController@add']);
    Route::get('/user/edit', ['as' => 'user/edit', 'uses' => 'backend\UserController@edit']);
    //user api
    Route::post('api-user-add', ['as' => 'api-user-add', 'uses' => 'backend\UserController@getAdd']);
    Route::post('api-user-edit', ['as' => 'api-user-edit', 'uses' => 'backend\UserController@getEdit']);
    Route::post('api-user-status', ['as' => 'api-user-status', 'uses' => 'backend\UserController@getStatus']);
    
});
