<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IdentificationCard extends Model
{
    protected $fillable = [
    	'user_id','realName','idCard','positive','opposite','hold','status','info'
    ];

    //一个认证属于一个用户
    public function user(){
        return $this->belongsTo('App\User','user_id','id');
    }
}
