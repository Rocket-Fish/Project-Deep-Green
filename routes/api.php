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

$authRoute = '/' . Config::get('constants.routes.auth');

Route::group(['prefix' => $authRoute], function () {
    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@login');

    Route::group(['middleware' => 'jwt.auth'], function(){
      Route::get('user', 'AuthController@user');
      Route::post('logout', 'AuthController@logout');
    });

    Route::group(['middleware' => 'jwt.refresh'], function(){
      Route::get('refresh', 'AuthController@refresh');
    });
});

/*
* We use the index like this because we want our index to reply even without Auth
* but we dont want unauthorized access to our other stuff like creating and changing
*/
Route::resource('cruds', 'CurdsController')->only(['index']);
Route::group(['middleware' => 'jwt.auth'], function(){
    Route::resource('cruds', 'CurdsController')->except(['edit', 'show', 'store', 'index']);
});

Route::resource('projects', 'ProjectsController')->only(['index']);
Route::group(['middleware' => 'jwt.auth'], function(){
    Route::resource('projects', 'ProjectsController')->except(['edit', 'show', 'store', 'index']);
});
