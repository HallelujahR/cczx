<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\CommentArticle;
use Illuminate\Http\Request;
use App\Notifications\CommentArticleNotification;

class CommentArticleController extends Controller
{

    //用户只有登录之后才能进行评论
    public function __construct(){
        $this->middleware('auth')->except('uploadpic');
    }

    //对文章进行评论
    public function store(Request $request){
        $flag = CommentArticle::create([
            'user_id' => Auth::id(),
            'article_id' => $request->article_id,
            'comment' => $request->detail,
            'time' => time()
        ]);

        if($flag) {
            $toUser = User::findOrFail($flag->article->user->id);
            if($toUser->id != Auth::id()){
                $data = [
                    'name' => Auth::user()->name,
                    'id' => Auth::id(),
                    'title' => '评论了您的文章',
                    'commentId' => $flag->id,
                    'article' => $flag->article->title,
                    'article_id' => $flag->article->id
                ];

                $toUser->notify(new CommentArticleNotification($data));
            }
            return '1';
        }else{
            return '2';
        }

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
                $destinationPath = '/articleCommentPic/'.date('Y-m-d'); // public文件夹下面uploads/xxxx-xx-xx 建文件夹
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
