<!Doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo e(config('app.name', 'Laravel')); ?>后台登录</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <link rel="stylesheet" href="<?php echo e(asset('x-admin/css/font.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('x-admin/css/xadmin.css')); ?>">
</head>
<body class="login-bg">
    
    <div class="login layui-anim layui-anim-up">
        <div class="message"><?php echo e(config('app.name', 'Laravel')); ?>后台登录</div>
        <div id="darkbannerwrap"></div>
        
        <form method="POST" class="layui-form" action="<?php echo e(url('/admin/login')); ?>">
            <?php echo e(csrf_field()); ?>

            <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
                <label for="name" class="col-md-4 control-label">用户名：</label>

                <div class="col-md-6">
                    <input id="name" type="text" class="form-control" name="name" value="<?php echo e(old('name')); ?>" required autofocus>

                    <?php if($errors->has('name')): ?>
                        <span class="help-block">
                        <strong><?php echo e($errors->first('name')); ?></strong>
                    </span>
                    <?php endif; ?>
                </div>
            </div>

            <hr class="hr15">
            
            <div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
                <label for="password" class="col-md-4 control-label">密码：</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control" name="password" required>

                    <?php if($errors->has('password')): ?>
                        <span class="help-block">
                        <strong><?php echo e($errors->first('password')); ?></strong>
                    </span>
                    <?php endif; ?>
                </div>
            </div>

            <hr class="hr15">
            <input value="登录" lay-submit lay-filter="login" style="width:100%;" type="submit">
            <hr class="hr20" >
        </form>
    </div>

<!-- Scripts -->
<script type="text/javascript" src="<?php echo e(asset('x-admin/js/jquery-3.2.1.min.js')); ?>"></script>
<script src="<?php echo e(asset('x-admin/lib/layui/layui.js')); ?>" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo e(asset('x-admin/js/xadmin.js')); ?>"></script>

</body>
</html>