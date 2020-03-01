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
    // WebApp apis
    Route::get("/users", "UserController@getSearchableUserTable");
    //?draw=1&length=10&column=0&dir11=desc


    Route::post("/login", "LoginController@login");//->name('login');;

    Route::prefix('/user')->middleware('auth:api')->group(function () {
        Route::get("/all", "LoginController@userAll");
    });

});

