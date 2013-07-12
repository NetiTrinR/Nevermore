<?php

class ShopController extends BaseController {
	
	public $restful = true;
	
	public function getIndex(){
		Redirect::route('home');			
	}

	public function getDonate(){
		Redirect::route('home');			
	}
}