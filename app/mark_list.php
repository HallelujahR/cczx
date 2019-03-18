<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mark_list extends Model
{
    //
    protected $fillable = [
        'mark_type','deal_id','from_user_id','to_user_id','mark','message'
    ];

    public function fromuser(){
        return $this->belongsTo('App\User','from_user_id','id');
    }

    public function touser(){
        return $this->belongsTo('App\User','to_user_id','id');
    }

    public function deal(){
        return $this->belongsTo('App\Deal','deal_id','id');
    }

}
