<?php

namespace App\Http\Controllers\Admin;

use DB;
use App\Cate;
use App\Article;
use App\Content;
use Illuminate\Http\Request;
use App\Http\Requests\CateRequest;
use App\Http\Controllers\Controller;

class CateController extends Controller
{
    public function index(){
    	$cates = $this->getCateByPid(Cate::get());
    	return view('admin.cate.index',compact('cates'));
    }

    //添加分类
    public function add(Request $request){
        $id = isset($request->id) ? $request->id : '';

        if($request->id){
            $check = Cate::findOrFail($id)['check'];
        }else{
            $check = 0;
        }

        $cates = Cate::select(DB::raw("id,cate,pid,path,concat(path,id) as p"))->orderBy('p')->get();
        foreach($cates as $k=>$v){
            $cates[$k]['cate'] = str_repeat('|---',count(explode(',',$v['path']))-2).$v['cate'];
        }
        return view('admin.cate.add',compact('cates','id','check'));
    }

    //执行添加分类
    public function store(CateRequest $request){

        $file = $request->file('file');

        $filePath = 0;

        if(!empty($file)){//此处防止没有多文件上传的情况
            $destinationPath = '/admins/catePic/'.date('Y-m-d');
            $extension = $file->getClientOriginalExtension();
            $fileName = date('YmdHis').mt_rand(100,999).'.'.$extension;
            $file->move(public_path().$destinationPath, $fileName);
            $filePath = $destinationPath.'/'.$fileName;
        }

        if($request->pid == 0){
            Cate::create([
                'cate' => $request->cate,
                'pid' => 0,
                'path' => '0,',
                'check' => $request->check,
                'catePic' => $filePath ? $filePath : '/home/images/web-4-45-1-11.jpg'
            ]);
        }else{
            Cate::create([
                'cate' => $request->cate,
                'pid' => $request->pid,
                'path' => Cate::findOrFail($request->pid)['path'].$request->pid.',',
                'check' => $request->check,
                'catePic' => $filePath ? $filePath : '/home/images/web-4-45-1-11.jpg'
            ]);
        }

        return redirect()->action('Admin\CateController@index');
    }

    //修改分类名称页面
    public function edit(Request $request){
        $cate = Cate::findOrFail($request->id);
        return view('admin.cate.edit',compact('cate'));
    }

    //执行修改分类名称
    public function update(Request $request){
        $cate = Cate::findOrFail($request->id);

        //获取传过来的图片
        $file = $request->file('file');

        $filePath = 0;

        if(!empty($file)){//此处防止没有多文件上传的情况
            $destinationPath = '/admins/catePic/'.date('Y-m-d');
            $extension = $file->getClientOriginalExtension();
            $fileName = date('YmdHis').mt_rand(100,999).'.'.$extension;
            $file->move(public_path().$destinationPath, $fileName);
            $filePath = $destinationPath.'/'.$fileName;
        }

        $cate->cate = $request->cate;
        $cate->check = $request->check;

        if(!$filePath == 0){
            $cate->catePic = $filePath;
        }
        
        $cate->save();

        return redirect()->action('Admin\CateController@index');
    }

    //执行删除分类
    public function delete(Request $request){
        Cate::destroy($request->id);

        //删除分类下的文章
        $articles = Article::where('cate_id',$request->id)->get();
        foreach($articles as $article){
            Content::where('article_id',$article->id)->delete();
            Article::destroy($article->id);
        }

        return redirect()->action('Admin\CateController@index');

    }

    //查询该分类下是否有子类
    public function chaxun(Request $request){
        if(Cate::where('path','like','%,'.$request->get('id').',%')->count() > 0){
            return 'no';
        }else{
            return 'ok';
        }
    }

    //查看这个分类下的所有文章
    public function articles(Request $request){

        $cate = Cate::findOrFail($request->id);

        return view('admin.cate.articles',compact('cate'));
    }

    /**
     * [getCateByPid 通过pid查询所有cate]
     * @param  [array]  $allcates [数据库数据]
     * @param  int $pid      [父类id]
     * @return [array]            [分层返回数组]
     */
    public function getCateByPid($allcates,$pid=0){
        $data = [];
        foreach($allcates as $k=>$v){
            if($v['pid'] == $pid){
                $v['sub'] = $this->getCateByPid($allcates,$v['id']);//根据自己的ID查询该类的子类
                $data[] = $v;
            }
        }
        return $data;
    }

}