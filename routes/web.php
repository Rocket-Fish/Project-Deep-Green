<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
* Give Vue js Route control for all default cases
* the '^(?!(api|secret)).*$' part separates out any routes which start with
* /api/ or /secret/
* this is so we can have an api and semi-secret access for me to make logins with
*/
Route::get('/{any}', 'PageController@index')->where('any', '^(?!(api|secret)).*$');

// TODO: secret routing goes here

// TODO: badkend api routing goes here
