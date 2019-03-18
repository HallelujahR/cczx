<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\Deal;
use App\User;
use App\DealCate;
use App\confirm_deals;
use App\Revoke;
use App\mark_list;
use Illuminate\Http\Request;
use App\Notifications\DealNotification;

class DealController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $shop = DB::connection("mysql_shop")->table("goods")->find(1151);
//        dump($shop);
        // return view('home.deal.index');
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
            flash('发布交易成功，等待交易！')->success();
            return redirect()->action('DealSonController@detail',$deal->id);
        }else{
            if(intval($request->input('check')) == 1){
                flash('交易帖不符合要求，请重新填写！')->error();
                return redirect()->action('DealController@buy');
            }else{
                flash('交易帖不符合要求，请重新填写！')->error();
                return redirect()->action('DealController@sell');
            }
        }
    }

    public function searchShop(Request $request){
        $goods = DB::connection("mysql_shop")->table("goods")->where('name','like','%'.$request['data'].'%')
            ->offset($request['num'])->limit(5)->get(['id',
        'name',
            'sell_price','market_price','img']);

        return response()->json($goods);
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

    public function personalWait(Request $request){
        if($request->id != Auth::id()){
            flash('只能访问自己的交易系统！')->error();
            return back();
        }

        $user = User::findOrFail($request->id);

        $deals = Deal::where('user_id',$user->id)->where('status',0)->orderBy('created_at','desc')->paginate(10);
        foreach($deals as $deal){
            $deal->deliveryMethods = json_decode($deal->deliveryMethods,true);
        }

        $counts = $this->countPersonal($user->id);

        return view('home.deal.personalWait',compact('user','deals','counts'));
    }

    public function personalNow(Request $request){
        if($request->id != Auth::id()){
            flash('只能访问自己的交易系统！')->error();
            return back();
        }

        $user = User::findOrFail($request->id);


        $deals = Deal::where(['user_id'=>$user->id,'status'=>1])
        ->orWhere(function ($query) use ($user){
            $query->where('trader',$user->id)
            ->where('status',1);
        })->orderBy('created_at','desc')->paginate(10);


        foreach($deals as $deal){
            $deal->deliveryMethods = json_decode($deal->deliveryMethods,true);
        }

        $counts = $this->countPersonal($user->id);

        return view('home.deal.personalNow',compact('user','deals','counts'));
    }

    public function personalScore(Request $request){
        if($request->id != Auth::id()){
            flash('只能访问自己的交易系统！')->error();
            return back();
        }

        $user = User::findOrFail($request->id);

        $deals = Deal::where(['user_id'=>$user->id,'status'=>2])->orWhere(function ($query) use ($user){
            $query->where('trader',$user->id)
            ->where('status',2);
        })->orderBy('created_at','desc')->paginate(10);

        foreach($deals as $deal){
            $deal->deliveryMethods = json_decode($deal->deliveryMethods,true);
        }

        $counts = $this->countPersonal($user->id);

        return view('home.deal.personalScore',compact('user','deals','counts'));
    }

    public function personalComplete(Request $request){
        if($request->id != Auth::id()){
            flash('只能访问自己的交易系统！')->error();
            return back();
        }

        $user = User::findOrFail($request->id);

        $deals = Deal::where(['user_id'=>$user->id,'status'=>3])->orWhere(function ($query) use ($user){
            $query->where('user_id',$user->id)
            ->where('status',4);
        })->orWhere(function ($query) use ($user){
            $query->where('trader',$user->id)
            ->where('status',3);
        })->orWhere(function ($query) use ($user){
            $query->where('trader',$user->id)
            ->where('status',4);
        })->orderBy('created_at','desc')->paginate(10);

        foreach($deals as $k => $v ){
            $v['deliveryMethods'] = json_decode($v['deliveryMethods']);
            $v['mark'] = mark_list::where(['from_user_id'=>Auth::id(),'deal_id'=>$v['id']])->first();
        }

        $counts = $this->countPersonal($user->id);

        return view('home.deal.personalComplete',compact('user','deals','counts'));
    }

    public function credit($id){

        $user = User::findOrFail($id);

        $deals = Deal::where(['user_id'=>$id,'status'=>3])->orWhere(function ($query) use ($id){
            $query->where('user_id',$id)
                ->where('status',4);
        })->orWhere(function ($query) use ($id){
            $query->where('trader',$id)
                ->where('status',3);
        })->orWhere(function ($query) use ($id){
            $query->where('trader',$id)
                ->where('status',4);
        })->orderBy('created_at','desc')->paginate(10);

        foreach($deals as $k => $v ){
            $v['deliveryMethods'] = json_decode($v['deliveryMethods']);
            $v['mark'] = mark_list::where(['to_user_id'=>$id,'deal_id'=>$v['id']])->first();
        }

        $marklist = $deals;
//        $counts = $this->countPersonal($id);

        return view('home.deal.credit',compact('marklist','user'));
    }
    public function personalRevoke(Request $request){
        if($request->id != Auth::id()){
            flash('只能访问自己的交易系统！')->error();
            return back();
        }

        $user = User::findOrFail($request->id);

        $deals = Revoke::where('user_id',$user->id)->orderBy('created_at','desc')->paginate(10);
        foreach($deals as $deal){
            $deal->deliveryMethods = json_decode($deal->deliveryMethods,true);
        }

        $counts = $this->countPersonal($user->id);

        return view('home.deal.personalRevoke',compact('user','deals','counts'));
    }

    public function sell(){
        $user = User::findOrFail(Auth::id());
        if($user->card->status != 3){
            flash('必须实名认证后才能进行交易帖的发布！');
            return back();
        }

        $cate = DealCate::get();
        return view('home.deal.sell',compact('cate'));
    }

    public function buy(){
        $user = User::findOrFail(Auth::id());
        if($user->card->status != 3){
            flash('必须实名认证后才能进行交易帖的发布！');
            return back();
        }

        $cate = DealCate::get();
        return view('home.deal.buy',compact('cate'));
    }

    //确认交易
    public function confirmDeal(Request $request, confirm_deals $confirm, Deal $deal){
        $res = $deal->findOrFail($request->input('deal_id'));




        if($request->input()['num'] < $res['num']){


            if($res['upper'] != 0 ){
                $upper = $res['upper'];
            }else{
                $upper = $request->input('deal_id');
            }
            $deal = $res->toArray();
            $deal['num'] = $res['num'] - $request->input('num');
            $deal['upper'] = $upper;
            $deal['total'] = $deal['num'] * $res['unitPrice'] + $res['otherExpenses'];
            $deal['status'] = 0;
            unset($deal['created_at']);
            unset($deal['updated_at']);
            unset($deal['id']);
            Deal::create($deal);

            Deal::where('id','=',$request->input('deal_id'))->update(['status'=>1,'num'=>$request->input('num'),'trader'=>Auth::id()]);
            $data = $request->input();
            $data['user_id'] = Auth::id();
            $res1 = $confirm::create($data);

            //消息通知
            $toUser = User::findOrFail($deal['user_id']);
            if($deal['check'] == 1){
                $check = '收购';
            }else{
                $check = '卖盘';
            }

            if($toUser->id != Auth::id()){
                $data = [
                    'name' => Auth::user()->name,
                    'id' => Auth::id(),
                    'title' => '已确认交易',
                    'status' => 1,
                    'deal_title' => '['.$check.']'.$deal['shopName'].$deal['productPhase'].$deal['num'].$deal['unit'].'单价：'.$deal['unitPrice'].'元',
                    'deal_id' => $request->input('deal_id')
                ];

                $toUser->notify(new DealNotification($data));
            }

            flash('交割成功，等待确认！')->success();
           msg(User::find($res['user_id'])['phone'],1);
            return redirect()->action('DealSonController@detail',$res['id']);

        }else{

            $data = $request->input();

            $data['user_id'] = Auth::id();
            if(Deal::where('upper','=',$request->input('deal_id'))->get()->count() > 0){
                Deal::where('id','=',$request->input('deal_id'))->update(['status'=>1,'num'=>$request->input('num'),'upper'=>$res['id'],'trader'=>Auth::id()]);
                $res1 = $confirm::create($data);
            }else{
                Deal::where('id','=',$request->input('deal_id'))->update(['status'=>1,'num'=>$request->input('num'),'trader'=>Auth::id()]);
                $res1 = $confirm::create($data);
            }

            $deal = Deal::findOrFail($request->input('deal_id'));
            //消息通知
            $toUser = User::findOrFail($deal->user_id);
            if($deal->check == 1){
                $check = '收购';
            }else{
                $check = '卖盘';
            }

            if($toUser->id != Auth::id()){
                $array = [
                    'name' => Auth::user()->name,
                    'id' => Auth::id(),
                    'title' => '已确认交易',
                    'status' => 1,
                    'deal_title' => '['.$check.']'.$deal->shopName.$deal->productPhase.$deal->num.$deal->unit.'单价：'.$deal->unitPrice.'元',
                    'deal_id' => $request->input('deal_id')
                ];

                $toUser->notify(new DealNotification($array));
            }

            flash('交割成功，等待确认！')->success();
           msg(User::find($res['user_id'])['phone'],1);
            return redirect()->action('DealSonController@detail',$res['id']);
        }


    }

    public function countPersonal($id){
        $counts = [];
        $counts['waitDeal'] =  Deal::where('user_id',$id)->where('status',0)->count();
        $counts['nowDeal'] = Deal::where(['user_id'=>$id,'status'=>1])->orWhere(function ($query) use ($id){
            $query->where('trader',$id)
            ->where('status',1);
        })->count();
        $counts['waitScore'] = Deal::where(['user_id'=>$id,'status'=>2])->orWhere(function ($query) use ($id){
            $query->where('trader',$id)
            ->where('status',2);
        })->count();

        return json_encode($counts);
    }
}
