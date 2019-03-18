<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
    	'user_id','province','city','county','street','zipcode'
    ];

    //一篇文章属于一个用户
    public function user(){
        return $this->belongsTo('App\User','user_id','id');
    }
}
