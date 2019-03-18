@extends('layouts.home')

@section('title')
<title>搜索[传承网]</title>
@endsection

@section('css')

<link rel="stylesheet" type="text/css" href="/home/css/search.css">
@endsection

@section('content')

<div style="margin-right: auto; margin-left: auto;width:1200px;">
<div id="s-contoiner">
	<!-- 交易帖子部分 -->
	<div class="s-head">
		<span class="s-head-a">交易帖子</span>
		<span class="s-head-b"><a  href="{{ action('DealSonController@search',['check'=>0,'deal_cate'=>0,
		'searchType'=>'shopName','text'=>$q]) }}">更多</a></span>
	</div>

	<div id="s-detail">
		<!-- 一侧可以容纳条帖子 -->
		@if($deal->count() > 0)
			<div class="s-detail">
				@foreach($deal as $k=>$v)
					<div class="s-detail-line">
						<div class="s-post-img">
							@if($v['check'] == '1')
								<div class="dealbody_line-icon_buy">
									买
								</div>
							@else
								<div class="dealbody_line-icon_sell">
									卖
								</div>
							@endif
						</div>
						<div class="s-post-title">
							<a href="/deal/detail/{{$v->id}}
									.html"> {{ $v->shopName }}({{ $v->productPhase }}){{ $v->num }}{{ $v->unit }}
								单价:{{ $v->unitPrice }}元</a>
						</div>
						<div class="s-detail-d">

							<span style="margin-right:20px;"> 「 {{$v->cate->name}} 」</span>

 							@if($v->status == 1)
								<span style="text-align: center;font-size:14px;color:red">
                                                交割中
                                            </span>
							@elseif($v->status == 2)
								<span style="width:100%;text-align: center;font-size:14px;color:red">
                                                交割完成
                                            </span>
							@elseif($v->status == 0)
								@if($v->check == 1)
									<span style="width:100%;text-align: center;font-size:14px;
                                            color:green;">
                                                    收购中
                                                </span>
								@else
									<span style="width:100%;text-align: center;font-size:14px;
                                            color:green;">
                                                    出售中
                                                </span>
								@endif
							@elseif($v->status == 10)
								<span style="width:100%;text-align: center;font-size:14px;color:red">
                                                已撤贴！
                                            </span>
							@elseif($v->status == 4)
								<span style="width:100%;text-align: center;font-size:14px;color:red">
                                                交割完成,双方已评分
                                            </span>
							@elseif($v->status == 3)
								<span style="width:100%;text-align: center;font-size:14px;color:red">
                                                交割失败
                                            </span>
							@endif

							@if($v->dealstatus == 6)
								<span style="width:100%;text-align: center;font-size:14px;color:red">
                                              交割失败
                                          </span>
							@endif


						</div>
						<div class="s-time">
							{{$v->created_at}}
						</div>
						<div class="s-post-auth">
							<a href="/personal/{{$v->user->id}}">发布者 ： {{$v->user->name}}</a>
						</div>
					</div>
				@endforeach
			</div>
		@else
			<div class="s-nopost">
				暂无相关帖子
			</div>
		@endif
	</div>

	<!-- 帖子部分 -->
	<div class="s-head">
		<span class="s-head-a">资讯帖子</span>
		<span class="s-head-b"><a href="/bbs">更多</a></span>
	</div>

	<div id="s-detail">
		<!-- 一侧可以容纳条帖子 -->
		@if($post->count() > 0)
			<div class="s-detail">
				@foreach($post as $k=>$v)
				<div class="s-detail-line">
					<div class="s-post-img">
						<a href="">
							<img src="/home/images/folder.gif">
						</a>
					</div>
					<div class="s-post-title">
						<a href="/bbs/post/{{$v->id}}.html">{{$v->title}}</a>
					</div>
					<div class="s-detail-d">
						<span>
							回复 : {{$v->replies->count()}}
						</span>
						<span>
							热度 : {{$v->access_count}}
						</span>
					</div>
					<div class="s-time">
						{{$v->created_at}}
					</div>
					<div class="s-post-auth">
						<a href="/personal/{{$v->user->id}}">作者 ： {{$v->user->name}}</a>
					</div>
				</div>
				@endforeach
			</div>
		@else
			<div class="s-nopost">
				暂无相关帖子
			</div>
		@endif
	</div>

	<!-- 文章部分 -->
	<div class="s-head">
		<span class="s-head-a">资讯文章</span>
		<span class="s-head-b"><a href="/">更多</a></span>
	</div>

	<div id="s-detail">
		<!-- 一侧可以容纳条帖子 -->
		@if($article->count() > 0)
			<div class="s-detail">
				@foreach($article as $k=>$v)
				<div class="s-detail-line">
					<div class="s-post-img">
						<a href="/cate/{{$v->cate->id}}.html" style="color:red">
							{{$v->cate->cate}}
						</a>
					</div>
					<div class="s-post-title">
						<a href="/article/{{$v->id}}.html">{{$v->title}}</a>
					</div>
					<div class="s-detail-d">
						<span>
							评论数量 : {{$v->comments->count()}}
						</span>
						<span>
							阅读量 : {{$v->access_count}}
						</span>
					</div>
					<div class="s-time">
						{{$v->created_at}}
					</div>
					<div class="s-post-auth">
						<a href="/personal/{{$v->user->id}}">作者 ： {{$v->user->name}}</a>
					</div>
				</div>
				@endforeach
			</div>
		@else
			<div class="s-nopost">
				暂无相关文章
			</div>
		@endif
	</div>


	<!-- 用户部分 -->
	<div class="s-head">
		<span class="s-head-a">用户</span>
	</div>


	<div class="s-detail">
		@if($user -> count() > 0)
			@foreach($user as $k => $v)
			<div class="s-user">
				<div class="s-user-img">
					<a href="/personal/{{$v->id}}">
						<img src="{{$v->avatar}}">
					</a>
				</div>
				<div class="s-user-detail">
					<div class="s-user-name">
						<a href="/personal/{{$v->id}}">{{$v->name}}</a>
					</div>
					<div class="s-user-num">
						<span>发帖数:{{$v->posts->count()}}</span>
						<span>文章数:{{$v->articles->count()}}</span>

					</div>

					@if(Auth::user() && Auth::id() != $v->id)
						<a class="s-user-action" href="/message/check/{{$v->id}}">
							发送私信
						</a>

						<span class="concern-list-body-string">
                                        <a login="true" href="javascript:void(0);" class=" s-user-action gzuser
                                        gzuser{{$v->id}}"
										   follow_id="{{$v->id}}">
                                            {!! Auth::check()&&Auth::user()->followed_user($v->id) ? "<span
                                            class='glyphicon glyphicon-minus'></span><span
                                            style='margin-left:5px'>已关注</span>" : "<span class='
                                            glyphicon glyphicon-plus'></span><span style='margin-left:5px'>关注他</span>" !!}
                                        </a>
                         </span>
					@endif

				</div>
			</div>
			@endforeach
		@else
		<div class="s-nopost">
			暂无相关用户
		</div>
		@endif
	</div>

</div>
</div>
@endsection

@section('js')
	<script>

        function qxgz(id){
            $('.gzuser'+id).find('span:eq(0)').attr('class', 'glyphicon glyphicon-minus')
            $('.gzuser'+id).find('span:eq(1)').html('已关注')

            $('.gzuser'+id).hover(function(){
                $(this).css({'color' : '#ABB6C5'})
                $(this).find('span:eq(1)').html('取消关注')
            },function(){
                $(this).css({'color' : '#A66C33'})
                $(this).find('span:eq(1)').html('已关注')
            })
        }

        function gz(id){
            $('.gzuser'+id).find('span:eq(0)').attr('class', 'glyphicon glyphicon-plus')
            $('.gzuser'+id).find('span:eq(1)').html('关注他')
            $('.gzuser'+id).css('color','#A66C33')

            $('.gzuser'+id).hover(function(){
                $(this).css({'color' : '#A66C33'})
                $(this).find('span:eq(1)').html('关注他')
            },function(){
                $(this).css({'color' : '#A66C33'})
                $(this).find('span:eq(1)').html('关注他')
            })
        }

        for(var i=0;i<$('.gzuser').length;i++){
            if($('.gzuser:eq('+i+')').find('span:eq(1)').text() == '已关注'){
                $('.gzuser:eq('+i+')').hover(function(){
                    $(this).css({'color' : '#ABB6C5'})
                    $(this).find('span:eq(1)').html('取消关注')
                },function(){
                    $(this).css({'color' : '#A66C33'})
                    $(this).find('span:eq(1)').html('已关注')
                })
            }

            $('.gzuser:eq('+i+')').css('color','#A66C33')
        }

        $('.gzuser').click(function(){
            var follow_id = $(this).attr('follow_id')

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
