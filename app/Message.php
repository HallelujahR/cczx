<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //
    protected $fillable = [
        'from_user_id','to_user_id','body'
    ];

    //发送者与私信的关系 1-many
    public function fromuser(){
    	return $this->belongsTo('App\User','from_user_id');
    }

    //接收者与私信的关系
    public function touser(){
    	return $this->belongsTo('App\User','to_user_id');
    }
}
