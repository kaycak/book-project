<?php

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

Route::get('/', 'HomeController@dashboard');

// Login routes...
Route::get('/login', 'Auth\AuthController@getLogin');
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('/logout', 'Auth\AuthController@logout');

Route::resource('/books', 'BooksController');
Route::get('/book/{id}/add-pages', 'BooksController@addPage');
Route::post('/book/{id}/add-pages', 'BooksController@postAddPage');

Route::resource('/lines', 'LinesController');
Route::resource('/pages', 'PagesController');
Route::resource('/sections', 'SectionsController');


