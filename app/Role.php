<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    protected $fillable = [
        'role'
    ];

    //一个级别属于一个用户
    public function user(){
        return $this->hasOne('App\User');
    }
}
