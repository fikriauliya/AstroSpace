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

// Auth
Route::controller('users', 'UsersController');

// Profiles
Route::resource('profiles', 'ProfilesController', array('only' => array('show', 'edit', 'update')));
Route::get('spaces/{id}', 'SpacesController@show');