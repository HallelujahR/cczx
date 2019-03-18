@extends('layouts.home')

@section('title')
<title>传承论坛_[传承网]</title>
@endsection

@section('css')
<!-- 论坛首页样式 -->
<link rel="stylesheet" type="text/css" href="/home/css/index.css">
@endsection

@section('content')
<!-- 6个框 -->
<div style="margin: auto;width: 1200px;margin-top:20px;">
	<!-- 第一层 一级分类 -->
	@foreach($bbs as $k => $v)
		<div class="bbs_two">
			<div class="bbs_two_name"><a href="/bbs/fucate/{{$v->id}}.html">{{$v->cate}}</a></div>
			<div class="bbs_two_more"><a href="/bbs/fucate/{{$v->id}}.html">更多</a></div>
			<div class="cate_underline"></div>
		</div>
		<!-- 第二层二级分类 -->
		@foreach($v->cate_son as $k1 => $v1)
			<div class="main1 @if($k1%3 == 0) main2 @endif bottom-div">
		        <div class="title-cut">
					<strong class="tt">
						<a href="/bbs/zicate/{{$v1->id}}.html" target="_blank">{{ $v1->cate }}</a>
					</strong>

					<span class="link">
						<a target="_blank" href="{{ action('BbsController@zicate',$v1->id) }}" style="color:#E00000">更多...</a>
					</span>
		        </div>
		        <div class="list16">
		            <ul class="uul">
			            <li><b>热帖展示</b></li>
			            @foreach($v1->hotPosts as $hotPosts)
			            <li><a href="/bbs/post/{{$hotPosts->id}}.html">{{ $hotPosts->title }}</a></li>
			            @endforeach
			        </ul>
		        </div>
				<div class="list16">
			        <ul class="uul">
			            <li><b>最新帖子</b></li>
			            @foreach($v1->newPosts as $newPosts)
			            <li><a href="/bbs/post/{{$newPosts->id}}.html">{{ $newPosts->title }}</a></li>
			            @endforeach
					</ul>
		    	</div>
			</div>
		@endforeach

	@endforeach
</div>
@endsection
