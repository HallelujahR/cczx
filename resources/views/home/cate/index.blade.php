@extends('layouts.home')

@section('title')
<title>{{ $cate->cate }}[传承网]</title>
@endsection

@section('css')
<!-- 文章分类页面样式 -->
<link rel="stylesheet" type="text/css" href="/home/css/cate.css">
@endsection

@section('content')

<!-- 主体内容 -->
<div id="cate_con">
	<!-- 左栏 -->
	<div id="cate_left">
		<!-- 如果是顶级分类显示子类 如果是子类显示相关分类 -->
		<div id="cate_left_cate">
			<span>
				<em></em>
				<span>相关分类</span>
			</span>
			@foreach($xgCates as $k=>$xgCate)
			<div>
				<span @if($k!=0) class="hui" @endif>{{ $k+1 }}</span>
				<div>
					<a href="{{ action('CateController@index',$xgCate->id) }}">{{ $xgCate->cate }}</a>
				</div>
			</div>
			@endforeach
		</div>
	</div>

	<!-- 右栏 -->
	<div id="cate_right">

		<!-- 导航部分 -->
		<div class="cate_dh">
			<span>您的当前位置:</span>
            <a href="/"> 传承资讯首页</a>
            <span>></span>
            <!-- 判断是顶级分类还是二级分类 -->
            @if($cate->pid == 0)
            <a href="{{ action('CateController@index',$cate->id) }}">{{ $cate->cate }}</a>
            <span>></span>
            @else
            <a href="{{ action('CateController@index',getCateName($cate->pid)->id)}}"> {{ getCateName($cate->pid)->cate }}</a>
            <span>></span>
            <a href="{{ action('CateController@index',$cate->id) }}">{{ $cate->cate }}</a>
            <span>></span>
            @endif

            <a id="fbwz" style="float:right;margin-right:0px" href="{{ action('PublishController@article',['id'=>$cate->id]) }}">发布文章</a>
		</div>

		<!-- 此分类下的文章 -->
		<div id="cate_right_con">
			<ul>
				@foreach($articles as $k=>$article)
				<li @if($k%2 == 1) class="two" @endif>
					<span>
						<a href="{{ action('ArticleController@index',$article->id) }}" target="_blank">{{ mb_substr($article->title,0,21,'utf-8') }}</a>
					</span>
					<label>
						<div></div>
						<span>{{ $article->user->name }}</span>
						<div></div>
						<span>{{ $article->access_count }} 阅读</span>
						<div></div>
						<span>{{ date('Y-m-d',$article->time) }}</span>
					</label>
				</li>
				@endforeach
			</ul>
		</div>
		<div style="float:right;">
			{!!$articles->links(('layouts.pagination'))!!}
		</div>
	</div>
</div>

@endsection

@section('js')
<script type="text/javascript">
    $('#cate_right_con > ul > li').mouseout(function(){
        $(this).css('transition',' all 0.5s');
    });
</script>
@endsection
