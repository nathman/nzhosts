<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function ()
{
	return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => 'api', 'namespace' => 'API', 'prefix' => 'api'], function ()
{
	Route::get('hosts/{hosts}/products', 'HostsController@products');
	Route::resource('hosts', 'HostsController');

	Route::get('categories', 'CategoriesController@index');

	Route::get('contact/honey', 'ContactController@honeypot');
	Route::post('contact/send', 'ContactController@send');

	Route::get('suggest/honey', 'SuggestionController@honeypot');
	Route::post('suggest/send', 'SuggestionController@send');
});

Route::group(['middleware' => ['web']], function ()
{

	Route::get('/', 'ContentController@home');

	Route::get('/{vue_capture?}', 'ContentController@home')->where('vue_capture', '[\/\w\.-]*');

});