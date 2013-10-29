<?php namespace App\Models;

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends \Eloquent implements UserInterface, RemindableInterface {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

	/**
	 * 	Enable soft deletes
	 *
	 * @var boolean
	 */
	protected $softDelete = true;

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}

	public function purchases(){
		return $this->hasMany('App\Models\Purchase');
	}

	public function getUsername(){
		return $this->username;
	}

	public function getPlat(){
		$total = 0;
		foreach($this->purchases as $purchase){
			$item = $purchase->items->first();//May need to convert this to a loop when / if we do bundles
			if($item->type == 1)
				$total += $item->plat;
			else
				$total-= $item->plat;
		}
		return $total;
	}
	public function getSilver(){
		return 5000;
	}
}