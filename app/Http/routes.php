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

Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);
Route::get('/login', ['as' => 'login', 'uses' => 'HomeController@authen']);
Route::get('/register', ['as' => 'login', 'uses' => 'HomeController@register']);
Route::get('/profile', ['as' => 'profile', 'uses' => 'HomeController@profile']);
Route::get('/menu', function () {
    return view('frontend/base/menu');
});

// Authentication routes...
//Route::get('auth/login', 'Auth\AuthController@getLogin');
//Route::get('auth/login', 'Auth\AuthController@getLogin');
//Route::post('auth/login', 'Auth\AuthController@postLogin');
//Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', ['as' => 'profile', 'uses' => 'Auth\AuthController@create']);
//Route::post('auth/register', 'Auth\AuthController@postRegister');