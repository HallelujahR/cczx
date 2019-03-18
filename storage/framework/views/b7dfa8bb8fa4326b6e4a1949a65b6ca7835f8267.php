<?php $__env->startSection('title'); ?>
    <title>[传承网]</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    <!-- 论坛帖子页面样式 -->
    <link rel="stylesheet" type="text/css" href="/home/css/deal/dealcate.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div id="dealcate">
        <div id="title">
            当前板块:<?php echo e($user->name); ?>的信用详情
        </div>
                <div id="dealbody">
                    <div class="dealbody_line dealbody_title">
                        <div style="width:40%;">标题</div>
                        <div style="width:10%;">发布人</div>
                        <div style="width:10%;">交易人</div>
                        <div style="width:15%;">交易时间</div>
                        <div style="width:10%;">交易金额</div>
                        <div style="width:10%;">对方评分</div>
                        <div style="width:10%;">评论等级</div>
                    </div>
                    <?php if(count($marklist) == 0): ?> <div class="dealbody_line dealbody_line-detail">
                        <div style="width:100%;text-align:center;font-size:20px;">
                            暂无信息
                        </div>
                    </div>
                    <?php else: ?>
                        <?php $__currentLoopData = $marklist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="dealbody_line dealbody_line-detail" style="height:auto;">
                                <div class="dealbody_line-detail_first" style="width: 40%;">

                                    <?php if($v->check == '1'): ?>
                                        <div class="dealbody_line-icon_buy">
                                            买
                                        </div>
                                    <?php else: ?>
                                        <div class="dealbody_line-icon_sell">
                                            卖
                                        </div>
                                    <?php endif; ?>
                                    <a href="/deal/detail/<?php echo e($v->id); ?>.html"><?php echo e($v->shopName); ?>

                                        (<?php echo e($v->productPhase); ?>) <?php echo e($v->num); ?><?php echo e($v->unit); ?>

                                        单价：<?php echo e($v->unitPrice); ?>元
                                    </a>
                                </div>
                                <div class="dealbody_line-text dealbody_line-text-name" style="width:10%">
                                    <a href="/personal/<?php echo e($v->user->id); ?>"><?php echo e($v->user->name); ?></a>
                                </div>
                                <div class="dealbody_line-text dealbody_line-text-name"  style="width:10%;">
                                    <a href="/personal/<?php echo e($v->confirm->user->id); ?>.html"><?php echo e($v->confirm->user->name); ?></a>
                                </div>
                                <div class="dealbody_line-text" style="width:15%;">
                                    <?php echo e($v->updated_at); ?>

                                </div>
                                <div class="dealbody_line-text" style="width:10%;">
                                    <?php echo e($v->total); ?> 元
                                </div>
                                <div class="dealbody_line-text" style="width:10%;">
                                    <?php echo e($v['mark']['mark']); ?>

                                </div>
                                <div  class="dealbody_line-text" style="width:10%">
                                    <?php if($v['mark']['mark_type'] == 0): ?>
                                        好评
                                    <?php elseif($v['mark']['mark_type'] == 1): ?>
                                        中评
                                    <?php elseif($v['mark']['mark_type'] == 2): ?>
                                        差评
                                    <?php endif; ?>

                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                    <?php echo e($marklist->links()); ?>

                </div>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.home', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>