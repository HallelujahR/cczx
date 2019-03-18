<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\FollowUserNotification;
use App\User;

class FollowUserController extends Controller
{
    public function store($user_id){
        //关注这个用户
    	$res = Auth::user()->followThis_user($user_id);

        if(count($res['attached']) > 0){
            //获取$user_id对应的模型
            $toUser = User::findOrFail($user_id);

            if($toUser->id != Auth::id()){
                $data = [
                    'name' => Auth::user()->name,
                    'id' => Auth::id(),
                    'title' => '关注了您'
                ];

                $toUser->notify(new FollowUserNotification($data));
            }
            return 1;
        }else{
            return 2;
        }
    }

    //关注了
    public function follow($user_id) {
        $user = User::findOrFail($user_id);
        $concern = User::findOrFail($user_id)->follows_user()->paginate(12);
        return view('home.follow.follow',compact('user','concern'));
    }

    //关注者
    public function concern($user_id) {
        $user = User::findOrFail($user_id);
        $concern = User::findOrFail($user_id)->followings_user()->paginate(12);
        return view('home.follow.concern',compact('user','concern'));
    }
}
