<?php

namespace App\Http\Controllers;

use Auth;
use App\topic;
use App\topic_cate;
use App\topic_replies;
use App\UserDetail;
use App\Deal;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    //
    public function index(Request $request){
        //查询出当前这个顶级版块
        $cate = topic_cate::findOrFail($request->id);


        //1.先获取今日凌晨时间戳(根据 这个查询今日帖)
        $time = strtotime(date('Y-m-d'));

        //查询这个顶级版块下面的版块
        $zicates = topic::where('cate_id',$request->id)->get();

        foreach($zicates as $k=>$v){
            $v['todyPost'] = topic::where('cate_id',$v->id)->where('created_at','>',$time)->count();

            $v['countPost'] = topic::where('cate_id',$v->id)->count();

            $posts = topic::where('cate_id',$v->id)->get();

            $countReply = 0;
            foreach($posts as $post){

                $count = $post->replies->count();

                $countReply += $count;

            }

            $v['countReply'] = $countReply+$v['countPost'];
        }

        //遍历这个版块下面的帖子
        $posts = topic::where('cate_id',$request->id)->orderBy('created_at','desc')->paginate(12);

        //查询总帖数
        $countPost = topic::where('cate_id',$request->id)->count();

        //查询出今日发帖多少个

        //2.查询这个版块下大于等于$time的帖子数量
        $todyPost = topic::where('cate_id',$request->id)->where('created_at','>',$time)->count();

        return view('home.topic.index',compact('cate','posts','countPost','todyPost','zicates'));
    }

    public function publish (Request $request){
        $cate_id = $request->input('type');
        $cates = topic_cate::get();
        $deals = [];
        if($request->input('id')){
            $deals = Deal::findOrFail($request->input('id'));
            $deals['deliveryMethods'] = json_decode($deals['deliveryMethods']);
            $deals['web'] = env('APP_URL').'/deal/detail/'.$deals['id'].'.html';
            $deals['flag'] = true;
        }else{
            $deals['flag'] = false;

        }
        return view('home.topic.publishTopic',compact('cates','cate_id','deals'));
    }

    public function detail(Request $request, $id){
        $post = topic::findOrFail($id);

        $post_user = UserDetail::where('user_id','=',$post->user_id)->first();
        $post->increment('access_count');

        //查询这个帖子的所有回帖
        $replies = topic_replies::where('topic_id',$id)->orderBy('created_at','asc')->paginate
        (10);

        return view('home.topic.topic',compact('post','replies','post_user'));
    }

    public function store(Request $request){
        $this->validate($request,[
            'detail' => 'required|string',
        ],[
            'detail.required' => '文章内容不能为空',
        ]);

        $topic = topic::create([
            'user_id' => Auth::id(),
            'cate_id' => $request->cate,
            'title' => htmlspecialchars($request->name),
            'content' => $request->detail,
            'access_count' => 0,
        ]);


        if($topic){

            flash('添加话题成功')->success();
            return redirect()->action('TopicController@detail',$topic->id);
        }else{

            flash('提交失败，请重新提交')->error();
            return back();
        }

    }

    //执行回帖
    public function storeReply(Request $request){
        $this->validate($request,[
            'detail' => 'required|string',
        ],[
            'detail.required' => '回复内容不能为空',
        ]);

        $reply = topic_replies::create([
            'user_id' => Auth::id(),
            'topic_id' => $request->pid,
            'reply' => $request->detail,
        ]);


        if($reply){
            dd($reply);

//            $toUser = User::findOrFail($reply->post->user->id);
//            if($toUser->id != Auth::id()){
//                $data = [
//                    'name' => Auth::user()->name,
//                    'id' => Auth::id(),
//                    'title' => '回复了您的帖子',
//                    'replyId' => $reply->id,
//                    'post' => $reply->post->title,
//                    'post_id' => $reply->post->id
//                ];
//
////                $toUser->notify(new ReplyPostNotification($data));
//            }

            flash('回复话题成功')->success();
            return redirect()->action('TopicController@detail',$request->pid);
        }else{

            flash('提交失败，请重新提交')->error();
            return back();
        }


    }
}
