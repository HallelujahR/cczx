<?php

namespace App\Http\Controllers\Admin;

use App\topic;
use App\topic_cate;
use App\topic_replies;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TopicController extends Controller
{
    public function index(){
        $topicCates = topic_cate::get();

        return view('admin.topicCate.index',compact('topicCates'));
    }

    public function add(){
        return view('admin.topicCate.add');
    }

    public function store(Request $request){
        topic_cate::create([
            'cate' => $request->input('cate')
        ]);

        return redirect()->action('Admin\TopicController@index');
    }

    public function post(){
        $posts = topic::get();

        return view('admin.topicCate.post',compact('posts'));
    }

    public function reply(Request $request){
        $topic = topic::findOrFail($request->id);

        $replies = topic_replies::where('topic_id',$request->id)->get();

        return view('admin.topicCate.reply',compact('topic','replies'));
    }

    public function topicPost(Request $request){
        $topic = topic_cate::findOrFail($request->id);

        $posts = topic::where('cate_id',$request->id)->get();

        return view('admin.topicCate.topicPost',compact('topic','posts'));
    }
}
