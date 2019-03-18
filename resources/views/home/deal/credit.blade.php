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
            当前板块:{{$user->name}}的信用详情
        </div>
                <div id="dealbody">
                    <div class="dealbody_line dealbody_title">
                        <div style="width:40%;">标题</div>
                        <div style="width:10%;">发布人</div>
                        <div style="width:10%;">交易人</div>
                        <div style="width:15%;">交易时间</div>
                        <div style="width:10%;">交易金额</div>
                        <div style="width:10%;">对方评分</div>
                        <div style="width:10%;">评论等级</div>
                    </div>
                    @if(count($marklist) == 0) <div class="dealbody_line dealbody_line-detail">
                        <div style="width:100%;text-align:center;font-size:20px;">
                            暂无信息
                        </div>
                    </div>
                    @else
                        @foreach($marklist as $k => $v)
                            <div class="dealbody_line dealbody_line-detail" style="height:auto;">
                                <div class="dealbody_line-detail_first" style="width: 40%;">

                                    @if($v->check == '1')
                                        <div class="dealbody_line-icon_buy">
                                            买
                                        </div>
                                    @else
                                        <div class="dealbody_line-icon_sell">
                                            卖
                                        </div>
                                    @endif
                                    <a href="/deal/detail/{{$v->id}}.html">{{$v->shopName}}
                                        ({{$v->productPhase}}) {{$v->num}}{{$v->unit}}
                                        单价：{{$v->unitPrice}}元
                                    </a>
                                </div>
                                <div class="dealbody_line-text dealbody_line-text-name" style="width:10%">
                                    <a href="/personal/{{$v->user->id}}">{{$v->user->name}}</a>
                                </div>
                                <div class="dealbody_line-text dealbody_line-text-name"  style="width:10%;">
                                    <a href="/personal/{{$v->confirm->user->id}}.html">{{$v->confirm->user->name}}</a>
                                </div>
                                <div class="dealbody_line-text" style="width:15%;">
                                    {{$v->updated_at}}
                                </div>
                                <div class="dealbody_line-text" style="width:10%;">
                                    {{$v->total}} 元
                                </div>
                                <div class="dealbody_line-text" style="width:10%;">
                                    {{$v['mark']['mark']}}
                                </div>
                                <div  class="dealbody_line-text" style="width:10%">
                                    @if($v['mark']['mark_type'] == 0)
                                        好评
                                    @elseif($v['mark']['mark_type'] == 1)
                                        中评
                                    @elseif($v['mark']['mark_type'] == 2)
                                        差评
                                    @endif

                                </div>
                            </div>
                        @endforeach
                    @endif
                    {{$marklist->links()}}
                </div>

    </div>
@endsection
