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
// url: /api/auth/
Route::prefix('auth')->group(function () {


    Route::get('count', 'API\AuthController@counts');

    Route::post('sign-up', 'API\AuthController@signUp');
    Route::post('login', 'API\AuthController@logIn');

    Route::get('users', 'API\AuthController@index');
    Route::put('change/{user}', 'API\AuthController@update');


    // User Should be connected !
    Route::group(['middleware' => 'auth:api'], function () {

        Route::get('logout', 'API\AuthController@logout');
        Route::get('user', 'API\AuthController@user');

    });

});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('children')->group(function () {

    Route::get('count', 'ChildController@counts');

    Route::get('', 'ChildController@index');
    Route::get('{id}', 'ChildController@show');
    Route::post('', 'ChildController@store');
    Route::post('{child}', 'ChildController@update');
    Route::delete('{child}', 'ChildController@destroy');


});

Route::prefix('educators')->group(function () {

    Route::get('', 'EducatorsController@index');
    Route::get('{id}', 'EducatorsController@show');
    Route::post('', 'EducatorsController@store');
//    Route::put('{child}', 'EducatorsController@update');

});

Route::prefix('sources')->group(function () {
    Route::get('', 'SourceController@index');
    Route::post('', 'SourceController@store');
});
