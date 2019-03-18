$(function(){
	$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

	for(var i=0;i < $('.info_left_hover').length;i++){
	    if($($('.info_left_hover')[i]).prev().html() == ''){
	        $($('.info_left_hover')[i]).css('display','block');
	    }else{
	        $($('.info_left_hover')[i]).css('display','none');
	    }
	}

	$('.info_left_all').hover(function(){
	    $(this).children('.info_left_con').children('.info_left_hover').css('display','block');
	},function(){
	    if($(this).children('.info_left_con').children('span:eq(0)').html() != ''){
	        $(this).children('.info_left_con').children('.info_left_hover').css('display','none');
	    }
	});

	$('.info_left_hover').click(function(){
	    $(this).parent().css('display','none');
	    $(this).parent().prev().css('display','block');
	});

	$('.qx').click(function(){
	    $(this).parent().parent().css('display','none');
	    $(this).parent().parent().next().css('display','block');
	    return false;
	});

	$('#nicheng').click(function(){
		var nicheng = $(this).parent().prev().children('input').val();

		if(nicheng.length < 1 || /^\s*$/.test(nicheng)){
			layer.msg('昵称不能为空');
			return false;
		}

		if(nicheng.length > 10){
			layer.msg('昵称不能超过10个字符');
			return false;
		}

		$.ajax({
			url:"/personal/updateUser",
            type:'post',
            data:{name:'name',value:nicheng},
			success:function(mes){
				if(mes == 1){
					$(this).parent().parent().next().children('span:eq(0)').html($(this).parent().prev().children('input').val());
					$('#username').html($(this).parent().prev().children('input').val());
					$(this).next().trigger('click');
					layer.msg('修改昵称成功');
				}else{
					layer.msg('修改昵称失败');
				}
			}.bind(this)
		});

	});

	$('#birthday').click(function(){
		var birthday = $(this).parent().prev().children('input').val();

		if(/^\s*$/.test(birthday)){
			layer.msg('生日不能为空');
			return false;
		}

		$.ajax({
            url:"/personal/updateDetail",
            type:'post',
            data:{name:'birthday',value:birthday},
            success:function(mes){
                if(mes == 1){
                    $(this).parent().parent().next().children('span:eq(0)').html($(this).parent().prev().children('input').val());
                    $(this).next().trigger('click');
                    layer.msg('修改生日成功');
                }else{
                    layer.msg('修改生日失败');
                }
            }.bind(this)
        });

	});

	$('#youxiang').click(function(){
		var reg = new RegExp("^[a-z0-9]+([._\\-]*[a-z0-9])*@([a-z0-9]+[-a-z0-9]*[a-z0-9]+.){1,63}[a-z0-9]+$");
		var youxiang = $(this).parent().prev().children('input').val();

		if(/^\s*$/.test(youxiang)){
			layer.msg('邮箱不能为空');
			return false;
		}

		if(!reg.test(youxiang)){
			layer.msg('邮箱格式不符合');
			return false;
		}

		$.ajax({
            url:"/personal/updateDetail",
            type:'post',
            data:{name:'email',value:youxiang},
            success:function(mes){
                if(mes == 1){
                    $(this).parent().parent().next().children('span:eq(0)').html($(this).parent().prev().children('input').val());
                    $(this).next().trigger('click');
                    layer.msg('修改邮箱成功');
                }else{
                    layer.msg('修改邮箱失败');
                }
            }.bind(this)
        });

	});

	$('#qq').click(function(){
		var qq = $(this).parent().prev().children('input').val();

		if(/^\s*$/.test(qq)){
			layer.msg('QQ不能为空');
			return false;
		}

		if(!/^\d*$/.test(qq)){
			layer.msg('QQ格式不符合');
			return false;
		}

		$.ajax({
            url:"/personal/updateDetail",
            type:'post',
            data:{name:'qq',value:qq},
            success:function(mes){
                if(mes == 1){
                    $(this).parent().parent().next().children('span:eq(0)').html($(this).parent().prev().children('input').val());
                    $(this).next().trigger('click');
                    layer.msg('修改QQ成功');
                }else{
                    layer.msg('修改QQ失败');
                }
            }.bind(this)
        });

	});

	$('#vx').click(function(){
		var vx = $(this).parent().prev().children('input').val();

		if(/^\s*$/.test(vx)){
			layer.msg('微信不能为空');
			return false;
		}

		$.ajax({
            url:"/personal/updateDetail",
            type:'post',
            data:{name:'vx',value:vx},
            success:function(mes){
                if(mes == 1){
                    $(this).parent().parent().next().children('span:eq(0)').html($(this).parent().prev().children('input').val());
                    $(this).next().trigger('click');
                    layer.msg('修改微信成功');
                }else{
                    layer.msg('修改微信失败');
                }
            }.bind(this)
        });

	});

	$('#dianhua').click(function(){
		// var dianhua = $(this).parent().prev().children('input').val();

		// if(/^\s*$/.test(dianhua)){
		// 	layer.msg('电话号不能为空');
		// 	return false;
		// }

		// if(!/^\d*$/.test(dianhua)){
		// 	layer.msg('电话格式不符合');
		// 	return false;
		// }

		// $.ajax({
  //           url:"/personal/updateDetail",
  //           type:'post',
  //           data:{name:'telephone',value:dianhua},
  //           success:function(mes){
  //               if(mes == 1){
  //                   $(this).parent().parent().next().children('span:eq(0)').html($(this).parent().prev().children('input').val());
  //                   $(this).next().trigger('click');
  //                   layer.msg('修改电话成功');
  //               }else{
  //                   layer.msg('修改电话失败');
  //               }
  //           }.bind(this)
  //       });
  		layer.msg('电话号同注册账号相同不能修改');

	});

	$('#zfb').click(function(){
		var zfb = $(this).parent().prev().children('input').val();

		if(/^\s*$/.test(zfb)){
			layer.msg('支付宝不能为空');
			return false;
		}

		$.ajax({
            url:"/personal/updateDetail",
            type:'post',
            data:{name:'alipay',value:zfb},
            success:function(mes){
                if(mes == 1){
                    $(this).parent().parent().next().children('span:eq(0)').html($(this).parent().prev().children('input').val());
                    $(this).next().trigger('click');
                    layer.msg('修改支付宝成功');
                }else{
                    layer.msg('修改支付宝失败');
                }
            }.bind(this)
        });

	});
});
