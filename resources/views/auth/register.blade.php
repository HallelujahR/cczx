<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

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

                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">用户名</label>
                            <div class="col-md-6">
                                <input id="name" maxlength="10" type="text" class="inputre form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">手机号</label>

                            <div class="col-md-6">
                                <input id="email" type="phone" class="inputre form-control" name="phone" value="{{ old('phone') }}" required>

                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">密码</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="inputre form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">确认密码</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="inputre form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary" id="register_btn">
                                    注册
                                </button>
                                <a href="/login" id="have_pass">已经有账号？立即登陆</a>
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
</html>
