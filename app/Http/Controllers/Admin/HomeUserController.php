<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Role;
use App\Post;
use App\Article;
use App\IdentificationCard;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\HomeUserRequest;

class HomeUserController extends Controller
{
    public function index(Request $request){

        if(!array_key_exists('name', $request->all()) ){
            $name = '';
        }else{
            $name = $request->all()['name'];
        }
        $homeUsers = User::where('name','like','%'.$name.'%')->paginate(10);

        $roles = Role::get();
    	return view('admin.homeuser.index',compact('homeUsers','roles','name'));
    }

    public function add(){
    	return view('admin.homeuser.add');
    }

    public function store(HomeUserRequest $request){
    	$homeUsers = User::create([
            'phone' => $request->phone,
    		'name' => $request->name,
    		'password' => bcrypt($request->password)
    	]);

        $homeUsers->detail()->create([
            'user_id'=> $homeUsers->id,
            'telephone'=>$homeUsers->phone,
        ]);

    	return redirect()->action('Admin\HomeUserController@index');
    }

    //前台用户发表的文章
    public function article(Request $request){

        //查询这个用户发布的文章
        $articles = Article::where('user_id',$request->id)->get();

        return view('admin.homeuser.article',compact('articles'));
    }

    //前台用户发表的帖子
    public function post(Request $request){

        //查询这个用户发布的帖子
        $posts = Post::where('user_id',$request->id)->get();

        return view('admin.homeuser.post',compact('posts'));
    }


    //更改用户权限
    public function changeStatus(Request $request){

        if(User::where('id','=',$request->uid)->update(['status'=>$request->status])){
            if($request->status == 0){
                return 0;
            }else{
                return 1;
            }
        };
    }

    //更改用户角色状态
    public function changeRole(Request $request){
        if(User::where('id',$request->id)->update(['role_id'=>$request->role_id])){
            return 1;
        }else{
            return 0;
        }
    }

    //审核认证会员
    public function cardAuth(Request $request){
        $cards = IdentificationCard::where('status',1)->get();

        return view('admin.homeuser.cardauth',compact('cards'));
    }

    //同意审核
    public function agreeCard(Request $request){
        $card = IdentificationCard::findOrFail($request->id);

        $flag = $card->update([
            'status' => 3
        ]);

        if($flag){
            if($card->user()->role_id != 1){
                $card->user()->update([
                    'role_id' => 3
                ]);
            }
            return 1;
        }else{
            return 0;
        }
    }

    //拒绝审核
    public function refuseCard(Request $request){
        $card = IdentificationCard::findOrFail($request->id);

        removePic($card->positive);
        removePic($card->opposite);
        removePic($card->hold);

        if($request->info == NULL){
            $flag = $card->update([
                'positive' => '0',
                'opposite' => '0',
                'hold' => '0',
                'status' => 2,
                'info' => $request->custom
            ]);
        }else{
            $flag = $card->update([
                'positive' => '0',
                'opposite' => '0',
                'hold' => '0',
                'status' => 2,
                'info' => implode(',',$request->info).','.$request->custom
            ]);
        }

        if($flag){
            return 1;
        }else{
            return 0;
        }

    }

}
