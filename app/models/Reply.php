<?php
namespace App\Models;
 
class Reply extends \Eloquent {
 
    protected $table = 'replies';
 	protected $softDelete = true;

 	public function threads(){
 		return $this->belongsTo('App\Models\Thread');
 	}
}