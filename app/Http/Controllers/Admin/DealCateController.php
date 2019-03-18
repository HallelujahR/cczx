<?php

namespace App\Http\Controllers\Admin;

use App\DealCate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DealCateController extends Controller
{
    public function index(){
        $dealCates = DealCate::get();

        return view('admin.dealCate.index',compact('dealCates'));
    }

    public function add(){
        return view('admin.dealCate.add');
    }

    public function store(Request $request){
        DealCate::create([
            'name' => $request->input('name'),
            'sort' => DealCate::max('sort')+1
        ]);

        return redirect()->action('Admin\DealCateController@index');
    }

    public function edit(Request $request){
        $dealCate = DealCate::findOrFail($request->id);

        return view('admin.dealCate.edit',compact('dealCate'));
    }

    public function update(Request $request){
        $cate = DealCate::findOrFail($request->id);

        if($cate->update(['name'=>$request->name])){
            return redirect()->action('Admin\DealCateController@index');
        }
    }

    public function updateSort(Request $request){
        $cate = DealCate::findOrFail($request->id);

        $cate->update(['sort'=>$request->sort]);

        return redirect()->action('Admin\DealCateController@index');
    }
}
