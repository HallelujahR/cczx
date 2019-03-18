<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'user_id', 'cate_id', 'title','access_count','time',
    ];

    //一篇文章属于一个分类
    public function cate(){
        return $this->belongsTo('App\Cate','cate_id','id');
    }

    //一篇文章属于一个用户
    public function user(){
        return $this->belongsTo('App\User','user_id','id');
    }

    //一篇文章对应一个内容
    public function content(){
        return $this->hasOne('App\Content');
    }

    //一篇文章有多个评论
    public function comments(){
        return $this->hasMany('App\CommentArticle');
    }
}
