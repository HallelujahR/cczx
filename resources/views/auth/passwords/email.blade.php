<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>传承网</title>
  <link rel="stylesheet" href="/home/css/register-login/css/bootstrap.min.css">
  <link rel="stylesheet" href="/home/css/register-login/css/demo.css" />
  <link rel="stylesheet" href="/home/css/register-login/css/templatemo-style.css">
  <link rel="stylesheet" type="text/css" href="/home/css/register-login/css/newcss.css" />

  <script type="text/javascript" src="/home/css/register-login/js/modernizr.custom.86080.js"></script>

    </head>

    <body>

            <div id="particles-js"></div>
            <img src="/home/images/logo1.png" style="width:200px;">
            <ul class="cb-slideshow">
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
            </ul>

            <div class="container-fluid">
                <div class="row cb-slideshow-text-container ">
                    <div class= "tm-content col-xl-6 col-sm-8 col-xs-8 ml-auto section">
                    <header class="mb-5"><h1>传承网</h1></header>
                    <P class="mb-5">收藏品专业资讯平台就来传承网</P>
                    <form class="form-horizontal" method="POST" action="/personal/foundPwd">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="phonenum" class="col-md-4 control-label">手机号码</label>

                            <div class="col-md-6">
                                <input id="phone" type="phone" class="form-control" name="phone" value="" required autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">验证码</label>

                            <div class="col-md-6">

                                <input id="yzm" type="text" class="form-control" name="yzm" required autofocus style="width:50%;float:left">

                                <button class="btn btn-primary" id="fsyzm" style="width:35%;float:left;margin-left:10px;" >发送验证码</button>
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="pwd" class="col-md-4 control-label">新密码</label>
                            <div class="col-md-6">
                                <input id="pwd" type="password" class="form-control" name="pwd" value="" required autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="confirm_pwd" class="col-md-4 control-label">确认新密码
                                <span id="cpwd" style="display:none;font-size: 13px;color:red;font-weight:bold">两次密码不一致</span>
                            </label>

                            <div class="col-md-6">
                                <input id="confirm_pwd" type="password" class="form-control" name="confirm_pwd" value="" required autofocus>

                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary" id="register_btn">
                                    修改密码
                                </button>
                                <a href="/login">立即登陆</a>
                            </div>
                        </div>
                    </form>

                    <div class="tm-social-icons-container text-xs-center">
                        <a href="#" class="tm-social-link"><i class="fa fa-facebook"></i></a>
                        <a href="#" class="tm-social-link"><i class="fa fa-google-plus"></i></a>
                        <a href="#" class="tm-social-link"><i class="fa fa-twitter"></i></a>
                        <a href="#" class="tm-social-link"><i class="fa fa-linkedin"></i></a>
                    </div>

                    </div>
                </div>
            </div>
    </body>

    <script type="text/javascript" src="/home/css/register-login/js/particles.js"></script>
    <script type="text/javascript" src="/home/css/register-login/js/app.js"></script>
    <script type="text/javascript" src="/home/js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="/layer/layer.js"></script>
    <script type="text/javascript">
        //ajax发送验证码
        $('#fsyzm').click(function(){
            $('#fsyzm').attr('disabled','readonly');
            // 获取到电话号
            var phone = $('#phone').val();
            if(!(/^1[34578]\d{9}$/.test(phone))){
                layer.msg("手机号码有误，请重填");
                return false;
            }

            $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            $.ajax({
                type:'post',
                url:'/personal/findPwd',
                data:{
                    phone:phone,
                },
                success:function(res){
                    //禁用按钮
                      $('#fsyzm').attr('disabled','readonly');
                      //倒计时
                        var num = 60;
                        //倒计时定时器
                        var time = setInterval(function(){

                            if(num != 0 ){
                                $('#fsyzm').text('重新发送'+num)
                                num--
                            }else{
                                $('#fsyzm').removeAttr('disabled')
                                num = 60;
                                $('#fsyzm').text('发送验证码');
                                clearInterval(time);
                            }

                        },1000);
                    return false;
                }
            })
        });

        $('#confirm_pwd').on('input' ,function(){
            if($('#pwd').val() != $(this).val() ){
                $('#cpwd').css({
                    'display':'block',
                })
                $('#register_btn').attr('disabled','readonly');
            }else{
                $('#cpwd').css({
                    'display':'none',
                })
                $('#register_btn').removeAttr('disabled');

            }
        })
    </script>
</html>
