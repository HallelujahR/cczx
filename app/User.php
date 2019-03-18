<?php

namespace App;

use Auth;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'phone', 'password', 'avatar', 'status', 'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //一个用户只有一个详情表
    public function detail(){
        return $this->hasOne('App\UserDetail','user_id','id');
    }

    //一个用户可以有多个文章
    public function articles(){
        return $this->hasMany('App\Article');
    }

    //一个用户可以有多个评论
    public function comments(){
        return $this->hasMany('App\CommentArticle');
    }

    //一个用户可以有多个帖子
    public function posts(){
        return $this->hasMany('App\Post');
    }

    //一个用户可以有多个回帖
    public function replies(){
        return $this->hasMany('App\Reply');
    }

    public function role(){
        return $this->belongsTo('App\Role','role_id','id');
    }

    //用户可以有多个公告
    public function notice(){
        return $this->hasMany('App\notice');
    }

    //用户拥有多个评论
    public function Announcement(){
        return $this->hasMang('App\Announcement');
    }

    //一个用户有一个认证
    public function card(){
        return $this->hasOne('App\IdentificationCard','user_id','id');
    }

    //一个用户可以上传多个银行
    public function banks(){
        return $this->hasMany('App\Bank');
    }

    //一个用户可以上传多个地址
    public function addresses(){
        return $this->hasMany('App\Address');
    }

    //关注用户
    public function follows_user(){
        return $this->belongsToMany(self::class,'follows','follower_id','followed_id')->withTimestamps();
    }

    public function followings_user(){
        return $this->belongsToMany(self::class,'follows','followed_id','follower_id')->withTimestamps();
    }

    public function followThis_user($user_id){
        return $this->follows_user()->toggle($user_id);
    }

    public function followed_user($user_id){
        $arr = Auth::user()->follows_user()->pluck('followed_id')->toArray();
        if(in_array($user_id,$arr)){
            return true;
        }else{
            return false;
        }
    }

    //用户收到多少个私信
    public function receiveMessages(){
        return $this->hasMany('App\Message','to_user_id');
    }

    //用户发送多个私信
    public function sendMessages(){
        return $this->hasMany('App\Message','from_user_id');
    }

    //一个用户可以有多个交易帖子
    public function deals(){
        return $this->hasMany('App\Deal');
    }

    //一个用户可以用多个确认交易
    public function confirm(){
        return $this->hasMany('App\confirm_deals','user_id');
    }

    //一个用户可以有多个交易留言
    public function deal_messages(){
        return $this->hasMany('App\deal_messages','user_id');
    }

    //一个用户可以有多个撤帖
    public function revokes(){
        return $this->hasMany('App\Revoke');
    }

    //一个用户可以有多个话题
    public function topic(){
        return $this->hasMany('App\topic','user_id');
    }

    //一个用户有多个话题回复
    public function topic_replies(){
        return $this->hasMany('App\topic_replies','user_id');
    }

    //一个用户有一个评分
    public function mark(){
        return $this->hasOne('App\mark','user_id');
    }



}
