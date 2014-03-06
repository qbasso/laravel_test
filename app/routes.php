<?php

/*
 * |-------------------------------------------------------------------------- | Application Routes |-------------------------------------------------------------------------- | | Here is where you can register all of the routes for an application. | It's a breeze. Simply tell Laravel the URIs it should respond to | and give it the Closure to execute when that URI is requested. |
 */
Route::get ( '/', function () {
	return View::make ( 'hello' );
} );

Route::get ( 'users', 'UserController@getIndex' );

Route::delete ( 'users/{id}', 'UserController@deleteUser' );

Route::get ( 'users/{id}', 'UserController@showUser' );

Route::get ( 'create', 'UserController@createUser' );

Route::post ( 'create', 'UserController@saveUser' );

Route::post ( 'users/{id}', 'UserController@updateUser' );

Route::resource('user', 'UserController2');
