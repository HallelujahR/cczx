@extends('layouts.admin')

@section('content')
<div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>修改密码 <small>后台用户</small></h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">

            <form action="http://www.cczx.com/admin/adminuser/cgPwd" method="POST" class="form-horizontal form-label-left" novalidate="">
              {{ csrf_field() }}
              <div class="item form-group">
                <label for="password" class="control-label col-md-3">新密码</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input id="password" type="password" name="password" placeholder="请输入密码" data-validate-length="1,2,3,4,5" class="form-control col-md-7 col-xs-12" required="required">
                </div>
              </div>
              <div class="item form-group">
                <label for="password2" id="confirm_pwd" class="control-label col-md-3 col-sm-3 col-xs-12">确认密码</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input id="password2" type="password" name="password2" placeholder="请确认密码" data-validate-linked="password" class="form-control col-md-7 col-xs-12" required="required">
                </div>
              </div>
              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-6 col-md-offset-3">
                  <!-- <button type="submit" class="btn btn-primary">Cancel</button> -->
                  <button id="send" type="submit" class="btn btn-success">修改密码</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
@endsection

@section('js')
    <script src="/admins/vendors/validator/validator.js"></script>

    <script type="text/javascript">

      $('#password').blur(function(){
        if($('#password2').val() != $(this).val()){
           $('#send').attr('disabled','readonly');
           $('#confirm_pwd').text('两次密码不一致');
           $('#confirm_pwd').css({
            'color':'red',
           })
         }else{
           $('#send').removeAttr('disabled');
          $('#confirm_pwd').text('确认密码');
           $('#confirm_pwd').css({
            'color':'#73879C',
           })
         }
      });

      $('#password2').on('input' ,function(){
          if($('#password').val() != $('#password2').val()){
            $('#send').attr('disabled','readonly');
            $('#confirm_pwd').text('两次密码不一致');
            $('#confirm_pwd').css({
             'color':'red',
            })
          }else{
            $('#send').removeAttr('disabled');
            $('#confirm_pwd').text('确认密码');
            $('#confirm_pwd').css({
             'color':'#73879C',
            })
          }
      })
    </script>
@endsection
