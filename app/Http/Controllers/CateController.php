<?php

namespace App\Http\Controllers;

use App\Cate;
use App\Article;
use Illuminate\Http\Request;

class CateController extends Controller
{
    public function index(Request $request){

    	//查询出点击进来的这条分类
    	$cate = Cate::findOrFail($request->id);

    	//查询出这条分类下的文章
    	$articles = Article::where('cate_id',$request->id)->orderBy('time','desc')->paginate(12);
    	
    	//查询相关分类(先判断点击进来的是顶级分类还是子类)
    	if($cate->pid == 0){
    		$xgCates = Cate::where('pid',$cate->id)->get();
    	}else{
    		$xgCates = Cate::where('pid',$cate->pid)->get();
    	}

		return view('home.cate.index',compact('cate','articles','xgCates'));
	}

}
