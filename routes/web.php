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
Auth::routes();

Route::group(['middleware' => 'auth'], function () {

	Route::resource('/', 'EventController');
   
	Route::get('/home', 'HomeController@index')->name('home');
	//events
	Route::resource('/events', 'EventController');

	Route::get('/events/send/{id}', 'EventController@senddata');

	Route::any('/events/send/confirm/{id}', 'EventController@sendemail');
	//add event
	Route::get('/addevent', 'EventController@display');
	//display event
	Route::get('/displaydata', 'EventController@show');
	//delete event
	Route::get('/deleteevent', 'EventController@show');

	Route::get('/calendarevents', 'EventController@index2');
});





