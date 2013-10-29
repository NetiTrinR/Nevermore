<?php
namespace App\Models;

class Cat extends \Eloquent {

	protected $table = 'cats';
	public $timestamps = false;

	public function threads(){
		return $this->hasMany('Thread');
	}
}