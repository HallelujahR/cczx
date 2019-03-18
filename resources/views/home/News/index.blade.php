@extends('layouts.home')


@section('css')
<!-- 个人中心样式 -->
<link rel="stylesheet" href="/home/css/personal/amazeui.cropper.css">
<link rel="stylesheet" href="/home/css/personal/custom_up_img.css">
<link rel="stylesheet" type="text/css" href="/home/css/personal/personal.css">
<link rel="stylesheet" type="text/css" href="/home/css/news/news.css">
<link rel="stylesheet" href="/layui/layui/css/layui.css"  media="all">
<link rel="stylesheet" type="text/css" href="/home/css/news/table.css">
@endsection


@section('content')

<div style="padding:0px;" class="container-fluid">
    <div id="personal_con" newsType="all" userid="{{Auth::id()}}">
        <!-- 左栏 -->
        @include("layouts.personleft")
        <!-- 右栏 -->
        <div id="personal_right">
        	<div class="layui-tab" lay-filter="news">
			  <ul class="layui-tab-title">
			    <li class="layui-this tab-title" id="firstClick" lay-id="11">全部消息<span class="total-news"></span></li>
			    <li class="tab-title" lay-id="22">帖子消息<span class="total-news"></span></li>
			    <li class="tab-title" lay-id="33">文章消息<span class="total-news"></span></li>
			    <li class="tab-title" lay-id="44">关注消息<span class="total-news"></span></li>
			    <li class="tab-title" lay-id="55">交易消息<span class="total-news"></span></li>
			  </ul>

			  <div class="layui-tab-content">

			    <div class="layui-tab-item layui-show">
			    	<div class="tab-div-img">
			     		<img src="/home/images/load.png" class="tab-img" width="100px">	
			     	</div>

			     	<div id="rw-table1">

			     	</div>
			     	
			    </div>

			    <div class="layui-tab-item">
			    	<div class="tab-div-img">
			     		<img src="/home/images/load.png" class="tab-img" width="100px">	
			     	</div>
			     	<div id="rw-table2">

			     	</div>
				</div>

			    <div class="layui-tab-item">
			    	<div class="tab-div-img">
			     		<img src="/home/images/load.png" class="tab-img" width="100px">	
			     	</div>
			     	<div id="rw-table3">

			     	</div>
				</div>

			    <div class="layui-tab-item">
			    	<div class="tab-div-img">
			     		<img src="/home/images/load.png" class="tab-img" width="100px">	
			     	</div>
					<div id="rw-table4">

					</div>
				</div>

				  <div class="layui-tab-item">
					  <div class="tab-div-img">
						  <img src="/home/images/load.png" class="tab-img" width="100px">
					  </div>
					  <div id="rw-table5">

					  </div>
				  </div>

			  </div>
			</div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript" src="/layui/layui/layui.js" charset="utf-8"></script>
<script type="text/javascript" src="/home/js/news/table.js"></script>
<script type="text/javascript" src="/home/js/personal/cropper.min.js"></script>
<script type="text/javascript" src="/home/js/personal/custom_up_img.js"></script>
<script type="text/javascript" src="/home/js/personal/amazeui.min.js"></script>
<script type="text/javascript" src="/home/js/news/news.js"></script>
<script type="text/javascript" src="/home/js/lazyload.js"></script>
<!-- 表格 -->
@endsection