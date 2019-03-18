<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deal extends Model
{
    //
    protected $fillable = [
        'user_id','check','deal_cate','shopName','productPhase','unit','num','unitPrice','otherExpenses','total','minQuantity','deliveryMethods','validity','instructions','item','anonymousPosting','sms','caption','pic','mallGoods','status','upper','trader','views','youconfirm','myconfirm','myfail','youfail','dealstatus',
    ];

    //一篇帖子属于一个分类
    public function cate(){
        return $this->belongsTo('App\DealCate','deal_cate','id');
    }

    //一篇帖子属于一个用户
    public function user(){
        return $this->belongsTo('App\User','user_id','id');
    }

    //一篇帖子拥有多个留言
    public function deal(){
        return $this->hasMany('App\Deal','deal_id');
    }

    //一篇帖子有一个确认交易
    public function confirm(){
        return $this->hasOne('App\confirm_deals','deal_id');
    }

    public function marklist(){
        return $this->hasMany('App\mark_list','deal_id');
    }

    public function traderUser(){
        return $this->belongsTo('App\User','trader','id');
    }
}
