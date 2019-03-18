$('.left-none').remove();
var userid =  $('#personal_con').attr('userid');
$('#personal_left_new').append(` 
		<div class="new_title">
            消息中心
        </div>
        <div class="new_section" ><a href="/news/index/`+userid+`" class="news_t">全部消息</a></div>
        <div class="new_section" ><a href="/news/notRead/`+userid+`" class="news_t">未读消息</a></div>
        <div class="new_section" ><a href="/news/isRead/`+userid+`" class="news_t">已读消息</a></div>
`);

$('#personal_left_detail').css({
	'width':'55px',
})
$('#personal_left_detail').mouseover(function() {

	$(this).css({
		'width':'240px',
		'transition':'all 0.4s',
		'background-color':'#646a6a',
	})
	$('#personal_left_new').css({
		// 'opacity':'0',
		'transition':'all 0.1s',
	})
	$('.personal_left_photo').css({
		'opacity':'1',
		'transition':'all 0.1s',
	})
}).mouseout(function(){
	$(this).css({
		'width':'53px',
		'transition':'all 0.4s',
	})
	$('#personal_left_new').css({
		'opacity':'1',
		'transition':'all 0.1s',
	})
	$('.personal_left_photo').css({
		'opacity':'0',
		'transition':'all 0.1s',
	})
})

layui.use('element', function(){
  var $ = layui.jquery
  ,element = layui.element; //Tab的切换功能，切换事件监听等，需要依赖element模块
  
  //Hash地址的定位
  var layid = location.hash.replace(/^#news=/, '');

  element.tabChange('news', layid);
  
  element.on('tab(news)', function(elem){
    location.hash = 'news='+ $(this).attr('lay-id');
    selectLay($(this).attr('lay-id'));
  });

  if(layid == ''){
  	layid = '11';
  }
  selectLay(layid);
});

var rotate = 0;
var img = null;

//调用加载图片 参数为 第几个图片 
function time(num){
	 $('.tab-div-img').css({'display':'block'});

	 $('#rw-table'+num+'').css({'display':'none'})
	 img = setInterval(() => {
		rotate += 1;
		$('.tab-img:eq('+num+')').css({
			'transform':'rotate('+rotate+'deg)',
		});

		if(rotate == 360) rotate = 0;
	},1);
}

//停用图片加载 参数为第几个图片
function clearTime(num) {
	clearInterval(img);
	$('.tab-div-img:eq('+num+')').css({'display':'none'});
	$('#rw-table'+num+'').css({'display':'block'});
}



function sendAjax(url,bigType,smallType,whichTable){

	var table = new createTable(url,bigType,smallType,whichTable);
	switch(smallType)
	{
    	case 'all':
	      time(0);
	    break;
	    case 'post':
	      time(1);
	    break;
	    case 'article':
	      time(2);
	    break;
        case 'follow':
          time(3);
        break;
        case 'deal':
            time(4);
            break;
	  }
}

function selectLay (layid) {
	
	var type = $('#personal_con').attr('newsType');

	//判断是哪个网页
	switch(type)
	{
		case 'all':
			var bigType = 'all';
			$('.news_t:eq(0)').css({
				'background-color':'#CCC',
			})
		break;
		case 'isRead':
			var bigType = 'read';
			$('.news_t:eq(2)').css({
				'background-color':'#CCC',
			})
		break;
		case 'notRead':
			var bigType = 'unread';
			$('.news_t:eq(1)').css({
				'background-color':'#CCC',
			})
		break;
	}

	//判断是哪个tab
	switch(layid)
	{
		case '11':
			// alert(1);
			sendAjax('/news/getNews',bigType,'all','rw-table1')
		break;
		case '22':
			// alert(2);
			sendAjax('/news/getNews',bigType,'replyPost','rw-table2')
		break;
		case '33':
			// alert(1);
			sendAjax('/news/getNews',bigType,'commentArticle','rw-table3')
		break;
        case '44':
            // alert(1);
            sendAjax('/news/getNews',bigType,'follow','rw-table4')
        break;
        case '55':
            // alert(1);
            sendAjax('/news/getNews',bigType,'deal','rw-table5')
            break;
	}
}
