<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', ['uses' => 'UserController@index', 'as' => 'home']);


Route::resource('user', 'UserController');
Route::post('user/{id}/upload', 'UserController@upload');

Route::resource('product', 'ProductController');
Route::post('product/{id}/upload', 'ProductController@upload');

