@extends('layouts.home')

@section('title')
    <title>{{ $post->shopName }}[传承网]</title>
@endsection

@section('css')
    <!-- 论坛帖子页面样式 -->
    <link rel="stylesheet" type="text/css" href="/home/css/ht.css">
    <link rel="stylesheet" type="text/css" href="/home/css/newHt.css">
    <link rel="stylesheet" type="text/css" href="/home/css/deal/detail.css">
@endsection

@section('content')

    <div class="htbox">
        <!--内容部分-->
        <div class="navigation">
            <div style="margin:8px 0 0 3px;float: left;width:1%;text-align: center; line-height:5px;margin-right:10px;">
                {{--<img src="/home/images/Forum_nav.gif">--}}
            </div>
            <div style="float: left;font-size: 14px;line-height: 25px ;height: 25px;">

            </div>
        </div>
        <!--楼主-->

            <div class="owner">
                <div class="owner_title">
                    <div style="word-break:break-all;">
                            <span style="color:red">
                            @if($post->check == 2)
                                    「出售」
                                @else
                                    「收购」
                                @endif
                            </span>
                        {{ $post->shopName }}({{ $post->productPhase }}){{ $post->num }}{{ $post->unit }}
                        单价:{{ $post->unitPrice }}元

                        @foreach($post->deliveryMethods as $k => $v)
                            {{$v}}
                        @endforeach
                        <span style="color:#A66C33;font-size:16px;">本帖交易ID 「{{$post['id']}}」</span>
                    </div>

                    <div class="owner_post_time">
                        {{$post->created_at}}
                    </div>
                </div>

                <div class="owner_down">
                    <div class="owner_detail">
                        <div class="owner_user_headpic">
                            <a href="/personal/{{$post->user->id}}">
                                <img src="{{$post->user->avatar}}"  width="90" height="90" style="border-radius:45px;"/ class="owner_user_img">
                            </a>
                            <div class="owner_user_name">
                                <a href="/personal/{{$post->user->id}}">{{ $post->user->name }}<span id="louzhu">[楼主]</span></a>
                                <br>
                                @if(Auth::id() != $post->user->id)

                                    <a @if(Auth::check()) login="true" @else login="false" @endif href='javascript:;' class='gzuser gzuser{{ $post->user->id }}' follow_id="{{ $post->user->id }}">{!! Auth::check()&&Auth::user()->followed_user($post->user->id) ? "<span class='glyphicon glyphicon-minus'></span><span style='margin-left:5px'>已关注</span>" : "<span class='glyphicon glyphicon-plus'></span><span style='margin-left:5px'>关注他</span>" !!}</a>

                                    <a href="/message/check/{{$post->user->id}}">
                                        <span class='glyphicon glyphicon-envelope' style="margin-left:2px;margin-right:5px;font-size:14px;"></span>私信
                                    </a>
                                @endif
                            </div>
                        </div>
                        <div class="owner_user_detail">
                            身份：{{$post->user->role->role}}
                        </div>
                        <div class="owner_user_detail">性别 : @if($post->user->detail->sex == 0)女 @else 男 @endif</div>
                        @if($post->user->birthday != 0)
                            <div class="owner_user_detail">生日 : {{$post->user->birthday}}</div>
                        @endif

                        @if($post->user->email != '0')
                            <div class="owner_user_detail">邮箱 : {{$post->user->detail->email}}</div>
                        @endif

                        <div class="owner_user_detail">发帖次数 : {{$post->user->posts->count()}}</div>
                        <div class="owner_user_detail">回帖次数 : {{$post->user->replies->count()}}</div>
                        <div class="owner_user_detail">注册日期 : {{$post->user->created_at}}</div>
                        <div class="owner_user_detail">信用积分 : {{$post->user->detail->creditscore}}</div>
                        <div class="owner_user_detail">交易次数 : {{$post->user->detail->transactionTimes}}</div>
                        <div class="owner_user_detail">交易金额 : {{$post->user->detail->transactionAmount}}</div>
                        <div class="owner_user_detail">好评率  : {{$post->user->mark->appreciation}}</div>
                    </div>
                    <div class="owner_content">
                        <div class="res" style="min-height:200px;font-size:9pt;line-height:normal;text-indent:24px;margin-top:10px;word-wrap : break-word ;word-break : break-all ;font-size:16px;" onload="this.style.overflowX='auto';">

                            <div style="width:100%;">
                                    <div style="width:100%;text-align: center;font-size:30px;color:red">
                                        已撤贴！
                                    </div>
                            </div>

                            <div>
                                交易类别：<span>  @if($post->check == 2)
                                        「出售」
                                    @else
                                        「收购」
                                    @endif</span>
                            </div>
                            <div>
                                交易栏目: <span>{{$post->cate->name}}</span>
                            </div>
                            <div>
                                交易ID号：<span style="color:red;">{{$post->id}}</span>
                            </div>
                            <div>
                                交易状态：<span>

                                        <span style="color:red">已撤贴！</span>
                                    </span>
                            </div>

                            <div>
                                品种名称：<span>{{ $post->shopName }}</span>
                            </div>

                            <div>
                                品相：<span>{{$post->productPhase}}</span>
                            </div>
                            <div>
                                单价：<span>{{$post->unit}}</span>
                            </div>

                            <div>
                                其他费用: <span>{{$post->otherExpenses}}元</span>
                            </div>

                            <div>
                                数量： <span>{{$post->num}}{{$post->unit}}</span>
                            </div>
                            <div>
                                最小购买数量 <span>{{$post->minQuantity}}{{$post->unit}}</span>
                            </div>
                            <div>
                                合计金额: <span  style="color:red;">{{$post->total}}元</span>
                            </div>

                            <div>
                                确认方式：<span style="color:red;">直接确认</span>
                            </div>
                            <div>
                                交割方式: @foreach($post->deliveryMethods as $k => $v)
                                    <span>{{$v}}</span>
                                @endforeach
                            </div>
                            <div>
                                发布时间: <span>{{$post->created_at}}</span>
                            </div>
                            <div>
                                信息有效时间: <span>{{date( "Y-m-d H : i : s", + $post->validity)}}</span>
                            </div>
                            <div>
                                剩余时间 : <span style="color:red">{{$date}}</span>
                            </div>
                            <div style="width:100%">
                                其他说明: <span>{{$post->instructions}}</span>
                            </div>

                            <div>
                                浏览次数 : <span>{{$post->views}}</span>
                            </div>
                            <div id="res-btn" style="width:100%">
                                        <div style="width:100%;text-align: center;font-size:30px;margin-top:10px;color:red">
                                            已撤贴！
                                        </div>
                            </div>
                        </div>

                        <div>
                            @foreach($post->pic as $k => $v)
                                <a href="{{$v}}"><img src="{{$v}}" width="100%" alt=""></a>
                            @endforeach
                        </div>
                        <div>
                            <img src="/home/images/tag.png" style="width:20px;"> ---------------------------------------------------------------------------------<br>

                        </div>

                        <div class="user_detail_x">
                            <div class="user_detail_x_line">认证状态 :
                                @if($post->user->role->role == '认证会员')
                                    <span>{{$post->user->role->role}} <span class="rzzt">「此用户已通过实名认证，地址，银行，姓名均认证成功」</span></span>
                                @elseif($post->user->role->role == '普通会员')
                                    <span>{{$post->user->role->role}} <span class="rzzt">「此用户还未实名认证」</span></span>
                                @elseif($post->user->role->role == '管理员')
                                    <span>{{$post->user->role->role}}</span>
                                @endif
                            </div>

                            @if($post->user->card->realName != '0')
                                <div class="user_detail_x_line">姓 名 : <span>{{$post->user->card->realName}}</span></div>
                            @endif

                            @foreach($post->user->addresses as $k => $v)
                                <div class="user_detail_x_line">地 址{{$k+1}} : <span> {{$v['province']}}{{$v['city']}}{{$v['county']}}{{$v['street']}} </span></div>
                            @endforeach

                            <div class="user_detail_x_line">手 机 : <span>{{$post->user->phone}}

                        </span></div>


                            @foreach( $post->user->banks as $k => $v)
                                <div class="user_detail_x_line">银 行{{$k+1}} : <span>{{$v['cateBank']}}&nbsp; &nbsp; {{$v['bankId']}} &nbsp; &nbsp; {{$v['bankName']}}  &nbsp; &nbsp; {{$v['tel']}}</span></div>
                            @endforeach

                            @if($post->user->detail->alipay != '0')
                                <div class="user_detail_x_line">支付宝 : <span>{{$post->user->detail->alipay}}</span></div>
                            @endif

                            @if($post->user->detail->vx != '0')
                                <div class="user_detail_x_line">微 信 : <span>{{$post->user->detail->vx}}</span></div>
                            @endif

                            @if($post->user->detail->qq != '0')
                                <div class="user_detail_x_line"> Q Q : <span>{{$post->user->detail->qq}}</span></div>
                            @endif

                        </div>
                    </div>
                </div>

                <div class="owner_tips">
                    <span class="owner_time">{{$post->created_at}}</span>
                    <span class="owner_tip">免责声明及风险提示： 所有交易人员，凡未采用本站中介交易的，被骗后果自负。</span>
                </div>
            </div>

        <div class="owner">

            <div class="owner_down">
                <div class="owner_detail">
                    <div class="owner_user_headpic">
                        <a href="/personal/{{$post->user->id}}">
                            <img src="{{$post->user->avatar}}"  width="90" height="90" style="border-radius:45px;"/ class="owner_user_img">
                        </a>
                        <div class="owner_user_name">
                            <a href="/personal/{{$post->user->id}}">{{ $post->user->name }}<span id="louzhu">[楼主]</span></a>
                            <br>
                            @if(Auth::id() != $post->user->id)

                                <a @if(Auth::check()) login="true" @else login="false" @endif href='javascript:;' class='gzuser gzuser{{ $post->user->id }}' follow_id="{{ $post->user->id }}">{!! Auth::check()&&Auth::user()->followed_user($post->user->id) ? "<span class='glyphicon glyphicon-minus'></span><span style='margin-left:5px'>已关注</span>" : "<span class='glyphicon glyphicon-plus'></span><span style='margin-left:5px'>关注他</span>" !!}</a>

                                <a href="/message/check/{{$post->user->id}}">
                                    <span class='glyphicon glyphicon-envelope' style="margin-left:2px;margin-right:5px;font-size:14px;"></span>私信
                                </a>
                            @endif
                        </div>
                    </div>
                    <div class="owner_user_detail">
                        身份：{{$post->user->role->role}}
                    </div>
                    <div class="owner_user_detail">性别 : @if($post->user->detail->sex == 0)女 @else 男 @endif</div>
                    @if($post->user->birthday != 0)
                        <div class="owner_user_detail">生日 : {{$post->user->birthday}}</div>
                    @endif

                    @if($post->user->email != '0')
                        <div class="owner_user_detail">邮箱 : {{$post->user->detail->email}}</div>
                    @endif

                    <div class="owner_user_detail">发帖次数 : {{$post->user->posts->count()}}</div>
                    <div class="owner_user_detail">回帖次数 : {{$post->user->replies->count()}}</div>
                    <div class="owner_user_detail">注册日期 : {{$post->user->created_at}}</div>
                    <div class="owner_user_detail">信用积分 : {{$post->user->detail->creditscore}}</div>
                    <div class="owner_user_detail">交易次数 : {{$post->user->detail->transactionTimes}}</div>
                    <div class="owner_user_detail">交易金额 : {{$post->user->detail->transactionAmount}}</div>
                    <div class="owner_user_detail">好评率  : {{$post->user->mark->appreciation}}</div>
                </div>
                <div class="owner_content">
                    <div class="res" style="min-height:200px;font-size:9pt;line-height:normal;text-indent:24px;margin-top:10px;word-wrap : break-word ;word-break : break-all ;font-size:16px;" onload="this.style.overflowX='auto';">

                        <div id="res-btn" style="width:100%">
                            <div style="width:100%;text-align: center;font-size:30px;margin-top:10px;color:red">
                               用户已经自行撤贴， 已撤贴！
                            </div>
                        </div>
                    </div>

                    <div>

                    </div>
                    <div>
                        <img src="/home/images/tag.png" style="width:20px;"> ---------------------------------------------------------------------------------<br>

                    </div>

                    <div class="user_detail_x">
                        <div class="user_detail_x_line">认证状态 :
                            @if($post->user->role->role == '认证会员')
                                <span>{{$post->user->role->role}} <span class="rzzt">「此用户已通过实名认证，地址，银行，姓名均认证成功」</span></span>
                            @elseif($post->user->role->role == '普通会员')
                                <span>{{$post->user->role->role}} <span class="rzzt">「此用户还未实名认证」</span></span>
                            @elseif($post->user->role->role == '管理员')
                                <span>{{$post->user->role->role}}</span>
                            @endif
                        </div>

                        @if($post->user->card->realName != '0')
                            <div class="user_detail_x_line">姓 名 : <span>{{$post->user->card->realName}}</span></div>
                        @endif

                        @foreach($post->user->addresses as $k => $v)
                            <div class="user_detail_x_line">地 址{{$k+1}} : <span> {{$v['province']}}{{$v['city']}}{{$v['county']}}{{$v['street']}} </span></div>
                        @endforeach

                        <div class="user_detail_x_line">手 机 : <span>{{$post->user->phone}}

                        </span></div>


                        @foreach( $post->user->banks as $k => $v)
                            <div class="user_detail_x_line">银 行{{$k+1}} : <span>{{$v['cateBank']}}&nbsp; &nbsp; {{$v['bankId']}} &nbsp; &nbsp; {{$v['bankName']}}  &nbsp; &nbsp; {{$v['tel']}}</span></div>
                        @endforeach

                        @if($post->user->detail->alipay != '0')
                            <div class="user_detail_x_line">支付宝 : <span>{{$post->user->detail->alipay}}</span></div>
                        @endif

                        @if($post->user->detail->vx != '0')
                            <div class="user_detail_x_line">微 信 : <span>{{$post->user->detail->vx}}</span></div>
                        @endif

                        @if($post->user->detail->qq != '0')
                            <div class="user_detail_x_line"> Q Q : <span>{{$post->user->detail->qq}}</span></div>
                        @endif

                    </div>
                </div>
            </div>

            <div class="owner_tips">
                <span class="owner_time">{{$post->created_at}}</span>
                <span class="owner_tip">免责声明及风险提示： 所有交易人员，凡未采用本站中介交易的，被骗后果自负。</span>
            </div>
        </div>

        @if($gljy)
            <div class="owner" >
                <div>关联交易 (同一个买卖盘拆分出来的相关交易)</div>

                <div style="margin-top:10px;">
                    @foreach($gljy as $k => $v)
                        <div style="margin-top:10px;">
                            <a target="_blank" href="{{action('DealSonController@detail',$v->id)}}">{{ $v->shopName }}({{
                        $v->productPhase
                        }}){{ $v->num }}{{
                        $v->unit }}
                                单价:{{ $v->unitPrice }}元 </a>
                            <a target="_blank" href="/personal/{{$v->confirm->user->id}}"><span
                                        style="color:red">{{$v->confirm->user->name}}</span></a>
                            <span>于{{$v->confirm->created_at}}交易</span>

                        </div>
                    @endforeach
                    @foreach($sy as $k => $v)
                        <div style="margin-top:10px;">
                            <a href="{{action('DealSonController@detail',$v->id)}}">剩余：{{$v->num}} {{$v->unit}}</a>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif




        <div id="match" >
            <div class="other-title">
                {{$post->shopName}}买卖盘配对
            </div>
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
                    <div style="font-size:15px;padding-left:10px;">
                        <a style="color:#ff6600" href="{{action('DealSonController@trade',
                        ['shopName'=>$post['shopName']])}}">更多买盘</a>
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
                    <div style="font-size:15px;padding-left:10px;">
                        <a style="color:#ff6600" href="{{action('DealSonController@trade',
                        ['shopName'=>$post['shopName']])}}">更多卖盘</a>
                    </div>
                </div>
            </div>
        </div>


        <div id="match" style="margin-top:20px;">
            <div class="other-title">
                {{$post->shopName}}最新成交
            </div>
            <div class="other-body newDeal" style="display: flex;flex-direction: column;">
                <div style="display: flex;flex-direction: row;">
                    <div style="width: 50%;">
                        标题
                    </div>
                    <div style="width: 15%;">
                        发布人
                    </div>
                    <div style="width: 10%;">
                        交易人
                    </div>
                    <div style="width: 20%;">
                        成交时间
                    </div>
                    <div style="width: 15%;">
                        状态
                    </div>
                </div>
                <div style="display: flex;flex-direction: column;">
                    @foreach($newDeal as $k => $v)
                        <div style="display: flex;flex-direction: row;font-size:14px;margin-top:10px;line-height:35px;">
                            <div style="width: 50%;  overflow: hidden;white-space: nowrap;text-overflow:ellipsis;">
                                @if($v->check == 1)
                                    <span  class="newDeal_buy">买</span>
                                @else
                                    <span class="newDeal_sell">卖</span>
                                @endif
                                <a href="" style="color:#f4b43f;margin-left:10px;">
                                    {{$v->shopName}}
                                    {{$v->productPhase}}
                                    {{$v->num}} {{$v->unit}}
                                    单价：{{$v->unitPrice}}

                                    @foreach($v['deliveryMethods'] as $k1 => $v1)
                                        {{$v1}}
                                    @endforeach
                                </a>
                            </div>
                            <div style="width: 15%;">
                                <a href="/personal/{{$v->user->id}}">{{$v->user->name}}</a>

                            </div>
                            <div style="width: 10%;">
                                <a href="/personal/{{$v->confirm->user->id}}">{{$v->confirm->user->name}}</a>
                            </div>
                            <div style="width: 20%;">
                                {{$v->confirm->created_at}}
                            </div>
                            <div style="width: 15%;">
                                @if($v->status == 1)
                                    交易人确认交易
                                @elseif($v->status == 2)
                                    双方确认交易
                                @endif
                            </div>

                        </div>
                    @endforeach
                </div>
                <div style="font-size:15px;padding-left:10px;margin-top:20px;">
                    <a href="{{action('DealSonController@trade',['shopName'=>$post['shopName']])}}"
                       style="color:#ff6600">更多成交</a>
                </div>
            </div>
        </div>

        <div id="match" style="margin-top:20px;" >
            <div class="other-title">
                {{$post->cate->name}}相关
            </div>
            <div class="other-body">
                <div class="other-body_left other-body_son" style="border-right: 1px solid #F0F0F0;">
                    <div style="  text-align: center;"> {{$post->cate->name}}最新买卖盘</div>
                    <div class="other-body_son_body">
                        @foreach($cateDeal['newDeal'] as $k => $v)
                            <div style="line-height:30px;border-bottom:1px solid #F0F0F0">
                                @if($v->check == 1)
                                    <span  class="newDeal_buy">买</span>
                                @else
                                    <span class="newDeal_sell">卖</span>
                                @endif
                                <a style="padding-left:10px;" href="{{action('DealSonController@detail',$v->id)}}"><span>{{$v->shopName}} 单价:
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
                    <div style="  text-align: center;"> {{$post->cate->name}}最新买成交</div>
                    <div class="other-body_son_body">
                        @foreach($cateDeal['newConfirm'] as $k => $v)
                            <div  style="line-height:30px;border-bottom:1px solid #F0F0F0">
                                @if($v->check == 1)
                                    <span  class="newDeal_buy">买</span>
                                @else
                                    <span class="newDeal_sell">卖</span>
                                @endif
                                <a   style="padding-left:10px;"  href="{{action('DealSonController@detail',$v->id)
                                }}"><span>{{$v->shopName}} 单价:
                                        {{$v->unitPrice}}
                                        @foreach($v['deliveryMethods'] as $k1 => $v1)
                                            {{$v1}}
                                        @endforeach

                                    </span></a>

                                <span >（<a
                                            href="/personal/{{$v->id}}" style="color:red">{{$v->confirm->user->name}}</a></span>
                                <span>于{{$v->confirm->created_at}}成交</span>）
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>


    </div>

@endsection


@section('js')
    <script type="text/javascript" src="/home/js/deal/details.js"></script>


@endsection
