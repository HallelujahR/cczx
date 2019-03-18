<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notice;
use App\Announcement;
use Auth;
class NoticeController extends Controller
{
    //公告首页
    public function index(){
        $notice = Notice::orderBy('created_at','desc')->paginate(20);
        $noticeCount = Notice::count();
        return view('home.notice.index',compact('notice','noticeCount'));
    }

    //发布公告页面
    public function create(){
    	return view('home.notice.create');
    }

    //创建公告数据
    public function store(Request $request){
    	$notice = new Notice();
    	$notice->user_id =Auth::id();
    	$notice->title=$request->title;
    	$notice->content=$request->content;
    	if($notice->save()){
    		return redirect()->action('NoticeController@notice',$notice->id);
    	}else{
    		return redirect()->back();
    	};
    }


    //单个公告页面
    public function notice(Request $request){
    	$post = Notice::findOrFail($request->id);
    	  	//查询这个帖子的所有回帖
    	$replies = Announcement::where('notice_id',$request->id)->orderBy('created_at','asc')->paginate(15);
    	return view('home.notice.notice',compact('post','replies'));
    }
    //回复公告
    public function storeReply(Request $request) {
    	$ann = new Announcement();

    	$ann->content=$request->detail;
    	$ann->user_id = Auth::id();
    	$ann->notice_id=$request->pid;
    	if($ann->save()){
			echo "<script>alert('留言成功!');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
    	}else{
    		echo "<script>alert('留言失败');history.back();</script>";
    	}
    }
    //
}
