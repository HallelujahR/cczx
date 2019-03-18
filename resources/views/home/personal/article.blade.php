@extends('layouts.home')

@section('title')
<title>
    <div style="border:1px solid red;">
        1
    </div>
    {{ $user->name}}的个人中心_我的文章[传承网]</title>
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
            <h2 style="text-align:center;margin-top:20px;">@if(Auth::id() == $user->id)我的文章@else 他的文章 @endif <small>Articles</small></h2>

            <div id="cate_right_con">
                <ul>
                    @if($articles->count() > 0)
                        @foreach($articles as $k=>$article)
                        <li @if($k%2 == 1) class="two" @endif>
                            <span>
                                <a href="{{ action('ArticleController@index',$article->id) }}" target="_blank">{{ mb_substr($article->title,0,21,'utf-8').'...' }}</a>
                            </span>
                            <label>
                                <div></div>
                                <span>{{ $article->comments->count() }} 评论</span>
                                <div></div>
                                <span>{{ $article->access_count }} 阅读</span>
                                <div></div>
                                <span>{{ date('Y-m-d',$article->time) }}</span>
                            </label>
                        </li>
                        @endforeach
                    @else
                        <h2 style="text-align:center;">暂时没有发表文章~</h2>
                    @endif
                </ul>
            </div>
            <div style="float:right;">
                {!!$articles->links(('layouts.pagination'))!!}
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript" src="/home/js/personal/custom_up_img.js"></script>
<script type="text/javascript" src="/home/js/personal/amazeui.min.js"></script>
<script type="text/javascript" src="/home/js/personal/cropper.min.js"></script>
@endsection
