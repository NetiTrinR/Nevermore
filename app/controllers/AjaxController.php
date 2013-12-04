<?php
use App\Models\User;
use App\Models\Thread;
use App\Models\Reply;
use App\Models\Tag;
class AjaxController extends BaseController
{

	public function __construct()
	{
		//Check CSRF token on POST
		$this->beforeFilter('ajax_only');
	}
	

}