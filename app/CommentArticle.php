<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentArticle extends Model
{
    protected $fillable = [
        'user_id', 'article_id', 'comment', 'time',
    ];

    //一个评论属于一个用户
    public function user(){
        return $this->belongsTo('App\User','user_id','id');
    }

    //一个评论属于一个文章
    public function article(){
    	return $this->belongsTo('App\Article','article_id','id');	
    }
}
