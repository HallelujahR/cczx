@extends('layouts.home')

@section('title')
<title>发布文章[传承网]</title>
@endsection

@section('css')
<!-- 修改文章样式 -->
<link rel="stylesheet" type="text/css" href="/home/css/article.css">
<!-- 修改文章表单验证样式 -->
<link href="/home/validator/bootstrapValidator.min.css" rel="stylesheet">
@endsection

@section('content')

<div id="article_con">

	<!-- 主体表单模块 -->
	<form id="form" class="form-horizontal" action="{{ action('PublishController@updateArticle') }}" method="post">
		<div class="order">
		   	<span class="line"></span>
		   	<span class="txt">编辑文章</span>
		   	<span class="line"></span>
		</div>
        {{ csrf_field() }}

        <input type="hidden" name="id" value="{{ $article->id }}">
		<div class="form-group">
			<label for="name" class="col-sm-2 control-label">文章标题：</label>
			<div class="col-sm-8">
				<input type="text" class="form-control" id="name" name="name" value="{{ $article->title }}">
			</div>
			<div class="col-sm-2 info">
				<span>(必填)</span>
				<div>文章名称</div>
			</div>
		</div>

		<div class="form-group">
			<label for="cate" class="col-sm-2 control-label">选择分类：</label>
			<div class="col-sm-8">
				<select class="form-control" name="cate">
					@foreach($cates as $cate)
					<option value="{{ $cate->id }}" @if($cate->id == $article->cate_id) selected @endif>{{ $cate->cate }}</option>
					@endforeach
				</select>
			</div>
			<div class="col-sm-2 info">
				<span>(必选)</span>
				<div>选择发布文章的分类</div>
			</div>
		</div>

		<div class="form-group">
			<label for="content" class="col-sm-2 control-label">文章内容：</label>
			<div class="col-sm-8" id='detail'>{!! $article->content->content !!}</div>
			<textarea id="text1" name='detail' style="width:100%; height:200px;display:none;"></textarea>
			<div class="col-sm-2 info">
				<span>（必填）</span>
				<div>文章内容</div>
			</div>
            @if ($errors->has('detail'))
                <span class="help-block">
                <strong>{{ $errors->first('detail') }}</strong>
            </span>
            @endif
		</div>


		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-8">
				<button id="qrtj" type="submit" class="btn btn-primary btn-block">确认提交</button>
			</div>
		</div>
	</form>
</div>

@endsection

@section('js')
<!-- Bootstrap 核心 JavaScript 文件 -->
<script src="/home/bootstrap/js/bootstrap.min.js"></script>
<!-- 验证 -->
<script src="/home/validator/bootstrapValidator.min.js"></script>

<script type="text/javascript" src='/wangEditor/wangEditor.min.js'></script>

<script type="text/javascript">
$(function () {
    $('form').bootstrapValidator({
		message: 'This value is not valid',
        feedbackIcons: {
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		},
        fields: {
            name: {
                message: '用户名验证失败',
                validators: {
                    notEmpty: {
                        message: '文章名称不能为空'
                    },
                    stringLength: {
                    	min: 5,
                    	max: 30,
                    	message: '文章名称长度要大于5位小于30位'
                    }
                }
            }
        }
    });

});

$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
var E = window.wangEditor
var editor = new E('#detail')
var $text1 = $('#text1')
editor.customConfig.onchange = function (html) {

   $text1.val(html)
}
// 配置服务器端地址
editor.customConfig.uploadImgHeaders = {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
}

editor.customConfig.uploadFileName = 'file[]'

editor.customConfig.uploadImgServer = '/admin/article/uploadpic'

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
    	console.log(result);
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
$text1.val(editor.txt.html())
</script>
@endsection
