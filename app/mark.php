<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mark extends Model
{
    //
    protected $fillable = [
        'user_id','appreciation','good','commonly','bad'
    ];

    public function user () {
        return $this->belongsTo('App\User','user_id','id');
    }
}
