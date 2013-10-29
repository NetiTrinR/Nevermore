<?php

class CalendarController extends BaseController {
	
		public $restful = true;

		public function getIndex(){
			Session::flash('warning', 'The Calendar is still under construction. You have been redirected home.');
			return Redirect::route('home');
		}
}
