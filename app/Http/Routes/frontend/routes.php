<?php

require app_path('Http/Routes/frontend/routesApi.php');
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
//frontend
Route::get('/', ['as' => 'home', 'uses' => 'frontend\HomeController@index']);
Route::get('/login', ['as' => 'login', 'uses' => 'frontend\HomeController@authen']);
Route::get('/register', ['as' => 'login', 'uses' => 'frontend\HomeController@register']);
Route::get('/profile', ['as' => 'profile', 'uses' => 'frontend\HomeController@profile']);
Route::get('/menu', function () {
    return view('frontend/base/menu');
});
// Authentication routes...
//Route::get('auth/login', 'Auth\AuthController@getLogin');
//Route::get('auth/login', 'Auth\AuthController@getLogin');
//Route::post('auth/login', 'Auth\AuthController@postLogin');
//Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
// Route::get('auth/register', ['as' => 'profile', 'uses' => 'Auth\AuthController@create']);
//Route::post('auth/register', 'Auth\AuthController@postRegister');