<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class topic_cate extends Model
{
    //
    protected $fillable = [
        'cate'
    ];

    public function topic(){
        return $this->hasMany('App\Topic');
    }

}
