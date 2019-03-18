@extends('layouts.home')

@section('title')
<title>{{ $config->title }}</title>
<meta name='keywords' content="{{ $config->keywords }}">
<meta name='description' content='{{ $config->description }}'>
@endsection

@section('css')
<!-- 首页样式 -->
<link rel="stylesheet" type="text/css" href="/home/css/index.css">

<!-- 轮播图 -->
<link rel="stylesheet" href="/home/slider/css/shutter.css">

<!-- 左侧导航条 -->
<link rel="stylesheet" type="text/css" href="/home/css/dh.css">

<style type="text/css">
#topheadimg{
  margin-top:8px;
}
table,tbody,tfoot,thead,tr,th,td {
margin:0;
padding:0;
outline:0;
font-size:100%;
vertical-align:baseline;
background:transparent;
border-collapse:collapse;
border-spacing:0;
border:0px;
}
.tablebox {
width:300px;
height:400px;
overflow:hidden;
margin:0px auto;
}
.tablebox table {
width:100%;
}
.tablebox table th,.tablebox table td {
font-size:12px;
text-align:center;
line-height:36px;
}
.tablebox table th {
color:#2584e3;
background-color:#f6f6f6;
}
.tablebox table td img {
display:inline-block;
vertical-align:middle;
}
.tablebox table tbody tr:nth-child(even) {
background-color:#f6f6f6;
}
.tablebox.table_md table td,.tablebox.table_md table th {
line-height:40px;
}
</style>
@endsection

@section('content')

<!-- 左侧导航条 -->
<div id="left_dh">
  <div id="left_center">
    <div id="left_nav">
<!--
      <a href="javascript:void(0)" class="left_nav_d box_i" pd="gg" flag="0">
        公告
      </a> -->
      <a href="javascript:void(0)" class="left_nav_d box_i" pd="index_zxcj" flag="0">最新成交</a>

      @foreach($catehs as $cateh)
      <a href="javascript:void(0)" class="left_nav_d box_i" pd="{{$cateh->id}}{{$cateh->cate}}" flag="0">
            {{$cateh->cate}}
      </a>
      @endforeach

      <a href="javascript:void(0)" class="left_nav_d box_i" pd="jy" flag="0">
        论坛区
       </a>

    </div>
  </div>
</div>

<!-- 最新成交 -->
<div style="width:1200px;margin:0 auto;">
    <div id="index_zxcj">
        <img class="lazy" data-original="/home/images/zxcj.png" width="24px;" style="margin-top:10px;">
        <span><a href="{{action('DealSonController@confirmlist',['check'=>0,
        'searchType'=>'shopName','text'=>'','deal_cate'=>0,'start'=>0,'end'=>0])}}" target="_blank">最新成交</a></span>
    </div>
</div>
<div class="tablebox" style="box-shadow:0px 0px 5px #ccc;width: 1200px;z-index:0;">
    <table id="tableId" border="0" cellspacing="0" cellpadding="0"  style="table-layout:fixed">
        <thead>
            <tr>
                <th width="30%" align="center">标题</th>
                <th width="10%" align="center">发布人</th>
                <th width="10%" align="center">交易人</th>
                <th width="10%" align="center">发布时间</th>
                <th width="10%" align="center">成交时间</th>
                <th width="10%" align="center">浏览</th>
                <th width="15%" align="center">状态</th>
            </tr>
        </thead>
        <tbody>
            @foreach($confirm as $v)
            <tr style="border-bottom:1px dashed #99CCFF;">
                <td style="font-size:16px;text-align:left;padding-left:5px;"><a target="_blank" href="{{action('DealSonController@detail',$v->id)}}" @if($v->check == 1)style="font-weight:bold;color:red;" @elseif($v->check == 2)style="font-weight:bold;color:#0033FF;" @endif class="oldzxcj" oldtitle="@if($v->check == 1)[收购]@elseif($v->check == 2)[出售]@endif{{ $v->shopName }}({{ $v->productPhase }}){{ $v->num }}{{ $v->unit }}单价:{{ $v->unitPrice }}元{{ $v->deliveryMethods[0] }}"></a></td>
                <td style="font-size:14px;"><a target="_blank" href="{{ action('PersonalController@index',$v->user_id) }}">{{ $v->user->name }}</a></td>
                <td style="font-size:14px;"><a target="_blank" href="{{ action('PersonalController@index',$v->trader) }}">{{ $v->traderUser->name }}</a></td>
                <td>{{ $v->created_at }}</td>
                <td>{{ $v->updated_at }}</td>
                <td style="font-size:14px;">{{ $v->views }}</td>
                <td style="color:#8f4b2e;font-size:14px;">@if($v->status==3)交个失败@elseif($v->status==4)交割成功，已互相评分@endif</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<!-- 横条 -->
@foreach($catehs as $cateh)
<!-- {{ $cateh->cate }} -->
<div class="box box_n" style="margin-bottom:20px;" id="{{$cateh->id}}{{$cateh->cate}}">
    <!--左侧-->
   	<div class="box-l">
       	<!--头-->
       	<div class="box-l-t">
			<h2 style="width:200px;height:61px;border-top: 3px solid red;text-align:center;line-height:60px;font-size:25px;display:inline-block;position: relative;float: left;margin-top:0px">
				<a href="{{ action('CateController@index',$cateh->id) }}" target="_blank">{{ $cateh->cate }}</a>
			</h2>
			<ul>
				@foreach($cateh->sub as $zicate)
				<li><a style="color:#989898;font-size:15px" href="{{ action('CateController@index',$zicate->id) }}" target="_blank">{{ $zicate->cate }}</a></li>
				@endforeach
			</ul>
       	</div>
       	<!--内容-->
       	<div class="box-l-b">
        	<!--图-->
	        <div class="box-l-bl">
	        	<div>
	        		<span class="ttt" style="margin-top:5px"></span>
	        		<b class="rw">最热资讯</b>
	        	</div>
	        	<!-- 最热资讯 -->
	        	@foreach($cateh->hotArticles as $k => $hotArticleh)
	        	<div style="float:left;margin-top:10px;">
	        		<div>
	        			<span class="@if($k==0) one @else fone @endif">{{ $k+1 }}</span>
	        			<a target="_blank" href="{{ action('ArticleController@index',$hotArticleh->id) }}" class="rwnr">{{ $hotArticleh->title }}</a>
	        		</div>
	        	</div>
	        	@endforeach
	        </div>
           	<!--文字部分-->
           	<div class="box-l-br">
               	<div class="box-l-brt">
                   	<ul>
                       	<li><b>最新资讯</b></li>
                      	@foreach($cateh->newArticles as $newArticleh)
                       	<li>
                       		<div>
	                        	<a target="_blank" href="{{ action('ArticleController@index',$newArticleh->id) }}" class="cateDate">{{ $newArticleh->title }}</a>
                        	</div>
                       	</li>
                       	@endforeach
                   	</ul>
               	</div>
           	</div>
       	</div>
   	</div>
   	<!--右侧-->
   	<div class="box-r">
       	<div style="width: 100%; height: 100%;">
           	<a target="_blank" href="{{ action('CateController@index',$cateh->id) }}"><img class="lazy" data-original="{{ $cateh->catePic }}" width="300" height="490" ></a>
       	</div>
   	</div>
</div>
@endforeach

<!-- 交易论坛 -->

@if(count($indexBbsCates) != 0)
<div style="margin: auto;width: 1200px;margin-top:20px">
    <div id="jy" class="box_n">
        <div id="jy_title">
            <img class="lazy" data-original="/home/images/jy.png" width="24px;" style="margin-top:10px;">
            <span>论坛区</span>
        </div>
        @foreach($indexBbsCates as $k=>$indexBbsCate)
        <div class="jylt_small @if($k%3 == 0) jylt_small2 @endif">
            <div class="title-cut">
    			<strong class="tt">
    				<a href="{{ action('BbsController@fucate',$indexBbsCate->id) }}" target="_blank">{{ $indexBbsCate->cate }}</a>
    			</strong>

                <span class="link">
    				@foreach($indexBbsCate->sub as $k=>$zicate)
    				@if($k < 2)
    				<a href="{{ action('BbsController@zicate',$zicate->id) }}" target="_blank">{{ $zicate->cate }}</a>
    				@endif
    				@endforeach
    			</span>

                <a class="gd" href="{{ action('BbsController@fucate',$indexBbsCate->id) }}" target="_blank">更多</a>
            </div>
            <div class="list16">
                <ul>
    	            <li><b>热帖展示</b></li>
                    @foreach($indexBbsCate->hotPosts as $hotPost)
    	            <li><a href="{{ action('BbsController@post',$hotPost->id) }}" target="_blank">{{ $hotPost->title }}</a></li>
                    @endforeach
    	        </ul>
            </div>
    		<div class="list16">
    	        <ul>
    	            <li><b>最新帖子</b></li>
                    @foreach($indexBbsCate->newPosts as $newPost)
    	            <li><a href="{{ action('BbsController@post',$newPost->id) }}" target="_blank">{{ $newPost->title }}</a></li>
                    @endforeach
    			</ul>
        	</div>
        </div>
        @endforeach
    </div>
</div>
@endif
@endsection



@if($links->count() > 0)
    @section('friendlink')
    <div class="foot_link con">
    	<div class="foot_link_con">
        	<span>友情链接</span><em>Friendly&nbsp;&nbsp;links</em>
        	@foreach($links as $link)
        	<a target="_blank" href="{{ $link->url }}">{{ $link->title }}</a>
        	@endforeach
    	</div>
    </div>
    @endsection
@endif

@section('js')
<!-- <script src="/home/slider/js/velocity.js"></script> -->
<!-- <script src="/home/slider/js/shutter.js"></script> -->
<script type="text/javascript" src="/home/js/dh.js"></script>
@endsection
