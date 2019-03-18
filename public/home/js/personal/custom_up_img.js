$(document).ready(function(){
        $("#up-img-touch").click(function(){
                  $("#up-modal-frame").modal({});
        });
});

$(function() {
    'use strict';
    // 初始化
    var $image = $('#up-img-show');
    $image.cropper({
        aspectRatio: '1',
        autoCropArea:0.8,
        preview: '.up-pre-after',
        responsive:true,
    });

    // 上传图片
    var $inputImage = $('.up-modal-frame .up-img-file');
    var URL = window.URL || window.webkitURL;
    var blobURL;

    if (URL) {
        $inputImage.change(function () {

            var files = this.files;
            var file;

            if (files && files.length) {
               file = files[0];

               if (/^image\/\w+$/.test(file.type)) {
                    blobURL = URL.createObjectURL(file);
                    $image.one('built.cropper', function () {
                        // Revoke when load complete
                       URL.revokeObjectURL(blobURL);
                    }).cropper('reset').cropper('replace', blobURL);
                    $inputImage.val('');
                } else {
                    window.alert('请选择一张图片进行上传。');
                }
            }
        });
    } else {
        $inputImage.prop('disabled', true).parent().addClass('disabled');
    }

    //绑定上传事件
    $('.up-modal-frame .up-btn-ok').on('click',function(){
        var $modal_loading = $('#up-modal-loading');
        var $modal_alert = $('#up-modal-alert');
        var img_src=$image.attr("src");
        if(img_src==""){
            set_alert_info("没有选择上传的图片");
            $modal_alert.modal();
            return false;
        }

        $modal_loading.modal();

        var url=$(this).attr("url");
        //parameter
        var parameter=$(this).attr("parameter");
        //console.log(parameter);
        var parame_json = eval('(' + parameter + ')');
        var width=parame_json.width;
        var height=parame_json.height;
        // console.log(parame_json.width);
        // console.log(parame_json.height);

        //控制裁剪图片的大小
        var canvas=$image.cropper('getCroppedCanvas',{width: width,height: height});
        var data=canvas.toDataURL(); //转成base64

        $.ajax( {
                url:url,
                dataType:'json',
                type: "POST",
                data: {"avatar":data.toString()},
                success: function(data, textStatus){
                    $modal_loading.modal('close');
                    set_alert_info(data.result);
                    $modal_alert.modal();
                    if(data.result=="ok"){
                        $("#up-img-touch img").attr("src",data.file);
                        var img_name=data.file.split('/')[2];
                        //console.log(img_name);
                        $(".up-img-txt a").text(img_name);
                        $("#up-modal-frame").modal('close');
                    }
                },
                error: function(data){
                    $modal_loading.modal('close');
                    set_alert_info("上传文件失败了！");
                    $modal_alert.modal();
                    // console.log(data);
                }
         });

    });

    $('#up-btn-left').on('click',function(){
        $("#up-img-show").cropper('rotate', 90);
    });
    $('#up-btn-right').on('click',function(){
        $("#up-img-show").cropper('rotate', -90);
    });

    $('.up-img-cover').hover(function(){
		$('#hoverphoto').css({
			'width':'125px',
			'height':'100%',
			'background-color':'grey',
			'transition':'all 0.5s',
			'opacity':'0.6',
			'cursor':'pointer',
		});
	},function(){
		$('#hoverphoto').css({
			'width':'0px',
			'height':'0px',
			'transition':'all 0.5s',
		})
	});

	$('#cate_right_con > ul > li').mouseout(function(){
        $(this).css('transition',' all 0.5s');
    });
});


function set_alert_info(content){
    $("#alert_content").html(content);
}



$('.follow').click(function(){
    var follow_id = $(this).attr('follow_id')

    //判断用户是否登录
    if($(this).attr('login') == '1'){

        $.ajax({
            url:'/follow/'+follow_id,
            type:'get',
            success: function(res) {
                if(res == 1){
                    $(this).html("  <span class='glyphicon glyphicon-minus'></span>取消关注");
                    layer.msg('关注该用户成功')
                }else{

                    $(this).html("<span class='glyphicon glyphicon-plus'></span>关注他");
                    layer.msg('你已取消关注该用户')
                }
            }.bind(this),
            error: function(res) {
                layer.msg('请重新登录')
            }.bind(this)
        });

    }else{
        layer.msg('请先进行登录才能关注用户')
    }
});


function test(){
    
}