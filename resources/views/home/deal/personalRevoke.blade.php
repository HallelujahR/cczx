@extends('layouts.home')


@section('css')
<!-- 个人中心样式 -->
<link rel="stylesheet" href="/home/css/personal/amazeui.cropper.css">
<link rel="stylesheet" href="/home/css/personal/custom_up_img.css">
<link rel="stylesheet" type="text/css" href="/home/css/personal/personal.css">
<link rel="stylesheet" type="text/css" href="/home/css/news/news.css">
<link rel="stylesheet" href="/layui/layui/css/layui.css"  media="all">
<link rel="stylesheet" type="text/css" href="/home/css/news/table.css">
<style>
.dealbar_buy{
	float:left;
    margin-right:3px;
	width:25px;
	height:25px;
	line-height:20px;
	color:blue;
	border:1px solid blue;
	text-align:center;
	border-radius:15px;
}
.dealbar_sell{
	float:left;
    margin-right:3px;
	width:25px;
	height:25px;
	line-height:20px;
	color:orangered;
	border:1px solid orangered;
	text-align:center;
	border-radius:25px;
}
a:hover{
    text-decoration: underline;
}
</style>
@endsection


@section('content')

<div style="padding:0px;" class="container-fluid">
    <div id="personal_con" style="width:100%;" newsType="revoke" userid="{{Auth::id()}}" counts="{{ $counts }}">
        <!-- 左栏 -->
        @include("layouts.personleft")
        <!-- 右栏 -->
        <div id="personal_right" style="width:81%;">
        	<div class="layui-tab" lay-filter="news">
			  <ul class="layui-tab-title">
			    <!-- <li class="layui-this tab-title" id="firstClick" lay-id="11">全部消息<span class="total-news"></span></li>
			    <li class="tab-title" lay-id="22">帖子消息<span class="total-news"></span></li>
			    <li class="tab-title" lay-id="33">文章消息<span class="total-news"></span></li>
			    <li class="tab-title" lay-id="44">关注消息<span class="total-news"></span></li> -->
			    <!-- <li class="tab-title" lay-id="55">关注消息<span>(1)</span></li> -->
                <li style="float:left;width:100%;letter-spacing:3px;"><span style="letter-spacing:0px;margin-right:5px;color:red;">{{ $user->name }}</span>已经撤销买卖盘</li>
			  </ul>

			  <div class="layui-tab-content">

			    <div class="layui-tab-item layui-show">
			    	<div class="tab-div-img">
			     		<img src="/home/images/load.png" class="tab-img" width="100px">
			     	</div>

			     	<div id="rw-table1">
                        <table class="layui-table">
                          <!-- <colgroup>
                            <col width="150">
                            <col width="200">
                            <col>
                          </colgroup> -->
                          <thead>
                            <tr>
                              <th>标题</th>
                              <th>发布时间</th>
                              <th>成交日期</th>
                              <th>浏览</th>
                              <th>交易人</th>
                              <th>状态</th>
                              <th>操作</th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($deals as $deal)
                            <tr>
                              <td><span @if($deal->check == 1)class="dealbar_buy"@elseif($deal->check == 2)class="dealbar_sell"@endif>@if($deal->check == 1)买@elseif($deal->check == 2)卖@endif</span>
                              <a href="{{ action('RevokeController@detail',$deal->id) }}" target="_blank">@if($deal->check == 1)[收购]@elseif($deal->check == 2)[出售]@endif
                              {{ $deal->shopName }}({{ $deal->productPhase }}){{ $deal->num }}{{ $deal->unit }}
                              单价:{{ $deal->unitPrice }}元
                              @foreach($deal->deliveryMethods as $deliveryMethod)
                                {{ $deliveryMethod }}
                              @endforeach</a></td>
                              <td>{{ $deal->created_at }}</td>
                              <td></td>
                              <td>{{ $deal->views }}</td>
                              <td></td>
                              <td>已撤销</td>
                              <td>
                                  <a href="{{ action('RevokeController@release',$deal->id) }}" target="_blank" style="color:blue;">重新发布</a>
                              </td>
                              <td><a style="color:blue;" href="{{ action('RevokeController@detail',$deal->id) }}" target="_blank">打开</a></td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                        {!! $deals->links() !!}
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
<!-- <script type="text/javascript" src="/home/js/news/table.js"></script> -->
<script type="text/javascript" src="/home/js/personal/cropper.min.js"></script>
<script type="text/javascript" src="/home/js/personal/custom_up_img.js"></script>
<script type="text/javascript" src="/home/js/personal/amazeui.min.js"></script>
<script type="text/javascript" src="/home/js/deal/personalDeal.js"></script>
<!-- 表格 -->
@endsection
