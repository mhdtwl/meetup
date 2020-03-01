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


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();



Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function()
{
    //Route::prefix('/subscriptions')->group(function () {
        // web invitation..
        Route::get('/invite/{groupId}/{userId}', 'SubscriptionController@invite')->name("group.invite");
        Route::get('/my/groups', 'SubscriptionController@myGroups')->name("myGroups");
        Route::get('/my/people', 'SubscriptionController@myPeople')->name("myPeople");
        Route::get('/my/invites', 'SubscriptionController@myInvites')->name("myInvites");
    //});

    // all resource
    Route::resource('users', 'UserController');
    Route::resource('groups', 'GroupController');
    Route::resource('interests', 'InterestController');
    Route::resource('subscriptions', 'SubscriptionController');
    Route::resource('group-interest', 'GroupInterestController');
});