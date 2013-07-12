<?php

class BaseController extends Controller {


	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}
	
	/**
	 * Uses minecraft API to check if the username has valid copy of minecraft
	 * @param  String  $mcUser Username of a minecraft account
	 * @return boolean
	 */
	function isValidMinecraft($mcUser)
	{
		$check_mcUser = file_get_contents('http://www.minecraft.net/haspaid.jsp?user='.$mcUser.'');
		if ($check_mcUser == 'true') {
			return true;
		}else{
			return false;
		}
	}
}