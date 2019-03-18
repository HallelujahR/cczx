$(document).ready(function(){
$(".top_ad_btn").click(function(){
	$(".top_ad_btn").toggle();
	$(".top_ad_img").toggle();
});
$(".toolbar_site,.toolbar_new,.toolbar_service,.toolbar_mobile,.toolbar_my,.toolbar_order").mouseenter(function(){
	$(this).addClass('toolbar_box_hover');
	$(this).children("div.toolbar_down_box").show();
});
$(".toolbar_site,.toolbar_new,.toolbar_service,.toolbar_mobile,.toolbar_my,.toolbar_order").mouseleave(function(){
	$(this).removeClass('toolbar_box_hover');
	$(this).children("div.toolbar_down_box").hide();
});
$(".toolbar_site,.toolbar_new,.toolbar_service,.toolbar_mobile_a,.toolbar_my,.toolbar_order").mouseenter(function(){
	$(this).addClass('toolbar_box_hover');
	$(this).children("div.toolbar_down_box_a").show();
});
$(".toolbar_site,.toolbar_new,.toolbar_service,.toolbar_mobile_a,.toolbar_my,.toolbar_order").mouseleave(function(){
	$(this).removeClass('toolbar_box_hover');
	$(this).children("div.toolbar_down_box_a").hide();
});
$(".toolbar_site em,.toolbar_mobile em").click(function(){
	$(this).parent().parent().removeClass('toolbar_box_hover');
	$(this).parent().hide();
});

	
	$(".nav_center a").mouseover(function(){
		var index = $(this).index();
		$('.nav_center a').removeClass('cur');
		$(this).addClass('cur');
		$('.nav_con ul').hide();
		$('.nav_con ul:eq('+index+')').show();
	});
	$(".nav_con ul").mouseover(function(){
		var index = $(this).index();
		$('.nav_center a').removeClass('cur');
		$('.nav_center a:eq('+index+')').addClass('cur');
	});
	
	$(".tupian_nav0 li").mouseover(function(){
		var index = $(this).index();
		$('.tupian_nav li').hide();
		$('.tupian_nav li:eq('+index+')').show();
	});
	
$(".con_third_l_nav a").mouseover(function(){
		$(this).addClass('on').siblings().removeClass('on');
		var index = $(this).index();
		$('.con_third_l_tabContent ul').hide();
		$('.con_third_l_tabContent ul:eq('+index+')').show();
});

$(".con_third_r_nav a").mouseover(function(){
		$(this).addClass('on').siblings().removeClass('on');
		var index = $(this).index();
		$('.con_third_r_con ul').hide();
		$('.con_third_r_con ul:eq('+index+')').show();
});
$(".con_four_r_nav a").mouseover(function(){
		$(this).addClass('on').siblings().removeClass('on');
		var index = $(this).index();
		$('.con_four_r_con ul').hide();
		$('.con_four_r_con ul:eq('+index+')').show();
});
$(".con_seven_con_r_nav a").mouseover(function(){
		$(this).addClass('on').siblings().removeClass('on');
		var index = $(this).index();
		$('.con_seven_con_r_con ol').hide();
		$('.con_seven_con_r_con ol:eq('+index+')').show();
});
$(".con_seven_nav a").mouseover(function(){
		$(this).addClass('on').siblings().removeClass('on');
		var index = $(this).index();
		$('.con_seven_con_l ul').hide();
		$('.con_seven_con_l ul:eq('+index+')').show();
});
$(".news_f3_fr_nav li").mouseover(function(){
		$(this).addClass('on').siblings().removeClass('on');
		var index = $(this).index();
		$('.news_f3_fr_con ol').hide();
		$('.news_f3_fr_con ol:eq('+index+')').show();
});
$(".news_f4_fr_nav li").mouseover(function(){
		$(this).addClass('on').siblings().removeClass('on');
		var index = $(this).index();
		$('.news_f4_fr_con ol').hide();
		$('.news_f4_fr_con ol:eq('+index+')').show();
});
$(".float_l em").click(function(){
	$(".float_l").hide();
});

$("img.lazy").lazyload({
    effect : "fadeIn"
});

$('.alert').click(function(){
    $(this).fadeOut(1000);
});

//判断用户是否登录
if($('#index_sx_message').attr('login') == "true"){

	var socket = io('127.0.0.1:3000');

	socket.on('message:'+$('#index_sx_message').attr('phone'),function(msg){
		
		//消息通知
		Lobibox.notify('info', {
		    title:"私信消息：<a href='/message/check/"+msg.id+"'>点击查看</a>",
		    img: msg.avatar,
		    msg: msg.name+'给您发了一条私信'
		});

		if($('#user').attr('userid') == msg.toid && msg.id == $('#user').attr('toid') ){
            //接收到消息
            let content = msg.body;
            let name = msg.name;
            let id = msg.id;
            let avatar = msg.avatar;
            let time = msg.date;

            $('#dialogue').prepend(` <div class="dialogue-line">
                   <div class="dialogue-line-head">
                       <a href="">
                           <img src="`+avatar+`" width="60px;" style="border-radius:30px;" alt="">
                       </a>
                       <a href="/personal/`+id+`">`+name+`</a>
                       </span>
                   </div>

                   <div class="dialogue-line-body">
                       `+content+`
                   </div>

                   <div class="dialogue-line-foot">
                       <span class="dialogue-time">`+time+`</span>
                   </div>
               </div>`);
		}

	});
}


});

// 返回顶部特效
$('#backtopimg').click(function(){
	$('html , body').animate({scrollTop: 0},'slow')
})
