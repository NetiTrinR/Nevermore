<?php

class HomeController extends BaseController {

	public function getIndex()
	{
		return View::make('hello')
			->with('title', 'Welcome to Nevermore');
	}

	public function getHome()
	{
		return View::make('home')
			->with('title', 'Home');
	}
}