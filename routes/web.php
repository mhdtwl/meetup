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
    Route::get('subscriptions/invite/{groupId}/{userId}', 'SubscriptionController@invite')->name("group.invite");
    //Route::post('subscriptions/invite/{groupId}/{userId}', 'SubscriptionController@inviteStore')->name("group.invite.store");

    Route::resource('users', 'UserController');
    Route::resource('groups', 'GroupController');
    Route::resource('interests', 'InterestController');
    Route::resource('subscriptions', 'SubscriptionController');
    Route::resource('group-interest', 'GroupInterestController');


});