$(function(){
	$(window).scroll(function(){	
		if($('#detail_right').offset().top-$(window).scrollTop() < -700){
			$('#detail_right').css({
				'position':'fixed',
				'top':'80px',
				'right':'100px',
				'transition':'all 1s',
				'width':'300px',
			})
		}

		if($('#detail_con').offset().top-$(window).scrollTop() > 0){
			$('#detail_right').css({
				'position':'',
				'top':'',
				'transition':'all 1s',
				'right':'25%',

			});

		};
	})

	$('.right_title_xg').mouseover(function(){
		$(this).css({
			'cursor':'pointer',
			'color':'#009BF9',
			'border-bottom':'2px solid #009BF9',
			'transition':'all 0.3s',
		});
		$('.right_title_rm').css({
			'color':'#4A4A4A',
			'border-bottom':'2px solid #CCC',
			'transition':'all 0.3s',
		})
		$('.detail_right_content_xg').css({
			'display':'block',
		})
		$('.detail_right_content_rm').css({
			'display':'none',
		})
	})


	$('.right_title_rm').mouseover(function(){
		$(this).css({
			'cursor':'pointer',
			'color':'#009BF9',
			'border-bottom':'2px solid #009BF9',
			'transition':'all 0.3s',
		});

		$('.right_title_xg').css({
			'color':'#4A4A4A',
			'border-bottom':'2px solid #CCC',
			'transition':'all 0.3s',
		});

		$('.detail_right_content_rm').css({
			'display':'block',
		})
		$('.detail_right_content_xg').css({
			'display':'none',
		})
	})
});

