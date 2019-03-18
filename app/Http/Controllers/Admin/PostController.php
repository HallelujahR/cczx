<?php

namespace App\Http\Controllers\Admin;

use DB;
use App\Post;
use App\Reply;
use App\ReplyContent;
use App\BbsCate;
use App\ContentPost;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
	//浏览所有帖子
    public function index(){
    	//获取所有帖子
    	$posts = Post::get();

    	return view('admin.post.index',compact('posts'));
    }

    //查看帖子内容
    public function detail(Request $request){

    	$post = Post::findOrFail($request->id);

    	return view('admin.post.detail',compact('post'));
    }

    //修改帖子内容
    public function updateDetail(Request $request){
    	$content = ContentPost::findOrFail($request->id);
    	$content->update([
    		'content' => $request->detail
    	]);

    	return redirect()->action('Admin\PostController@detail',$content->post_id);
    }

    //修改帖子标题和分类
    public function edit(Request $request){
    	$post = Post::findOrFail($request->id);

    	$cates = BbsCate::select(DB::raw("id,cate,pid,path,concat(path,id) as p"))->orderBy('p')->get();
        foreach($cates as $k=>$v){
            $cates[$k]['cate'] = str_repeat('|---',count(explode(',',$v['path']))-2).$v['cate'];
        }
    	
    	return view('admin.post.edit',compact('post','cates'));
    }

    //执行修改帖子标题和分类
    public function update(Request $request){
    	$post = Post::findOrFail($request->id);

    	$post->update($request->all());

    	return redirect()->action('Admin\PostController@index');
    }

    //删除帖子
    public function delete(Request $request){
    	//先查询这条帖子是否有回帖
    	$replies = Reply::where('pid',$request->id)->get();

    	//如果这条帖子存在回复的话删除
    	if($replies){
    		foreach($replies as $reply){
    			//先删除这条回复的内容
    			$reply->content->delete();
    			$reply->delete();
    		}
    	}
    	//删除这条帖子
    	$post = post::findOrFail($request->id);
    	$post->content->delete();
    	$post->delete();

    	return redirect()->action('Admin\PostController@index');
    }
    
    //查看这个帖子下面的回帖
    public function reply(Request $request){
    	$post = Post::findOrFail($request->id);
    	$replies = Reply::where('pid',$request->id)->get();

    	return view('admin.post.reply',compact('post','replies'));
    }

    //查看回帖内容
    public function replyDetail(Request $request){
    	$reply = Reply::findOrFail($request->id); 

    	return view('admin.post.replyDetail',compact('reply'));
    }

    //执行修改回帖内容
    public function updateReplyDetail(Request $request){
    	$replyContent = ReplyContent::findOrFail($request->id);

    	$replyContent->update([
    		'reply' => $request->detail
    	]);

    	return redirect()->action('Admin\PostController@replyDetail',$replyContent->r_id);
    }

    //执行删除回帖内容
    public function replyDelete(Request $request){
    	$reply = Reply::findOrFail($request->id);

    	//先删除回帖内容那张表
    	$reply->content->delete();
    	$reply->delete();

    	return redirect()->action('Admin\PostController@reply',$reply->pid);
    }
}