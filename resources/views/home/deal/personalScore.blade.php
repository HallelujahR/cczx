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
    <div id="personal_con" style="width:100%;" newsType="waitScore" userid="{{Auth::id()}}" counts="{{ $counts }}">
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
                <li style="float:left;width:100%;letter-spacing:3px;"><span style="letter-spacing:0px;
                margin-right:5px;color:red;">{{ $user->name }}</span>等待评分买卖盘
                <span style="float: right;
    font-size: 14px;
    background-color: #1499F8;
    color: #FFF;
    height: 30px;
    display: block;
    line-height: 10px;
    border-radius: 5px;
    padding: 10px 15px 10px 15px;
    margin-bottom: 10px;
    box-shadow: 0px 0px 2px #1499F8;">只有评分完毕才会计入已完成交易以及信用评分，请及时完成评分</span>
                </li>
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
                              <th>浏览</th>
                              <th>发布人</th>
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
                              <a href="{{ action('DealSonController@detail',$deal->id) }}" target="_blank">@if($deal->check == 1)[收购]@elseif($deal->check == 2)[出售]@endif
                              {{ $deal->shopName }}({{ $deal->productPhase }}){{ $deal->num }}{{ $deal->unit }}
                              单价:{{ $deal->unitPrice }}元
                              @foreach($deal->deliveryMethods as $deliveryMethod)
                                {{ $deliveryMethod }}
                              @endforeach</a></td>
                              <td>{{ $deal->created_at }}</td>
                              <td>{{ $deal->views }}</td>
                              <td style="color:red;">{{ $deal->user->name }}</td>
                              <td style="color:blue;">{{ $deal->confirm->user->name }}</td>
                              <td>
                                  @if(count($deal->marklist) == 0)
                                      交易完成，等待双方评分
                                  @elseif(count($deal->marklist) == 1)
                                      @if($deal->marklist['0']->from_user_id == Auth::id())
                                          <span>等待对方评分</span>
                                      @else
                                          <span>等待您评分</span>
                                      @endif
                                  @elseif(count($deal->marklist) == 2)
                                      双方都已评分
                                  @endif

                              </td>
                              <td>

                                  @if(count($deal->marklist) == 0)
                                      <button class="btn btn-info click_mark" dealid="{{$deal['id']}}" data-toggle="modal"
                                              data-target="#myModal">点击评分</button>
                                  @elseif(count($deal->marklist) == 1)

                                      @if($deal->marklist['0']->from_user_id == Auth::id())
                                              <span>等待对方评分</span>
                                      @else
                                              <button class="btn btn-info click_mark" dealid="{{$deal['id']}}"
                                                      data-toggle="modal"
                                                      data-target="#myModal">点击评分</button>
                                      @endif
                                  @elseif(count($deal->marklist) == 2)
                                      双方都已评分
                                  @endif

                              </td>

                              <td><a style="color:blue;" href="{{ action('DealSonController@detail',$deal->id) }}" target="_blank">打开</a></td>
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




<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{action('ConfirmController@mark')}}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="deal_id" id="deal_id" value="">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">交易评分</h4>
                </div>
                <div class="modal-body">

                    <div>
                        评分等级: <input type="radio" name="mark_type" id="optionsRadios1" value="0" checked> 好评

                        <input type="radio" name="mark_type" id="optionsRadios1" value="1"> 中评

                        <input type="radio" name="mark_type" id="optionsRadios1" value="2"> 差评
                    </div>
                    <div style="margin-top:20px;">
                        <span style="
    font-size: 14px;
    background-color: #1499F8;
    color: #FFF;
    height: 30px;
    display: block;
    line-height: 10px;
    border-radius: 5px;
    padding: 10px 15px 10px 15px;
    margin-bottom: 10px;
    box-shadow: 0px 0px 2px #1499F8;">分数区间为-50 到 50 分</span>
                        给对方打分: <input type="number" class="form-control" id="mark" name="mark" value="" />
                    </div>
                    <div style="margin-top:20px;">
                        给交易留言: <textarea name="message"  class="form-control"  id="message" cols="80"
                                         rows="10"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    <button type="submit" id="submit" class="btn btn-primary">确定</button>
                </div>
            </form>
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
<script type="text/javascript" src="/home/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript">
$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
$('.click_mark').click(function(){
    var dealid = $(this).attr('dealid');
    $('#deal_id').val(dealid);
});

$('#submit').click(function () {
    if($('#mark').val().length <= 0){
        layer.msg('请填写分数');
        return false;
    }

    if(parseInt($('#mark').val()) < -50 || parseInt($('#mark').val()) > 50){
        layer.msg('分数区间在-50 到 50 ');
        return false;
    }


    if($('#message').val().length <= 0){
        layer.msg('请填写留言');
        return false;
    }


})
</script>
<!-- 表格 -->
@endsection
