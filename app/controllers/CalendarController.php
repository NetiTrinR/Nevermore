<?php

class CalendarController extends BaseController {
	
		public $restful = true;

		public function getIndex(){
			Redirect::route('home');			
		}
}
