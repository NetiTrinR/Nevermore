<?php
namespace App\Models;
 
class Thread extends \Eloquent {
 
    protected $table = 'threads';
 	protected $softDelete = true;

 	public function cats(){
 		return $this->belongsTo('App\Models\Cat');
 	}
 	public function replies(){
 		return $this->hasMany('App\Models\Reply');
 	}
 	public function tags(){
 		return $this->belongsToMany('App\Models\Tag');
 	}
}