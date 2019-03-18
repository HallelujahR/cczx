<?php

namespace App\Http\Controllers\Admin;

use DB;
use App\Cate;
use App\Content;
use App\Article;
use App\CommentArticle;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
	//浏览文章
    public function index(){
    	$articles = Article::get();
    	return view('admin.article.index',compact('articles'));
    }

    //渲染添加文章页面
    public function add(){
    	$cates = Cate::select(DB::raw("id,cate,pid,path,concat(path,id) as p"))->orderBy('p')->get();
        foreach($cates as $k=>$v){
            $cates[$k]['cate'] = str_repeat('|---',count(explode(',',$v['path']))-2).$v['cate'];
        }
    	return view('admin.article.add',compact('cates'));
    }

    //执行添加
    public function store(Request $request){
    	$article = Article::create([
    		'cate_id' => $request->cate_id,
    		'title' => $request->title,
            'access_count' => rand(100,200),
            'time' => time()
    	]);

    	if($article){
    		Content::create([
    			'article_id' => $article->id,
    			'content' => $request->detail
    		]);
    	}

    	return redirect()->action('Admin\ArticleController@index');
    }

    //渲染修改页面
    public function edit(Request $request){
    	$article = Article::findOrFail($request->id);
    	$cates = Cate::get();
    	return view('admin.article.edit',compact('article','cates'));
    }

    //渲染修改标题页面
    public function updateTitle(Request $request){
    	$article = Article::findOrFail($request->id);
    	$article->update($request->all());
    	return redirect()->action('Admin\ArticleController@index');
    }

    //渲染查看详情页面
    public function editDetail(Request $request){
    	$content = Content::where('article_id',$request->id)->first();
    	return view('admin.article.editdetail',compact('content'));
    }

    //修改文章内容
    public function updateDetail(Request $request){
    	$content = Content::findOrFail($request->id);
    	$content->update([
    		'content' => $request->detail
    	]);

    	return redirect()->action('Admin\ArticleController@editDetail',$content->article_id);
    }

    //删除文章及内容
    public function delete(Request $request){
        
        //删除文章时先查询这个文章有没有评论
        $comments = commentArticle::where('article_id',$request->id)->get();

        //如果存在评论的话进行删除
        if($comments){
            foreach($comments as $comment){
                $comment->delete();
            }
        }

        //查询这篇文章删除掉
        $article = Article::findOrFail($request->id);
        $article->content->delete();
        $article->delete();
    	
    	return redirect()->action('Admin\ArticleController@index');

    }

    //查看文章的评论
    public function comments(Request $request){
        $article = Article::findOrFail($request->id);

        return view('admin.article.comment',compact('article'));
    }

    //查看评论内容
    public function commentDetail(Request $request){
        $comment = CommentArticle::findOrFail($request->id);

        return view('admin.article.commentDetail',compact('comment'));
    }

    //执行修改评论内容
    public function updateCommentDetail(Request $request){
        $comment = CommentArticle::findOrFail($request->id);

        $comment->update([
            'comment' => $request->detail
        ]);

        return redirect()->action('Admin\ArticleController@commentDetail',$request->id);
    }

    //执行删除评论
    public function commentDelete(Request $request){
        $comment = CommentArticle::findOrFail($request->id);

        $comment->delete();

        return redirect()->action('Admin\ArticleController@comments',$comment->article_id);
    }

    //上传图片
    public function uploadpic(Request $request){
    	$arr = ["errno"=>0,"data"=>[]];
        $file = $request->file('file');
        $filePath =[];  // 定义空数组用来存放图片路径
        foreach($file as $key => $value) {
            // 判断图片上传中是否出错
            if (!$value->isValid()) {
                exit("上传图片出错，请重试！");
            }
            if(!empty($value)){//此处防止没有多文件上传的情况
                $destinationPath = '/articlePic/'.date('Y-m-d'); // public文件夹下面uploads/xxxx-xx-xx 建文件夹
                $extension = $value->getClientOriginalExtension();   // 上传文件后缀
                $fileName = date('YmdHis').mt_rand(100,999).'.'.$extension; // 重命名
                $value->move(public_path().$destinationPath, $fileName); // 保存图片
                $filePath[] = $destinationPath.'/'.$fileName;
                $arr['errno'] = 0;

            }
        }

        foreach($filePath as $k=>$v){
            array_push($arr['data'],$v);
        }
        return json_encode($arr);
    }
}
