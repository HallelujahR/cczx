<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReplyContent extends Model
{
    protected $fillable = [
        'r_id', 'reply',
    ];

    //一篇内容对应一个回复
    public function reply(){
        return $this->belongsTo('App\Reply','r_id','id');
    }
}