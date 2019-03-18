@extends('layouts.home')

@section('title')
<title>{{ $post->title }}[传承网公告]</title>
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
	    	<a href="">公告</a>
			<span>{{ $post->title }}</span>
	    </div>
	</div>

	<!--项目栏-->
	<div class="xml">
		<div class="xmll">
			<a href="javascript:void(0)" flag="{{Auth::id()}}" id="hftz">回复公告</a>
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
					</div>
				</div>
				<div class="owner_user_detail">性别 : @if($post->user->sex == 0)女 @else 男 @endif</div>
				@if($post->user->birthday != 0)
					<div class="owner_user_detail">生日 : {{$post->user->birthday}}</div>
				@endif

				@if($post->user->email != '0')
					<div class="owner_user_detail">邮箱 : {{$post->user->email}}</div>
				@endif

				<div class="owner_user_detail">发帖次数 : {{$post->user->posts->count()}}</div>
				<div class="owner_user_detail">回帖次数 : {{$post->user->replies->count()}}</div>
				<div class="owner_user_detail">注册日期： {{$post->user->created_at}}</div>
			</div>
			<div class="owner_content">
				<div class="res" style="min-height:200px;font-size:9pt;line-height:normal;text-indent:24px;margin-top:10px;word-wrap : break-word ;word-break : break-all ;font-size:16px;" onload="this.style.overflowX='auto';">
					{!! $post->content !!}
				</div>
				<div>
				   <img src="/home/images/tag.png" style="width:20px;"> ---------------------------------------------------------------------------------<br>

				</div>
			</div>
		</div>

		<div class="owner_tips">
			<span class="owner_time">发布时间：{{$post->created_at}}</span>
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
					<a href="/personal/{{$post->user->id}}">
						<img src="{{$reply->user->avatar}}"  width="90" height="90" style="border-radius:45px;"/ class="reply_user_img">
					</a>
					<div class="reply_user_name">
							<a href="/personal/{{$post->user->id}}">{{ $reply->user->name }}<span id="louzhu">[@if($replies->currentPage() <= 1){{ getLou($k+1) }}@else {{ getLou(($replies->currentPage()-1)*10+$k+1) }} @endif]</span></a>
					</div>
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
					 {!! $reply->content !!}
				</div>
				<div>
				   <img src="/home/images/tag.png" style="width:20px;"> ---------------------------------------------------------------------------------<br>

				</div>
			</div>
		</div>

		<div class="reply_tips">
			<span class="reply_time">发布时间：{{$reply->created_at}}</span>
			<span class="reply_tip">免责声明及风险提示： 所有交易人员，凡未采用本站中介交易的，被骗后果自负。</span>
		</div>
   	</div>

	@endforeach

	<!--按钮-->
	<div style="float:right;">
		{!! $replies->links(('layouts.pagination')) !!}
	</div>


	<div style="float:left;width:100%;padding:0px;" id="hfgg">
	    @if(Auth::check() && Auth::user())
	        <div id="plArticle">
	        	<div style="color:#999999">
	        		上传的图片不能大于2M
	        	</div>
	            <div>
	                <form id="form" class="form-horizontal" action="{{ action('NoticeController@storeReply') }}" method="post">
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
<script type="text/javascript">
$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
var E = window.wangEditor
var editor = new E('#detail')

//配置菜单选项
editor.customConfig.menus = [
    'bold',  // 粗体
    'fontSize',  // 字号
    'italic',  // 斜体
    'strikeThrough',  // 删除线
    'foreColor',  // 文字颜色
    // 'backColor',  // 背景颜色
    'link',  // 插入链接
    'list',  // 列表
    'justify',  // 对齐方式
    // 'quote',  // 引用
    'emoticon',  // 表情
    'image',  // 插入图片
    // 'video',  // 插入视频
    'undo',  // 撤销
    'redo'  // 重复
]


var $text1 = $('#text1')
editor.customConfig.onchange = function (html) {

   $text1.val(html)
}
// 配置服务器端地址
editor.customConfig.uploadImgHeaders = {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
}

editor.customConfig.uploadFileName = 'file[]'

editor.customConfig.uploadImgServer = '/publish/uploadpic'

editor.customConfig.uploadImgHooks = {
    before: function (xhr, editor, files) {
        // 图片上传之前触发
        // xhr 是 XMLHttpRequst 对象，editor 是编辑器对象，files 是选择的图片文件

        // 如果返回的结果是 {prevent: true, msg: 'xxxx'} 则表示用户放弃上传
        // return {
        //     prevent: true,
        //     msg: '放弃上传'
        // }
    },
    success: function (xhr, editor, result) {
        // 图片上传并返回结果，图片插入成功之后触发
        // xhr 是 XMLHttpRequst 对象，editor 是编辑器对象，result 是服务器端返回的结果
    },
    fail: function (xhr, editor, result) {
        // 图片上传并返回结果，但图片插入错误时触发
        // xhr 是 XMLHttpRequst 对象，editor 是编辑器对象，result 是服务器端返回的结果
    },
    error: function (xhr, editor) {
        // 图片上传出错时触发
        // xhr 是 XMLHttpRequst 对象，editor 是编辑器对象
    },
    timeout: function (xhr, editor) {
        // 图片上传超时时触发
        // xhr 是 XMLHttpRequst 对象，editor 是编辑器对象
    },

    // 如果服务器端返回的不是 {errno:0, data: [...]} 这种格式，可使用该配置
    // （但是，服务器端返回的必须是一个 JSON 格式字符串！！！否则会报错）
    customInsert: function (insertImg, result, editor) {
        // 图片上传并返回结果，自定义插入图片的事件（而不是编辑器自动插入图片！！！）
        // insertImg 是插入图片的函数，editor 是编辑器对象，result 是服务器端返回的结果

        // 举例：假如上传图片成功后，服务器端返回的是 {url:'....'} 这种格式，即可这样插入图片：
        var url = result.data
        $(url).each(function( key, val){
            insertImg(val)
        })

        // result 必须是一个 JSON 格式字符串！！！否则报错
    }
}


editor.create()
// 初始化 textarea 的值
$text1.val(' ')

//判断用户点击几次,同时利用ajax进行上传，直接操作DOM让评论在页面中显示出来
$('#comment-commit').click(function(){

    var mydate = new Date();

    //获取到用户名
    var username = $('#username').attr('username');
    //获取到id
    var userid = $('#username').attr('userid');
    console.log($(this).attr('flag'));

    //判断用户是否连续点击的开关
    if($(this).attr('flag') == '0') {
        return false;
    }

    //把提交按钮的状态改为0 禁止再次提交
    $(this).attr('flag','0');

    //获取评论的内容
    var detail = $text1.val();
    //去除HTML标签方便判断
    var dd=detail.replace(/<\/?.+?>/g,"");
    var dds=dd.replace(/ /g,"");//dds为得到后的内容
    if(detail.length > 0 && dds.length != 0){
        if(detail.match(/^\s*$/)){
            layer.msg('不能提交空的评论或只提交图片');
            $('#comment-commit').attr('flag','1');
            $text1.val(' ');
            return false;
        }
    }else{
        layer.msg('不能提交空的评论或只提交图片');
        $('#comment-commit').attr('flag','1');
        $text1.val(' ');
        return false;
    }

    //获取文章的id
    var article_id = $('#article_id').val();

})

    $('.res').addClass('img-responsive');

$('#hftz').click(function(){

	if($(this).attr('flag') == null){
		layer.msg('请先登录');
		return false;
	}

	document.getElementById("hfgg").scrollIntoView();
})

</script>
@endsection
