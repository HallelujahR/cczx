<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class topic extends Model
{
    //
    protected $fillable = [
      'title','content','user_id','cate_id','access_count'
    ];

    public function cate(){
        return $this->belongsTo('App\topic_cate','cate_id','id');
    }

    public function user(){
        return $this->belongsTo('App\User','user_id','id');
    }

    public function replies(){
        return $this->hasMany('App\topic_replies','topic_id');
    }
}
