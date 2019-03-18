<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContentPost extends Model
{
    protected $fillable = [
        'post_id', 'content',
    ];

    //一篇帖子内容对应一个帖子标题
    public function post(){
        return $this->belongsTo('App\Post','post_id','id');
    }
}
