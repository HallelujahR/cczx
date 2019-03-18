<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" href="/home/css/news/only.css">
</head>
<body>
	<div id="title">
		消息详情
	</div>
	<div id="body">
		<span>
			<a href="/personal/{{$data['data']['id']}}" target="blank">{{$data['data']['name']}}</a>
			{{$data['data']['title']}}
			<a href="/bbs/post/{{$data['data']['post_id']}}.html" target="blank">{{$data['data']['post']}}</a>
		</span>

		<span id="time">{{$data['nf']->created_at}}</a></span>
	</div>
	<div id="detail">
		{!! $data['content']['reply'] !!}
	</div>
</body>
</html>