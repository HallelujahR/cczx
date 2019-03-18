<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;
use App\User;
use App\Article;
use App\Post;
use App\CommentArticle;
use App\Reply;

class IndexController extends Controller
{
    /**
     * 显示后台管理模板首页
     */
    public function index()
    {
        $userCount = User::count();
        $ArticleCount = Article::count();
        $PostCount = Post::count();
        $CommentArticleCount = CommentArticle::count();
        $Reply = Reply::count();
        return view('admin.index',compact('userCount','ArticleCount','PostCount','CommentArticleCount','Reply'));
    }

    //清除redis缓存
    public function clearCache(){
        Redis::del('catehs','bbs','index_bbs_cates');
    	return back();
    }
}
