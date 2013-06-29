<?php
namespace App\Models;
 
class Thread extends \Eloquent {
 
    protected $table = 'threads';
 
    public function author()
    {
        return $this->belongsTo('User');
    }
 
}