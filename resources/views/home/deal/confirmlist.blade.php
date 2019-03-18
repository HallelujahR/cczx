@extends('layouts.home')

@section('title')
    <title>[传承网]</title>
@endsection

@section('css')
    <!-- 论坛帖子页面样式 -->
    <link rel="stylesheet" type="text/css" href="/home/css/deal/dealcate.css">
@endsection

@section('content')
    <div id="dealcate">
        <div id="title">
            当前板块: 最近成交
        </div>
        <form action="{{ action('DealSonController@confirmlist') }}" method="get">
            <div id="search">

                <div style="color:#966f3c">
                    查询
                </div>
                <div>
                    买卖盘：
                    <select name="check" id="">
                        <option value="0" @if($search['check'] == 0) selected @endif>所有</option>
                        <option value="1" @if($search['check'] == 1) selected @endif>买盘</option>
                        <option value="2" @if($search['check'] == 2) selected @endif>卖盘</option>
                    </select>
                </div>
                <div>
                    买卖盘类别：
                    <select name="deal_cate" id="">
                        <option value="0" @if($search['deal_cate'] == 0) selected @endif>所有</option>
                        @foreach($allcates as $k => $v)
                            <option value="{{$v['id']}}"  @if($search['deal_cate'] == $v['id']) selected
                                    @endif>{{$v['name']}}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    查询方式：
                    <select name="searchType" id="">
                        <option value="shopName" @if($search['searchType'] == 'shopName') selected @endif>标题</option>
                        <option value="user_id" @if($search['searchType'] == 'user_id') selected @endif>发布人</option>
                        <option value="instructions" @if($search['searchType'] == 'instructions') selected @endif>其他说明</option>
                        <option value="productPhase" @if($search['searchType'] == 'productPhase') selected @endif>品相</option>
                        <option value="deliveryMethods" @if($search['searchType'] == 'deliveryMethods') selected @endif>交割方式</option>
                    </select>
                </div>
                <div>
                    <input type="text" name="text" id="searchInput"/>
                </div>
                <div>
                    发布日期 <input type="date" name="start" value="{{$time1}}" id="searchInput">到 <input name="end"
                                                                                                      type="date"
                                                                                                      value="{{$time2}}"  id="searchInput">
                </div>
                <div>
                    <button id="btn">查询</button>
                </div>
            </div>
            <form action="">



                <div id="dealbody">
                    <div class="dealbody_line dealbody_title">
                        <div style="width:45%;">标题</div>
                        <div style="width:10%;">发布人</div>
                        <div style="width:15%;">发布时间</div>
                        <div style="width:15%;">有效期</div>
                        <div style="width:5%;">浏览</div>
                        <div style="width:10%;">状态</div>

                    </div>
                    @if(count($deals) == 0) <div class="dealbody_line dealbody_line-detail">
                        <div style="width:100%;text-align:center;font-size:20px;">
                            暂无信息
                        </div>
                    </div>
                    @else
                        @foreach($deals as $k => $v)
                            <div class="dealbody_line dealbody_line-detail">
                                <div class="dealbody_line-detail_first">

                                    @if($v['check'] == '1')
                                        <div class="dealbody_line-icon_buy">
                                            买
                                        </div>
                                    @else
                                        <div class="dealbody_line-icon_sell">
                                            卖
                                        </div>
                                    @endif
                                    <a href="/deal/detail/{{$v['id']}}.html">{{ $v->shopName }}({{ $v->productPhase }}){{ $v->num }}{{ $v->unit }}
                                        单价:{{ $v->unitPrice }}元</a>
                                </div>
                                <div class="dealbody_line-text dealbody_line-text-name">
                                    <a href="/personal/{{$v['user_id']}}">{{$v->user->name}}</a>
                                </div>
                                <div class="dealbody_line-text"  style="width:15%;">
                                    {{$v['created_at']}}
                                </div>
                                <div class="dealbody_line-text" style="width:15%;">
                                    {{ date( "Y-m-d H : i : s", + $v['validity'])}}
                                </div>
                                <div class="dealbody_line-text" style="width:5%;">
                                    {{$v['views']}}
                                </div>
                                <div class="dealbody_line-text" style="width:10%;">

                                    @if($v['status'] == 0)
                                        等待交易
                                    @elseif($v['status'] == 1)
                                        确认交易
                                    @elseif($v['status'] == 2)
                                        对方确认交割
                                    @elseif($v['status'] == 3)
                                        交易失败
                                    @elseif($v['status'] == 4)
                                        交割成功，已评分
                                    @endif

                                </div>
                            </div>
                        @endforeach
                    @endif
                    {{$deals->appends(['check' => $backR['check'],'deal_cate' => $backR['deal_cate'],
                    'searchType'=>$backR['searchType'],'text'=>$backR['text'],'start'=>$backR['start'],
                    'end'=>$backR['end']])
                    ->links
                    ()}}
                </div>
                <div>

                </div>
    </div>
@endsection

@section('js')
@endsection
