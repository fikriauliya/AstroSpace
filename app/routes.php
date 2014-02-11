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
Route::post('addFriend/', 'FriendsController@addFriend');
Route::post('acceptFriend/', 'FriendsController@acceptFriend');
Route::post('removeFriend/', 'FriendsController@removeFriend');


// Auth
Route::controller('users', 'UsersController');

// Profiles
Route::resource('profiles', 'ProfilesController', array('only' => array('show', 'edit', 'update')));
Route::get('spaces/{id}', 'SpacesController@show');

Route::resource('themes', 'ThemesController', array('only' => array('edit', 'update')));
Route::resource('blogposts', 'BlogPostsController', array('only' => array('create', 'store')));

