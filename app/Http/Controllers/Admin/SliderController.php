<?php

namespace App\Http\Controllers\Admin;

use App\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SliderController extends Controller
{
    public function index(){
        $sliders = Slider::orderBy('order_id','asc')->get();
        return view('admin.slider.index',compact('sliders'));
    }

    public function store(Request $request){
        $file = $request->file('pic');

        $filePath = 0;
        $maxid = (null !== Slider::max('order_id')) ? Slider::max('order_id') : 0;

        if(!empty($file)){//此处防止没有文件上传的情况
            $destinationPath = '/admins/sliderPic';
            $extension = $file->getClientOriginalExtension();
            $fileName = date('YmdHis').mt_rand(100,999).'.'.$extension;
            $file->move(public_path().$destinationPath, $fileName);
            $filePath = $destinationPath.'/'.$fileName;
        }

        Slider::create([
            'name' => $request->name,
            'path' => $filePath,
            'link' => $request->link,
            'order_id' => $maxid+1
        ]);

        return redirect()->action('Admin\SliderController@index');
    }

    public function delete(Request $request){
        if(Slider::destroy($request->id)){
            // 如果删除成功 重新排序loopPic表
            $idArr = Slider::orderBy('order_id')->get();
			foreach($idArr as $k=>$v){
                Slider::where('id',$v['id'])->update(['order_id'=>$k+1]);
			}
            return redirect()->action('Admin\SliderController@index');
        }else{
            return redirect()->action('Admin\SliderController@index');
        }
    }

    public function orderPic(Request $request){

		if( !($id = $request->id) || !($action = $request->action) ) return json_encode(['status'=>'no','error'=>'没有接收到必要参数']);

        $first = Slider::orderBy('order_id','asc')->first();
        $last = Slider::orderBy('order_id','desc')->first();
        $data = Slider::findOrFail($id);

        switch($action){
			case 'up':
				if($id == $first->id) return json_encode(['status'=>'no','error'=>'目前已是第一张']);

                Slider::where('order_id',$data->order_id-1)->first()->update(['order_id'=>$data->order_id]);
                $data->update(['order_id'=>$data->order_id-1]);
			break;

			case 'down':
				if($id == $last->id) return json_encode(['status'=>'no','error'=>'目前已是最后一张']);

                Slider::where('order_id',$data->order_id+1)->first()->update(['order_id'=>$data->order_id]);
                $data->update(['order_id'=>$data->order_id+1]);

			break;
			default:
				return json_encode(['status'=>'no','error'=>'action参数错误: up || down']);
			break;
		}

        return json_encode(['status'=>'ok']);

	}

    public function edit(Request $request){
        $slider = Slider::findOrFail($request->id);

        return view('admin.slider.edit',compact('slider'));
    }

    public function update(Request $request){
        $slider = Slider::findOrFail($request->id);
        $file = $request->file('path');

        $filePath = $slider->path;

        if(!empty($file)){//此处防止没有文件上传的情况
            $destinationPath = '/admins/sliderPic';
            $extension = $file->getClientOriginalExtension();
            $fileName = date('YmdHis').mt_rand(100,999).'.'.$extension;
            $file->move(public_path().$destinationPath, $fileName);
            $filePath = $destinationPath.'/'.$fileName;
        }

        $slider->update([
            'name'=>$request->name,
            'link'=>$request->link,
            'path'=>$filePath
        ]);

        return redirect()->action('Admin\SliderController@index');
    }
}
