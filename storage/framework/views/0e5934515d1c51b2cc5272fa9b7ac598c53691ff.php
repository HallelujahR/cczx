<?php $__env->startSection('content'); ?>
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>浏览<small>前台用户</small></h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <p class="text-muted font-13 m-b-30">
          展示前台用户的所有信息
        </p>
          <form class="" action="<?php echo e(action('Admin\HomeUserController@index')); ?>" method="get" style="float:right;">
              <input type="text" name="name" value="">
              <button type="submit" name="button" class="btn btn-sm btn-primary">搜索</button>
          </form>
        <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th>ID</th>
              <th>用户名</th>
              <th>状态[是否让用户登录]</th>
              <th>级别</th>
              <th>操作</th>
            </tr>
          </thead>
          <tbody>
            <?php $__currentLoopData = $homeUsers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $homeUser): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($homeUser->id); ?></td>
                    <td><?php echo e($homeUser->name); ?></td>
                    <td>
                    	<input type="checkbox" class="js-switch" uid="<?php echo e($homeUser->id); ?>"  <?php if($homeUser->status == 1): ?> checked status="1" <?php else: ?> status='0' <?php endif; ?>/>
                    </td>
                    <td>
                        <select class="form-control selectRole" name="selectRole">
                            <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($role->id); ?>" <?php if($homeUser->role_id == $role->id): ?> selected <?php endif; ?> ><?php echo e($role->role); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </td>
                    <td style="width:30%;">
                        <a href="javascript:void(0)" class="btn btn-warning btn-xs userinfo" data-toggle="modal" data-target=".bs-example-modal-lg" username="<?php echo e($homeUser->name); ?>" xingbie="<?php echo e($homeUser->detail->sex); ?>" dianhua="<?php echo e($homeUser->detail->telephone); ?>" shengri="<?php echo e($homeUser->detail->birthday); ?>" email="<?php echo e($homeUser->detail->email); ?>" qq="<?php echo e($homeUser->detail->qq); ?>" vx="<?php echo e($homeUser->detail->vx); ?>" addresses="<?php echo e($homeUser->addresses); ?>"><i class="fa fa-file"></i> 用户信息 </a>

                         <?php if($homeUser->banks->count() > 0): ?>

                      <a href="javascript:void(0)" bank="<?php echo e($homeUser->banks); ?>" class="btn btn-info btn-xs banks"  data-toggle="modal" data-target=".bs-example-modal-lg-bank"><i class="glyphicon glyphicon-credit-card" style="margin-right:5px;"></i>查看银行 </a>

                        <?php else: ?>
                            暂无银行信息
                        <?php endif; ?>

                        <?php if($homeUser->articles->count() > 0): ?>
                      <a href="<?php echo e(action('Admin\HomeUserController@article',$homeUser->id)); ?>" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> 查看文章 </a>
                        <?php else: ?>
                            暂无文章
                        <?php endif; ?>

                        <?php if($homeUser->posts->count() > 0): ?>
                      <a href="<?php echo e(action('Admin\HomeUserController@post',$homeUser->id)); ?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i>查看帖子 </a>
                        <?php else: ?>
                            暂无帖子
                        <?php endif; ?>


                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </tbody>
        </table>
        <div style="float:right;margin-top:0px;">
            <?php echo e($homeUsers->appends(['name'=>$name])->links()); ?>

        </div>
      </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade bs-example-modal-lg-bank" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">用户银行卡信息</h4>
      </div>

        <table class="table table-hover" id="bank-detail">

        </table>
    </div>
  </div>
</div>


<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel_user">XXX用户信息</h4>
        </div>
        <div class="modal-body">
            <form id="user_info_message">
              <div class="form-group">
                <label for="sex" class="control-label">性别:</label>
                <span id="xingbie">男</span>
              </div>
              <div class="form-group">
                <label for="telephone" class="control-label">电话:</label>
                <input type="text" class="form-control" id="telephone" readonly>
              </div>
              <div class="form-group">
                <label for="shengri" class="control-label">生日:</label>
                <input type="text" class="form-control" id="shengri" readonly>
              </div>
              <div class="form-group">
                <label for="email" class="control-label">邮箱:</label>
                <input type="text" class="form-control" id="email" readonly>
              </div>
              <div class="form-group">
                <label for="qq" class="control-label">Q Q:</label>
                <input type="text" class="form-control" id="qq" readonly>
              </div>
              <div class="form-group">
                <label for="vx" class="control-label">微信:</label>
                <input type="text" class="form-control" id="vx" readonly>
              </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
        </div>
      </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>

<!-- Switchery -->
<script src="/admins/vendors/switchery/dist/switchery.min.js"></script>
<!-- 更改用户状态 -->
<script type="text/javascript">
  $(function(){
    $('.js-switch').change(function(){
      var uid = $(this).attr('uid');
      var status = $(this).attr('status');

      if(status == 0){
        $(this).attr('status','1');
        status = 1;
      }else{
        $(this).attr('status','0');
        status = 0;
      }

      $.ajax({
        type:'get',
        url:'homeuser/changeStatus',
        data:{
          uid:uid,
          status:status,
        },
        success:function(res){
          if(res == 0){
            layer.msg('已经禁用');
          }else{
            layer.msg('已经启用');
          }
        }
      })
    })

    $('.selectRole').change(function(){
        var uid = parseInt($(this).parents('tr').children(':first').html());
        var role_id = $(this).val();

        $.ajax({
            type:'get',
            url:'homeuser/changeRole',
            data:{id:uid,role_id:role_id},
            success:function(mes){
                if(mes == 1){
                    layer.msg('更改角色状态成功');
                }else{
                    layer.msg('更改角色状态失败');
                }
            }
        })
    });

    $('.userinfo').click(function(){

        $('#myModalLabel_user').html($(this).attr('username')+'的信息');

        if($(this).attr('xingbie') == "0"){
            $('#xingbie').html('女');
        }else{
            $('#xingbie').html('男');
        }

        $('#telephone').val($(this).attr('dianhua'));

        $('#shengri').val($(this).attr('shengri'));

        $('#email').val($(this).attr('email'));

        $('#qq').val($(this).attr('qq'));

        $('#vx').val($(this).attr('vx'));

        const addresses = JSON.parse($(this).attr('addresses'));
        $('.clearAddress').remove();
        for(var i=0;i<addresses.length;i++){
            $('#user_info_message').append(`
                <div class="form-group clearAddress">
                  <label for="address" class="control-label">地址`+(i+1)+`:</label>
                  <input type="text" class="form-control" value="`+addresses[i]['province']+addresses[i]['city']+addresses[i]['county']+addresses[i]['street']+`" readonly>
                </div>
                `);
        }
    });

    $('.banks').click( function() {

      var bank = JSON.parse($(this).attr('bank'));
      var str = '<table class="table table-hover" id="bank-detail"><tr><th>开户银行</th><th>银行卡号</th><th>开户人</th><th>联系电话</th><tr>';

      for(var i =0;i<bank.length;i++){
        str += "<tr><td>"+bank[i]['cateBank']+"</td><td>"+bank[i]['bankId']+"</td><td>"+bank[i]['bankName']+"</td><td>"+bank[i]['tel']+"</td></tr>";
      }

      str += '</table>';


      $('#bank-detail').replaceWith(str);

    })
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>