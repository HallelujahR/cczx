@extends('layouts.home')

@section('title')
    <title>交易区[传承网]</title>
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="/home/css/deal/dealbar.css">
@endsection

@section('content')
    <div id="dealbar_dk">

        <div id="dealbar">

            @foreach($dealCates as $dealCate)
            <div class="small_dealbar">
                <div class="small_dealbar_head">
                    <div class="small_dealbar_head_title">
                        <a href="{{ action('DealSonController@search',['check'=>0,'deal_cate'=>$dealCate->id,'searchType'=>'shopName','text'=>'']) }}" target="_blank">{{ $dealCate->name }}</a>
                    </div>
                    <div class="small_dealbar_head_title2">

                        <span><a href="{{ action('DealSonController@search',['check'=>1,'deal_cate'=>$dealCate->id,
                        'searchType'=>'shopName','text'=>'']) }}">买盘:{{ $dealCate->countBuy }}条</a></span>
                        <span><a href="{{ action('DealSonController@search',['check'=>2,'deal_cate'=>$dealCate->id,
                        'searchType'=>'shopName','text'=>'']) }}">卖盘:{{ $dealCate->countSell }}条</a></span>
                        <a style="color: #888888;" href="{{ action('DealSonController@search',['check'=>0,
                        'deal_cate'=>$dealCate->id,
                        'searchType'=>'shopName','text'=>'']) }}">更多</a>
                    </div>
                </div>

                <div class="small_dealbar_content">
                    @foreach($dealCate->deals as $deal)
                        @if($deal['status'] == 0)
                    <div class="small_dealbar_content_title">
                        <span @if($deal->check == 1)class="dealbar_buy"@elseif($deal->check == 2)class="dealbar_sell"@endif>@if($deal->check == 1)买@elseif($deal->check == 2)卖@endif</span>
                        <a target="_blank" href="{{ action('DealSonController@detail',$deal->id) }}" title="@if($deal->check == 1)[收购]@elseif($deal->check == 2)[出售]@endif{{ $deal->shopName }}({{ $deal->productPhase }}){{ $deal->num }}{{ $deal->unit }}单价:{{ $deal->unitPrice }}元 {{ $deal->deliveryMethods[0] }}">
                            @if($deal->check == 1)[收购]@elseif($deal->check == 2)[出售]@endif
                            {{ $deal->shopName }}({{ $deal->productPhase }}){{ $deal->num }}{{ $deal->unit }}
                            单价:{{ $deal->unitPrice }}元
                            {{ $deal->deliveryMethods[0] }}
                        </a>
                    </div>
                        @endif
                    @endforeach
                </div>
            </div>
            @endforeach
                <div class="small_dealbar" style="width:49%">
                    <div class="small_dealbar_head" >
                        <div class="small_dealbar_head_title">
                            <a target="_blank">最近成交买卖盘</a>
                        </div>
                        <div class="small_dealbar_head_title2" style="width:418px;">
                            <a style="color:#888;" href="{{action('DealSonController@confirmlist',['check'=>0,
                            'searchType'=>'shopName','text'=>'','deal_cate'=>0,'start'=>0,'end'=>0])}}"
                               target="_blank">更多</a>
                        </div>
                    </div>

                    <div class="small_dealbar_content" style="font-size:14px;">
                        @foreach($confirm as $k => $v)
                            <div class="small_dealbar_content_title" style="border-bottom:1px solid #CCC;">
                                <span @if($deal->check == 1)class="dealbar_buy"@elseif($deal->check == 2)class="dealbar_sell"@endif>@if($v->check == 1)买@elseif($v->check == 2)卖@endif</span>
                                <span style="color:orangered">「{{$v->cate->name}}」</span>
                                <a target="_blank" href="{{action('DealSonController@detail',$v->id)}}">
                                    @if($v->check == 1)[收购]@elseif($v->check == 2)[出售]@endif
                                    {{ $v->shopName }}({{ $v->productPhase }}){{ $v->num }}{{ $v->unit }}
                                    单价:{{ $v->unitPrice }}元
                                    {{ $v->deliveryMethods[0] }}
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="small_dealbar" style="width:49%">
                    <div class="small_dealbar_head" >
                        <div class="small_dealbar_head_title">
                            <a target="_blank">最近撤销买卖盘</a>
                        </div>
                        <div class="small_dealbar_head_title2" style="width:418px;">
                            <a style="color:#888;" href="{{action('RevokeController@list',['check'=>0,
                            'searchType'=>'shopName','text'=>'','deal_cate'=>0,'start'=>0,'end'=>0])}}"
                               target="_blank">更多</a>
                        </div>
                    </div>

                    <div class="small_dealbar_content" style="font-size:14px;">
                        @foreach($revokes as $k => $v)
                            <div class="small_dealbar_content_title" style="border-bottom:1px solid #CCC;">
                                <span @if($v->check == 1)class="dealbar_buy"@elseif($v->check == 2)class="dealbar_sell"@endif>@if($v->check == 1)买@elseif($v->check == 2)卖@endif</span>
                                <span style="color:orangered">「{{$v->cate->name}}」</span>
                                <a target="_blank" href="{{action('RevokeController@detail',$v->id)}}">
                                    @if($v->check == 1)[收购]@elseif($v->check == 2)[出售]@endif
                                    {{ $v->shopName }}({{ $v->productPhase }}){{ $v->num }}{{ $v->unit }}
                                    单价:{{ $v->unitPrice }}元
                                    {{ $v->deliveryMethods[0] }}
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>

                @foreach($topicCates as $k=>$v)
                <div class="small_dealbar">
                    <div class="small_dealbar_head">
                        <div class="small_dealbar_head_title">
                            <a href="{{ action('TopicController@index',$v->id) }}" target="_blank">{{$v->cate}}</a>
                        </div>
                        <div class="small_dealbar_head_title2">
                            <a style="color:#888;" href="{{ action('TopicController@index',$v->id) }}"
                               target="_blank">更多</a>
                        </div>
                    </div>

                    <div class="small_dealbar_content">
                        @foreach($v->topics as $topic)
                            <div class="small_dealbar_content_title" style="border-bottom:1px solid #CCC;">

                                <a target="_blank" href="{{action('TopicController@detail',$topic->id)}}">
                                    {{$topic->title}}
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endforeach

        </div>

    </div>

    <div id="dealbar_zxcj_dk">
        <div id="dealbar_zxcj">

        </div>
    </div>
@endsection
