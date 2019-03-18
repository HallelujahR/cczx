@extends('layouts.home')

@section('title')
<title>{{ $post->title }}[传承网]</title>
@endsection

@section('css')
<!-- 论坛帖子页面样式 -->
<link rel="stylesheet" type="text/css" href="/home/css/ht.css">
<link rel="stylesheet" type="text/css" href="/home/css/newHt.css">
@endsection

@section('content')

<div class="htbox">
	<!--内容部分-->
	<div class="navigation">
	    <div style="margin:8px 0 0 3px;float: left;width:1%;text-align: center; line-height:5px;margin-right:10px;">
	    	<img src="/home/images/Forum_nav.gif">
	    </div>
	    <div style="float: left;font-size: 14px;line-height: 25px ;height: 25px;">
	    	<a href="/">传承网 </a>→
	    	@if($post->cate->pid == 0)
	    		<a href="{{ action('BbsController@fucate',$post->cate->id) }}">{{ $post->cate->cate }}</a> →
	    	@else
	    		<a href="{{ action('BbsController@fucate',getBbsCate($post->cate->pid)->id) }}">{{ getBbsCate($post->cate->pid)->cate }} </a> →
				<a href="/bbs/zicate/{{$post->cate->id}}.html">{{ $post->cate->cate }}</a> →
	    	@endif
			<span>{{ $post->title }}</span>
	    </div>
	</div>

	<!--项目栏-->
	<div class="xml">
		<div class="xmll">
			<a href="{{ action('PublishController@post',['id'=>$post->cate->id]) }}" id="fbtz">发表帖子</a>
			<a href="{{ action('PublishController@reply',$post->id) }}" id="hftz">回复帖子</a>
		</div>
		<div class="xmlr">
		   	<p>
		    	您是本帖的第 <span>{{ $post->access_count }}</span> 个阅读者
		   	</p>
		</div>
	</div>

	<!--回复框-->


	<!--楼主-->
	@if($replies->currentPage() <= 1)

   	<div class="owner">
		<div class="owner_title">
			<div style="word-break:break-all;">
				{{ $post->title }}
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
				<div class="owner_user_detail">性别 : @if($post_user->sex == 0)女 @else 男 @endif</div>
				@if($post_user->birthday != 0)
					<div class="owner_user_detail">生日 : {{$post_user->birthday}}</div>
				@endif

				@if($post_user->email != '0')
					<div class="owner_user_detail">邮箱 : {{$post_user->email}}</div>
				@endif

				<div class="owner_user_detail">发帖次数 : {{$post->user->posts->count()}}</div>
				<div class="owner_user_detail">回帖次数 : {{$post->user->replies->count()}}</div>
				<div class="owner_user_detail">注册日期： {{$post->user->created_at}}</div>
			</div>
			<div class="owner_content">
				<div class="res" style="min-height:200px;font-size:9pt;line-height:normal;text-indent:24px;margin-top:10px;word-wrap : break-word ;word-break : break-all ;font-size:16px;" onload="this.style.overflowX='auto';">
					{!! $post->content->content !!}
				</div>
				<div>
				   <img src="/home/images/tag.png" style="width:20px;"> ---------------------------------------------------------------------------------<br>

				</div>

				<div class="user_detail_x">
					<div class="user_detail_x_line">认证状态 :
						@if($post->user->card->status == 3)
						<span>{{$post->user->role->role}} <span class="rzzt">「此用户已通过实名认证，地址，银行，姓名均认证成功」</span></span>
						@else
						<span>{{$post->user->role->role}} <span class="rzzt">「此用户还未实名认证」</span></span>

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
   	@endif


	<!--回帖内容-->
	@foreach($replies as $k=>$reply)
   	<div class="reply">
		<div class="reply_down">
			<div class="reply_detail">

				<div class="reply_user_headpic">
					<a href="/personal/{{$reply->user->id}}">
						<img src="{{$reply->user->avatar}}"  width="90" height="90" style="border-radius:45px;"/ class="reply_user_img">
					</a>
					<div class="reply_user_name">
						<a href="/personal/{{$post->user->id}}">{{ $reply->user->name }}<span id="louzhu">[@if($replies->currentPage() <= 1){{ getLou($k+1) }}@else {{ getLou(($replies->currentPage()-1)*10+$k+1) }} @endif]</span></a>
						<br>

						@if(Auth::id() != $reply->user->id)

						<a @if(Auth::check()) login="true" @else login="false" @endif href='javascript:;' class='gzuser gzuser{{ $reply->user->id }}' follow_id="{{ $reply->user->id }}">{!! Auth::check()&&Auth::user()->followed_user($reply->user->id) ? "<span class='glyphicon glyphicon-minus'></span><span style='margin-left:5px'>已关注</span>" : "<span class='glyphicon glyphicon-plus'></span><span style='margin-left:5px'>关注他</span>" !!}</a>

						<a href="/message/check/{{$reply->user->id}}">
							 <span class='glyphicon glyphicon-envelope' style="margin-left:2px;margin-right:5px;font-size:14px;"></span>私信
						</a>
						@endif
					</div>
				</div>

				<div class="owner_user_detail">
					身份：{{$reply->user->role->role}}
				</div>
				<div class="owner_user_detail">性别 : @if($reply->user->detail->sex == 0)女 @else 男 @endif</div>
				@if($reply->user->detail->birthday != 0)
					<div class="owner_user_detail">生日 : {{$reply->user->detail->birthday}}</div>
				@endif

				@if($reply->user->detail->email != '0')
					<div class="owner_user_detail">邮箱 : {{$reply->user->detail->email}}</div>
				@endif
				<div class="owner_user_detail">发帖次数 : {{$reply->user->posts->count()}}</div>
				<div class="owner_user_detail">回帖次数 : {{$reply->user->replies->count()}}</div>
				<div class="owner_user_detail">注册日期： {{$reply->user->created_at}}</div>
			</div>
			<div class="reply_content">
				<div class="res" style="min-height:200px;font-size:9pt;line-height:normal;text-indent:24px;margin-top:10px;word-wrap : break-word ;word-break : break-all ;font-size:16px;" onload="this.style.overflowX='auto';">
					 {!! $reply->content->reply !!}
				</div>
				<div>
				   <img src="/home/images/tag.png" style="width:20px;"> ---------------------------------------------------------------------------------<br>

				</div>

				<div class="user_detail_x">
					<div class="user_detail_x_line">认证状态 :
						@if($reply->user->card->status == 3)
						<span>{{$reply->user->role->role}} <span class="rzzt">「此用户已通过实名认证，地址，银行，姓名均认证成功」</span></span>
						@else
						<span>{{$reply->user->role->role}} 「此用户还未实名认证」</span>
						@endif
					</div>

					@if($reply->user->card->realName != '0')
					<div class="user_detail_x_line">姓 名 : <span>{{$reply->user->card->realName}}</span></div>
					@endif


					@foreach($reply->user->addresses as $k => $v)
					<div class="user_detail_x_line">地 址{{$k+1}} : <span> {{$v['province']}}{{$v['city']}}{{$v['county']}}{{$v['street']}} </span></div>
					@endforeach

					<div class="user_detail_x_line">手 机 : <span>{{$reply->user->phone}}

					</span></div>

					@foreach( $reply->user->banks as $k => $v)
					<div class="user_detail_x_line">银 行{{$k+1}} : <span>{{$v['cateBank']}}&nbsp; &nbsp; {{$v['bankId']}} &nbsp; &nbsp; {{$v['bankName']}} &nbsp; &nbsp; {{$v['tel']}}</span></div>
					@endforeach

					@if($reply->user->detail->alipay != '0')
					<div class="user_detail_x_line">支付宝 : <span>{{$reply->user->detail->alipay}}</span></div>
					@endif
					@if($reply->user->detail->vx != '0')
					<div class="user_detail_x_line">微 信 : <span>{{$reply->user->detail->vx}}</span></div>
					@endif

					@if($reply->user->detail->qq != '0')
					<div class="user_detail_x_line"> Q Q : <span>{{$reply->user->detail->qq}}</span></div>
					@endif

				</div>


			</div>
		</div>

		<div class="reply_tips">
			<span class="reply_time">{{$reply->created_at}}</span>
			<span class="reply_tip">免责声明及风险提示： 所有交易人员，凡未采用本站中介交易的，被骗后果自负。</span>
		</div>
   	</div>

	@endforeach

	<!--按钮-->
	<div style="float:right;">
		{!! $replies->links(('layouts.pagination')) !!}
	</div>


	<div style="float:left;width:100%;padding:0px;">
	    @if(Auth::check() && Auth::user())
	        <div id="plArticle">
	        	<div style="color:#999999">
	        		上传的图片不能大于2M
	        	</div>
	            <div>
	                <form id="form" class="form-horizontal" action="{{ action('PublishController@storeReply') }}" method="post">
	                    {{ csrf_field() }}
	                    <input type="hidden" name="pid" value="{{ $post->id }}">
	                    <div id='detail'></div>
	                    <textarea id="text1" name='detail' style="width:100%; height:200px;display:none;"></textarea>
	                    <button flag="1" style="background-color:#7FB4CB;margin-top:10px;" type="submit" class="btn btn-info btn-block" id="comment-commit">确认提交</button>
	                </form>
	            </div>
	        </div>
        @endif
    </div>

</div>

@endsection


@section('js')
<script type="text/javascript" src='/wangEditor/plarticlewangEditor.min.js'></script>
<script type="text/javascript" src='/home/js/post/post.js'></script>
@endsection
