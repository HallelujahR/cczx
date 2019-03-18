<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cate extends Model
{
    //指定表名
    protected $table = 'cates';

    protected $fillable = [
        'cate','pid','path','check','catePic'
    ];

    //一个分类可以有多个文章
    public function articles(){
        return $this->hasMany('App\Article');
    }
}
