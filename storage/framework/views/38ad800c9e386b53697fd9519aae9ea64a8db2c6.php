<?php $__env->startSection('title'); ?>
<title><?php echo e($user->name); ?>的个人中心_详细信息[传承网]</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<!-- 个人中心样式 -->
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>"> 
<link rel="stylesheet" href="/layui/layui/css/layui.css"  media="all">
<link rel="stylesheet" href="/home/css/personal/amazeui.cropper.css">
<link rel="stylesheet" href="/home/css/personal/custom_up_img.css">
<link rel="stylesheet" type="text/css" href="/home/css/personal/personal.css">
<link rel="stylesheet" type="text/css" href="/home/css/personal/perfect.css">
<style>
.left_xk > a{
    font-size:16px;
}
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div style="padding:0px;" class="container-fluid">
    <div id="personal_con">
        <!-- 左栏 -->
        <?php echo $__env->make("layouts.personleft", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <!-- 右栏 -->
        <div id="personal_right">
            <ul id="perfect" class="perfect">
               <li class="active"><a href="#card" data-toggle="tab">实名认证</a></li>
               <li><a href="#bank" data-toggle="tab">银行管理</a></li>
               <!-- <li><a href="#address" data-toggle="tab">地址管理</a></li> -->
            </ul>
            <div id="myTabContent" class="tab-content">
               <div class="tab-pane fade in active" id="card">
                  <h2 style="text-align:center;margin-top:20px;">实名认证 <small>Authentication</small></h2>
                  <hr>
            <?php if($user->card->status == 0 || $user->card->status == 2): ?>
                <?php if($user->card->status == 2): ?>
                    <div style="text-align:center;font-size:18px;"><b style="color:red">审核失败原因：</b><span style="color:#00A4C5;"><?php echo e($user->card->info); ?></div>
                    <div style="text-align:center;font-size:18px;">请重新上传数据</div>
                    <hr>
                <?php endif; ?>
                  <div class="card_info"><b>温馨提示</b><span>个人实名信息必须真实有效。</span></div>
                  <div class="card_message"><span></span><b>填写本人信息</b></div>

                  <!-- 表单 -->
                  <form class="layui-form" action="<?php echo e(action('PerfectController@createCard')); ?>" method="post" style="margin-top:30px" enctype="multipart/form-data">
                      <?php echo e(csrf_field()); ?>

                      <div class="layui-form-item">
                        <label class="layui-form-label" style="width:160px;">真实姓名：</label>
                        <div class="layui-input-inline">
                            <input type="text" name="realName" required lay-verify="required" autocomplete="off" class="layui-input" id="card_realName">
                        </div>
                        <div class="layui-form-mid layui-word-aux">请输入身份证上的真实姓名才可保证审核</div>
                      </div>

                      <div class="layui-form-item">
                        <label class="layui-form-label" style="width:160px;">身份证号码：</label>
                        <div class="layui-input-inline">
                            <input type="text" name="idCard" required lay-verify="required" autocomplete="off" class="layui-input" id="card_idCard">
                        </div>
                        <div class="layui-form-mid layui-word-aux">身份证号码前后不能有空格。年龄不足18岁，不能认证。</div>
                      </div>

                      <div class="layui-form-item card_pic">
                        <label class="layui-form-label" style="width:160px;">身份证<span class="card_color">正面</span>照：</label>
                        <div id="card_positive" class="card_file" number="file1">
                            <div>
                                <input id="file1" type="file" name="file1" class="sfzPic" />
                                <img src="/home/images/sfzz.png" alt="" class="card_base_img">
                            </div>
                            <a href="javascript:(0)">点击上传<span class="glyphicon glyphicon-upload" style="margin-left:10px;margin-top:6px;"></span></a>
                        </div>
                        <div class="card_info_sfz">
                            <ul>
                                <li>必须<span class="card_color">看清</span>证件信息，且<span class="card_color">证件信息不能被遮挡</span></li>
                                <li>仅支持.jpg .bmp .png .gif的图片格式，图片大小不超过2M</li>
                                <li>您提供的照片传承网将予以保护，不会用于其他用途</li>
                            </ul>
                        </div>
                      </div>

                      <div class="layui-form-item card_pic">
                        <label class="layui-form-label" style="width:160px;">身份证<span class="card_color">反面</span>照：</label>
                        <div id="card_opposite" class="card_file" number="file2">
                            <div>
                                <input id="file2" type="file" name="file2" class="sfzPic" />
                                <img src="/home/images/sfzf.png" alt="" class="card_base_img">
                            </div>
                            <a href="javascript:(0)">点击上传<span class="glyphicon glyphicon-upload" style="margin-left:10px;margin-top:6px;"></span></a>
                        </div>
                        <div class="card_info_sfz">
                            <ul>
                                <li>必须<span class="card_color">看清</span>证件信息，且<span class="card_color">证件信息不能被遮挡</span></li>
                                <li>仅支持.jpg .bmp .png .gif的图片格式，图片大小不超过2M</li>
                                <li>您提供的照片传承网将予以保护，不会用于其他用途</li>
                            </ul>
                        </div>
                      </div>

                      <div class="layui-form-item card_pic">
                        <label class="layui-form-label" style="width:160px;"><span class="card_color">手持</span>身份证正面照：</label>
                        <div id="card_positive" class="card_file" number="file3">
                            <div>
                                <input id="file3" type="file" name="file3" class="sfzPic" />
                                <img src="/home/images/sfzz.png" alt="" class="card_base_img">
                            </div>
                            <a href="javascript:(0)">点击上传<span class="glyphicon glyphicon-upload" style="margin-left:10px;margin-top:6px;"></span></a>
                        </div>
                        <div class="card_info_sfz" id="card_info_hold">
                            <ul>
                                <li>请上传本人<span class="card_color">手持</span>身份证正面头部照片和上半身照片</li>
                                <li>照片为免冠、未化妆的数码照片原始图片，<span class="card_color">请勿用任何软件编辑修改</span></li>
                                <li>必须看清证件信息，且证件信息不能被遮挡，持证人五官清晰可见</li>
                                <li>仅支持.jpg .bmp .png .gif的图片格式，图片大小不超过3M</li>
                                <li>您提供的照片传承网将予以保护，不会用于其他用途</li>
                            </ul>
                        </div>
                      </div>


                      <div class="layui-form-item">
                        <div class="layui-input-block" style="margin-left:160px;">
                          <button class="layui-btn" type="submit" id="smrzsubmit">立即提交</button>
                          <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                        </div>
                      </div>
                  </form>
            <?php elseif($user->card->status == 1): ?>
            <div class="card_status"><span style="color:red;">正在审核</span>，请耐心等候。</div>
            <?php elseif($user->card->status == 3): ?>
            <div class="card_status" style="color:red;">恭喜您，实名认证成功</div>
            <?php endif; ?>
               </div>


               <div class="tab-pane fade" id="bank">
                  <h2 style="text-align:center;margin-top:20px;">银行管理</h2>
                  <hr>
                  <div class="card_info"><b>温馨提示</b><span>银行信息必须真实有效。</span></div>
                  <div id="bank-exist" flag="1">

                     <div id="bank-exist-a">
                        <span>查看银行信息 <span class="bank-click" id="bank-c">「点击收起」</span> </span>
                        <img src="/home/images/more.png" id="bank-exist-img" flag="1" style="transform: rotate(90deg); transition: all 0.3s ease 0s;width:20px;float:right">
                     </div>
                     <div class="layui-form">
                       <table class="layui-table">
                         <colgroup>
                           <col width="150">
                           <col width="150">
                           <col width="200">
                           <col>
                         </colgroup>
                         <thead>
                           <tr>
                             <th>银行</th>
                             <th>银行卡号</th>
                             <th>开户人姓名</th>
                             <th>银联系手机号</th>
                             <th>编辑</th>
                           </tr>
                         </thead>
                         <tbody id="bank-line">
                           <?php $__currentLoopData = $banks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr id="bk<?php echo e($v['id']); ?>">
                               <td><?php echo e($v['cateBank']); ?></td>
                               <td><?php echo e($v['bankId']); ?></td>
                               <td><?php echo e($v['bankName']); ?></td>
                               <td><?php echo e($v['tel']); ?></td>
                               <td>
                                 <button bankid="<?php echo e($v['id']); ?>" type="button" class="btn btn-primary bank-edit" data-toggle="modal" data-target="#myModal">
                                   修改
                                 </button>
                                 <button bankid="<?php echo e($v['id']); ?>"  type="button" class="btn btn-danger bank-del">删除</button>
                               </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                         </tbody>
                       </table>
                     </div>
                  </div>

                  <div id="bank-tj" flag="2">
                     <div id="bank-tj-a">
                        <span>添加银行信息 <span class="bank-click" id="bank-c1">「点击展开」</span> </span>
                        <img src="/home/images/more.png" id="bank-tj-img" flag="1" style="transform: rotate(0deg); transition: all 0.3s ease 0s;width:20px;float:right">
                     </div>
                     <form class="layui-form" action="">
                        <div class="layui-inline" id="bank-line" style="margin-bottom:13px;" >
                           <label class="layui-form-label bank-line-title" >选择银行</label>
                           <div class="layui-input-inline" style="width:500px;" >
                             <select name="bank-name" id="bank-select" lay-verify="required" lay-search="">
                                <option value="国家开发银行">国家开发银行</option>
                                <option value="中国进出口银行">中国进出口银行</option>
                                <option value="中国农业发展银行">中国农业发展银行</option>
                                <option value="中国银行">中国银行</option>
                                <option value="中国工商银行">中国工商银行</option>
                                <option value="中国建设银行">中国建设银行</option>
                                <option value="中国农业银行">中国农业银行</option>
                                <option value="中国光大银行">中国光大银行</option>
                                <option value="中国民生银行">中国民生银行</option>
                                <option value="中信银行">中信银行</option>
                                <option value="交通银行">交通银行</option>
                                <option value="华夏银行">华夏银行</option>
                                <option value="招商银行">招商银行</option>
                                <option value="兴业银行">兴业银行</option>
                                <option value="广发银行">广发银行</option>
                                <option value="平安银行">平安银行</option>
                                <option value="上海浦东发展银行">上海浦东发展银行</option>
                                <option value="恒丰银行">恒丰银行</option>
                                <option value="浙商银行">浙商银行</option>
                                <option value="渤海银行">渤海银行</option>
                                <option value="中国邮政储蓄银行">中国邮政储蓄银行</option>
                                <option value="城市商业银行">城市商业银行</option>
                                <option value="北京银行">北京银行</option>
                                <option value="天津银行">天津银行</option>
                                <option value="河北银行">河北银行</option>
                                <option value="沧州银行">沧州银行</option>
                                <option value="唐山市商业银行">唐山市商业银行</option>
                                <option value="承德银行">承德银行</option>
                                <option value="张家口市商业银行">张家口市商业银行</option>
                                <option value="秦皇岛银行">秦皇岛银行</option>
                                <option value="邢台银行">邢台银行</option>
                                <option value="廊坊银行">廊坊银行</option>
                                <option value="保定银行">保定银行</option>
                                <option value="邯郸银行">邯郸银行</option>
                                <option value="衡水银行">衡水银行</option>
                                <option value="晋商银行">晋商银行</option>
                                <option value="大同市商业银行">大同市商业银行</option>
                                <option value="长治银行">长治银行</option>
                                <!-- <option value="其他</">其他</option> -->
                             </select>
                           </div>
                        </div>

                        <div class="layui-form-item">
                           <label class="layui-form-label bank-line-title">开户人姓名</label>
                           <div class="layui-input-block bank-line-input">
                              <input type="text" name="bankusername" lay-verify="bankusername" autocomplete="off" placeholder="请输入姓名" class="layui-input bank-layui-input">
                           </div>
                        </div>

                        <div class="layui-form-item">
                           <label class="layui-form-label bank-line-title">银行卡号</label>
                           <div class="layui-input-block bank-line-input">
                              <input type="text" name="bankid" lay-verify="bankid" autocomplete="off" placeholder="请输入卡号" class="layui-input bank-layui-input">
                           </div>
                        </div>

                        <div class="layui-form-item">
                           <label class="layui-form-label bank-line-title">银行预留手机号</label>
                           <div class="layui-input-block bank-line-input">
                              <input type="text" name="bankphone" lay-verify="bankphone" autocomplete="off" placeholder="请输入预留手机号" class="layui-input bank-layui-input">
                           </div>
                        </div>

                        <div class="layui-form-item">
                         <div class="layui-input-block" style="margin-left:150px;">
                           <button class="layui-btn" id="bank-submit" lay-submit="" lay-filter="demo1">立即添加</button>
                           <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                         </div>
                        </div>
                     </form>
                  </div>

               </div>

               <!-- <div class="tab-pane fade" id="address">
                  添加地址
               </div> -->
            </div>


            <!-- 修改银行的弹出层 -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="margin-top:100px;">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">修改银行卡信息</h4>
                  </div>
                  <div class="modal-body">
                  <form class="layui-form">
                    <select name="bank-name" id="bkname" lay-verify="required" lay-search="">
                       <option value="国家开发银行">国家开发银行</option>
                       <option value="中国进出口银行">中国进出口银行</option>
                       <option value="中国农业发展银行">中国农业发展银行</option>
                       <option value="中国银行">中国银行</option>
                       <option value="中国工商银行">中国工商银行</option>
                       <option value="中国建设银行">中国建设银行</option>
                       <option value="中国农业银行">中国农业银行</option>
                       <option value="中国光大银行">中国光大银行</option>
                       <option value="中国民生银行">中国民生银行</option>
                       <option value="中信银行">中信银行</option>
                       <option value="交通银行">交通银行</option>
                       <option value="华夏银行">华夏银行</option>
                       <option value="招商银行">招商银行</option>
                       <option value="兴业银行">兴业银行</option>
                       <option value="广发银行">广发银行</option>
                       <option value="平安银行">平安银行</option>
                       <option value="上海浦东发展银行">上海浦东发展银行</option>
                       <option value="恒丰银行">恒丰银行</option>
                       <option value="浙商银行">浙商银行</option>
                       <option value="渤海银行">渤海银行</option>
                       <option value="中国邮政储蓄银行">中国邮政储蓄银行</option>
                       <option value="城市商业银行">城市商业银行</option>
                       <option value="北京银行">北京银行</option>
                       <option value="天津银行">天津银行</option>
                       <option value="河北银行">河北银行</option>
                       <option value="沧州银行">沧州银行</option>
                       <option value="唐山市商业银行">唐山市商业银行</option>
                       <option value="承德银行">承德银行</option>
                       <option value="张家口市商业银行">张家口市商业银行</option>
                       <option value="秦皇岛银行">秦皇岛银行</option>
                       <option value="邢台银行">邢台银行</option>
                       <option value="廊坊银行">廊坊银行</option>
                       <option value="保定银行">保定银行</option>
                       <option value="邯郸银行">邯郸银行</option>
                       <option value="衡水银行">衡水银行</option>
                       <option value="晋商银行">晋商银行</option>
                       <option value="大同市商业银行">大同市商业银行</option>
                       <option value="长治银行">长治银行</option>
                       <!-- <option value="其他</">其他</option> -->
                     </select>

                    <div class="form-group" style="margin-top:10px;">
                      <label for="exampleInputEmail1">开户人姓名</label>
                      <input type="text" class="form-control" value="" name="bkuname" id="bkuname" placeholder="开户人姓名">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">银行卡号</label>
                      <input type="text" class="form-control" value="" name="bkid" id="bkcardid" placeholder="银行卡号">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">联系手机号</label>
                      <input type="text" class="form-control" value="" name="bkphone" id="bkphone" placeholder="联系手机号">
                    </div>
                     <input type="hidden" id="bkid" value="" name="bkid">
                  </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" id="bankqx" class="btn btn-default" data-dismiss="modal">取消修改</button>
                    <button type="button" id="bank-subedit" class="btn btn-primary">提交修改</button>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('js'); ?>
<script type="text/javascript" src="/home/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/home/js/personal/custom_up_img.js"></script>
<script type="text/javascript" src="/home/js/personal/amazeui.min.js"></script>
<script type="text/javascript" src="/home/js/personal/cropper.min.js"></script>
<script type="text/javascript" src="/layui/layui/layui.js" charset="utf-8"></script>
<script type="text/javascript" src="/home/js/personal/perfect.js"></script>
<script type="text/javascript">
    if($('#personal_right').height() > 600){
        $('#personal_left').css('height',$('#personal_right').height());
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.home', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>