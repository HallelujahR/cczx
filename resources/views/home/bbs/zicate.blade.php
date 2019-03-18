@extends('layouts.home')

@section('title')
<title>{{$cate->cate}}[传承网]</title>
@endsection

@section('css')
<!-- 论坛子类页面样式 -->
<link rel="stylesheet" type="text/css" href="/home/css/tz.css">
<link rel="stylesheet" type="text/css" href="/home/css/newTz.css">
@endsection

@section('content')

<div id="bbs_con">
	<!--内容部分-->
	<div class="navigation">
		<div style="margin:0px 0 0 3px;float: left;width:1%;text-align: center; ">
			<img src="/home/images/Forum_nav.gif">
		</div>
		<div style="float: left;font-size: 14px;line-height: 25px ;height: 25px;">
			<a href="/">传承网</a> →
			<a href="{{ action('BbsController@fucate',getBbsCate($cate->pid)->id)}}">{{ getBbsCate($cate->pid)->cate }} </a>→
			<a href="{{ action('BbsController@zicate',$cate->id) }}">{{ $cate->cate }}</a>
		</div>
	</div>
	<br>

	<!--在线人数-->
	<!--在线人数-->
	<div class="zxr" style="margin-top:10px;">
		&nbsp;&nbsp;总帖数：{{ $countPost }}，今日贴子
		<b>
			<font color="red">{{ $todyPost }}</font>
		</b>
		<!-- <span>
			<a href="">[详情列表]</a>
		</span>
 -->
		<div class="plate">
			<a id="plate_a" href="{{ action('PublishController@post',['id'=>$cate->id]) }}">
				发表帖子
			</a>
		</div>

	</div>

	<div class="mainbar4" id="boardmaster">
	  <div id="boardmanage">
	    <!-- <a href="" title="查看本版精华">
	      <font color="#FF0000">精华</font>
	    </a> |
	    <a href="" title="查看本版在线详细情况">在线</a> |
	    <a href="" title="查看本版事件">事件</a> |
	    <a href="" title="查看本版用户组权限">权限</a>  |
	    <a href="">管理</a> |
	    <a href="" title="进入审核管理页面">审核</a> -->

	  </div>
	  <div>
	  	<img src="/home/images/tiezi.png" style="width:20px;margin-top:-3px;">
	  	<b style="padding-left:3px;">
	  		{{ $cate->cate }}
	  	</b>
	  </div>
	  <hr id="board-line" />
	</div>

	<!--表格-->
	<div class="table">
		<!--表格标题-->
		<div class="table_title">
			<div class="table_head">
				<div class="table_head_n n2">主 题</div>
				<div class="table_head_n n3">回复</div>
				<div class="table_head_n n4">人气</div>
				<div class="table_head_n n5">最后更新</div>
				<div class="table_head_n n6">作 者</div>
			</div>
		</div>

		<!--表格一行，一行的头是list-->
		@foreach($posts as $post)
		<div class="table_tr">

			<div class="table_tr_n r2">
		  		<a href="{{ action('BbsController@post',$post->id) }}" title="{{ $post->title }}">{{ $post->title }}</a>
		 <!-- <span>
		  			<img border="0" class="imgSmall" src="/home/images/ztop.gif">
		  		</span> -->
			</div>

			<div class="table_tr_n r3">{{ $post->replies->count('id') }}</div>

			<div class="table_tr_n r4">{{ $post->access_count }}</div>

			<div class="table_tr_n r5">
		    	{{ date('Y-m-d H:i:s',$post->time) }}
			</div>

			<div class="table_tr_n r6">
				<a href="/personal/{{$post->user->id}}" target="_blank">{{ $post->user->name }}</a>
			</div>

		</div>
		@endforeach

		<!--按钮-->
		<div class="mainbar0" style="float:right;margin-top:-10px;">
			{!! $posts->links(('layouts.pagination')) !!}
		</div>
	</div>

</div>

@endsection
