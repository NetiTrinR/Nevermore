<?php

class ForumController extends BaseController {
	
	public function getIndex(){
		Redirect::route('home');			
	}
}