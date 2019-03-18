@extends('layouts.home')

@section('title')
<title>{{ $user->name}}的个人中心[传承网]</title>
@endsection

@section('css')
<!-- 个人中心样式 -->
<link rel="stylesheet" href="/home/css/personal/amazeui.cropper.css">
<link rel="stylesheet" href="/home/css/personal/custom_up_img.css">
<link rel="stylesheet" type="text/css" href="/home/css/personal/personal.css">
@endsection

@section('content')

<div style="padding:0px;" class="container-fluid">
    <div id="personal_con">
        <!-- 左栏 -->
        @include("layouts.personleft")
        <!-- 右栏 -->
        <div id="personal_right">
            <h2 style="text-align:center;margin-top:20px;">个人中心 <small>Personal Center</small></h2>
            <div id="personal_right_info">

                <div id="personal_right_info_left">
                    <div class="info_left_all">
                        <div class="info_left_label">
                            昵称：
                        </div>
                        <div class="info_left_form" style="display:none;">
                            <div class="col-sm-6 col-sm-offset-2">
                                <input type="text" class="form-control" name="nicheng" placeholder="请编辑您的昵称" value="{{ $user->name }}">
                            </div>
                            <div class="col-sm-4">
                                <button id="nicheng" class="btn btn-default bc" type="button">保存</button>
                                <button class="btn btn-default qx" type="button">取消</button>
                            </div>
                        </div>
                        <div class="info_left_con">
                            <span>{{ $user->name }}</span>
                            <div class="info_left_hover">
                                <span class="glyphicon glyphicon-edit"></span>
                                <span>编辑昵称</span>
                            </div>
                        </div>
                    </div>

                    <div class="info_left_all">
                        <div class="info_left_label">
                            性别：
                        </div>
                        <div class="info_left_form" style="display:none;">
                            <div class="col-sm-6 col-sm-offset-2" style="padding-top:8px;">
                                <input type="radio" name="sex" value="1" @if($user->detail->sex == 1) checked @endif><span style="margin-left:5px;margin-right:10px;">男</span>
                                <input type="radio" name="sex" value="0" @if($user->detail->sex == 0) checked @endif><span style="margin-left:5px;margin-right:10px;">女</span>
                            </div>
                            <div class="col-sm-4">
                                <button id="xingbie" class="btn btn-default bc" type="button">保存</button>
                                <button class="btn btn-default qx" type="button">取消</button>
                            </div>
                        </div>
                        <div class="info_left_con">
                            <span>@if($user->detail->sex == '0') 女 @else 男 @endif</span>
                            <div class="info_left_hover">
                                <span class="glyphicon glyphicon-user"></span>
                                <span>编辑性别</span>
                            </div>
                        </div>
                    </div>

                    <div class="info_left_all">
                        <div class="info_left_label">
                            生日：
                        </div>
                        <div class="info_left_form" style="display:none;">
                            <div class="col-sm-6 col-sm-offset-2">
                                <input type="date" class="form-control" name="shengri" placeholder="请编辑您的生日" @if($user->detail->birthday != '0') value="{{ $user->detail->birthday }}" @endif>
                            </div>
                            <div class="col-sm-4">
                                <button id="birthday" class="btn btn-default bc" type="button">保存</button>
                                <button class="btn btn-default qx" type="button">取消</button>
                            </div>
                        </div>
                        <div class="info_left_con">
                            <span>@if($user->detail->birthday != '0') {{ $user->detail->birthday }} @endif</span>
                            <div class="info_left_hover">
                                <span class="glyphicon glyphicon-hand-right"></span>
                                <span>编辑生日</span>
                            </div>
                        </div>
                    </div>

                    <div class="info_left_all">
                        <div class="info_left_label">
                            邮箱：
                        </div>
                        <div class="info_left_form" style="display:none;">
                            <div class="col-sm-6 col-sm-offset-2">
                                <input type="email" class="form-control" name="youxiang" placeholder="请编辑您的邮箱" @if($user->detail->email) != '0') value="{{ $user->detail->email }}" @endif>
                            </div>
                            <div class="col-sm-4">
                                <button id="youxiang" class="btn btn-default bc" type="button">保存</button>
                                <button class="btn btn-default qx" type="button">取消</button>
                            </div>
                        </div>
                        <div class="info_left_con">
                            <span>@if($user->detail->email != '0') {{ $user->detail->email }} @endif</span>
                            <div class="info_left_hover">
                                <span class="glyphicon glyphicon-envelope"></span>
                                <span>编辑邮箱</span>
                            </div>
                        </div>
                    </div>

                    <div class="info_left_all">
                        <div class="info_left_label">
                            Q Q：
                        </div>
                        <div class="info_left_form" style="display:none;">
                            <div class="col-sm-6 col-sm-offset-2">
                                <input type="text" class="form-control" name="qq" placeholder="请编辑您的QQ" @if($user->detail->qq != '0') value="{{ $user->detail->qq }}" @endif>
                            </div>
                            <div class="col-sm-4">
                                <button id="qq" class="btn btn-default bc" type="button">保存</button>
                                <button class="btn btn-default qx" type="button">取消</button>
                            </div>
                        </div>
                        <div class="info_left_con">
                            <span>@if($user->detail->qq != '0') {{ $user->detail->qq }} @endif</span>
                            <div class="info_left_hover">
                                <span class="glyphicon glyphicon-log-in"></span>
                                <span>编辑QQ</span>
                            </div>
                        </div>
                    </div>

                    <div class="info_left_all">
                        <div class="info_left_label">
                            微信：
                        </div>
                        <div class="info_left_form" style="display:none;">
                            <div class="col-sm-6 col-sm-offset-2">
                                <input type="text" class="form-control" name="weixin" placeholder="请编辑您的微信" @if($user->detail->vx != '0') value="{{ $user->detail->vx }}" @endif>
                            </div>
                            <div class="col-sm-4">
                                <button id="vx" class="btn btn-default bc" type="button">保存</button>
                                <button class="btn btn-default qx" type="button">取消</button>
                            </div>
                        </div>
                        <div class="info_left_con">
                            <span>@if($user->detail->vx != '0') {{ $user->detail->vx }} @endif</span>
                            <div class="info_left_hover">
                                <span class="glyphicon glyphicon-log-out"></span>
                                <span>编辑微信</span>
                            </div>
                        </div>
                    </div>

                    <div class="info_left_all">
                        <div class="info_left_label">
                            电话：
                        </div>
                        <div class="info_left_form" style="display:none;">
                            <div class="col-sm-6 col-sm-offset-2">
                                <input type="text" class="form-control" name="dianhua" placeholder="请编辑您的电话" @if($user->detail->telephone != '0') value="{{ $user->detail->telephone }}" @endif>
                            </div>
                            <div class="col-sm-4">
                                <button id="dianhua" class="btn btn-default bc" type="button">保存</button>
                                <button class="btn btn-default qx" type="button">取消</button>
                            </div>
                        </div>
                        <div class="info_left_con">
                            <span>@if($user->detail->telephone != '0') {{ $user->detail->telephone }} @endif</span>
                            <div class="info_left_hover">
                                <span class="glyphicon glyphicon-phone-alt"></span>
                                <span>编辑电话</span>
                            </div>
                        </div>
                    </div>

                    <div class="info_left_all">
                        <div class="info_left_label">
                            支付宝：
                        </div>
                        <div class="info_left_form" style="display:none;">
                            <div class="col-sm-6 col-sm-offset-2">
                                <input type="text" class="form-control" name="alipay" placeholder="请编辑您的支付宝" @if($user->detail->alipay != '0') value="{{ $user->detail->alipay }}" @endif>
                            </div>
                            <div class="col-sm-4">
                                <button id="zfb" class="btn btn-default bc" type="button">保存</button>
                                <button class="btn btn-default qx" type="button">取消</button>
                            </div>
                        </div>
                        <div class="info_left_con">
                            <span>@if($user->detail->alipay != '0') {{ $user->detail->alipay }} @endif</span>
                            <div class="info_left_hover">
                                <span class="glyphicon glyphicon-yen"></span>
                                <span>编辑支付宝</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="personal_right_info_right">
                    <div class="info_right_message">
                        <a href="{{ action('PersonalController@article',$user->id) }}">发表的文章</a>
                        <span>{{ $user->articles->count() }}</span>
                    </div>
                    <div class="info_right_message">
                        <a href="{{ action('PersonalController@commentArticles',$user->id) }}">文章的评论</a>
                        <span>{{ $user->comments->count() }}</span>
                    </div>
                    <div class="info_right_message">
                        <a href="{{ action('PersonalController@post',$user->id) }}">发表的帖子</a>
                        <span>{{ $user->posts->count() }}</span>
                    </div>
                    <div class="info_right_message">
                        <a href="{{ action('PersonalController@replyPosts',$user->id) }}">帖子的回复</a>
                        <span>{{ $user->replies->count() }}</span>
                    </div>
                    <div class="info_right_message">
                        <div>注册日期</div>
                        <span>{{ $user->created_at }}</span>
                    </div>
                    @if($user->card->status == 3)
                        <span data-toggle="modal" data-target="#myModal"><div id="pass_title">「此用户已通过实名认证」点击查看</div></span></span>
                        @else
                        <span><div id="pass_title">「此用户还未实名认证」</div></span>
                        @endif
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">认证信息</h4>
      </div>
      <div class="modal-body">
        <div class="pass" style="padding-left:15px;">

            @if($user->card->realName != '0')
                <div class="pass_detail">姓名 : {{$user->card->realName}}</div>
            @endif

            @foreach($user->addresses as $k => $v)
                <div class="pass_detail">地址{{$k+1}} : <span>{{$v['province']}}{{$v['city']}}{{$v['county']}}{{$v['street']}}</span></div>
            @endforeach

            @foreach($user->banks as $k => $v)
            <div class="pass_detail">银 行{{$k+1}} : <span>{{$v['cateBank']}}&nbsp; &nbsp; {{$v['bankId']}} &nbsp; &nbsp; {{$v['bankName']}}</span></div>
            @endforeach

            <div class="pass_detail">电话 ： {{$user->phone}}</div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
      </div>
    </div>
  </div>
</div>
@endsection

@section('js')
<script type="text/javascript" src="/home/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/home/js/personal/custom_up_img.js"></script>
<script type="text/javascript" src="/home/js/personal/amazeui.min.js"></script>
<script type="text/javascript" src="/home/js/personal/cropper.min.js"></script>

    @if(Auth::check() && Auth::id())
        @if($user->id == Auth::id())
        <script type="text/javascript" src="/home/js/personal.js"></script>
        <script type="text/javascript">
            var sex = parseInt({{$user->detail->sex}});
            $('input[name="sex"]').click(function(){
                sex = $(this).val();
            });

            $('#xingbie').click(function(){
                $.ajax({
                    url:"{{ action('PersonalController@updateDetail') }}",
                    type:'post',
                    data:{name:'sex',value:sex},
                    success:function(mes){
                        if(mes == 1){
                            $(this).parent().parent().next().children('span:eq(0)').html($(this).parent().prev().find('input[value='+sex+']').next().html());
                            $(this).next().trigger('click');
                            layer.msg('修改性别成功');
                        }else{
                            layer.msg('修改性别失败');
                        }
                    }.bind(this)
                });

                return false;
            });
        </script>
        @endif
    @endif

    @if($user->id != Auth::id())
        <script type="text/javascript">
            for(var i=0;i < $('.info_left_con').length;i++){
                if($($('.info_left_con')[i]).children('span:eq(0)').html() == ''){
                    $($('.info_left_con')[i]).children('span:eq(0)').html('无');
                }
            }
        </script>
    @endif

    <script type="text/javascript">
        if($('#personal_right').height() > 660){
            $('#personal_left').css('height',$('#personal_right').height());
        }
    </script>
@endsection
