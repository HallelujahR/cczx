@extends('layouts.home')

@section('title')
    <title>回复私信/查看对话</title>
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="/home/css/message/check.css">
    <link rel="stylesheet" type="text/css" href="/layui/layui/css/layui.css">
@endsection

@section('content')
    <div id="check-body">
        <form class="layui-form layui-form-pane" action="">
            <div id="user" userid="{{Auth::id()}}" useravatar="{{Auth::user()->avatar}}"
                 username="{{Auth::user()->name}}" toid="{{$toid}}"></div>
            <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">发送私信</label>
                <div class="layui-input-block">
                    <textarea placeholder="请输入内容"  id="content" class="layui-textarea"></textarea>
                </div>
            </div>
            <div class="layui-form-item">
                <button class="layui-btn" lay-submit="" lay-filter="demo2">确认回复</button>
            </div>
        </form>


        <div id="dialogue">
            {{ $messages->links() }}
           @foreach($messages as $k => $v)
               @if($v->to_user_id == Auth::id())
                   <div class="dialogue-line">
                       <div class="dialogue-line-head">
                           <a href="/personal/{{$v->from_user_id}}">
                               <img src="{{$v->user->avatar}}" width="60px;" style="border-radius:30px;" alt="">
                           </a>
                           <a href="/personal/{{$v->from_user_id}}">{{$v->user->name}} :</a>
                           </span>
                       </div>

                       <div class="dialogue-line-body">
                           {{$v['body']}}
                       </div>

                       <div class="dialogue-line-foot">
                           <span class="dialogue-time">{{$v['created_at']}}</span>
                       </div>
                   </div>
                @else
                    <div class="dialogue-line">
                        <div class="dialogue-line-head">
                            <a href="/personal/{{$v->to_user_id}}">
                                <img src="{{$v->user->avatar}}" width="60px;" style="border-radius:30px;" alt="">
                            </a>
                            <a href="/personal/{{$v->to_user_id}}">我：</a>
                            </span>
                        </div>

                        <div class="dialogue-line-body">
                            {{$v['body']}}
                        </div>

                        <div class="dialogue-line-foot">
                            <span class="dialogue-time">{{$v['created_at']}}</span>
                        </div>
                    </div>
                @endif
           @endforeach
            {{ $messages->links() }}
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript" src="/layui/layui/layui.js" charset="utf-8"></script>
    <script src="/home/js/message/check.js"></script>
@endsection