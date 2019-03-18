<?php $__env->startSection('css'); ?>
<!-- 个人中心样式 -->
<link rel="stylesheet" href="/home/css/personal/amazeui.cropper.css">
<link rel="stylesheet" href="/home/css/personal/custom_up_img.css">
<link rel="stylesheet" type="text/css" href="/home/css/personal/personal.css">
<link rel="stylesheet" type="text/css" href="/home/css/news/news.css">
<link rel="stylesheet" href="/layui/layui/css/layui.css"  media="all">
<link rel="stylesheet" type="text/css" href="/home/css/news/table.css">
<style>
.dealbar_buy{
	float:left;
    margin-right:3px;
	width:25px;
	height:25px;
	line-height:20px;
	color:blue;
	border:1px solid blue;
	text-align:center;
	border-radius:15px;
}
.dealbar_sell{
	float:left;
    margin-right:3px;
	width:25px;
	height:25px;
	line-height:20px;
	color:orangered;
	border:1px solid orangered;
	text-align:center;
	border-radius:25px;
}
a:hover{
    text-decoration: underline;
}
</style>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

<div style="padding:0px;" class="container-fluid">
    <div id="personal_con" newsType="now" userid="<?php echo e(Auth::id()); ?>" counts="<?php echo e($counts); ?>">
        <!-- 左栏 -->
        <?php echo $__env->make("layouts.personleft", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <!-- 右栏 -->
        <div id="personal_right">
        	<div class="layui-tab" lay-filter="news">
			  <ul class="layui-tab-title">
			    <!-- <li class="layui-this tab-title" id="firstClick" lay-id="11">全部消息<span class="total-news"></span></li>
			    <li class="tab-title" lay-id="22">帖子消息<span class="total-news"></span></li>
			    <li class="tab-title" lay-id="33">文章消息<span class="total-news"></span></li>
			    <li class="tab-title" lay-id="44">关注消息<span class="total-news"></span></li> -->
			    <!-- <li class="tab-title" lay-id="55">关注消息<span>(1)</span></li> -->
                <li style="float:left;width:100%;letter-spacing:3px;"><span style="letter-spacing:0px;margin-right:5px;color:red;"><?php echo e($user->name); ?></span>正在交易的买卖盘</li>
			  </ul>

			  <div class="layui-tab-content">

			    <div class="layui-tab-item layui-show">
			    	<div class="tab-div-img">
			     		<img src="/home/images/load.png" class="tab-img" width="100px">
			     	</div>

			     	<div id="rw-table1">
                        <table class="layui-table">
                          <!-- <colgroup>
                            <col width="150">
                            <col width="200">
                            <col>
                          </colgroup> -->
                          <thead>
                            <tr>
                              <th>标题</th>
                              <th>发布时间</th>
                              <th>成交日期</th>
                              <th>发布人</th>
                              <th>交易人</th>
                              <th>状态</th>
                              <th>操作</th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php $__currentLoopData = $deals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $deal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                              <td><span <?php if($deal->check == 1): ?>class="dealbar_buy"<?php elseif($deal->check == 2): ?>class="dealbar_sell"<?php endif; ?>><?php if($deal->check == 1): ?>买<?php elseif($deal->check == 2): ?>卖<?php endif; ?></span>
                              <a href="<?php echo e(action('DealSonController@detail',$deal->id)); ?>" target="_blank"><?php if($deal->check == 1): ?>[收购]<?php elseif($deal->check == 2): ?>[出售]<?php endif; ?>
                              <?php echo e($deal->shopName); ?>(<?php echo e($deal->productPhase); ?>)<?php echo e($deal->num); ?><?php echo e($deal->unit); ?>

                              单价:<?php echo e($deal->unitPrice); ?>元
                              <?php $__currentLoopData = $deal->deliveryMethods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $deliveryMethod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php echo e($deliveryMethod); ?>

                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></a></td>
                              <td><?php echo e($deal->created_at); ?></td>
                              <td><?php echo e($deal->confirm->created_at); ?></td>
                              <td style="color:red;"><?php echo e($deal->user->name); ?></td>
                              <td style="color:blue;"><?php echo e($deal->traderUser->name); ?></td>
                              <td>
								  <?php if($deal->dealstatus == 0): ?>
								  		等待双方交割
								  <?php elseif($deal->dealstatus == 1): ?>
								  		发布人确认交割
								  <?php elseif($deal->dealstatus == 2): ?>
								  		交易人确认交割
								  <?php elseif($deal->dealstatus == 3): ?>
								  		双方交割成功
								  <?php elseif($deal->dealstatus == 4): ?>
								  		发布人确认交割失败
								  <?php elseif($deal->dealstatus == 5): ?>
								  		交易人确认交割失败
								  <?php else: ?>
								  		双方确认交割失败
								  <?php endif; ?>
							  </td>
                              <td width="10%">
								  <?php if($deal->dealstatus == 0): ?>
									  <a style="color:blue" href="" deal_id="<?php echo e($deal->id); ?>" class="qrconfirm">确认交割</a ><br />
									  <a style="color:blue;margin-top:5px;" href="" deal_id="<?php echo e($deal->id); ?>" class="failconfirm">交割失败</a >
								  <?php elseif($deal->dealstatus == 1): ?>
								  	<?php if($deal->user_id == Auth::id()): ?>
								  	<a style="color:blue;margin-top:5px;" href="" deal_id="<?php echo e($deal->id); ?>" class="failconfirm">交割失败</a>
									<?php else: ?>
									<a style="color:blue" href="" deal_id="<?php echo e($deal->id); ?>" class="qrconfirm">确认交割</a><br />
									<a style="color:blue;margin-top:5px;" href="" deal_id="<?php echo e($deal->id); ?>" class="failconfirm">交割失败</a>
									<?php endif; ?>
								  <?php elseif($deal->dealstatus == 2): ?>
								  	<?php if($deal->user_id == Auth::id()): ?>
									<a style="color:blue" href="" deal_id="<?php echo e($deal->id); ?>" class="qrconfirm">确认交割</a><br />
									<a style="color:blue;margin-top:5px;" href="" deal_id="<?php echo e($deal->id); ?>" class="failconfirm">交割失败</a>
									<?php else: ?>
								  	<a style="color:blue;margin-top:5px;" href="" deal_id="<?php echo e($deal->id); ?>" class="failconfirm">交割失败</a>
									<?php endif; ?>
								  <?php elseif($deal->dealstatus == 3): ?>
									  双方交割成功
								  <?php elseif($deal->dealstatus == 4): ?>
								  	<?php if($deal->user_id == Auth::id()): ?>
										己方已确认交割失败，等待对方
									<?php else: ?>
										<a style="color:blue;margin-top:5px;" href="" deal_id="<?php echo e($deal->id); ?>" class="failconfirm">交割失败</a>
									<?php endif; ?>
								  <?php elseif($deal->dealstatus == 5): ?>
								  	<?php if($deal->user_id == Auth::id()): ?>
								  		<a style="color:blue;margin-top:5px;" href="" deal_id="<?php echo e($deal->id); ?>" class="failconfirm">交割失败</a>
									<?php else: ?>
										己方已确认交割失败，等待对方
									<?php endif; ?>
								  <?php else: ?>
									  双方确认交割失败
								  <?php endif; ?>
                              </td>
                              <td><a style="color:blue;" href="<?php echo e(action('DealSonController@detail',$deal->id)); ?>" target="_blank">打开</a></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </tbody>
                        </table>
						<?php echo $deals->links(); ?>

			     	</div>

			    </div>

			  </div>
			</div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script type="text/javascript" src="/layui/layui/layui.js" charset="utf-8"></script>
<!-- <script type="text/javascript" src="/home/js/news/table.js"></script> -->
<script type="text/javascript" src="/home/js/personal/cropper.min.js"></script>
<script type="text/javascript" src="/home/js/personal/custom_up_img.js"></script>
<script type="text/javascript" src="/home/js/personal/amazeui.min.js"></script>
<script type="text/javascript" src="/home/js/deal/personalDeal.js"></script>
<!-- 表格 -->
<script type="text/javascript">
$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

$('.qrconfirm').click(function(){
	var deal_id = $(this).attr('deal_id');

	layer.confirm('<span style="color:black;">重要提醒：在你没有完成实物交割之前，不要点确认交割！否则由引起的投诉或纠纷责任自负。你是否确认已完成交割？</span>', {
		btn: ['确定','取消'] //按钮
	}, function(){

		$.ajax({
			url:"<?php echo e(action('ConfirmController@confirm')); ?>",
			type:'post',
			data:{id:deal_id},
			success:function(mes){
				// alert(mes);
				location.reload()
			},
			error:function(){
				layer.msg('请重新登录尝试，如果还不行请联系管理员');
			}
		})
	});

	return false;
});

$('.failconfirm').click(function(){
	var deal_id = $(this).attr('deal_id');

	layer.confirm('<span style="color:black;">你确认点击交割失败？</span>', {
		btn: ['确定','取消'] //按钮
	}, function(){

		$.ajax({
			url:"<?php echo e(action('ConfirmController@failConfirm')); ?>",
			type:'post',
			data:{id:deal_id},
			success:function(mes){
				location.reload()
			},
			error:function(){
				layer.msg('请重新登录尝试，如果还不行请联系管理员');
			}
		})
	})

	return false;
})
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.home', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>