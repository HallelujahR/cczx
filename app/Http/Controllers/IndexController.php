<?php

namespace App\Http\Controllers;

use Auth;
use App\Cate;
use App\Link;
use App\BbsCate;
use App\Config;
use App\Deal;
use App\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use App\Announcement;
use App\Post;
use App\Notice;
use App\User;
use App\Message;
class IndexController extends Controller
{
	//首页
    public function index(){
    	// 利用redis做一个缓存遍历分类及文章
		if(Redis::exists('catehs')){
            $catehs = unserialize(Redis::get('catehs'));
        }else{
        	//横条分类遍历
    		$catehs = getCateByPid(Cate::where('check',0)->get());

    		//横条下文章遍历
	    	foreach($catehs as $k=>$cate){
	    		$arr = [];
	    		array_push($arr,$cate->id);
	    		foreach(Cate::where('pid',$cate->id)->get() as $s_cate){
	    			array_push($arr,$s_cate->id);
	    		}

	    		//最新资讯
	    		$cate['newArticles'] = Article::whereIn('cate_id',$arr)->orderBy('time','desc')->limit(12)->get();

	    		//最热资讯
	    		$cate['hotArticles'] = Article::whereIn('cate_id',$arr)->orderBy('access_count','desc')->limit(13)->get();
	    	}

        	Redis::setex('catehs', 86400, serialize($catehs));
        }

        if(Redis::exists('index_bbs_cates')){
            $indexBbsCates = unserialize(Redis::get('index_bbs_cates'));
        }else{
            $indexBbsCates = getCateByPid(BbsCate::get());

            foreach($indexBbsCates as $k=>$indexBbsCate){
                $arr = [];
                array_push($arr,$indexBbsCate->id);
                foreach(BbsCate::where('pid',$indexBbsCate->id)->get() as $s_indexBbsCate){
                    array_push($arr,$s_indexBbsCate->id);
                }

                $indexBbsCate['newPosts'] = Post::whereIn('bbs_cate_id',$arr)->orderBy('time','desc')->limit(6)->get();

                $indexBbsCate['hotPosts'] = Post::whereIn('bbs_cate_id',$arr)->orderBy('access_count','desc')->limit(3)->get();
            }

            Redis::setex('index_bbs_cates', 86400, serialize($indexBbsCates));
        }

        //最近成交
        $confirm = Deal::where('status',3)->orWhere('status',4)->orderBy('updated_at','desc')->limit(12)->get();

        foreach($confirm as $k => $v){
            $confirm[$k]['deliveryMethods'] = json_decode($confirm[$k]['deliveryMethods']);
        }

        //遍历轮播图
        // $sliders = Slider::orderBy('order_id')->get();
        //查询公告
        // $Notice = Notice::orderBy('created_at','desc')->limit(7)->get();

        //查询精选文章和帖子
        // if(Redis::exists('jx')){
        // 	$jx = unserialize(Redis::get('jx'));
        // }else{
	    //     $jxwz = Article::orderBy('access_count','desc')->limit(7)->get();
	    //     $jxtz = Post::orderBy('access_count','desc')->limit(7)->get();
	    //     $jx['jxwz'] = $jxwz;
	    //     $jx['jxtz'] = $jxtz;
        // 	Redis::setex('jx', 86400, serialize($jx));
        // }

        //首页的网站概况
        // $gk = [];
        // $gk['userCount'] = User::count()+50000;
        // $gk['lastUser'] = User::orderBy('id','desc')->first();
        // $today = date('Y-m-d');
        // $gk['jrft'] = Post::whereDate('created_at',$today)->count();
        // $gk['zrft'] = Post::whereDate('created_at',date("Y-m-d",strtotime("-1 day")))->count();
        //
        // $gk['cateCount'] = Cate::count();
        //
        // $gk['postCount'] = Post::count();
        // $gk['articleCount'] = Article::count();

        //查询首页的友情链接
        $links = Link::where('status',1)->get();

        //查询网站配置
        $config = Config::first();

    	return view('home.index',compact('catehs','links','config','confirm','indexBbsCates'));
    }
}
