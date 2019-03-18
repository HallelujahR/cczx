@extends('layouts.home')

@section('title')
    <title>私信中心</title>
@endsection


@section('css')
    <link rel="stylesheet" type="text/css" href="/home/css/message/message.css">
@endsection
@section('content')
    <div id="body">
       <div id="title">
           <span>私信中心</span>
               <span id="writeMessage">
                  如果想给指定用户发送私信在搜索栏中搜索用户名，点击「发送私信」按钮即可
               </span>
       </div>
        <div id="message">

            @foreach($chats as $k=>$v)
            <div class="message-body">
                <div class="message-line">
                    <div class="message-line-head">
                        <a href="/personal/{{$v->user->id}}">
                            <img src="{{$v->user->avatar}}" width="60px;" style="border-radius:30px;" alt="">
                        </a>

                        <span class="name">来自：
                            <a href="/personal/{{$v->user->id}}">{{$v->user->name}}</a></span>
                              私信
                        </span>

                        @if($v->has_read == 'F')
                        <span style="font-size:14px;margin-left:10px;color:red">
                            未读
                        </span>
                        @endif
                    </div>
                    <div class="message-line-body">
                        {{$v->body}}
                    </div>
                    <div class="message-line-foot">
                        <span class="message-time">{{$v->created_at}}</span>
                        <div class="message-method">
                            {{--<span><a class="delete" href="/message/delete/">删除</a></span>--}}
                            <span><a class="reply" href="{{ action('MessageController@check',$v->user->id)
                            }}">回复对话/查看对话</a></span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach



        </div>
        {{$chats->links()}}
    </div>
@endsection

@section('js')
    <script src="/home/js/message/message.js"></script>
@endsection