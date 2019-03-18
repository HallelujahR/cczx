<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\User;
use App\Cate;
use App\Post;
use App\Reply;
use App\ReplyContent;
use App\ContentPost;
use App\Content;
use App\Article;
use App\BbsCate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use App\Notifications\ReplyPostNotification;

class PublishController extends Controller
{

	//用户只有登录之后才能进行发布
	public function __construct(){
        $this->middleware('auth')->except('uploadPic');
    }

    //渲染发布文章页面
    public function article(Request $request){

    	$cate_id = $request->id;

    	//查询所有的分类
    	$cates = $this->getCate();
    	return view('home.publish.article',compact('cates','cate_id'));
    }

    //执行添加文章
    public function storeArticle(Request $request){

    	$this->validate($request,[
            'detail' => 'required|string',
        ],[
            'detail.required' => '文章内容不能为空',
        ]);

		//开启事务
		\DB::beginTransaction();

        $article = Article::create([
        	'user_id' => Auth::id(),
    		'cate_id' => $request->cate,
    		'title' => htmlspecialchars($request->name),
            'access_count' => 0,
            'time' => time()
    	]);

		$article_content = Content::create([
			'article_id' => $article->id,
			'content' => $request->detail
		]);

		if($article_content && $article_content){
			\DB::commit();
			$this->clearCache();

			flash('添加文章成功')->success();
	    	return redirect()->action('ArticleController@index',$article->id);
		}else{
        	\DB::rollback();

			flash('提交失败，请重新提交')->error();
			return back();
		}


    }

    //渲染修改文章页面
    public function editArticle(Request $request){

    	//获取分类数据
    	$cates = $this->getCate();

    	//查询修改的这篇文章信息
    	$article = Article::findOrFail($request->id);

    	return view('home.publish.editArticle',compact('cates','article'));
    }

    //执行修改文章
    public function updateArticle(Request $request){
    	$article = Article::findOrFail($request->id);
    	$article->update([
    		'title' => htmlspecialchars($request->name),
    		'cate_id' => $request->cate
    	]);

    	$content = Content::where('article_id',$article->id)->first();
    	$content->update([
    		'content' => $request->detail
    	]);

    	$this->clearCache();
    	return redirect()->action('ArticleController@index',$article->id);
    }

    //删除文章
    public function delArticle(Request $request){
    	Content::where('article_id',$request->id)->delete();
    	Article::destroy($request->id);
    	$this->clearCache();
    	return redirect()->action('IndexController@index');
    }

    //获取所有的分类
    public function getCate(){
    	$cates = Cate::select(DB::raw("id,cate,pid,path,concat(path,id) as p"))->orderBy('p')->get();

        foreach($cates as $k=>$v){
            $cates[$k]['cate'] = str_repeat('|---',count(explode(',',$v['path']))-2).$v['cate'];
        }

        return $cates;
    }

    //清除首页的Redis缓存
    public function clearCache(){
    	Redis::del('catehs','bbs','index_bbs_cates');
    }

    //用户发布帖子
    public function post(Request $request){

        $cate_id = $request->id;
        $cates = $this->getPostCate();
        return view('home.publish.post',compact('cates','cate_id'));
    }

    //执行发布帖子
    public function storePost(Request $request){
        $this->validate($request,[
            'detail' => 'required|string',
        ],[
            'detail.required' => '帖子内容不能为空',
        ]);

		//开启事务
		\DB::beginTransaction();

        $post = Post::create([
            'user_id' => Auth::id(),
            'bbs_cate_id' => $request->cate,
            'title' => $request->name,
            'access_count' => 0,
            'time' => time()
        ]);

        $post_content = ContentPost::create([
            'post_id' => $post->id,
            'content' => $request->detail
        ]);

		if($post && $post_content){
			\DB::commit();
			$this->clearCache();

			flash('添加帖子成功')->success();
			return redirect()->action('BbsController@post',$post->id);
		}else{
			\DB::rollback();

			flash('提交失败，请重新提交')->error();
			return back();
		}
    }

    //获取帖子的分类
    public function getPostCate(){
        $cates = BbsCate::select(DB::raw("id,cate,pid,path,concat(path,id) as p"))->orderBy('p')->get();

        foreach($cates as $k=>$v){
            $cates[$k]['cate'] = str_repeat('|---',count(explode(',',$v['path']))-2).$v['cate'];
        }

        return $cates;
    }

    //渲染用户回复帖子的页面
    public function reply(Request $request){
        $post = Post::findOrFail($request->id);

        return view('home.publish.reply',compact('post'));
    }

    //执行回帖
    public function storeReply(Request $request){
        $this->validate($request,[
            'detail' => 'required|string',
        ],[
            'detail.required' => '回帖内容不能为空',
        ]);

		//开启事务
		\DB::beginTransaction();

        $reply = Reply::create([
            'user_id' => Auth::id(),
            'pid' => $request->pid,
            'time' => time()
        ]);

        $reply_content = ReplyContent::create([
            'r_id' => $reply->id,
            'reply' => $request->detail
        ]);

		if($reply && $reply_content){
			\DB::commit();

			$toUser = User::findOrFail($reply->post->user->id);
			if($toUser->id != Auth::id()){
				$data = [
					'name' => Auth::user()->name,
					'id' => Auth::id(),
					'title' => '回复了您的帖子',
					'replyId' => $reply->id,
					'post' => $reply->post->title,
					'post_id' => $reply->post->id
				];

				$toUser->notify(new ReplyPostNotification($data));
			}

			flash('回复帖子成功')->success();
			return redirect()->action('BbsController@post',$request->pid);
		}else{
			\DB::rollback();

			flash('提交失败，请重新提交')->error();
			return back();
		}


    }

    //上传发布帖子时的图片
    public function uploadPic(Request $request){
        $arr = ["errno"=>0,"data"=>[]];
        $file = $request->file('file');
        $filePath =[];  // 定义空数组用来存放图片路径
        foreach($file as $key => $value) {
            // 判断图片上传中是否出错
            if (!$value->isValid()) {
                exit("上传图片出错，请重试！");
            }
            if(!empty($value)){//此处防止没有多文件上传的情况
                $destinationPath = '/postPic/'.date('Y-m-d'); // public文件夹下面uploads/xxxx-xx-xx 建文件夹
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
