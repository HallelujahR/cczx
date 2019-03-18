<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Bank;
use App\IdentificationCard;

class PerfectController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }


    //创建银行卡信息
    public function createBank (Request $request) {

    	$arr = $request->all();

    	
    	$arr['user_id'] = Auth::id();

    	if(Bank::where('bankId','=',$arr['bankId'])->count() >= 1) return '3';
    	if(Bank::where('user_id','=',Auth::id())->count() >= 3) return '4';
    	$res = Bank::create($arr);

    	if($res){
    		return $res;
    	}else{
    		return '2';
    	}


    }

    //删除银行卡信息
    public function delBank (Request $request) {

    	$res = Bank::destroy($request['id']);
    	return $res;
    }

    //更改银行卡信息
    public function bankedit (Request $request) {
    	$arr = $request->all();
    	$id = $request['id'];
    	$num = Bank::where('bankId','=',$arr['bankId'])->where('id','!=',$id)->count();
    	if($num >= 1) return '3';
    	unset($arr['id']);

    	$res = Bank::findOrFail($id)->update($arr);

    	if($res){
    		return '1';
    	}else{
    		return '2';
    	}
    }

    //添加实名认证
    public function createCard(Request $request) {
        $card = IdentificationCard::where('user_id',Auth::id())->first();

        $flag = $card->update([
            'realName' => $request->realName,
            'idCard' => $request->idCard,
            'positive' => $this->upload_img($request->file('file1')),
            'opposite' => $this->upload_img($request->file('file2')),
            'hold' => $this->upload_img($request->file('file3')),
            'status' => 1
        ]);

        if($flag){
            flash('实名认证已提交完成，等待审核')->success();
            return redirect()->action('PersonalController@perfect',Auth::id());
        }else{
            flash('数据不符合请重新提交')->error();
            return redirect()->action('PersonalController@perfect',Auth::id());
        }

    }

    public function upload_img($file) {

        if ($file->isValid()) {
            $destinationPath = '/admins/cardPic/'.date('Y').'/'.date('m').'/'.date('d'); // public文件夹下面uploads/xxxx-xx-xx 建文件夹
            $extension = $file->getClientOriginalExtension();   // 上传文件后缀
            $fileName = date('YmdHis').mt_rand(100,999).'.'.$extension; // 重命名
            $file->move(public_path().$destinationPath, $fileName); // 保存图片
            $filePath = $destinationPath.'/'.$fileName;
            return $filePath;
        }

    }

}
