<?php $__env->startSection('title'); ?>
<title>传承论坛_[传承网]</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<!-- 论坛首页样式 -->
<link rel="stylesheet" type="text/css" href="/home/css/index.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<!-- 6个框 -->
<div style="margin: auto;width: 1200px;margin-top:20px;">
	<!-- 第一层 一级分类 -->
	<?php $__currentLoopData = $bbs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<div class="bbs_two">
			<div class="bbs_two_name"><a href="/bbs/fucate/<?php echo e($v->id); ?>.html"><?php echo e($v->cate); ?></a></div>
			<div class="bbs_two_more"><a href="/bbs/fucate/<?php echo e($v->id); ?>.html">更多</a></div>
			<div class="cate_underline"></div>
		</div>
		<!-- 第二层二级分类 -->
		<?php $__currentLoopData = $v->cate_son; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k1 => $v1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<div class="main1 <?php if($k1%3 == 0): ?> main2 <?php endif; ?> bottom-div">
		        <div class="title-cut">
					<strong class="tt">
						<a href="/bbs/zicate/<?php echo e($v1->id); ?>.html" target="_blank"><?php echo e($v1->cate); ?></a>
					</strong>

					<span class="link">
						<a target="_blank" href="<?php echo e(action('BbsController@zicate',$v1->id)); ?>" style="color:#E00000">更多...</a>
					</span>
		        </div>
		        <div class="list16">
		            <ul class="uul">
			            <li><b>热帖展示</b></li>
			            <?php $__currentLoopData = $v1->hotPosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hotPosts): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			            <li><a href="/bbs/post/<?php echo e($hotPosts->id); ?>.html"><?php echo e($hotPosts->title); ?></a></li>
			            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			        </ul>
		        </div>
				<div class="list16">
			        <ul class="uul">
			            <li><b>最新帖子</b></li>
			            <?php $__currentLoopData = $v1->newPosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $newPosts): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			            <li><a href="/bbs/post/<?php echo e($newPosts->id); ?>.html"><?php echo e($newPosts->title); ?></a></li>
			            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</ul>
		    	</div>
			</div>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.home', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>