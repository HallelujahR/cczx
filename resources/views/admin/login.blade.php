<!Doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name', 'Laravel') }}后台登录</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ asset('x-admin/css/font.css') }}">
    <link rel="stylesheet" href="{{ asset('x-admin/css/xadmin.css') }}">
</head>
<body class="login-bg">
    
    <div class="login layui-anim layui-anim-up">
        <div class="message">{{ config('app.name', 'Laravel') }}后台登录</div>
        <div id="darkbannerwrap"></div>
        
        <form method="POST" class="layui-form" action="{{ url('/admin/login') }}">
            {{ csrf_field() }}
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name" class="col-md-4 control-label">用户名：</label>

                <div class="col-md-6">
                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                    @if ($errors->has('name'))
                        <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                    @endif
                </div>
            </div>

            <hr class="hr15">
            
            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="col-md-4 control-label">密码：</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control" name="password" required>

                    @if ($errors->has('password'))
                        <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif
                </div>
            </div>

            <hr class="hr15">
            <input value="登录" lay-submit lay-filter="login" style="width:100%;" type="submit">
            <hr class="hr20" >
        </form>
    </div>

<!-- Scripts -->
<script type="text/javascript" src="{{ asset('x-admin/js/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('x-admin/lib/layui/layui.js') }}" charset="utf-8"></script>
<script type="text/javascript" src="{{ asset('x-admin/js/xadmin.js') }}"></script>

</body>
</html>