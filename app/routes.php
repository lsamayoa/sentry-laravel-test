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

Route::get('/', function()
{
	return View::make('hello');
});

Route::resource('todos', 'TodosController');
Route::get('users/login', array('as' => 'users.login', 'uses' => 'UsersController@login'));
Route::post('users/login',  array('as' => 'users.authenticate', 'uses' => 'UsersController@authenticate'));
Route::get('users/logout', array('as' => 'users.logout', 'uses' => 'UsersController@logout'));