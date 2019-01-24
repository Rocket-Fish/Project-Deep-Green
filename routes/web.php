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
* For example '^(?!(api|secret)).*$' separates out any routes which start with
* /api/ or /secret/
* this is so we can have an api and semi-secret access for me to make logins with
* We will however, be building this from a constant array for better scalability
*/

// obtain routes from constants
$routes = Config::get('constants.routes');
// calculate routes count
$routesCount = count($routes);
// define output text
$outputText = "";

// counter, because we don't need to add a | after the last item
$i = 0;
// iterate through the array
foreach ($routes as $r){
  $i++;

  // append array content
  $outputText .= $r;
  // add | if its not the last item
  if($i < $routesCount) {
    $outputText .= '|';
  }
}

//setup the route
Route::get('/{any}', 'PageController@index')->where('any', '^(?!('.$outputText.')).*$');

/* secret routing goes here
*
* secretRoute variable stores our route
*
*/
$secretRoute = '/' . Config::get('constants.routes.secret');
$apiRoute = '/' . Config::get('constants.routes.api');


// add prefix to the magic laravel facad
Route::group(['prefix' => $secretRoute], function () {
  // magic routing by default laravel
  Auth::routes();
  // secret home
  Route::get('/', 'HomeController@index')->name('home');
  // secret Projects
  Route::resource('/projects', 'ProjectsController');
});

// TODO: badkend api routing goes here
Route::group(['prefix' => $apiRoute], function () {
  Route::get('/projects', 'ProjectsApiController@index');
});
