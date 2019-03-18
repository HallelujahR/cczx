<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $fillable = [
        'user_id', 'pid', 'time',
    ];

    //一个回复对应一个内容
    public function content(){
        return $this->hasOne('App\ReplyContent','r_id','id');
    }

    //一篇回帖属于一个用户
    public function user(){
        return $this->belongsTo('App\User','user_id','id');
    }

    //一篇回复对应一个帖子
    public function post(){
        return $this->belongsTo('App\Post','pid','id');
    }


    //一个回复对应一个用户详情
    public function detail(){
        return $this->belongsTo('App\UserDetail');
    }
}
