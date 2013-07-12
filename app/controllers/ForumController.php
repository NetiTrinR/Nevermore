<?php

class ForumController extends BaseController {
	
	public $restful = true;
	
	public function getIndex(){
		Redirect::route('home');			
	}
}