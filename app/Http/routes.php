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
Route::get('/profile', ['as' => 'profile', 'uses' => 'HomeController@profile']);
Route::get('/menu', function () {
    return view('frontend/base/menu');
});