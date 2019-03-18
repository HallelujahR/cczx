<?php

namespace App\Http\Controllers;

use Auth;
use App\Deal;
use App\Revoke;
use App\confirm_deals;
use App\DealCate;
use App\User;
use App\deal_messages;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RevokeController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function revoke(Request $request){
        $deal = Deal::findOrFail($request->id)->toArray();

        $data = $deal;
        $data ['status'] = 10;
        unset($data['id']);
        unset($data['updated_at']);

        $revoke = Revoke::create($data);

        if($revoke){
            deal_messages::where('deal_id',$request->id)->delete();
            Deal::destroy($request->id);

            return 'ok';
        }else{
            return 'no';
        }
    }

    public function detail($id){
        $post = Revoke::findOrFail($id);

        $post->increment('views');
        $post['deliveryMethods'] = json_decode($post['deliveryMethods'],true);

        $date=floor(($post['validity']-time())/86400);
        if($date < 0) {
            $date = '已经过期';
        }else{
            $date = $date.'天';
        };


        $messages = deal_messages::where('deal_id','=',$id)->orderby('id','desc')->paginate(15);

        $confirm = confirm_deals::where('deal_id','=',$id)->get();


        $gljy = Deal::where('upper','=',$post['id'])->where('status','!=','0')->get();


        $res = confirm_deals::where('deal_id','=',$post['id'])->get();
        $sy = 0;
        if(count($gljy) > 0){
            $sy = Deal::where('upper','=',$post['id'])->where('status','=','0')->get();
        }else{
            $gljy = Deal::where('upper','=',$post['upper'])->where('status','!=','0')->get();
            $sy = Deal::where('upper','=',$post['upper'])->where('status','=','0')->get();
            if(count($gljy) < 1){
                $gljy = false;
            }
        }


        $post['pic'] = json_decode($post['pic']);

        $buyDeal = Deal::where('shopName','=',$post['shopName'])->where('check','=','1')->orderBy('unitPrice','desc')->orderBy('created_at','desc')->limit('15')->get();
        $sellDeal = Deal::where('shopName','=',$post['shopName'])->where('check','=','2')->orderBy('unitPrice','desc')->orderBy('created_at','desc')->limit('15')->get();


        foreach ( $buyDeal as $k => $v) {
            $buyDeal[$k]['deliveryMethods'] = json_decode($buyDeal[$k]['deliveryMethods'],true);
        }

        foreach ( $sellDeal as $k => $v) {
            $sellDeal[$k]['deliveryMethods'] = json_decode($sellDeal[$k]['deliveryMethods'],true);

        }

        $newDeal = Deal::where('shopName','=',$post['shopName'])->where('status','!=','0')->limit('15')->get();

        foreach ( $newDeal as $k => $v) {
            $newDeal[$k]['deliveryMethods'] = json_decode($newDeal[$k]['deliveryMethods'],true);
        }

        //相关板块的最新买卖盘以及成交
        $cateDeal = [];
        $cateDeal['newDeal'] = Deal::where('deal_cate','=',$post['deal_cate'])->where('status','=','0')->orderBy('created_at')->limit('15')->get();

        $cateDeal['newConfirm'] = Deal::where('deal_cate','=',$post['deal_cate'])->where('status','!=','0')->orderBy('updated_at')->limit('15')->get();


        foreach ( $cateDeal['newDeal'] as $k => $v) {

            $cateDeal['newDeal'][$k]['deliveryMethods'] = json_decode($cateDeal['newDeal'][$k]['deliveryMethods'],true);
        }

        foreach ( $cateDeal['newConfirm'] as $k => $v) {
            $cateDeal['newConfirm'][$k]['deliveryMethods'] = json_decode($cateDeal['newConfirm'][$k]['deliveryMethods'],true);
        }

        return view('home.deal.revoke',compact('post','date','messages','confirm','gljy','sy','buyDeal','sellDeal','newDeal','cateDeal'));
    }

    public function release(Request $request){
        if(Deal::where(['id'=>$request->id,'status'=>3])->count() > 0){
            $revoke = Deal::where(['id'=>$request->id,'status'=>3])->first();
        }else{
            $revoke = Revoke::findOrFail($request->id);
        }

        $revoke->deliveryMethods = json_decode($revoke->deliveryMethods,true);

        $cate = DealCate::get();



        return view('home.deal.release',compact('cate','revoke'));
    }

    public function store(Request $request){

        $pic = [];

        if($request->file('pic1')){
            $pic[] = $this->uploadPic($request->file('pic1'));
        }

        if($request->file('pic2')){
            $pic[] = $this->uploadPic($request->file('pic2'));
        }

        if($request->file('pic3')){
            $pic[] = $this->uploadPic($request->file('pic3'));
        }

        if($request->input('shopid') == null){
            $mallGoods = 0;
        }else{
            $mallGoods = $request->input('shopid');
        }
        $deal = Deal::create([
            'user_id' => Auth::id(),
            'check' => $request->input('check'),
            'deal_cate' => $request->input('deal_cate'),
            'shopName' => $request->input('shopName'),
            'productPhase' => $request->input('productPhase'),
            'unit' => $request->input('unit'),
            'num' => $request->input('num'),
            'unitPrice' => $request->input('unitPrice'),
            'total' => intval($request->input('total')),
            'otherExpenses' => $request->input('otherExpenses'),
            'minQuantity' => $request->input('minQuantity'),
            'deliveryMethods' => json_encode($request->input('deliveryMethods')),
            'validity' => time()+86400*30,
            'instructions' => $request->input('instructions'),
            'item' => 0,
            'anonymousPosting' => 0,
            'sms' => $request->input('sms'),
            'caption' => $request->input('caption') ? $request->input('caption') : ' ',
            'pic' => json_encode($pic),
            'mallGoods' => $mallGoods,
            'trader' => 0,
            'upper' => 0,
            'status' => 0,
        ]);

        if($deal){
            Deal::find($deal['id'])->update(['upper' => $deal['id']]);
            flash('重新发布成功，等待交易！')->success();
            return redirect()->action('DealSonController@detail',$deal->id);
        }else{
            flash('重新发布失败，请重新填写！')->error();
            return back();
        }
    }

    public function uploadPic($file){
        if ($file->isValid()) {
            $destinationPath = '/home/dealPic/'.date('Y').'/'.date('m').'/'.date('d'); // public文件夹下面uploads/xxxx-xx-xx 建文件夹
            $extension = $file->getClientOriginalExtension();   // 上传文件后缀
            $fileName = date('YmdHis').mt_rand(100,999).'.'.$extension; // 重命名
            $file->move(public_path().$destinationPath, $fileName); // 保存图片
            $filePath = $destinationPath.'/'.$fileName;
            return $filePath;
        }
    }

    public function revokeRelease(Request $request){
        $deal = Deal::findOrFail($request->id)->toArray();

        $data = $deal;
        $data ['status'] = 10;
        unset($data['id']);
        unset($data['updated_at']);

        $revoke = Revoke::create($data);

        if($revoke){
            deal_messages::where('deal_id',$request->id)->delete();
            Deal::destroy($request->id);

            return redirect()->action('RevokeController@release',$revoke->id);
        }
    }


    public function list(Request $request){
//dd($request);
        $check = $request->all()['check'];
        $dealcate = $request->all()['deal_cate'];
        $type = $request->all()['searchType'];
        $text = $request->all()['text'];
        $start = $request->all()['start'];
        $end = $request->all()['end'];
        $search = $request->all();
        $allcates = DealCate::get();
        if($text == null){
            $text = '';
        }

        $time1 = date("Y-m-d");
        $time2 = date('Y-m-d');

        if($start == 0){
            $start = '1970-01-01';
        }else{
            $time1 = $start;
        }

        if($start == date("Y-m-d")){
            $start = date("Y-m-d",strtotime("-1 day"));
        }

        if($end == 0){
            $end =  date("Y-m-d",strtotime("+1 day"));
        }else{
            $time2 = $end;
        }

        if($check != 0){

            if($type == 'user_id'){
                if($dealcate == 0){
                    $deals =  Revoke::where(['check' => $check,$type=>$text])->whereDate('created_at' ,'>=', $start)
                        ->where('created_at','<=',$end)->where('status',10)->paginate(20);

                }else{

                    $deals =  Revoke::where(['check' => $check,'deal_cate' => $dealcate,$type=>$text])->whereDate('created_at' ,'>=', $start)->whereDate('created_at','<=',$end)->where('status',10)->paginate(20);

                }
            }else{
                if($dealcate == 0){
                    $deals =  Revoke::where(['check' => $check])->whereDate('created_at' ,'>=', $start)->where('created_at','<=',$end)->where($type,'like','%'.$text.'%')->where('status',10)->paginate(20);

                }else{

                    $deals =  Revoke::where(['check' => $check,'deal_cate' => $dealcate])->whereDate('created_at' ,'>=',$start)->whereDate('created_at','<=',$end)->where($type,'like','%'.$text.'%')->where('status',10)->paginate(20);


                }
            }
        }else{
            if($type == 'user_id'){

                if($dealcate == 0){
                    $deals =  Revoke::where([$type=>$text])->whereDate('created_at' ,'>=', $start)->where('created_at','<=',$end)->where('status',10)->paginate(20);
                }else{
                    $deals =  Revoke::where(['deal_cate' => $dealcate,$type=>$text])->whereDate('created_at' ,'>=',
                        $start)->whereDate('created_at','<=',$end)->where('status',10)->paginate(20);
                }

            }else{

                if($dealcate == 0){

                    $deals =  Revoke::where($type,'like','%'.$text.'%')->whereDate('created_at' ,'>=', $start)
                        ->whereDate('created_at','<=',$end)->where('status',10)->paginate(20);

                }else{

                    $deals =  Revoke::where(['deal_cate' => $dealcate])->whereDate('created_at' ,'>=', $start)
                        ->whereDate('created_at','<=',$end)->where($type,'like','%'.$text.'%')->where('status',10)
                        ->paginate(20);
                }
            }

        }
        $backR = $search;
        $backR['text'] = $text;


        return view('home.deal.revokelist',compact('deals','allcates','search','time1','time2','backR'));
    }
}
