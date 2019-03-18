<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminUserRequest;
use Auth;

class AdminUserController extends Controller
{
    public function index(){
    	$admins = Admin::get();
    	return view('admin.adminuser.index',compact('admins'));
    }

    public function add(){
    	return view('admin.adminuser.add');
    }

    public function store(AdminUserRequest $request){
    	$admins = Admin::create([
    		'name' => $request->name,
    		'password' => bcrypt($request->password)
    	]);

    	return redirect()->action('Admin\AdminUserController@index');
    }

    public function changePwd() {
        return view('admin.adminuser.changePwd');
    }

    public function cgPwd(Request $request) {
        if(Admin::where('id','=',auth()->guard('admin')->id())->update(['password'=>bcrypt($request->password)])){
            auth()->guard('admin')->logout();
            return redirect()->action('Admin\LoginController@login');
        };
    }
}
