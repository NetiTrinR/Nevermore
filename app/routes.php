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
//Get Methods
//die(var_dump($_SERVER));

Route::controller('/forum', 'ForumController', ['getIndex'=>'forum']);
Route::controller('/user', 'UserController', ['getRegister'=>'register', 'getLogin' => 'login']);
Route::controller('/shop', 'ShopController', ['getIndex'=>'shop', 'getDonate'=>'donate']);
Route::controller('/calendar', 'CalendarController', ['getIndex'=>'calendar']);
Route::controller('/', 'HomeController', ['getHome'=>'home', 'getHello'=>'hello']);