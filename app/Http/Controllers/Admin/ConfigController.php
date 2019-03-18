<?php

namespace App\Http\Controllers\Admin;

use App\Config;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\HotSearch;

class ConfigController extends Controller
{
    public function index(){
    	$config = Config::first();
    	return view('admin.config.config',compact('config'));
    }

    public function store(Request $request){
    	$config = Config::first();

    	$file = $request->file('logo');
        $file2= $request->file('longPic');
        $filePath = 0;

        if(!empty($file)){//此处防止没有文件上传的情况
            $destinationPath = '/admins/images';
            $extension = $file->getClientOriginalExtension();
            $fileName = date('YmdHis').mt_rand(100,999).'.'.$extension;
            $file->move(public_path().$destinationPath, $fileName);
            $filePath = $destinationPath.'/'.$fileName;
        }

        $filePath2 = 0;

        if(!empty($file2)){//此处防止没有文件上传的情况
            $destinationPath2 = '/admins/images';
            $extension2 = $file2->getClientOriginalExtension();
            $fileName2 = date('YmdHis').mt_rand(100,999).'.'.$extension2;
            $file2->move(public_path().$destinationPath2, $fileName2);
            $filePath2 = $destinationPath2.'/'.$fileName2;
        }

    	//判断数据库有没有配置信息，如果没有添加
    	if(!$config){

	        Config::create([
	        	'siteName' => $request->siteName ? $request->siteName : ' ',
    			'website' => $request->website ? $request->website : ' ',
    			'logo' => $filePath ? $filePath : ' ',
    			'contacts' => $request->contacts ? $request->contacts : ' ',
    			'qq' => $request->qq ? $request->qq : ' ',
    			'email' => $request->email ? $request->email : ' ',
    			'phone' => $request->phone ? $request->phone : ' ',
    			'telephone' => $request->telephone ? $request->telephone : ' ',
    			'address' => $request->address ? $request->address : ' ',
    			'title' => $request->title ? $request->title : ' ',
    			'keywords' => $request->keywords ? $request->keywords : ' ',
    			'description' => $request->description ? $request->description : ' ',
                'longPic' => $filePath2 ? $filePath2 : '',
	        ]);

	        return redirect()->action('Admin\ConfigController@index');

    	}else{

    		$config->update([
    			'siteName' => $request->siteName ? $request->siteName : ' ',
    			'website' => $request->website ? $request->website : ' ',
    			'logo' => $filePath ? $filePath : $config->logo,
    			'contacts' => $request->contacts ? $request->contacts : ' ',
    			'qq' => $request->qq ? $request->qq : ' ',
    			'email' => $request->email ? $request->email : ' ',
    			'phone' => $request->phone ? $request->phone : ' ',
    			'telephone' => $request->telephone ? $request->telephone : ' ',
    			'address' => $request->address ? $request->address : ' ',
    			'title' => $request->title ? $request->title : ' ',
    			'keywords' => $request->keywords ? $request->keywords : ' ',
    			'description' => $request->description ? $request->description : ' ',
                'longPic' => $filePath2 ? $filePath2 : '',
    		]);

    		return redirect()->action('Admin\ConfigController@index');

    	}
    }

    //热搜
    public function hotSearch(){
        $hot = HotSearch::orderBy('order','asc')->get();
        return view('admin.config.hotSearch',compact('hot'));
    }

    public function changeHotSearch(Request $request){


        switch ($request->type) {
            case 1:
                if(HotSearch::where('name','=',$request->name)->get()->count() > 0){
                    return 'exit';
                }

                $maxid = HotSearch::max('order');
                $maxid++;

                $res = HotSearch::create([
                    'name' => $request->name,
                    'link' => $request->link,
                    'order' => $maxid,
                ]);

                if($res){
                    return $res;
                }else{
                    return '2';
                }
            break;
            case 2:
                if(HotSearch::where('id','=',$request->sid)->delete()){
                    return '1';
                }else{
                    return '2';
                }
            break;
            case 3:
                if(HotSearch::where('name','=',$request->name)->get()->count() > 0){
                    return 'exit';
                }
                $res = HotSearch::where('id','=',$request->sid)->update(['name'=>$request->name,'link'=>$request->link]);
                if($res){
                    return '1';
                }else{
                    return '2';
                }
            break;
            case 4:
                //下
                if($request->wz == 1){

                  $res = HotSearch::where('id','=',$request->sid)->first();

                  $res1 = HotSearch::where('order','>',$res->order)->first();
                  //被更换
                  $a = $res['order'];
                  //更换
                  $b = $res1['order'];

                  HotSearch::where('order','>',$a)->first()->update(['order'=>$a]);
                  HotSearch::where('id','=',$request->sid)->first()->update(['order'=>$b]);
                  return 1;
                }else{
                //上
                  $res = HotSearch::where('id','=',$request->sid)->first();

                  $res1 = HotSearch::where('order','<',$res->order)->first();
                  //被更换
                  $a = $res['order'];
                  //更换
                  $b = $res1['order'];

                  HotSearch::where('order','<',$a)->first()->update(['order'=>$a]);
                  HotSearch::where('id','=',$request->sid)->first()->update(['order'=>$b]);

                  return 1;
                }
            break;

            default:
                # code...
                break;
        }



    }
}
