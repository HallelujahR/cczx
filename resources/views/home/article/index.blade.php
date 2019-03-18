@extends('layouts.home')

@section('title')
<title>{{ $article->title }}[传承网]</title>
@endsection

@section('css')
<!-- 文章详情页样式 -->
<link rel="stylesheet" type="text/css" href="/home/css/detail.css">
@endsection

@section('content')

<div id="detail_con">
    <!-- 左栏 -->
    <div id="detail_left">

        <!-- 导航图 -->
        <div class="detail_dh">
            <span>您的当前位置:</span>
            <a href="/"> 传承资讯首页</a>
            <span>></span>
            @if($article->cate->pid == 0)
            <a href="{{ action('CateController@index',$article->cate_id)}}"> {{ $article->cate->cate }}</a>
            <span>></span>
            @else
            <a href="{{ action('CateController@index',getCateName($article->cate->pid)->id)}}"> {{ getCateName($article->cate->pid)->cate }}</a>
            <span>></span>
            <a href="{{ action('CateController@index',$article->cate_id) }}"> {{ $article->cate->cate }}</a>
            <span>></span>
            @endif
        </div>

        <!-- 文章标题 -->
        <h1 id="title">{{ $article->title }}</h1>

        <!-- 文章信息 -->
        <div class="detail_detail">
            <div></div>
            <span>{{ date('Y-m-d',$article->time) }}</span>
            <div></div>
            <span><a href="{{ action('PersonalController@index',$article->user->id) }}" style="color:#979797">{{ $article->user->name }}</a></span>
            <div></div>
            <span>{{ $article->access_count }}浏览</span>
            <span>
                @if(Auth::id() != $article->user->id)

                <a @if(Auth::check())
                    login="true"
                   @else
                    login="false"
                   @endif
                   href='javascript:;' class='gzuser gzuser{{ $article->user->id }}' follow_id="{{
                    $article->user->id }}">

                    {!! Auth::check()&&Auth::user()->followed_user($article->user->id) ? "<span class='glyphicon glyphicon-minus'></span><span style='margin-left:5px'>已关注</span>" : "<span class='glyphicon glyphicon-plus'></span><span style='margin-left:5px'>关注他</span>" !!}

                </a>

                @endif
            </span>
            <div>
                <span class="fl">分享到：</span>
                <span onclick="shareTo('qzone')">
                    <img data-original="/home/images/qqzoneshare.png" class="lazy shareLogo">
                </span>
                <span onclick="shareTo('qq')">
                    <img data-original="/home/images/qqshare.png" class="lazy shareLogo">
                </span>
                <span onclick="shareTo('sina')">
                    <img data-original="/home/images/sinaweiboshare.png" class="lazy shareLogo">
                </span>
                <span  data-toggle="modal" data-target=".bs-example-modal-sm">
                    <img data-original="/home/images/wechatshare.png" class="lazy shareLogo">
                </span>
            </div>
        </div>

        <!-- 文章内容 -->
        <div id="res " class="detail_content" style="border-bottom:1px dashed #CCC;padding-bottom:50px;margin-bottom:20px;">
            {!! $article->content->content !!}
        </div>

        <div id="shareBtn">
            <span class="fl">分享到：</span>
            <span onclick="shareTo('qzone')">
                <img data-original="/home/images/qqzoneshare.png" class="lazy shareLogo">
            </span>
            <span onclick="shareTo('qq')">
                <img data-original="/home/images/qqshare.png" class="lazy shareLogo">
            </span>
            <span onclick="shareTo('sina')">
                <img data-original="/home/images/sinaweiboshare.png" class="lazy shareLogo">
            </span>
            <span  data-toggle="modal" data-target=".bs-example-modal-sm">
                <img data-original="/home/images/wechatshare.png" class="lazy shareLogo">
            </span>
<!-- Small modal -->
<!-- <button type="button" class="btn btn-primary" >Small modal</button> -->

<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" style="z-index:999999;padding-top:200px">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
        <span class="modal-title" id="myModalLabel" style="height:50px;padding:20px;text-align:center;margin-top:30px;">扫描二维码后，点击手机右上方分享</span>
       <div id="qrcode" style="margin-left:30px;padding:20px;margin-top:0px"></div>
    </div>
  </div>
</div>

        </div>

        @if(Auth::check() && Auth::user())
        <div id="plArticle" style="padding-bottom:20px;">
            <div style="padding-left:20px;z-index:-1">
                <div id="articleTitle">
                    <b>评论 (大于2M的图片无法上传）</b>
                </div>
                <form id="form" class="form-horizontal" action="{{ action('CommentArticleController@store') }}" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="article_id" id="article_id" value="{{ $article->id }}">
                    <div id='detail'></div>
                    <textarea id="text1" name='detail' style="width:100%; height:200px;display:none;"></textarea>
                    <button flag="1" style="background-color:#7FB4CB;margin-top:10px;" type="submit" class="btn btn-info btn-block" id="comment-commit">确认提交</button>
                </form>
            </div>
        </div>
        @else
        <div id="loginNow" style="margin-bottom:40px;margin-top:40px;">
           登录后才能评论 <a href="/login">立即登录</a>
        </div>
        @endif

        <div id="comment-father">
            @foreach($comments as $comment)
            <div class="plcontent">
                <div class="userinfo">
                    <a href="/personal/{{$comment->user->id}}">
                        <img style="border-radius:10px" class="user-image" src="{{ $comment->user->avatar }}">
                    </a>
                    <a href="/personal/{{$comment->user->id}}">
                        <b>{{ $comment->user->name }}</b>
                    </a>

                    <span>
                        评论于 : {{$comment->created_at}}
                    </span>
                </div>
                <div class="usercontent">
                    {!! $comment->comment !!}
                </div>
            </div>
            @endforeach

        </div>
        @if($comments->count() != 0)
            <div id="more-comment">
                <span id="loaded">
                    <a href="javascript:void(0)" id="click-more">点击加载更多评论 </a>
                </span>
                <!-- 加载中 -->
                <span id="loading">
                    <img src="/home/images/loading.gif">
                </span>


            </div>
        @endif
    </div>

    <!-- 右栏 -->
    <div id="detail_right">
        <div class="detail_right_title">
            <div class="right_title_xg">相关文章</div>
            <div class="right_title_rm">热门文章</div>
        </div>

        <div class="detail_right_content">
            <div class="detail_right_content_xg content">
                @foreach($xgArticles as $k=>$xgArticle)
                <a href="{{ action('ArticleController@index',$xgArticle->id) }}" target="_blank">
                   {{mb_substr($xgArticle->title,0,15,'utf-8').' · · ·'}}
                </a>
                <span class="content_time">{{$xgArticle->created_at}}</span>
                @endforeach
            </div>

            <div class="detail_right_content_rm content">
                @foreach($rmwz as $k=>$rmwz)
                <a href="{{ action('ArticleController@index',$rmwz->id) }}" target="_blank">
                   {{mb_substr($rmwz->title,0,15,'utf-8').' · · ·'}}
                </a>
                <span class="content_time">{{$rmwz->created_at}}</span>
                @endforeach
            </div>

        </div>
    </div>

    <!-- 判断用户是否登录获取用户名 -->
    @if(Auth::user())
    <input type="hidden" avatar="{{Auth::user()->avatar}}" name="username" id="username" username="{{Auth::user()->name}}" userid="{{Auth::user()->id}}" article_id="{{$article->id}}" />
    @endif
</div>
@endsection

@if($xgCates->count() > 0)
    @section('friendlink')
    <div class="foot_link con">
    	<div class="foot_link_con">
        	<span>友情链接</span><em>Friendly&nbsp;&nbsp;links</em>
            @foreach($xgCates as $xgCate)
        	<a target="_blank" href="{{ action('CateController@index',$xgCate->id) }}">{{ $xgCate->cate }}</a>
            @endforeach
    	</div>
    </div>
    @endsection
@endif

@section('js')
<script type="text/javascript" src="/home/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src='/wangEditor/plarticlewangEditor.min.js'></script>
<script type="text/javascript" src="/home/js/articleScroll.js"></script>
<!-- 引入分享js -->
<script type="text/javascript" src="/home/js/share.js"></script>
<!-- 生成微信二维码 -->
<script type="text/javascript" src="/home/js/qrcode.min.js" ></script>
<script type="text/javascript" src="/home/js/article/article.js"></script>
@endsection
