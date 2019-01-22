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
* the '^(?!api).*$' part separates out any routes which start with /api/
* this is so we can have an api to work with
*/
Route::get('/{any}', 'PageController@index')->where('any', '^(?!api).*$');

// TODO: badkend api routing goes here
