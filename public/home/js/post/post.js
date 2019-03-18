$(function(){
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    var E = window.wangEditor
    var editor = new E('#detail')

    //配置菜单选项
    editor.customConfig.menus = [
        'bold',  // 粗体
        'fontSize',  // 字号
        'italic',  // 斜体
        'strikeThrough',  // 删除线
        'foreColor',  // 文字颜色
        // 'backColor',  // 背景颜色
        'link',  // 插入链接
        'list',  // 列表
        'justify',  // 对齐方式
        // 'quote',  // 引用
        'emoticon',  // 表情
        'image',  // 插入图片
        // 'video',  // 插入视频
        'undo',  // 撤销
        'redo'  // 重复
    ]


    var $text1 = $('#text1')
    editor.customConfig.onchange = function (html) {

       $text1.val(html)
    }
    // 配置服务器端地址
    editor.customConfig.uploadImgHeaders = {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
    }

    editor.customConfig.uploadFileName = 'file[]'

    editor.customConfig.uploadImgServer = '/publish/uploadpic'

    editor.customConfig.uploadImgHooks = {
        before: function (xhr, editor, files) {
            // 图片上传之前触发
            // xhr 是 XMLHttpRequst 对象，editor 是编辑器对象，files 是选择的图片文件

            // 如果返回的结果是 {prevent: true, msg: 'xxxx'} 则表示用户放弃上传
            // return {
            //     prevent: true,
            //     msg: '放弃上传'
            // }
        },
        success: function (xhr, editor, result) {
            // 图片上传并返回结果，图片插入成功之后触发
            // xhr 是 XMLHttpRequst 对象，editor 是编辑器对象，result 是服务器端返回的结果
        },
        fail: function (xhr, editor, result) {
            // 图片上传并返回结果，但图片插入错误时触发
            // xhr 是 XMLHttpRequst 对象，editor 是编辑器对象，result 是服务器端返回的结果
        },
        error: function (xhr, editor) {
            // 图片上传出错时触发
            // xhr 是 XMLHttpRequst 对象，editor 是编辑器对象
        },
        timeout: function (xhr, editor) {
            // 图片上传超时时触发
            // xhr 是 XMLHttpRequst 对象，editor 是编辑器对象
        },

        // 如果服务器端返回的不是 {errno:0, data: [...]} 这种格式，可使用该配置
        // （但是，服务器端返回的必须是一个 JSON 格式字符串！！！否则会报错）
        customInsert: function (insertImg, result, editor) {
            // 图片上传并返回结果，自定义插入图片的事件（而不是编辑器自动插入图片！！！）
            // insertImg 是插入图片的函数，editor 是编辑器对象，result 是服务器端返回的结果

            // 举例：假如上传图片成功后，服务器端返回的是 {url:'....'} 这种格式，即可这样插入图片：
            var url = result.data
            $(url).each(function( key, val){
                insertImg(val)
            })

            // result 必须是一个 JSON 格式字符串！！！否则报错
        }
    }


    editor.create()
    // 初始化 textarea 的值
    $text1.val(' ')

    //判断用户点击几次,同时利用ajax进行上传，直接操作DOM让评论在页面中显示出来
    $('#comment-commit').click(function(){

        var mydate = new Date();

        //获取到用户名
        var username = $('#username').attr('username');
        //获取到id
        var userid = $('#username').attr('userid');
        console.log($(this).attr('flag'));

        //判断用户是否连续点击的开关
        if($(this).attr('flag') == '0') {
            return false;
        }

        //把提交按钮的状态改为0 禁止再次提交
        $(this).attr('flag','0');

        //获取评论的内容
        var detail = $text1.val();
        //去除HTML标签方便判断
        var dd=detail.replace(/<\/?.+?>/g,"");
        var dds=dd.replace(/ /g,"");//dds为得到后的内容
        if(detail.length > 0 && dds.length != 0){
            if(detail.match(/^\s*$/)){
                layer.msg('不能提交空的评论或只提交图片');
                $('#comment-commit').attr('flag','1');
                $text1.val(' ');
                return false;
            }
        }else{
            layer.msg('不能提交空的评论或只提交图片');
            $('#comment-commit').attr('flag','1');
            $text1.val(' ');
            return false;
        }

        //获取文章的id
        var article_id = $('#article_id').val();

    })

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