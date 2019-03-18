$(function(){
	// console.log($('.oldzxcj'));
	for(var i=0;i<$('.oldzxcj').length;i++){
		// console.log($($('.oldzxcj')[i]).attr('oldtitle'));

		if($($('.oldzxcj')[i]).attr('oldtitle').length > 25){
			$($('.oldzxcj')[i]).html($($('.oldzxcj')[i]).attr('oldtitle').substr(0,25)+'...');
		}else{
			$($('.oldzxcj')[i]).html($($('.oldzxcj')[i]).attr('oldtitle'));
		}
	}

	// $('.shutter').shutter({
	// 	shutterH: 400, // 容器高度
	// 	isAutoPlay: true, // 是否自动播放
	// 	playInterval: 3000, // 自动播放时间
	// 	curDisplay: 0, // 当前显示页
	// 	fullPage: false // 是否全屏展示
	// });
	// 参数1 tableID,参数2 div高度，参数3 速度，参数4 tbody中tr几条以上滚动
	tableScroll('tableId', 400, 30, 10)
	var MyMarhq;

	function tableScroll(tableid, hei, speed, len) {
	clearTimeout(MyMarhq);
	$('#' + tableid).parent().find('.tableid_').remove()
	$('#' + tableid).parent().prepend(
	    '<table class="tableid_"><thead>' + $('#' + tableid + ' thead').html() + '</thead></table>'
	).css({
	    'position': 'relative',
	    'overflow': 'hidden',
	    'height': hei + 'px'
	})
	$(".tableid_").find('th').each(function(i) {
	    $(this).css('width', $('#' + tableid).find('th:eq(' + i + ')').width());
	});
	$(".tableid_").css({
	    'position': 'absolute',
	    'top': 0,
	    'left': 0,
	    'z-index': 9
	})
	$('#' + tableid).css({
	    'position': 'absolute',
	    'top': 0,
	    'left': 0,
	    'z-index': 1
	})

	if ($('#' + tableid).find('tbody tr').length > len) {
	    $('#' + tableid).find('tbody').html($('#' + tableid).find('tbody').html() + $('#' + tableid).find('tbody').html());
	    $(".tableid_").css('top', 0);
	    $('#' + tableid).css('top', 0);
	    var tblTop = 0;
	    var outerHeight = $('#' + tableid).find('tbody').find("tr").outerHeight();

	    function Marqueehq() {
	        if (tblTop <= -outerHeight * $('#' + tableid).find('tbody').find("tr").length / 2) {
	            tblTop = 0;
	        } else {
	            tblTop -= 1;
	        }
	        $('#' + tableid).css('margin-top', tblTop + 'px');
	        clearTimeout(MyMarhq);
	        MyMarhq = setTimeout(function() {
	            Marqueehq()
	        }, speed);
	    }

	    MyMarhq = setTimeout(Marqueehq, speed);
	    $('#' + tableid).find('tbody').hover(function() {
	        clearTimeout(MyMarhq);
	    }, function() {
	        clearTimeout(MyMarhq);
	        if ($('#' + tableid).find('tbody tr').length > len) {
	            MyMarhq = setTimeout(Marqueehq, speed);
	        }
	    })
	}

	}
	
	$('#jx1').mouseover(function(){
		$(this).css({
		  'border-bottom':'2px solid #966f3c',
		  'transition':'all 0.3s',
		});
		$('#jx2').css({
		  'border-bottom':'2px solid #CCC',
		  'transition':'all 0.3s',
		});

		$('#content2').css({
		  'display':'none',
		});
		$('#content1').css({
		  'display':'block',
		})
	});

	$('#jx2').mouseover(function(){
		$(this).css({
		  'border-bottom':'2px solid #966f3c',
		  'transition':'all 0.3s',
		});
		$('#jx1').css({
		  'border-bottom':'2px solid #CCC',
		  'transition':'all 0.3s',
		});
		$('#content1').css({
		  'display':'none',
		});
		$('#content2').css({
		  'display':'block',
		})
	});

	// HTML:
	// <h1 id="anchor">Lorem Ipsum</h1>
	// <p><a href="#anchor" class="topLink">Back to Top</a></p>
	$(document).ready(function() {
	  
	  $("a.topLink").click(function() {
	    
	    $("html, body").animate({
	      scrollTop: $($(this).attr("href")).offset().top + "px"
	    }, {
	      duration: 500,
	      easing: "swing"
	    });

	    return false;

	  });

	});


	//左侧鼠标移入移除事件
	$('.left_nav_d').mouseover(function(){
		$(this).css({
			'box-shadow':'0px 8px 15px #bccccc',
			'transition':'all 0.3s',
			// 'background-color':'#e2d6d6',
			'color':'#907044',
			'font-weight':'bold',
		})
	}).mouseout(function(){
		if($(this).attr('flag') == '0'){
			$(this).css({
				'box-shadow':'0px 0px 5px #CCC',
				'transition':'all 0.3s',
				'color':'#6E6E6E',
			});
		}
	});

	//左侧点击事件
	$('.left_nav_d').click(function(){
		//flag 判断是否点击过
		$(this).attr('flag','1');
		$(this).siblings().attr('flag','0')
		dhCss($(this) ,$(this).siblings());
	
	});


	$(".left_nav_d").click(function() {
			var _this = $(this).attr('pd');
			$('html,body').animate({scrollTop:$('#'+_this).offset().top - 55},500)
	 });

	var arr = [];
	for(var i = 0; i < $('.box_n').length; i++){
		arr[i] = $('.box_n').eq(i).offset().top;
	}

	$(window).scroll(function(){
		if($('#left_nav').offset().top > $('.box_n').eq(0).offset().top-50){
			$('#left_nav').css({
				'height':'auto',
				'opacity':'1',
				'transition':'0.3s',
			})
		}else{
			$('#left_nav').css({
				'height':'0px',
				'opacity':'0',
				'overflow':'hidden',
				'transition':'0.3s',
			})
		}

		for(var n = 0;n < arr.length ; n++){
			if( $('#left_nav').offset().top > arr[n]-100 ){
				dhCss($('.box_i').eq(n) ,$('.box_i').eq(n).siblings());
			}
		}
	});

	function dhCss(a1,a2){
		a1.css({
			'box-shadow':'0px 8px 15px #bccccc',
			'transition':'all 0.3s',
			// 'background-color':'#e2d6d6',
			'color':'#907044',
			'font-weight':'bold',
		});

		a2.css({
			'box-shadow':'0px 0px 5px #CCC',
			'transition':'all 0.3s',
			'color':'#6E6E6E',

		})
	}


})