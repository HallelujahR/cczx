<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    protected $fillable = [
        'id', 'user_id', 'fullname', 'telephone', 'idnumber', 'sex', 'birthday', 'email', 'qq', 'vx', 'postIntegral', 'articleIntegral', 'transaction', 'creditscore', 'scoringtimes', 'alipay', 'transactionTimes', 'transactionAmount'
    ];

    //一个用户详情属于一个用户
    public function user(){
        return $this->belongsTo('App\User','user_id','id');
    }


}
