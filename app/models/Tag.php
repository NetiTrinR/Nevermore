<?php
namespace App\Models;
 
class Tag extends \Eloquent {
 
    protected $table = 'tags';
    public $timestamps = false;

    public function threads(){
 		return $this->belongsToMany('App\Models\Thread');
 	}
}