<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DealCate extends Model
{
    //
    protected $fillable = [
        'name','sort'
    ];

    //一个分类可以有多个帖子
    public function posts(){
        return $this->hasMany('App\Deal');
    }

    //一个分类可以有多个帖子
    public function revokes(){
        return $this->hasMany('App\Revoke');
    }
}
