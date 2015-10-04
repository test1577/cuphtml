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

// Authentication routes...
Route::get('auth/login', ['as' => 'login', 'uses' => 'backend\BackendController@login']);
Route::post('auth/authen', ['as' => 'authen', 'uses' => 'backend\BackendController@authen']);
Route::get('auth/register', ['as' => 'register', 'uses' => 'backend\BackendController@register']);
Route::get('auth/logout', ['as' => 'admin/logout', 'uses' => 'backend\BackendController@logout']);

//@min
Route::group(['prefix' => '@min', 'middleware' => 'auth'], function () {
    //dashboard
    Route::get('/', [ 'as' => 'dashboard', 'uses' => 'backend\BackendController@index']);
    Route::post('/system-info', ['as' => 'update/system', 'uses' => 'backend\BackendController@updateSystem']);
    //user
    Route::get('/user/add', ['as' => 'user/add', 'uses' => 'backend\UserController@add']);
    Route::get('/user/edit/{id}', ['as' => 'user/edit', 'uses' => 'backend\UserController@edit']);
    Route::get('/user/index', ['as' => 'user/index', 'uses' => 'backend\UserController@index']);
    //user api
    Route::any('api-user-get', ['as' => 'api-user-get', 'uses' => 'backend\UserController@get']);
    Route::post('api-user-add', ['as' => 'api-user-add', 'uses' => 'backend\UserController@getAdd']);
    Route::post('api-user-edit', ['as' => 'api-user-edit', 'uses' => 'backend\UserController@getEdit']);
    Route::post('api-user-status', ['as' => 'api-user-status', 'uses' => 'backend\UserController@getStatus']);
    Route::post('api-user-get-where', ['as' => 'api-user-get-where', 'uses' => 'backend\UserController@getWhere']);
    Route::post('api-user-delete-where', ['as' => 'api-user-delete-where', 'uses' => 'backend\UserController@getDeleteWhere']);
    Route::post('api-user-update-where', ['as' => 'api-user-update-where', 'uses' => 'backend\UserController@getUpdateWhere']);
    //user submit
    Route::post('api-user-add-form-where', ['as' => 'user-add', 'uses' => 'backend\UserController@getAddFormWhere']);
    Route::post('api-user-update-form-where', ['as' => 'user-update', 'uses' => 'backend\UserController@getUpdateFormWhere']);
    
    //admin
    Route::get('/admin/add', ['as' => 'admin/add', 'uses' => 'backend\AdminController@add']);
    Route::get('/admin/edit/{id}', ['as' => 'admin/edit', 'uses' => 'backend\AdminController@edit']);
    Route::get('/admin/index', ['as' => 'admin/index', 'uses' => 'backend\AdminController@index']);
    //admin api
    Route::any('api-admin-get', ['as' => 'api-admin-get', 'uses' => 'backend\AdminController@get']);
    Route::post('api-admin-add', ['as' => 'api-admin-add', 'uses' => 'backend\AdminController@getAdd']);
    Route::post('api-admin-edit', ['as' => 'api-admin-edit', 'uses' => 'backend\AdminController@getEdit']);
    Route::post('api-admin-status', ['as' => 'api-admin-status', 'uses' => 'backend\AdminController@getStatus']);
    Route::post('api-admin-get-where', ['as' => 'api-admin-get-where', 'uses' => 'backend\AdminController@getWhere']);
    Route::post('api-admin-delete-where', ['as' => 'api-admin-delete-where', 'uses' => 'backend\AdminController@getDeleteWhere']);
    Route::post('api-admin-update-where', ['as' => 'api-admin-update-where', 'uses' => 'backend\AdminController@getUpdateWhere']);
    //admin submit
    Route::post('api-admin-add-form-where', ['as' => 'admin-add', 'uses' => 'backend\AdminController@getAddFormWhere']);
    Route::post('api-admin-update-form-where', ['as' => 'admin-update', 'uses' => 'backend\AdminController@getUpdateFormWhere']);
    
});

//Helper
Route::any('validate-email', ['as' => 'validate-email', 'uses' => 'backend\HelperController@validateEmail']);
