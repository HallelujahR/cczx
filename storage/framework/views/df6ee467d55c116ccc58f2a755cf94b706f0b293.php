<?php $__env->startSection('title'); ?>
<title><?php echo e($user->name); ?>的个人中心_文章的评论[传承网]</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<!-- 个人中心样式 -->
<link rel="stylesheet" href="/home/css/personal/amazeui.cropper.css">
<link rel="stylesheet" href="/home/css/personal/custom_up_img.css">
<link rel="stylesheet" type="text/css" href="/home/css/personal/personal.css">
<link rel="stylesheet" type="text/css" href="/home/css/personal/article.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div style="padding:0px;" class="container-fluid">
    <div id="personal_con">
        <!-- 左栏 -->
        <?php echo $__env->make("layouts.personleft", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <!-- 右栏 -->
        <div id="personal_right">
            <h2 style="text-align:center;margin-top:20px;"><?php if(Auth::id() == $user->id): ?>我的文章评论<?php else: ?> 他的文章评论 <?php endif; ?> <small>Comments</small></h2>

            <div id="cate_right_con">
                <ul>
                    <?php if($comments->count() > 0): ?>
                        <?php $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li <?php if($k%2 == 1): ?> class="two" <?php endif; ?>>
                            <span>
                                <a href="<?php echo e(action('ArticleController@index',$comment->article->id)); ?>" target="_blank"><?php echo e(mb_substr($comment->article->title,0,21,'utf-8').'...'); ?></a>
                            </span>
                            <label>
                                <b style="float:left;margin-top:5px;">评论：</b>
                                <button class="btn btn-default btn-sm nr" type="button" data-toggle="modal" data-target=".bs-example-modal-lg" style="margin-top:2px;" biaoti="<?php echo e($comment->article->title); ?>" neirong="<?php echo e($comment->comment); ?>">点击查看评论内容</button>
                            </label>
                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <h2 style="text-align:center;">暂时没有发表过评论哦~</h2>
                    <?php endif; ?>
                </ul>
            </div>
            <div style="float:right;">
                <?php echo $comments->links(('layouts.pagination')); ?>

            </div>

            <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel"></h4>
                    </div>
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
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
<script type="text/javascript">
    $('.nr').click(function(){
        $('#myModalLabel').html($(this).attr('biaoti'));
        $('.modal-body').html($(this).attr('neirong'));
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.home', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>