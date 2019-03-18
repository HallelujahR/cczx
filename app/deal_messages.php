<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class deal_messages extends Model
{
    //
    protected $fillable = [
        'user_id','deal_id','message'
    ];

    public function deal(){
        return $this->belongsTo('App\Deal','deal_id','id');
    }

    public function user(){
        return $this->belongsTo('App\User','user_id','id');
    }
}
