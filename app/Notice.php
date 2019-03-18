<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    protected $fillable = [
        'user_id', 'title', 'content', 
    ];

    public function Announcement(){
    	return $this->hasMany('App\Announcement');
    }


    public function User(){
    	return $this->belongsTo('App\User');
    }
}
