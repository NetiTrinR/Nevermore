<?php
namespace App\Models;

class Purchase extends \Eloquent {

	protected $table = 'purchases';
	protected $softDelete = true;
	
	public function items(){
		return $this->belongsToMany('App\Models\Item');
	}
	public function user(){
		return $this->belongsTo('App\Models\User');
	}
}