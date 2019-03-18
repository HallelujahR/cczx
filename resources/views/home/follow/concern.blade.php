@extends('layouts.home')


@section('css')
    <!-- 个人中心样式 -->
    <link rel="stylesheet" href="/home/css/personal/amazeui.cropper.css">
    <link rel="stylesheet" href="/home/css/personal/custom_up_img.css">
    <link rel="stylesheet" type="text/css" href="/home/css/personal/personal.css">
    <link rel="stylesheet" href="/home/css/follow.css">
@endsection


@section('content')

    <div style="padding:0px;" class="container-fluid">
        <div id="personal_con" newsType="all" userid="{{Auth::id()}}">
            <!-- 左栏 -->
        @include("layouts.personleft")
        <!-- 右栏 -->
            <div id="personal_right">
                <h2 style="text-align:center;margin-top:20px;">关注者 <small>Concern</small></h2>
                <div id="concern">
                        @if(count($concern) > 0)
                        @foreach($concern as $k => $v)

                            <div class="concern-list">
                                <a href="/personal/{{$v->id}}}"><img src="{{$v->avatar}}" alt="" width="80px;"></a>
                                <div class="concern-list-body">
                                    <span class="concern-list-body-string">
                                        <a href="/personal/{{$v->id}}}">{{$v->name}}</a>
                                    </span>

                                    @if($v->id != Auth::id())
                                    <span class="concern-list-body-string">
                                        <a login="true" href="javascript:void(0);" class="gzuser gzuser{{$v->id}}"
                                           follow_id="{{$v->id}}">
                                            {!! Auth::check()&&Auth::user()->followed_user($v->id) ? "<span
                                            class='glyphicon glyphicon-minus'></span><span style='margin-left:5px'>已关注</span>" : "<span class='glyphicon glyphicon-plus'></span><span style='margin-left:5px'>关注他</span>" !!}
                                        </a>

                                        <a href="/message/check/{{ $v->id }}" style="margin-left:10px;color:#B16932;">
                                            <span class='glyphicon glyphicon-envelope' style="margin-right:5px;"></span>私信
                                        </a>
                                    </span>
                                    @endif

                                </div>
                            </div>
                        @endforeach

                    <div style="position:absolute;bottom:-10px;right:10px;">
                        {{ $concern->links() }}
                    </div>
                        @else
                            <div style="font-size:20px;padding:20px 0px 0px 20px;">
                                还没人关注您
                            </div>
                        @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript" src="/home/js/personal/cropper.min.js"></script>
    <script type="text/javascript" src="/home/js/personal/custom_up_img.js"></script>
    <script type="text/javascript" src="/home/js/personal/amazeui.min.js"></script>
    <!-- 表格 -->
    <script>
        <!-- 表格 -->

        function qxgz(id){
            $('.gzuser'+id).find('span:eq(0)').attr('class', 'glyphicon glyphicon-minus');
            $('.gzuser'+id).find('span:eq(1)').html('已关注');

            $('.gzuser'+id).hover(function(){
                $(this).css({'color' : '#ABB6C5'});
                $(this).find('span:eq(1)').html('取消关注')
            },function(){
                $(this).css({'color' : '#A66C33'});
                $(this).find('span:eq(1)').html('已关注')
            })
        }

        function gz(id){
            $('.gzuser'+id).find('span:eq(0)').attr('class', 'glyphicon glyphicon-plus');
            $('.gzuser'+id).find('span:eq(1)').html('关注他');
            $('.gzuser'+id).css('color','#A66C33');

            $('.gzuser'+id).hover(function(){
                $(this).css({'color' : '#A66C33'});
                $(this).find('span:eq(1)').html('关注他')
            },function(){
                $(this).css({'color' : '#A66C33'});
                $(this).find('span:eq(1)').html('关注他')
            })
        }

        for(var i=0;i< $('.gzuser').length;i++){
            if($('.gzuser:eq('+i+')').find('span:eq(1)').text() == '已关注'){
                $('.gzuser:eq('+i+')').hover(function(){
                    $(this).css({'color' : '#ABB6C5'});
                    $(this).find('span:eq(1)').html('取消关注')
                },function(){
                    $(this).css({'color' : '#A66C33'});
                    $(this).find('span:eq(1)').html('已关注')
                })
            }

            $('.gzuser:eq('+i+')').css('color','#A66C33')
        }

        $('.gzuser').click(function(){

            var follow_id = $(this).attr('follow_id');

            //判断用户是否登录
            if($(this).attr('login') == 'true'){

                $.ajax({
                    url:'/follow/'+follow_id,
                    type:'get',
                    success: (res) => {
                        if(res == 1){
                            qxgz(follow_id)

                            layer.msg('关注该用户成功')
                        }else{
                            gz(follow_id)

                            layer.msg('你已取消关注该用户')
                        }
                    },
                    error: (res) => {
                        layer.msg('请重新登录')
                    }
                })

            }else{
                layer.msg('请先进行登录才能关注用户')
            }
        })


    </script>
@endsection
