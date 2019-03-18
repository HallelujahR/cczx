@extends('layouts.home')

@section('title')
<title>{{$cate->cate}}[传承网]</title>
@endsection

@section('css')
<!-- 论坛顶级分类页面样式 -->
<link rel="stylesheet" type="text/css" href="/home/css/tz.css">
<!-- 新的样式 只是论坛帖子列表 -->
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
			<a href="{{ action('BbsController@fucate',$cate->id) }}">{{ $cate->cate }}</a> →
			<span>帖子列表</span>
		</div>
	</div>
	<br>

	<!-- 顶级分类下的子类模块 -->
	<div class="zxr">
		<b style="margin-left:10px;">{{ $cate->cate }}-论坛列表</b>
	</div>
	<div id="zicate">
		@foreach($zicates as $zicate)
		<div>
			<a href="{{ action('BbsController@zicate',$zicate->id) }}">{{ $zicate->cate }}</a>
			<div>
				今日帖：
				<font color="red">{{ $zicate->todyPost }}</font>
				主题帖：{{ $zicate->countPost }}
			</div>
			<div>
				发帖总数：{{ $zicate->countReply }}
			</div>
		</div>
		@endforeach
	</div>

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

	<!--选项块-->


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
				<!-- <div class="table_head_n n1">状态</div> -->
				<div class="table_head_n n2">主 题</div>
				<div class="table_head_n n3">回复</div>
				<div class="table_head_n n4">人气</div>
				<div class="table_head_n n5">最后更新</div>
				<div class="table_head_n n6">作 者</div>
			</div>
		</div>

		<!--表格一行，一行的头是list-->
		@foreach($posts as $post)
		<div class="table_tr"><!-- 
			<div class="table_tr_n r1">
				<a href="" target="_blank">
			    	<img style="margin-top:5px" border="0" src="/home/images/ztop.gif">
				</a>
			</div> -->

			<div class="table_tr_n r2">
		  		<a href="{{ action('BbsController@post',$post->id) }}" title="{{ $post->title }}">{{ $post->title }}</a>
<!-- 		  		<span>
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

@section('js')
<script type="text/javascript">
	$(function(){
		$('#plate_a').mouseout(function(){
			$(this).css({
				'transition':'all 0.8s',
				'background-color':'#1499F8',
				'color':'white',
			})
		}).mouseover(function(){
			$(this).css({
			    'background-color':'#E3E3E3',
			    'transition':'all 0.8s',
			    'box-shadow': '0px 0px 20px #1499FB',
			    'border-radius':'5px',
			    'color':'#1499F8',
			})
		})



		$('.table_tr').mouseover(function(){
			$(this).css({
				'box-shadow':'0px 0px 10px #A5A5A5',
				'transition':'all 0.5s',
			})
		}).mouseout(function(){
			$(this).css({
				'box-shadow':'none',
				'transition':'all 0.1s',
			})
		})
	})
</script>
@endsection
