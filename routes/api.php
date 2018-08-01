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

Route::prefix('v1')->group(function () {
    Route::post('register', 'Users\AuthController@register')->name('users.register');
    Route::post('login', 'Users\AuthController@login')->name('users.login');

    Route::group(['prefix' => 'auth', 'middleware' => 'jwt.auth'], function () {
        Route::middleware('jwt.refresh')->get('/token/refresh', 'Users\AuthController@refresh')->name('users.token');
        Route::post('logout', 'Users\AuthController@logout')->name('users.logout');

    });
    Route::group(['middleware' => 'jwt.auth'], function () {

    });
});
