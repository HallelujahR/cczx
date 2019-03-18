<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\User;
use App\Message;
use Illuminate\Support\Facades\Redis;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $arr = Message::where('from_user_id',Auth::id())->orwhere('to_user_id',Auth::id())->orderBy('id','desc')->get();
    	$arr1 = [];
    	foreach($arr as $v){

    		if(!in_array($v->from_user_id.'*'.$v->to_user_id,$arr1) && !in_array($v->to_user_id.'*'.$v->from_user_id,$arr1)){
    			$arr1[$v->id]= $v->from_user_id.'*'.$v->to_user_id;
    		}

    	}
    	$arr2 = [];
    	foreach($arr1 as $k=>$v){
    		$arr2[] = $k;
    	}

    	$chats = Message::whereIn('id',$arr2)->orderBy('created_at','desc')->paginate(10);

    	foreach($chats as $k=>$v){
    		if($v->from_user_id != Auth::id()){
    			$chats[$k]['user'] = Message::findOrFail($v->id)->fromuser()->first();
    		}else{
    			$chats[$k]['user'] = Message::findOrFail($v->id)->touser()->first();
    		}
    	}

        return view('home.message.index',compact('chats'));
    }

    public function check(Request $request)
    {
        $toid = $request->id;

        $arr = Message::where('from_user_id',Auth::id())->orwhere('from_user_id',$request->id)->get();

    	foreach($arr as $key=>$v){
    		if(!((($v->from_user_id == Auth::id() || $v->from_user_id == $request->id)) && (($v->to_user_id == Auth::id() || $v->to_user_id == $request->id)))){
    			unset($arr[$key]);
    		}
    	}
    	$arr1 = [];
    	foreach($arr as $key=>$v){
    		$arr1[] = $v->id;
    	}

    	$messages = Message::whereIn('id',$arr1)->orderBy('id','desc')->paginate(20);

    	foreach($messages as $k=>$v){
    		if($v->read_at == ''){
    			$arr = ['has_read'=>'H','read_at'=>\Carbon\Carbon::now()];
    			Message::whereIn('id',$arr1)->where('to_user_id',Auth::id())->update($arr);
    		}
    		if($v->from_user_id != Auth::id()){
    			$messages[$k]['user'] = $v->fromuser()->first();
    		}else{
    			$messages[$k]['user'] = $v->fromuser()->first();
    		}
    	}

        return view('home.message.message',compact('messages','toid'));
    }
    public function sx(Request $request){
        $message = Message::create([
            'from_user_id'=>Auth::id(),
            'to_user_id'=>$request->get('to_user_id'),
            'body'=>$request->get('body')
        ]);

        if($message){
            //获取$user_id对应的模型
            $toUser = User::findOrFail($request->get('to_user_id'));

            $data = [
                'event'=>$toUser->phone,
                'data'=>[
                    'toid' =>  $request->get('to_user_id'),
                    'name'=>Auth::user()->name,
                    'avatar'=>Auth::user()->avatar,
                    'id'=>Auth::id(),
                    'body'=>$message->body,
                    'date'=>$message->created_at,
                ],
            ];

            Redis::publish('message',json_encode($data));

            return 'ok';
        }else{
            return 'no';
        }
    }
}
