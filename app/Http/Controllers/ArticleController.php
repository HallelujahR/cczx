<?php

namespace App\Http\Controllers;

use App\Cate;
use App\Article;
use App\CommentArticle;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
	//详情页
    public function index(Request $request){

    	//查询点击进来的这篇文章
    	$article = Article::findOrFail($request->id);

    	//每浏览一次让这篇文章浏览量+1
    	$article->increment('access_count');

    	//查询和这篇文章分类相关的7篇文章
    	$xgArticles = Article::where('cate_id',$article->cate_id)->where('id','!=',$article->id)->limit(12)->get();

        $comments = CommentArticle::where('article_id',$article->id)->orderBy('time','desc')->limit(10)->get();

        $rmwz = Article::where('cate_id',$article->cate_id)->where('id','!=',$article->id)->limit(12)->orderBy('access_count','desc')->get();

        //查询相关分类(先判断点击进来的是顶级分类还是子类)
        if($article->cate->pid == 0){
            $xgCates = Cate::where('pid',$article->cate->id)->get();
        }else{
            $xgCates = Cate::where('pid',$article->cate->pid)->get();
        }

        // 热门文章
    	return view('home.article.index',compact('article','xgArticles','comments','xgCates','rmwz'));
    }
    //评论加载更多
    public function comment(Request $request){
        //查询这篇文章的评论
         $comments = CommentArticle::where('article_id',$request->article_id)->orderBy('time','desc')->with('user')->offset($request->page_start)->limit(10)->get();

         if(count($comments) > 0){
            return $comments;
         }else{
            return '0';
         }
    }

    
}
