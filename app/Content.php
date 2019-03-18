<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $fillable = [
        'article_id', 'content',
    ];

    //一篇内容对应一个文章标题
    public function article(){
        return $this->belongsTo('App\Article','article_id','id');
    }
}
