<?php

namespace App\Http\Controllers\Admin;

use DB;
use App\BbsCate;
use Illuminate\Http\Request;
use App\Http\Requests\BbsCateRequest;
use App\Http\Controllers\Controller;

class BbsCateController extends Controller
{
	//展示论坛下的所有分类
    public function index(){
    	$cates = getCateByPid(BbsCate::get());
    	return view('admin.bbscate.index',compact('cates'));
    }

    //渲染添加分类页面
    public function create(Request $request){
    	$id = isset($request->id) ? $request->id : '';

        $cates = BbsCate::select(DB::raw("id,cate,pid,path,concat(path,id) as p"))->orderBy('p')->get();
        foreach($cates as $k=>$v){
            $cates[$k]['cate'] = str_repeat('|---',count(explode(',',$v['path']))-2).$v['cate'];
        }
        return view('admin.bbscate.create',compact('cates','id'));
    }

    //执行添加分类
    public function store(BbsCateRequest $request){
    	if($request->pid == 0){
            BbsCate::create([
                'cate' => $request->cate,
                'pid' => 0,
                'path' => '0,',
            ]);
        }else{
            BbsCate::create([
                'cate' => $request->cate,
                'pid' => $request->pid,
                'path' => BbsCate::findOrFail($request->pid)['path'].$request->pid.',',
            ]);
        }

        return redirect()->action('Admin\BbsCateController@index');
    }

    //渲染分类修改页面
    public function edit(Request $request){
    	$cate = BbsCate::findOrFail($request->id);
        return view('admin.bbscate.edit',compact('cate'));
    }

    //执行修改
    public function update(BbsCateRequest $request){
    	$cate = BbsCate::findOrFail($request->id);
        $cate->cate = $request->cate;
        $cate->save();

        return redirect()->action('Admin\BbsCateController@index');
    }

    //执行删除分类
    public function delete(Request $request){
        BbsCate::destroy($request->id);

        return redirect()->action('Admin\BbsCateController@index');

    }

    //查询该分类下是否有子类
    public function chaxun(Request $request){
        if(BbsCate::where('path','like','%,'.$request->get('id').',%')->count() > 0){
            return 'no';
        }else{
            return 'ok';
        }
    }

    //查询这个分类下的所有帖子
    public function posts(Request $request){
        $cate = BbsCate::findOrFail($request->id);

        return view('admin.bbscate.posts',compact('cate'));
    }
}
