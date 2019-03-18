<?php $__env->startSection('title'); ?>
<title><?php echo e($cate->cate); ?>[传承网]</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<!-- 文章分类页面样式 -->
<link rel="stylesheet" type="text/css" href="/home/css/cate.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<!-- 主体内容 -->
<div id="cate_con">
	<!-- 左栏 -->
	<div id="cate_left">
		<!-- 如果是顶级分类显示子类 如果是子类显示相关分类 -->
		<div id="cate_left_cate">
			<span>
				<em></em>
				<span>相关分类</span>
			</span>
			<?php $__currentLoopData = $xgCates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$xgCate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<div>
				<span <?php if($k!=0): ?> class="hui" <?php endif; ?>><?php echo e($k+1); ?></span>
				<div>
					<a href="<?php echo e(action('CateController@index',$xgCate->id)); ?>"><?php echo e($xgCate->cate); ?></a>
				</div>
			</div>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</div>
	</div>

	<!-- 右栏 -->
	<div id="cate_right">

		<!-- 导航部分 -->
		<div class="cate_dh">
			<span>您的当前位置:</span>
            <a href="/"> 传承资讯首页</a>
            <span>></span>
            <!-- 判断是顶级分类还是二级分类 -->
            <?php if($cate->pid == 0): ?>
            <a href="<?php echo e(action('CateController@index',$cate->id)); ?>"><?php echo e($cate->cate); ?></a>
            <span>></span>
            <?php else: ?>
            <a href="<?php echo e(action('CateController@index',getCateName($cate->pid)->id)); ?>"> <?php echo e(getCateName($cate->pid)->cate); ?></a>
            <span>></span>
            <a href="<?php echo e(action('CateController@index',$cate->id)); ?>"><?php echo e($cate->cate); ?></a>
            <span>></span>
            <?php endif; ?>

            <a id="fbwz" style="float:right;margin-right:0px" href="<?php echo e(action('PublishController@article',['id'=>$cate->id])); ?>">发布文章</a>
		</div>

		<!-- 此分类下的文章 -->
		<div id="cate_right_con">
			<ul>
				<?php $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<li <?php if($k%2 == 1): ?> class="two" <?php endif; ?>>
					<span>
						<a href="<?php echo e(action('ArticleController@index',$article->id)); ?>" target="_blank"><?php echo e(mb_substr($article->title,0,21,'utf-8')); ?></a>
					</span>
					<label>
						<div></div>
						<span><?php echo e($article->user->name); ?></span>
						<div></div>
						<span><?php echo e($article->access_count); ?> 阅读</span>
						<div></div>
						<span><?php echo e(date('Y-m-d',$article->time)); ?></span>
					</label>
				</li>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</ul>
		</div>
		<div style="float:right;">
			<?php echo $articles->links(('layouts.pagination')); ?>

		</div>
	</div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script type="text/javascript">
    $('#cate_right_con > ul > li').mouseout(function(){
        $(this).css('transition',' all 0.5s');
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.home', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>