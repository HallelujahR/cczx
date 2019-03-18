<?php

namespace App\Http\Controllers;

use App\confirm_deals;
use App\Deal;
use App\DealCate;
use App\topic;
use App\topic_cate;
use App\User;
use App\deal_messages;
use App\mark_list;
use Auth;
use DB;
use App\Revoke;

use Illuminate\Http\Request;

class DealSonController extends Controller
{
    //
    public function index(){

    }

    public function dealbar(){
        $dealCates = DealCate::orderBy('sort')->get();

       foreach($dealCates as $k => $v){
           $v['deals'] = Deal::where(['deal_cate'=>$v->id])->limit(10)->orderBy('created_at','desc')
               ->get();

           foreach($v['deals'] as $deal){
               $deal->deliveryMethods = json_decode($deal->deliveryMethods,true);
           }

           $v['countBuy'] = Deal::where('deal_cate',$v->id)->where('check',1)->count();
           $v['countSell'] = Deal::where('deal_cate',$v->id)->where('check',2)->count();
       }

       $topicCates = topic_cate::get();
        foreach($topicCates as $k => $v){
            $v['topics'] = topic::where('cate_id','=',$v->id)->limit(10)->orderBy('created_at','desc')->get();
        }

        //最近撤销
        $revokes = Revoke::orderBy('created_at','desc')->limit(10)->get();

        foreach($revokes as $k => $v){
            $revokes[$k]['deliveryMethods'] = json_decode($revokes[$k]['deliveryMethods']);
        }


        //最近成交
        $confirm = Deal::where('status',3)->orWhere('status',4)->orderBy('updated_at')->limit(10)->get();

        foreach($confirm as $k => $v){
            $confirm[$k]['deliveryMethods'] = json_decode($confirm[$k]['deliveryMethods']);
        }

        return view('home.deal.dealbar',compact('dealCates','topicCates','revokes','confirm'));
    }


    public function detail(Request $request, $id){
        $post = Deal::findOrFail($id);

        $post->increment('views');
        $post['deliveryMethods'] = json_decode($post['deliveryMethods'],true);

        $date=floor(($post['validity']-time())/86400);
        if($date < 0) {
            $date = '已经过期';
        }else{
            $date = $date.'天';
        };


        $messages = deal_messages::where('deal_id','=',$id)->orderby('id','desc')->orderBy('id','desc')->paginate(15);

        $confirm = confirm_deals::where('deal_id','=',$id)->orderBy('id','desc')->get();


            $gljy = Deal::where('upper','=',$post['id'])->where('status','!=','0')->orderBy('id','desc')->get();


            $res = confirm_deals::where('deal_id','=',$post['id'])->get();
            $sy = 0;
            if(count($gljy) > 0){
                $sy = Deal::where('upper','=',$post['id'])->where('status','=','0')->orderBy('id','desc')->get();
            }else{
                $gljy = Deal::where('upper','=',$post['upper'])->where('status','!=','0')->orderBy('id','desc')->get();
                $sy = Deal::where('upper','=',$post['upper'])->where('status','=','0')->orderBy('id','desc')->get();
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

        $newDeal = Deal::where('shopName','=',$post['shopName'])->where('status','!=','0')->orderBy('id','desc')->limit('15')->get();

        foreach ( $newDeal as $k => $v) {
            $newDeal[$k]['deliveryMethods'] = json_decode($newDeal[$k]['deliveryMethods'],true);
        }

        //相关板块的最新买卖盘以及成交
        $cateDeal = [];
        $cateDeal['newDeal'] = Deal::where('deal_cate','=',$post['deal_cate'])->where('status','=','0')->orderBy('id','desc')->limit('15')->get();

        $cateDeal['newConfirm'] = Deal::where('deal_cate','=',$post['deal_cate'])->where('status','!=','0')->orderBy('id','desc')->limit('15')->get();


        foreach ( $cateDeal['newDeal'] as $k => $v) {

            $cateDeal['newDeal'][$k]['deliveryMethods'] = json_decode($cateDeal['newDeal'][$k]['deliveryMethods'],true);
        }

        foreach ( $cateDeal['newConfirm'] as $k => $v) {
            $cateDeal['newConfirm'][$k]['deliveryMethods'] = json_decode($cateDeal['newConfirm'][$k]['deliveryMethods'],true);
        }

        $mark = mark_list::where('deal_id',$post->id)->get();

        return view('home.deal.details',compact('post','date','messages','confirm','gljy','sy','buyDeal','sellDeal','newDeal','cateDeal','mark'));

    }


    public function dealcate($cateid){

        $deals = Deal::where('deal_cate','=',$cateid)->orderBy('id','desc')->paginate(20);
        $cate = DealCate::findOrFail($cateid);
        $allcates = DealCate::get();
        return view('home.deal.dealcate',compact('deals','cate','allcates'));
    }

    public function search(Request $request){
        $check = $request->all()['check'];
        $dealcate = $request->all()['deal_cate'];
        $type = $request->all()['searchType'];
        $text = $request->all()['text'];
        if($text == null){
            $text = '';
        }
        if($dealcate != '0'){
            $cate = DealCate::findOrFail($dealcate);
        }else{
            $cate['name'] = '所有板块';
        }

        $allcates = DealCate::get();

        if($check != 0){

            if($type == 'user_id' || $type == 'trader'){
                if($dealcate == '0'){
                    $text = User::where('name','=',$text)->first()['id'];
                    $deals =  Deal::where(['check' => $check,$type=>$text])->orderBy('id','desc')->paginate(20);
                }else{
                    $text = User::where('name','=',$text)->first()['id'];
                    $deals =  Deal::where(['check' => $check,'deal_cate' => $dealcate,$type=>$text])->orderBy('id','desc')->paginate(20);
                }
            }else{
                if($dealcate == '0'){
                    $deals =  Deal::where(['check' => $check])->where($type,'like','%'.$text.'%')->orderBy('id','desc')->paginate(20);
                }else{
                    $deals =  Deal::where(['check' => $check,'deal_cate' => $dealcate])->where($type,'like','%'.$text.'%')->orderBy('id','desc')->paginate(20);
                }
            }
        }else{
            if($type == 'user_id' || $type == 'trader'){
                if($dealcate == '0'){
                    $text = User::where('name','=',$text)->first()['id'];
                    $deals =  Deal::where([$type=>$text])->orderBy('id','desc')->paginate(20);
                }else{
                    $text = User::where('name','=',$text)->first()['id'];
                    $deals =  Deal::where(['deal_cate' => $dealcate,$type=>$text])->orderBy('id','desc')->paginate(20);
                }

            }else{
                if($dealcate == '0'){

                    $deals =  Deal::where($type,'like','%'.$text.'%')->orderBy('id','desc')->paginate(20);
                }else{
                    $deals =  Deal::where(['deal_cate' => $dealcate])->where($type,'like','%'.$text.'%')->orderBy('id','desc')->paginate(20);
                }
            }
        }

        $backR = $request->all();
        $backR['text'] = $text;


        return view('home.deal.dealcate',compact('deals','cate','allcates','backR'));
    }

    public function message(Request $request){

        $message =  deal_messages::create([
            'user_id' => Auth::id(),
            'deal_id' => $request->input('deal_id'),
            'message' => $request->input('message'),
        ]);

        if($message){
            flash('留言成功')->success();
            return redirect()->action('DealSonController@detail',$request->input('deal_id'));
        }else{
            flash('留言失败请重新留言')->error();
            return redircet()->action('DealSonController@detail',$request->input('deal_id'));
        }
    }

    //确认交易
    public function confirm(Request $request){
//        dd($request->id);
        $user = User::findOrFail(Auth::id());
        if($user->card->status != 3){
            flash('请实名认证完毕之后才可交易，请尽快实名认证！');
            return back();
        }
        
        $post = Deal::findOrFail($request->id);
        $post['deliveryMethods'] = json_decode($post['deliveryMethods'],true);

        $date=floor(($post['validity']-time())/86400);
        if($date < 0) {
            $date = '已经过期';
        }else{
            $date = $date.'天';
        };
        return view('home.deal.confirm',compact('post','date'));
    }


    public function trade(Request $request){
        if(!$request->get('shopName') && !$request->get('id')){
            return redirect()->back();
        }

        if($request->get('id')){
            $id = $request->get('id');
            $name = DealCate::findOrFail($request->get('id'))['name'];
            $deals =  Deal::where('deal_cate','=',$id)->where('status','!=','0')->paginate(20);

            $buyDeal = Deal::where('deal_cate','=',$id)->where('check','=','1')->orderBy('unitPrice','desc')
                ->orderBy('created_at','desc')->limit('15')->get();
            $sellDeal = Deal::where('deal_cate','=',$id)->where('check','=','2')->orderBy('unitPrice','desc')
                ->orderBy('created_at','desc')->limit('15')->get();


            foreach ( $buyDeal as $k => $v) {
                $buyDeal[$k]['deliveryMethods'] = json_decode($buyDeal[$k]['deliveryMethods'],true);
            }

            foreach ( $sellDeal as $k => $v) {
                $sellDeal[$k]['deliveryMethods'] = json_decode($sellDeal[$k]['deliveryMethods'],true);

            }

        }elseif($request->get('shopName')){
            $shopName = $request->get('shopName');
            $deals =  Deal::where('shopName','=',$request->get('shopName'))->where('status','!=','0')->paginate(20);

            $buyDeal = Deal::where('shopName','=',$shopName)->where('check','=','1')->orderBy('unitPrice','desc')->orderBy('created_at','desc')->limit('15')->get();
            $sellDeal = Deal::where('shopName','=',$shopName)->where('check','=','2')->orderBy('unitPrice','desc')->orderBy('created_at','desc')->limit('15')->get();


            foreach ( $buyDeal as $k => $v) {
                $buyDeal[$k]['deliveryMethods'] = json_decode($buyDeal[$k]['deliveryMethods'],true);
            }

            foreach ( $sellDeal as $k => $v) {
                $sellDeal[$k]['deliveryMethods'] = json_decode($sellDeal[$k]['deliveryMethods'],true);

            }
            $name = $shopName;
        }


        return view('home.deal.trade',compact('deals','buyDeal','sellDeal','name'));
    }

    public function confirmlist(Request $request){
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
                    $deals =  Deal::where(['check' => $check,$type=>$text])->whereDate('created_at' ,'>=', $start)
                        ->where('created_at','<=',$end)->where('status','!=',0)->where('status','!=',3)->orderBy('id','desc')->paginate
                    (20);

                }else{
                    $deals =  Deal::where(['check' => $check,'deal_cate' => $dealcate,$type=>$text])->whereDate('created_at' ,'>=', $start)->whereDate('created_at','<=',$end)->where('status','!=',0)->where('status','!=',3)->orderBy('id','desc')->paginate(20);

                }
            }else{
                if($dealcate == 0){
                    $deals =  Deal::where(['check' => $check])->whereDate('created_at' ,'>=', $start)->where('created_at','<=',$end)->where($type,'like','%'.$text.'%')->where('status','!=',0)->where('status','!=',3)->orderBy('id','desc')->paginate(20);

                }else{
                    $deals =  Deal::where(['check' => $check,'deal_cate' => $dealcate])->whereDate('created_at' ,
                        '>=',$start)->whereDate('created_at','<=',$end)->where($type,'like','%'.$text.'%')->where('status','!=',0)->where('status','!=',3)->orderBy('id','desc')->paginate(20);

                }
            }
        }else{
            if($type == 'user_id'){
                if($dealcate == 0){
                    $deals =  Deal::where([$type=>$text])->whereDate('created_at' ,'>=', $start)->where('created_at','<=',$end)->where('status','!=',0)->where('status','!=',3)->orderBy('id','desc')->paginate(20);
                }else{
                    $deals =  Deal::where(['deal_cate' => $dealcate,$type=>$text])->whereDate('created_at' ,'>=',
                        $start)->whereDate('created_at','<=',$end)->where('status','!=',0)->where('status','!=',3)
                        ->orderBy('id','desc')->paginate(20);
                }

            }else{
                if($dealcate == 0){

                    $deals =  Deal::where($type,'like','%'.$text.'%')->whereDate('created_at' ,'>=', $start)
                        ->whereDate('created_at','<=',$end)->where('status','!=',0)->where('status','!=',3)->orderBy('id','desc')->paginate(20);

                }else{

                    $deals =  Deal::where(['deal_cate' => $dealcate])->whereDate('created_at' ,'>=', $start)
                        ->whereDate('created_at','<=',$end)->where($type,'like','%'.$text.'%')->where('status','!=',
                            0)->where('status','!=',3)->orderBy('id','desc')->paginate(20);
                }
            }

        }

        $backR = $search;
        $backR['text'] = $text;

        return view('home.deal.confirmlist',compact('deals','allcates','search','time1','time2','backR'));
    }
}
