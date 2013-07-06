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
	protected function isValidYoutube($user)
	{
		$api = 'https://gdata.youtube.com/feeds/api/users/';
		$headers = get_headers($api . $user, true);
		if ($headers[0] == "HTTP/1.0 200 OK") {
			return true;
		}
		return false;
	}
	protected function isValidMinecraft($mcUser)
	{
		$check_mcUser = file_get_contents('http://www.minecraft.net/haspaid.jsp?user='.$mcUser.'');
		if ($check_mcUser == 'true') {
			return true;
		}else{
			return false;
		}
	}
	
}