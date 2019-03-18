<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\User;
use App\Post;
use App\Article;
use App\Reply;
use App\CommentArticle;
use App\Bank;
use App\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;


class PersonalController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except('findPwd','foundPwd');
    }

    //个人中心首页
    public function index(Request $request){
        $user = User::findOrFail($request->id);

        return view('home.personal.benren',compact('user','commentArticles','replyPosts'));
    }

    //渲染个人中心修改密码页面
    public function password(Request $request){
        //如果不是本人防止进入
        if($request->id != Auth::id()){
            return back();
        }

        $user = User::findOrFail($request->id);

        return view('home.personal.password',compact('user'));
    }
    //验证旧密码
    public function changePassword(Request $request){
        if(Hash::check($request->oldpassword,Auth::user()->password)){
            return 'ok';
        }else{
            return 'no';
        }
    }

    //执行修改个人密码
    public function updatePassword(Request $request){
        if(User::findOrFail(Auth::id())->update(['password'=>bcrypt($request->newPassword)])){
            Auth::logout();
            return redirect('/login');
        }else{
            echo "<script>alert('请修改密码失败');location.href='/personal/password/".Auth::id()."'</script>";
        }
    }

    //我的文章
    public function article(Request $request){
        $user = User::findOrFail($request->id);

        //查询出我发表的文章
        $articles = Article::where('user_id',$request->id)->paginate(10);

        return view('home.personal.article',compact('user','articles'));
    }

    //我的帖子
    public function post(Request $request){
        $user = User::findOrFail($request->id);

        //查询出我发表的帖子
        $posts = Post::where('user_id',$request->id)->paginate(10);

        return view('home.personal.post',compact('user','posts'));
    }

    //修改用户昵称
    public function updateUser(Request $request){
        $user = User::findOrFail(Auth::id());

        $arr = [
            $request->name=>$request->value
        ];

        if($user->update($arr)){
            return 1;
        }else{
            return 0;
        }
    }

    //修改用户详情
    public function updateDetail(Request $request){
        $user = User::findOrFail(Auth::id());

        $arr = [
            $request->name=>$request->value
        ];

        if($user->detail()->update($arr)){
            return 1;
        }else{
            return 0;
        }
    }

    //找回密码
    public function findPwd(Request $request){
        return msg($request->phone);
    }

    //提交找回后的修改密码
    public function foundPwd(Request $request){
        if(Redis::exists($request->phone.'yzm') && Redis::get($request->phone.'yzm') == $request->yzm){
            if(User::where('phone','=',$request->phone)->update(['password'=>bcrypt($request->pwd)])){
                echo "<script>alert('找回成功请登录');location.href='/login'</script>";
            }else{
                echo "<script>alert('修改失败');location.href='/reset'</script>";
            }
        }else{
            echo "<script>alert('验证码错误');location.href='/password/reset'</script>";
        }

    }

    //修改密码
    public function updateAvatar(Request $request){
        $base64_img = trim($request->avatar);
        $up_dir = 'home/avatar/';

        if(!file_exists($up_dir)){
          mkdir($up_dir,0777);
        }

        if(preg_match('/^(data:\s*image\/(\w+);base64,)/', $base64_img, $result)){
            $type = $result[2];
            if(in_array($type,array('pjpeg','jpeg','jpg','gif','bmp','png'))){
                $new_file = $up_dir.date('YmdHis_').'.'.$type;

                if(file_put_contents($new_file, base64_decode(str_replace($result[1], '', $base64_img)))){
                    $img_path = str_replace('../../..', '', $new_file);

                    if(Auth::user()->update(['avatar'=>'/'.$new_file])){
                        return response()->json(['result'=>'ok','file'=>$request->avatar]);
                    }else{
                        return response()->json(['result'=>'no']);
                    }

                }else{
                    return response()->json(['result'=>'no']);
                }
            }else{
                //文件类型错误
                return response()->json(['result'=>'no']);
            }

        }else{
            //文件错误
            return response()->json(['result'=>'no']);
        }
    }


    //文章的评论
    public function commentArticles(Request $request){
        $user = User::findOrFail($request->id);

        $comments = CommentArticle::where('user_id',$request->id)->orderBy('time','desc')->paginate(10);

        return view('home.personal.commentArticles',compact('user','comments'));
    }

    //帖子的回复
    public function replyPosts(Request $request){
        $user = User::findOrFail($request->id);

        $replies = Reply::where('user_id',$request->id)->orderBy('time','desc')->paginate(10);

        return view('home.personal.replyPosts',compact('user','replies'));
    }

    //完善信息
    public function perfect(Request $request){
        if($request->id != Auth::id()){
            return back();
        }

        $user = User::findOrFail($request->id);

        $banks = Bank::where('user_id','=',$request->id)->get();

        // $banks = json_encode($bank);
        // dd($banks);
        return view('home.personal.perfect',compact('user','banks'));
    }

    //我的地址
    public function address(Request $request){
        if($request->id != Auth::id()){
            return back();
        }

        $user = User::findOrFail($request->id);

        $addresses = Address::where('user_id',$request->id)->get();

        return view('home.personal.address',compact('user','addresses'));
    }
}
