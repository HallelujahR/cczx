var flag = true;
$('#more').click(function(){
	event.stopPropagation();

	if($(this).attr('flag') == '1'){
		$(this).css({
			'transform':'rotate(90deg)',
			'transition':'all 0.3s',
		});
		$('#more-menu').css({
			'height':'200px',
			// 'height':'160px',
			'transition':'all 0.3s',
			'opacity':'1',
		})
		$(this).attr('flag','2');
	}else{
		$(this).css({
			'transform':'rotate(0deg)',
			'transition':'all 0.3s',
		});
		$('#more-menu').css({
			'height':'0px',
			'transition':'all 0.3s',
			'opacity':'0',
		})
		$(this).attr('flag','1');
	}
	$('#notification-list').css({
			'opacity':'0',
			'overflow':'hidden',
			'height':'0px',
			'transition':'all 0.3s',
	})

	flag = !flag;	

});

$(document).click(function(){
	$('#more-menu').css({
		'height':'0px',
		'transition':'all 0.3s',
		'opacity':'0',
	});
	$('#more').css({
		'transform':'rotate(0deg)',
		'transition':'all 0.3s',
	});

	$('#notification-list').css({
			'opacity':'0',
			'overflow':'hidden',
			'height':'0px',
			'transition':'all 0.3s',
	});

	$('#more').attr('flag','1');
	flag = true;
})

$('#more-menu').click(function(){
	event.stopPropagation();
})
$('#more2').click(()=>{
	event.stopPropagation();
})


$(function(){
	var jl = null;
	$(window).scroll(function(){	
		jl = $('#nav').offset().top-$(window).scrollTop();
		
		if($('#nav').offset().top-$(window).scrollTop() < 0){
			$('#nav').css({
				'position':'fixed',
				'top':'0px',
				'transition':'all 1s',
				'z-index':'99999',				
			})
			$('.shutter').css({
				'margin-top':'50px',
			})

			$('#head').css({
				'margin-bottom':'60px',
			})
		}

		if($('#head').offset().top-$(window).scrollTop() > -90){

			$('#nav').css({
				'position':'static',
				'top':'none',
				'transition':'all 1s',
				'margin-bottom':'10px',
			});
			$('#nav').next().css({
				'margin-top':'0px',
			})
			$('.shutter').css({
				'margin-top':'-15px',
			});
			$('#head').css({
				'margin-bottom':'0px',
			})

		};

	})
})

$('#more2').click(() => {
	
	if(flag){
		$('#notification-list').css({
			'opacity':'1',
			
			'height':'420px',
			'transition':'all 0.3s',
		})

		flag = !flag;
	}else{
		$('#notification-list').css({
			'opacity':'0',
			'overflow':'hidden',
			'height':'0px',
			'transition':'all 0.3s',
		})

		flag = !flag;		
	}

	$('#more').css({
		'transform':'rotate(0deg)',
		'transition':'all 0.3s',
	});
	$('#more-menu').css({
		'height':'0px',
		'transition':'all 0.3s',
		'opacity':'0',
	})
	$('#more').attr('flag','1');
	
});
$('#notification-list').click(()=>{event.stopPropagation();});

$('.close-img').click(function(){

	var user = parseInt($(this).attr('user'));
	var id = $(this).attr('nid');

	$.ajax({
		url:'/api/readone',
		data:{user:user,id:id},
		type:'get',
		success: (mes) => {

			$(this).parent().parent().css({
				'opacity':'0',
				'transition':'all 0.3s',
				'overflow':'hidden',
			})

			setTimeout(()=>{ $(this).parent().parent().remove();countNum(); },300)
		}
	})
})

function countNum(){
	if($('.notification-line').length > 0 && $('.notification-line').length < 99){
		$('#tz-num').text($('.notification-line').length)
	}else if($('.notification-line').length > 99){
		$('#tz-num').text('99+')
	}else if($('.notification-line').length <= 0){
		$('#tz-num').css('display','none');
	}
}

countNum();