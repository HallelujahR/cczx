<?php

namespace App\Http\Controllers\Admin;

use App\Notice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NoticeController extends Controller
{
    public function index(Request $request){
        $notices = Notice::get();

        return view('admin.notice.index',compact('notices'));
    }
}
