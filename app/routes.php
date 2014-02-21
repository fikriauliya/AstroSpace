<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', 'HomeController@showWelcome');

//Friend
Route::post('addFriend/', 'FriendsController@addFriend');
Route::post('acceptFriend/', 'FriendsController@acceptFriend');
Route::post('removeFriend/', 'FriendsController@removeFriend');

//WebRTC testing
Route::get('webrtc/', 'WebRTCController@goToRoom');
Route::post('webrtc/createRoom', 'WebRTCController@createRoom');
Route::post('webrtc/approveRoom', 'WebRTCController@approveRoom');
Route::post('webrtc/inviteToRoom', 'WebRTCController@inviteToRoom');
Route::post('webrtc/exitRoom', 'WebRTCController@exitRoom');

// Auth
Route::controller('users', 'UsersController');
Route::controller('password', 'RemindersController');

//Ads
Route::controller('ads','AdsController');


// Profiles
Route::resource('profiles', 'ProfilesController', array('only' => array('show', 'edit', 'update')));
Route::resource('spaces', 'SpacesController', array('only'=> array('show', 'edit', 'update')));

Route::resource('themes', 'ThemesController', array('only' => array('edit', 'update')));
Route::resource('blogposts', 'BlogPostsController', array('only' => array('show', 'create', 'store')));
Route::resource('comments', 'CommentsController', array('only' => array('store')));
