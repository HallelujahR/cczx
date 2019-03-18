@extends('layouts.home')

@section('title')
    <title>[传承网]</title>
@endsection

@section('css')
    <!-- 论坛帖子页面样式 -->
    <link rel="stylesheet" type="text/css" href="/home/css/deal/dealcate.css">
    <link rel="stylesheet" type="text/css" href="/home/css/deal/detail.css">

@endsection

@section('content')
    <div id="dealcate">
        <div id="title"  style="margin-top:20px;margin-bottom:-10px">
            {{$name}} 最新买卖盘
        </div>
        <div id="match"  style="margin-top:20px;">
            <div class="other-body">
                <div class="other-body_left other-body_son" style="border-right: 1px solid #F0F0F0;">
                    <div style="  text-align: center;">买盘</div>
                    <div class="other-body_son_body">
                        @foreach($buyDeal as $k => $v)
                            <div>
                                <span>「买盘」</span>
                                <a href="{{action('DealSonController@detail',$v->id)}}"><span>{{$v->shopName}} 单价:
                                        {{$v->unitPrice}}
                                        @foreach($v['deliveryMethods'] as $k1 => $v1)
                                            {{$v1}}
                                        @endforeach

                                    </span></a>
                            </div>
                        @endforeach

                    </div>
                </div>
                <div class="other-body_right other-body_son">
                    <div style="  text-align: center;">卖盘</div>
                    <div class="other-body_son_body">
                        @foreach($sellDeal as $k => $v)
                            <div>
                                <span>「卖盘」</span>
                                <a href="{{action('DealSonController@detail',$v->id)}}"><span>{{$v->shopName}} 单价:
                                        {{$v->unitPrice}}
                                        @foreach($v['deliveryMethods'] as $k1 => $v1)
                                            {{$v1}}
                                        @endforeach

                                    </span></a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div id="title"  style="margin-top:20px;margin-bottom:-20px">
            {{$name}} 最新成交
        </div>

                <div id="dealbody">
                    <div class="dealbody_line dealbody_title">
                        <div style="width:45%;">标题</div>
                        <div style="width:10%;">发布人</div>
                        <div style="width:15%;">交易人</div>
                        <div style="width:15%;">交易时间</div>
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
                                    <a href="/deal/detail/{{$v['id']}}.html">{{ $v->shopName }}({{ $v->productPhase }}){{ $v->num }}{{ $v->unit }}单价:{{ $v->unitPrice }}元</a>
                                </div>
                                <div class="dealbody_line-text dealbody_line-text-name">
                                    <a href="/personal/{{$v['user_id']}}">{{$v->user->name}}</a>
                                </div>
                                <div class="dealbody_line-text"  style="width:15%;">
                                    <a target="_blank" href="/personal/{{$v->confirm->user->id}}">
                                        {{$v->confirm->user->name}}
                                    </a>
                                </div>
                                <div class="dealbody_line-text" style="width:15%;">
                                    {{$v->confirm->created_at}}
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
                    {{$deals->links()}}
                </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript" src='/home/js/dealcate.js'></script>
@endsection
