<?php $__env->startSection('title'); ?>
<title><?php echo e($post->title); ?>[传承网]</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<!-- 论坛帖子页面样式 -->
<link rel="stylesheet" type="text/css" href="/home/css/ht.css">
<link rel="stylesheet" type="text/css" href="/home/css/newHt.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="htbox">
	<!--内容部分-->
	<div class="navigation">
	    <div style="margin:8px 0 0 3px;float: left;width:1%;text-align: center; line-height:5px;margin-right:10px;">
	    	<img src="/home/images/Forum_nav.gif">
	    </div>
	    <div style="float: left;font-size: 14px;line-height: 25px ;height: 25px;">
	    	<a href="/">传承网 </a>→
	    	<?php if($post->cate->pid == 0): ?>
	    		<a href="<?php echo e(action('BbsController@fucate',$post->cate->id)); ?>"><?php echo e($post->cate->cate); ?></a> →
	    	<?php else: ?>
	    		<a href="<?php echo e(action('BbsController@fucate',getBbsCate($post->cate->pid)->id)); ?>"><?php echo e(getBbsCate($post->cate->pid)->cate); ?> </a> →
				<a href="/bbs/zicate/<?php echo e($post->cate->id); ?>.html"><?php echo e($post->cate->cate); ?></a> →
	    	<?php endif; ?>
			<span><?php echo e($post->title); ?></span>
	    </div>
	</div>

	<!--项目栏-->
	<div class="xml">
		<div class="xmll">
			<a href="<?php echo e(action('PublishController@post',['id'=>$post->cate->id])); ?>" id="fbtz">发表帖子</a>
			<a href="<?php echo e(action('PublishController@reply',$post->id)); ?>" id="hftz">回复帖子</a>
		</div>
		<div class="xmlr">
		   	<p>
		    	您是本帖的第 <span><?php echo e($post->access_count); ?></span> 个阅读者
		   	</p>
		</div>
	</div>

	<!--回复框-->


	<!--楼主-->
	<?php if($replies->currentPage() <= 1): ?>

   	<div class="owner">
		<div class="owner_title">
			<div style="word-break:break-all;">
				<?php echo e($post->title); ?>

			</div>

			<div class="owner_post_time">
				<?php echo e($post->created_at); ?>

			</div>
		</div>

		<div class="owner_down">
			<div class="owner_detail">
				<div class="owner_user_headpic">
					<a href="/personal/<?php echo e($post->user->id); ?>">
						<img src="<?php echo e($post->user->avatar); ?>"  width="90" height="90" style="border-radius:45px;"/ class="owner_user_img">
					</a>
					<div class="owner_user_name">
							<a href="/personal/<?php echo e($post->user->id); ?>"><?php echo e($post->user->name); ?><span id="louzhu">[楼主]</span></a>
							<br>
							<?php if(Auth::id() != $post->user->id): ?>

							<a <?php if(Auth::check()): ?> login="true" <?php else: ?> login="false" <?php endif; ?> href='javascript:;' class='gzuser gzuser<?php echo e($post->user->id); ?>' follow_id="<?php echo e($post->user->id); ?>"><?php echo Auth::check()&&Auth::user()->followed_user($post->user->id) ? "<span class='glyphicon glyphicon-minus'></span><span style='margin-left:5px'>已关注</span>" : "<span class='glyphicon glyphicon-plus'></span><span style='margin-left:5px'>关注他</span>"; ?></a>

							<a href="/message/check/<?php echo e($post->user->id); ?>">
	                             <span class='glyphicon glyphicon-envelope' style="margin-left:2px;margin-right:5px;font-size:14px;"></span>私信
	                        </a>
							<?php endif; ?>
					</div>
				</div>
				<div class="owner_user_detail">
					身份：<?php echo e($post->user->role->role); ?>

				</div>
				<div class="owner_user_detail">性别 : <?php if($post_user->sex == 0): ?>女 <?php else: ?> 男 <?php endif; ?></div>
				<?php if($post_user->birthday != 0): ?>
					<div class="owner_user_detail">生日 : <?php echo e($post_user->birthday); ?></div>
				<?php endif; ?>

				<?php if($post_user->email != '0'): ?>
					<div class="owner_user_detail">邮箱 : <?php echo e($post_user->email); ?></div>
				<?php endif; ?>

				<div class="owner_user_detail">发帖次数 : <?php echo e($post->user->posts->count()); ?></div>
				<div class="owner_user_detail">回帖次数 : <?php echo e($post->user->replies->count()); ?></div>
				<div class="owner_user_detail">注册日期： <?php echo e($post->user->created_at); ?></div>
			</div>
			<div class="owner_content">
				<div class="res" style="min-height:200px;font-size:9pt;line-height:normal;text-indent:24px;margin-top:10px;word-wrap : break-word ;word-break : break-all ;font-size:16px;" onload="this.style.overflowX='auto';">
					<?php echo $post->content->content; ?>

				</div>
				<div>
				   <img src="/home/images/tag.png" style="width:20px;"> ---------------------------------------------------------------------------------<br>

				</div>

				<div class="user_detail_x">
					<div class="user_detail_x_line">认证状态 :
						<?php if($post->user->role->role == '认证会员'): ?>
						<span><?php echo e($post->user->role->role); ?> <span class="rzzt">「此用户已通过实名认证，地址，银行，姓名均认证成功」</span></span>
						<?php elseif($post->user->role->role == '普通会员'): ?>
						<span><?php echo e($post->user->role->role); ?> <span class="rzzt">「此用户还未实名认证」</span></span>
						<?php elseif($post->user->role->role == '管理员'): ?>
						<span><?php echo e($post->user->role->role); ?></span>
						<?php endif; ?>
					</div>

					<?php if($post->user->card->realName != '0'): ?>
					<div class="user_detail_x_line">姓 名 : <span><?php echo e($post->user->card->realName); ?></span></div>
					<?php endif; ?>

					<?php $__currentLoopData = $post->user->addresses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<div class="user_detail_x_line">地 址<?php echo e($k+1); ?> : <span> <?php echo e($v['province']); ?><?php echo e($v['city']); ?><?php echo e($v['county']); ?><?php echo e($v['street']); ?> </span></div>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

					<div class="user_detail_x_line">手 机 : <span><?php echo e($post->user->phone); ?>


					</span></div>


					<?php $__currentLoopData = $post->user->banks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<div class="user_detail_x_line">银 行<?php echo e($k+1); ?> : <span><?php echo e($v['cateBank']); ?>&nbsp; &nbsp; <?php echo e($v['bankId']); ?> &nbsp; &nbsp; <?php echo e($v['bankName']); ?>  &nbsp; &nbsp; <?php echo e($v['tel']); ?></span></div>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

					<?php if($post->user->detail->alipay != '0'): ?>
					<div class="user_detail_x_line">支付宝 : <span><?php echo e($post->user->detail->alipay); ?></span></div>
					<?php endif; ?>

					<?php if($post->user->detail->vx != '0'): ?>
					<div class="user_detail_x_line">微 信 : <span><?php echo e($post->user->detail->vx); ?></span></div>
					<?php endif; ?>

					<?php if($post->user->detail->qq != '0'): ?>
					<div class="user_detail_x_line"> Q Q : <span><?php echo e($post->user->detail->qq); ?></span></div>
					<?php endif; ?>

				</div>
			</div>
		</div>

		<div class="owner_tips">
			<span class="owner_time"><?php echo e($post->created_at); ?></span>
			<span class="owner_tip">免责声明及风险提示： 所有交易人员，凡未采用本站中介交易的，被骗后果自负。</span>
		</div>
   	</div>
   	<?php endif; ?>


	<!--回帖内容-->
	<?php $__currentLoopData = $replies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$reply): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
   	<div class="reply">
		<div class="reply_down">
			<div class="reply_detail">

				<div class="reply_user_headpic">
					<a href="/personal/<?php echo e($reply->user->id); ?>">
						<img src="<?php echo e($reply->user->avatar); ?>"  width="90" height="90" style="border-radius:45px;"/ class="reply_user_img">
					</a>
					<div class="reply_user_name">
						<a href="/personal/<?php echo e($post->user->id); ?>"><?php echo e($reply->user->name); ?><span id="louzhu">[<?php if($replies->currentPage() <= 1): ?><?php echo e(getLou($k+1)); ?><?php else: ?> <?php echo e(getLou(($replies->currentPage()-1)*10+$k+1)); ?> <?php endif; ?>]</span></a>
						<br>

						<?php if(Auth::id() != $reply->user->id): ?>

						<a <?php if(Auth::check()): ?> login="true" <?php else: ?> login="false" <?php endif; ?> href='javascript:;' class='gzuser gzuser<?php echo e($reply->user->id); ?>' follow_id="<?php echo e($reply->user->id); ?>"><?php echo Auth::check()&&Auth::user()->followed_user($reply->user->id) ? "<span class='glyphicon glyphicon-minus'></span><span style='margin-left:5px'>已关注</span>" : "<span class='glyphicon glyphicon-plus'></span><span style='margin-left:5px'>关注他</span>"; ?></a>

						<a href="/message/check/<?php echo e($reply->user->id); ?>">
							 <span class='glyphicon glyphicon-envelope' style="margin-left:2px;margin-right:5px;font-size:14px;"></span>私信
						</a>
						<?php endif; ?>
					</div>
				</div>

				<div class="owner_user_detail">
					身份：<?php echo e($reply->user->role->role); ?>

				</div>
				<div class="owner_user_detail">性别 : <?php if($reply->user->detail->sex == 0): ?>女 <?php else: ?> 男 <?php endif; ?></div>
				<?php if($reply->user->detail->birthday != 0): ?>
					<div class="owner_user_detail">生日 : <?php echo e($reply->user->detail->birthday); ?></div>
				<?php endif; ?>

				<?php if($reply->user->detail->email != '0'): ?>
					<div class="owner_user_detail">邮箱 : <?php echo e($reply->user->detail->email); ?></div>
				<?php endif; ?>
				<div class="owner_user_detail">发帖次数 : <?php echo e($reply->user->posts->count()); ?></div>
				<div class="owner_user_detail">回帖次数 : <?php echo e($reply->user->replies->count()); ?></div>
				<div class="owner_user_detail">注册日期： <?php echo e($reply->user->created_at); ?></div>
			</div>
			<div class="reply_content">
				<div class="res" style="min-height:200px;font-size:9pt;line-height:normal;text-indent:24px;margin-top:10px;word-wrap : break-word ;word-break : break-all ;font-size:16px;" onload="this.style.overflowX='auto';">
					 <?php echo $reply->content->reply; ?>

				</div>
				<div>
				   <img src="/home/images/tag.png" style="width:20px;"> ---------------------------------------------------------------------------------<br>

				</div>

				<div class="user_detail_x">
					<div class="user_detail_x_line">认证状态 :
						<?php if($reply->user->role->role == '认证会员'): ?>
						<span><?php echo e($reply->user->role->role); ?> <span class="rzzt">「此用户已通过实名认证，地址，银行，姓名均认证成功」</span></span>
						<?php elseif($reply->user->role->role == '普通会员'): ?>
						<span><?php echo e($reply->user->role->role); ?> 「此用户还未实名认证」</span>
						<?php elseif($reply->user->role->role == '管理员'): ?>
						<span><?php echo e($reply->user->role->role); ?></span>
						<?php endif; ?>
					</div>

					<?php if($reply->user->card->realName != '0'): ?>
					<div class="user_detail_x_line">姓 名 : <span><?php echo e($reply->user->card->realName); ?></span></div>
					<?php endif; ?>


					<?php $__currentLoopData = $reply->user->addresses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<div class="user_detail_x_line">地 址<?php echo e($k+1); ?> : <span> <?php echo e($v['province']); ?><?php echo e($v['city']); ?><?php echo e($v['county']); ?><?php echo e($v['street']); ?> </span></div>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

					<div class="user_detail_x_line">手 机 : <span><?php echo e($reply->user->phone); ?>


					</span></div>

					<?php $__currentLoopData = $reply->user->banks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<div class="user_detail_x_line">银 行<?php echo e($k+1); ?> : <span><?php echo e($v['cateBank']); ?>&nbsp; &nbsp; <?php echo e($v['bankId']); ?> &nbsp; &nbsp; <?php echo e($v['bankName']); ?> &nbsp; &nbsp; <?php echo e($v['tel']); ?></span></div>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

					<?php if($reply->user->detail->alipay != '0'): ?>
					<div class="user_detail_x_line">支付宝 : <span><?php echo e($reply->user->detail->alipay); ?></span></div>
					<?php endif; ?>
					<?php if($reply->user->detail->vx != '0'): ?>
					<div class="user_detail_x_line">微 信 : <span><?php echo e($reply->user->detail->vx); ?></span></div>
					<?php endif; ?>

					<?php if($reply->user->detail->qq != '0'): ?>
					<div class="user_detail_x_line"> Q Q : <span><?php echo e($reply->user->detail->qq); ?></span></div>
					<?php endif; ?>

				</div>


			</div>
		</div>

		<div class="reply_tips">
			<span class="reply_time"><?php echo e($reply->created_at); ?></span>
			<span class="reply_tip">免责声明及风险提示： 所有交易人员，凡未采用本站中介交易的，被骗后果自负。</span>
		</div>
   	</div>

	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

	<!--按钮-->
	<div style="float:right;">
		<?php echo $replies->links(('layouts.pagination')); ?>

	</div>


	<div style="float:left;width:100%;padding:0px;">
	    <?php if(Auth::check() && Auth::user()): ?>
	        <div id="plArticle">
	        	<div style="color:#999999">
	        		上传的图片不能大于2M
	        	</div>
	            <div>
	                <form id="form" class="form-horizontal" action="<?php echo e(action('PublishController@storeReply')); ?>" method="post">
	                    <?php echo e(csrf_field()); ?>

	                    <input type="hidden" name="pid" value="<?php echo e($post->id); ?>">
	                    <div id='detail'></div>
	                    <textarea id="text1" name='detail' style="width:100%; height:200px;display:none;"></textarea>
	                    <button flag="1" style="background-color:#7FB4CB;margin-top:10px;" type="submit" class="btn btn-info btn-block" id="comment-commit">确认提交</button>
	                </form>
	            </div>
	        </div>
        <?php endif; ?>
    </div>

</div>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('js'); ?>
<script type="text/javascript" src='/wangEditor/plarticlewangEditor.min.js'></script>
<script type="text/javascript" src='/home/js/post/post.js'></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.home', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>