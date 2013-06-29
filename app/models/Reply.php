<?php
namespace App\Models;
 
class Reply extends \Eloquent {
 
    protected $table = 'replies';
 
    public function author()
    {
        return $this->belongsTo('User');
    }
 
}