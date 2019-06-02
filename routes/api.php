<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
  
    Route::group([
      'middleware' => 'auth:api'
    ], function() {
        //Users
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');
        //Roles
        Route::post('role/create','RoleController@create');
        Route::get('role/update/{id}','RoleController@update');
        Route::get('roles','RoleController@list');
        //Common Areas
        Route::post('commonArea/create','CommonAreaController@create');
        Route::get('commonArea/update/{id}','CommonAreaController@update');
        Route::get('commonAreas','CommonAreaController@list');
    });
});