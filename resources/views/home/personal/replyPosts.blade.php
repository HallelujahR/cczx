@extends('layouts.home')

@section('title')
<title>{{ $user->name}}的个人中心_帖子的回复[传承网]</title>
@endsection

@section('css')
<!-- 个人中心样式 -->
<link rel="stylesheet" href="/home/css/personal/amazeui.cropper.css">
<link rel="stylesheet" href="/home/css/personal/custom_up_img.css">
<link rel="stylesheet" type="text/css" href="/home/css/personal/personal.css">
<link rel="stylesheet" type="text/css" href="/home/css/personal/article.css">
@endsection

@section('content')

<div style="padding:0px;" class="container-fluid">
    <div id="personal_con">
        <!-- 左栏 -->
        @include("layouts.personleft")
        <!-- 右栏 -->
        <div id="personal_right">
            <h2 style="text-align:center;margin-top:20px;">@if(Auth::id() == $user->id)我的帖子回复@else 他的帖子回复 @endif <small>Replies</small></h2>

            <div id="cate_right_con">
                <ul>
                    @if($replies->count() > 0)
                        @foreach($replies as $k=>$reply)
                        <li @if($k%2 == 1) class="two" @endif>
                            <span>
                                <a href="{{ action('BbsController@post',$reply->post->id) }}" target="_blank">{{ mb_substr($reply->post->title,0,21,'utf-8').'...' }}</a>
                            </span>
                            <label>
                                <b style="float:left;margin-top:5px;">回复：</b>
                                <button class="btn btn-default btn-sm nr" type="button" data-toggle="modal" data-target=".bs-example-modal-lg" style="margin-top:2px;" biaoti="{{ $reply->post->title }}" neirong="{{ $reply->content->reply }}">点击查看评论内容</button>
                            </label>
                        </li>
                        @endforeach
                    @else
                        <h2 style="text-align:center;">暂时没有回复过帖子哦~</h2>
                    @endif
                </ul>
            </div>
            <div style="float:right;">
                {!! $replies->links(('layouts.pagination')) !!}
            </div>

            <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel"></h4>
                    </div>
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript" src="/home/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/home/js/personal/custom_up_img.js"></script>
<script type="text/javascript" src="/home/js/personal/amazeui.min.js"></script>
<script type="text/javascript" src="/home/js/personal/cropper.min.js"></script>
<script type="text/javascript">
    $('.nr').click(function(){
        $('#myModalLabel').html($(this).attr('biaoti'));
        $('.modal-body').html($(this).attr('neirong'));
    });
</script>
@endsection
