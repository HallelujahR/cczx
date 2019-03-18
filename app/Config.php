<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    protected $fillable = [
        'siteName', 'website', 'logo', 'contacts', 'qq', 'email', 'phone', 'telephone', 'address', 'title', 'keywords', 'description','longPic'
    ];
}
