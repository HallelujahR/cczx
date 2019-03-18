<?php

namespace App\Http\Controllers\Admin;

use App\Link;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;

class LinkController extends Controller
{
	//浏览友情链接
    public function index(){    	
    	// 测试redis
		// if(Redis::exists('links')){
  //           $links = unserialize(Redis::get('links'));
  //       }else{
  //       	$links = Link::get();
  //       	Redis::setex('links', 10, serialize($links));
  //       }
        $links = Link::get();
    	return view('admin.link.index',compact('links'));
    }

    //添加友情链接
    public function add(){
    	return view('admin.link.add');
    }

    //执行添加
    public function store(Request $request){
    	Link::create($request->all());

    	return redirect()->action('Admin\LinkController@index');
    }

    //渲染修改页面
    public function edit(Request $request){
    	$link = Link::findOrFail($request->id);
    	return view('admin.link.edit',compact('link'));
    }

    //执行修改友链
    public function update(Request $request){
    	$link = Link::findOrFail($request->id);
    	$link->update($request->all());
    	return redirect()->action('Admin\LinkController@index');
    }

    //删除友链
    public function delete(Request $request){
    	Link::destroy($request->id);
    	return redirect()->action('Admin\LinkController@index');
    }

}