$('.left-none').remove();
var userid =  $('#personal_con').attr('userid');
var countPersonal = JSON.parse($('#personal_con').attr('counts'));
var newstype = $('#personal_con').attr('newstype');
$('#personal_left_new').append(` 
		<div class="new_title">
            我的网上邮市
        </div>
        <div class="new_section" ><a href="/personal/waitdeal/`+userid+`" class="news_t">等待交易(<span style="color:red">`+countPersonal['waitDeal']+`</span>)</a></div>
        <div class="new_section" ><a href="/personal/nowdeal/`+userid+`" class="news_t">正在交易(<span style="color:red">`+countPersonal['nowDeal']+`</span>)</a></div>
        <div class="new_section" ><a href="/personal/waitingscore/`+userid+`" class="news_t">等待评分(<span style="color:red">`+countPersonal['waitScore']+`</span>)</a></div>
        <div class="new_section" ><a href="/personal/compoletedeal/`+userid+`" class="news_t">已完成交易</a></div>
        <div class="new_section" ><a href="/personal/myRevoke/`+userid+`" class="news_t">我的撤帖</a></div>
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

selectTab(newstype);

//判断是哪个网页
function selectTab(type){

	switch(type)
	{
		case 'wait':
			$('.news_t:eq(0)').css({
				'background-color':'#CCC',
			})
		break;
		case 'now':
			$('.news_t:eq(1)').css({
				'background-color':'#CCC',
			})
		break;
		case 'waitScore':
			$('.news_t:eq(2)').css({
				'background-color':'#ccc',
			})
		break;
		case 'complete':
			$('.news_t:eq(3)').css({
				'background-color':'#ccc',
			})
		break;
		case 'revoke':
			$('.news_t:eq(4)').css({
				'background-color':'#CCC',
			})
		break;
	}

}