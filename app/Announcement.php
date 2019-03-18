<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    //
    protected $fillable = [
    	'user_id','content','notice_id'
    ];

    public function notice(){
    	return $this->belongsTo('App\Notice');
    }

    public function user(){
    	return $this->belongsTo('App\User');
    }


}
