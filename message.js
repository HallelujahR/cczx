var http = require('http').Server();

var Redis = require('ioredis');

var io = require('socket.io')(http);

var redis = new Redis();

//监听频道
redis.subscribe('message');

//只要订阅频道有新数据发布就触发
redis.on('message',function(channel,data){
	var data1 = JSON.parse(data);
	io.emit(channel+':'+data1.event,data1.data);
});

http.listen('3000',function(){
	console.log('Server Start');
});