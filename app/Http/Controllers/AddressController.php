<?php

namespace App\Http\Controllers;

use Auth;
use App\Address;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AddressController extends Controller
{
    public function create(Request $request){
        $arr = $request->all();

        $arr['user_id'] = Auth::id();

        if(Address::where('user_id','=',Auth::id())->count() >= 3) return '3';

        $res = Address::create($arr);

        if($res){
            return $res;
        }else{
            return '2';
        }
    }

    public function del(Request $request){

        $res = Address::destroy($request->id);
    	return $res;

    }

    public function update(Request $request){
        $arr = $request->all();
    	$id = $request->id;
    	unset($arr['id']);
    	$res = Address::findOrFail($id)->update($arr);

    	if($res){
    		return '1';
    	}else{
    		return '2';
    	}
    }
}
