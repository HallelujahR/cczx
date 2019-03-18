@extends('errors::layout')

@section('title', '您所访问的页面未找到')

@section('message', '404~ 不好意思,您所访问的页面未找到,我们将为您跳转到上一个页面')

<script type="text/javascript">

	setTimeout(function(){
		location.href=history.go(-1);
	},5000)
</script>

