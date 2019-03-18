<?php

namespace App\Http\Controllers;

use App\UserDetail;
use Auth;
use App\Deal;
use App\User;
use App\mark;
use App\mark_list;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\DealNotification;

class ConfirmController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function confirm(Request $request){

        $deal = Deal::findOrFail($request->id);

        if($deal->user_id == Auth::id()){
            $deal->update(['myconfirm'=>1,'dealstatus'=>1]);

            //消息通知
            $toUser = User::findOrFail($deal->trader);
            if($deal->check == 1){
                $check = '收购';
            }else{
                $check = '卖盘';
            }

            $array = [
                'name' => Auth::user()->name,
                'id' => Auth::id(),
                'title' => '已确认交割',
                'status' => 2,
                'deal_title' => '['.$check.']'.$deal->shopName.$deal->productPhase.$deal->num.$deal->unit.'单价：'.$deal->unitPrice.'元',
                'deal_id' => $deal->id
            ];

            $toUser->notify(new DealNotification($array));

        }else{
            $deal->update(['youconfirm'=>1,'dealstatus'=>2]);

            //消息通知
            $toUser = User::findOrFail($deal->user_id);
            if($deal->check == 1){
                $check = '收购';
            }else{
                $check = '卖盘';
            }

            $array = [
                'name' => Auth::user()->name,
                'id' => Auth::id(),
                'title' => '已确认交割',
                'status' => 2,
                'deal_title' => '['.$check.']'.$deal->shopName.$deal->productPhase.$deal->num.$deal->unit.'单价：'.$deal->unitPrice.'元',
                'deal_id' => $deal->id
            ];

            $toUser->notify(new DealNotification($array));
        }

        if($deal->myconfirm == 1 && $deal->youconfirm == 1){
            $deal->update(['status'=>2,'dealstatus'=>3]);

            UserDetail::where('user_id',$deal->user_id)->increment('transactionTimes');
            $total1 = $deal['total'] + UserDetail::where('user_id',$deal->user_id)->first()['transactionAmount'];
            UserDetail::where('user_id',$deal->user_id)->update(['transactionAmount'=>$total1]);

            UserDetail::where('user_id',$deal->trader)->increment('transactionTimes');
            $total2 = $deal['total'] + UserDetail::where('user_id',$deal->trader)->first()['transactionAmount'];
            UserDetail::where('user_id',$deal->trader)->update(['transactionAmount'=>$total2]);

        }
    }

    public function failConfirm(Request $request){

        $deal = Deal::findOrFail($request->id);

        if($deal->user_id == Auth::id()){
            $deal->update(['myfail'=>1,'dealstatus'=>4]);

            //消息通知
            $toUser = User::findOrFail($deal->trader);
            if($deal->check == 1){
                $check = '收购';
            }else{
                $check = '卖盘';
            }

            $array = [
                'name' => Auth::user()->name,
                'id' => Auth::id(),
                'title' => '已确认交割失败',
                'status' => 3,
                'deal_title' => '['.$check.']'.$deal->shopName.$deal->productPhase.$deal->num.$deal->unit.'单价：'.$deal->unitPrice.'元',
                'deal_id' => $deal->id
            ];

            $toUser->notify(new DealNotification($array));
        }else{
            $deal->update(['youfail'=>1,'dealstatus'=>5]);

            //消息通知
            $toUser = User::findOrFail($deal->user_id);
            if($deal->check == 1){
                $check = '收购';
            }else{
                $check = '卖盘';
            }

            $array = [
                'name' => Auth::user()->name,
                'id' => Auth::id(),
                'title' => '已确认交割失败',
                'status' => 3,
                'deal_title' => '['.$check.']'.$deal->shopName.$deal->productPhase.$deal->num.$deal->unit.'单价：'.$deal->unitPrice.'元',
                'deal_id' => $deal->id
            ];

            $toUser->notify(new DealNotification($array));
        }

        if($deal->myfail == 1 && $deal->youfail == 1){
            $deal->update(['status'=>3,'dealstatus'=>6]);
        }
    }

    public function mark(Request $request){
        $deal = Deal::findOrFail($request->all()['deal_id']);

        $listNum = mark_list::where('deal_id',$request->all()['deal_id'])->count();

        if ($listNum == 1){

            $deal->update(['status'=>4]);

        }

        $arr['from_user_id'] = Auth::id();

        if($deal->user_id == Auth::id()){
            $arr['to_user_id'] = $deal['trader'];
            $mark = mark::where('user_id',$deal['trader']);
            if($request->all()['mark_type'] == 0){
                $mark->increment('good');
            }elseif ($request->all()['mark_type'] == 1){
                $mark->increment('commonly');
            }elseif ($request->all()['mark_type'] == 2){
                $mark->increment('bad');
            }


            $app = $mark->first()['good']/($mark->first()['good'] + $mark->first()['commonly'] + $mark->first()['bad'])*100;
            $mark->update(['appreciation'=>$app]);
        }else{
            $arr['to_user_id'] = $deal['user_id'];
            $mark = mark::where('user_id',$deal['user_id']);
            if($request->all()['mark_type'] == 0){
                $mark->increment('good');
            }elseif ($request->all()['mark_type'] == 1){
                $mark->increment('commonly');
            }elseif ($request->all()['mark_type'] == 2){
                $mark->increment('bad');
            }


            $app = $mark->first()['good']/($mark->first()['good'] + $mark->first()['commonly'] + $mark->first()['bad'])*100;
            $mark->update(['appreciation'=>$app]);


        }

        $arr['message'] = $request->all()['message'];
        $arr['mark_type'] = $request->all()['mark_type'];
        $arr['deal_id'] = $request->all()['deal_id'];
        $arr['mark'] = $request->all()['mark'];
        $list = new mark_list($arr);
        $list->save();

        UserDetail::findOrFail(Auth::id())->increment('scoringtimes');

        //消息通知
        $toUser = User::findOrFail($arr['to_user_id']);
        if($deal->check == 1){
            $check = '收购';
        }else{
            $check = '卖盘';
        }

        $array = [
            'name' => Auth::user()->name,
            'id' => Auth::id(),
            'title' => '为您打了'.$arr['mark'].'分',
            'status' => 4,
            'deal_title' => '['.$check.']'.$deal->shopName.$deal->productPhase.$deal->num.$deal->unit.'单价：'.$deal->unitPrice.'元',
            'deal_id' => $deal->id
        ];

        $toUser->notify(new DealNotification($array));


        flash('评分成功')->success();
        return redirect()->back();

    }

}
