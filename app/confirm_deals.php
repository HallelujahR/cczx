<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class confirm_deals extends Model
{
    //
    protected $fillable = [
        'user_id','deal_id','num','total','message'
    ];

    public function user(){
        return $this->belongsTo('App\User','user_id','id');

    }

    public function deal(){
        return $this->belongsTo('App\Deal','deal_id','id');
    }


}
