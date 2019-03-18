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
			<a href="/article/{{$data['data']['article_id']}}.html" target="blank">{{$data['data']['article']}}</a>
		</span>

		<span id="time">{{$data['nf']->created_at}}</span>
	</div>
	<div id="detail">
		{!! $data['content']['comment'] !!}
	</div>
</body>
</html>