<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Revoke extends Model
{
    protected $fillable = [
        'user_id','check','deal_cate','shopName','productPhase','unit','num','unitPrice','otherExpenses','total','minQuantity','deliveryMethods','validity','instructions','item','anonymousPosting','sms','caption','pic','mallGoods','status','upper','trader','views'
    ];

    //一篇帖子属于一个分类
    public function cate(){
        return $this->belongsTo('App\DealCate','deal_cate','id');
    }

    //一篇帖子属于一个用户
    public function user(){
        return $this->belongsTo('App\User','user_id','id');
    }
}
