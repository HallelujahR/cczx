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
                    <form class="form-horizontal" method="POST" action="<?php echo e(route('login')); ?>">
                        <?php echo e(csrf_field()); ?>


                        <div class="form-group<?php echo e($errors->has('phone') ? ' has-error' : ''); ?>">
                            <label for="email" class="col-md-4 control-label">手机号码</label>

                            <div class="col-md-6">
                                <input id="email" type="phone" class="form-control" name="phone" value="<?php echo e(old('phone')); ?>" required autofocus>

                                <?php if($errors->has('phone')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('phone')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
                            <label for="password" class="col-md-4 control-label">密码</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                <?php if($errors->has('password')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

<!--                         <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>>记住密码
                                    </label>
                                </div>
                            </div>
                        </div>
 -->
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary" id="register_btn">
                                    登录
                                </button>

                                <a class="btn btn-link" href="<?php echo e(route('password.request')); ?>">
                                    忘记密码？
                                </a>

                                <a href="/register" id="have_pass">还没有账号？马上注册</a>
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
