<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BbsCate extends Model
{

	//指定表名
    protected $table = 'bbs_cates';

    protected $fillable = [
        'cate','pid','path',
    ];

    //一个分类可以有多个帖子
    public function posts(){
        return $this->hasMany('App\Post');
    }
}
