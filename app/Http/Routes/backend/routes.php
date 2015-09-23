<?php

require app_path('Http/Routes/backend/routesApi.php');
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
Route::get('/admin', ['as' => 'admin', 'uses' => 'backend\BackendController@index']);
