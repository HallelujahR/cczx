<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class topic_replies extends Model
{
    protected $fillable = [
      'user_id','topic_id','reply'
    ];

    public function user(){
        return $this->belongsTo('App\User','user_id','id');

    }

    public function topic(){
        return $this->belongsTo('App\topic','topic_id','id');
    }

}
