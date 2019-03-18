<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Article;
use App\User;
use App\Post;
use App\Deal;


class SearchController extends Controller
{
    //搜索下拉框
    public function search(Request $request) {
    	// echo $request['content'];
    	$content = $request['content'];
    	$article = Article::where('title','like','%'.$content.'%')->with('user')->limit(3)->get()->toArray();
    	$post = Post::where('title','like','%'.$content.'%')->with('user')->limit(3)->get()->toArray();
    	$user = User::where('name','like','%'.$content.'%')->limit(3)->get()->toArray();
    	$deal = Deal::where('shopName','like','%'.$content.'%')->orderBy('updated_at','desc')->limit(3)->get()
            ->toArray();
    	$res['article'] = $article;
    	$res['post'] = $post;
    	$res['user'] = $user;
    	$res['deal'] = $deal;

    	return $res;

    }
    
    //搜索主页面
    public function index(Request $request) {

    	// dump($request->all());
    	//接收到的值
    	$q = $request->all()['q'];

    	//进行查询
	    	//帖子
	    	$post = Post::where('title','like','%'.$q.'%')->limit(20)->with('user')->get();
	    	//文章
	    	$article = Article::where('title','like','%'.$q.'%')->limit(20)->with('user')->get();
	    	//用户
	    	$user = User::where('name','like','%'.$q.'%')->limit(20)->get();
	    	//交易帖子
            $deal = Deal::where('shopName','like','%'.$q.'%')->limit(20)->get();
	    //返回数据
    	return view('home.Search.Index',compact('post','article','user','deal','q'));
    }

}
