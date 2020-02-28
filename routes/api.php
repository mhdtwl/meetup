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


Route::namespace("ApiV1")->group(function () {
    Route::get("/users", "LoginController@users");

    Route::post("/login", "LoginController@login");//->name('login');;

    Route::prefix('/user')->middleware('auth:api')->group(function () {
        Route::get("/all", "LoginController@userAll");
    });

});