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
    // WebApp apis //?draw=1&length=10&column=0&search="11"&dir11=desc
    Route::get("/users", "UserService@getSearchableUserTable");
    // auth
    Route::post("/login", "LoginService@login");//->name('login');;
    // Subscription service.
    Route::prefix('/subscriber')->middleware('auth:api')->group(function () {
        Route::get("/my-groups", "SubscriptionService@getMyGroups");
        Route::get("/my-users", "SubscriptionService@getMyPeople");
        Route::get("/my-invites", "SubscriptionService@getMyInvitations");
        Route::post("/invite", "SubscriptionService@inviteUserToGroup");
    });

});

