$(function(){
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

    //判断用户点击几次,同时利用ajax进行上传，直接操作DOM让评论在页面中显示出来
    $('#comment-commit').click(function(){

        if($('#text1').val().length > 143){
            layer.msg('留言不能超过143个字');
            return false;
        }

    });

    $('.res').addClass('img-responsive');

    $('.gzuser').click(function(){
        var follow_id = $(this).attr('follow_id')

        //判断用户是否登录
        if($(this).attr('login') == 'true'){

            $.ajax({
                url:'/follow/'+follow_id,
                type:'get',
                success: (res) => {
                    if(res == 1){
                        qxgz(follow_id)

                        layer.msg('关注该用户成功')
                    }else{
                        gz(follow_id)

                        layer.msg('你已取消关注该用户')
                    }
                },
                error: (res) => {
                    layer.msg('请重新登录')
                }
            })

        }else{
            layer.msg('请先进行登录才能关注用户')
        }
    })

    function qxgz(id){
        $('.gzuser'+id).find('span:eq(0)').attr('class', 'glyphicon glyphicon-minus')
        $('.gzuser'+id).find('span:eq(1)').html('已关注')

        $('.gzuser'+id).hover(function(){
            $(this).css({'color' : '#ABB6C5'})
            $(this).find('span:eq(1)').html('取消关注')
        },function(){
            $(this).css({'color' : '#A66C33'})
            $(this).find('span:eq(1)').html('已关注')
        })
    }

    function gz(id){
        $('.gzuser'+id).find('span:eq(0)').attr('class', 'glyphicon glyphicon-plus')
        $('.gzuser'+id).find('span:eq(1)').html('关注他')
        $('.gzuser'+id).css('color','#A66C33')

        $('.gzuser'+id).hover(function(){
            $(this).css({'color' : '#A66C33'})
            $(this).find('span:eq(1)').html('关注他')
        },function(){
            $(this).css({'color' : '#A66C33'})
            $(this).find('span:eq(1)').html('关注他')
        })
    }

    for(var i=0;i<$('.gzuser').length;i++){
        if($('.gzuser:eq('+i+')').find('span:eq(1)').text() == '已关注'){
            $('.gzuser:eq('+i+')').hover(function(){
                $(this).css({'color' : '#ABB6C5'})
                $(this).find('span:eq(1)').html('取消关注')
            },function(){
                $(this).css({'color' : '#A66C33'})
                $(this).find('span:eq(1)').html('已关注')
            })
        }
    }
})