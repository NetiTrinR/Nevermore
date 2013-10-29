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

//Forum Routes
Route::get('/forum', ['uses'=>'ForumController@getIndex', 'as'=>'forum']);
Route::group(['before' => 'auth'], function(){
	Route::get('/forum/create', ['uses'=>'ForumController@getCreate']);
	Route::post('/forum/create', ['uses'=>'ForumController@postCreate']);
	Route::get('/forum/delete/{type}/{id}',['uses'=>'ForumController@getDelete']);
	Route::post('/forum/reply', 'ForumController@postReply');
	Route::post('/forum/createTag', ['uses'=>'ForumController@postCreateTag']);
	Route::get('/forum/chosenTags',['uses'=>'ForumController@getChosenTags']);
	Route::post('/forum/flag', ['uses'=>'ForumController@postFlag']);
	Route::get('/forum/{thread}/edit', ['uses'=>'ForumController@getEdit']);
	Route::post('/forum/{thread}/edit', ['uses'=>'ForumController@postEdit']);
});
Route::get('/forum/{thread}',['uses'=>'ForumController@getThread']);

//User routes
Route::get('/user/login', ['uses'=>'UserController@getLogin','as'=>'login']);
Route::post('/user/login', 'UserController@postLogin');
Route::get('/user/logout', ['uses'=>'UserController@getLogout','as'=>'logout']);
Route::get('/user/register', ['uses'=>'UserController@getRegister','as'=>'register']);
Route::post('/user/register', 'UserController@postRegister');
Route::get('/user/activate/{userId}/{activationCode}', 'UserController@getActivate');
Route::get('/user/{user}/profile', 'UserController@getProfile');
Route::post('/user/{user}/profile', 'UserController@postProfile');
Route::get('/user/{user}/edit', 'UserController@getEdit');
Route::post('/user/{user}/edit', 'UserController@postEdit');


Route::controller('/shop', 'ShopController', ['getIndex'=>'shop', 'getCash'=>'cash']);
Route::controller('/calendar', 'CalendarController', ['getIndex'=>'calendar']);
// Route::controller('/docs', 'DocumentationController');//May be added to the site later
//Admin Controller
Route::controller('/admin', 'AdminController', ['getIndex'=>'admin']);
//content controller
Route::controller('/', 'HomeController', ['getHome'=>'home', 'getIndex'=>'hello', 'getAbout'=>'about', 'getPrivacy'=>'privacy', 'getTerms'=>'terms', 'getRules'=>'rules', 'getFaq' => 'faq', 'getBug' => 'bug']);