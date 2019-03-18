<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'user_id', 'bbs_cate_id', 'title','access_count','time',
    ];

    //一篇帖子属于一个分类
    public function cate(){
        return $this->belongsTo('App\BbsCate','bbs_cate_id','id');
    }

    //一篇帖子属于一个用户
    public function user(){
        return $this->belongsTo('App\User','user_id','id');
    }

    //一篇文章对应一个内容
    public function content(){
        return $this->hasOne('App\ContentPost');
    }

    //一篇帖子有多个回复
    public function replies(){
        return $this->hasMany('App\Reply','pid','id');
    }
}
