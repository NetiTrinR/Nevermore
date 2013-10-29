<?php
namespace App\Models;

class Item extends \Eloquent {

	protected $table = 'items';
	protected $softDelete = true;
	
	public function purchases()
	{
		$this->belongsToMany('Purchase');
	}
}