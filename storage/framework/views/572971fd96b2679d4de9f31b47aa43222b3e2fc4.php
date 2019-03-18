<?php $__env->startSection('title'); ?>
    <title>[传承网]</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    <!-- 论坛帖子页面样式 -->
    <link rel="stylesheet" type="text/css" href="/home/css/deal/dealcate.css">
    <link rel="stylesheet" type="text/css" href="/home/css/deal/detail.css">

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div id="dealcate">
        <div id="title"  style="margin-top:20px;margin-bottom:-10px">
            <?php echo e($name); ?> 最新买卖盘
        </div>
        <div id="match"  style="margin-top:20px;">
            <div class="other-body">
                <div class="other-body_left other-body_son" style="border-right: 1px solid #F0F0F0;">
                    <div style="  text-align: center;">买盘</div>
                    <div class="other-body_son_body">
                        <?php $__currentLoopData = $buyDeal; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div>
                                <span>「买盘」</span>
                                <a href="<?php echo e(action('DealSonController@detail',$v->id)); ?>"><span><?php echo e($v->shopName); ?> 单价:
                                        <?php echo e($v->unitPrice); ?>

                                        <?php $__currentLoopData = $v['deliveryMethods']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k1 => $v1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php echo e($v1); ?>

                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    </span></a>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </div>
                </div>
                <div class="other-body_right other-body_son">
                    <div style="  text-align: center;">卖盘</div>
                    <div class="other-body_son_body">
                        <?php $__currentLoopData = $sellDeal; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div>
                                <span>「卖盘」</span>
                                <a href="<?php echo e(action('DealSonController@detail',$v->id)); ?>"><span><?php echo e($v->shopName); ?> 单价:
                                        <?php echo e($v->unitPrice); ?>

                                        <?php $__currentLoopData = $v['deliveryMethods']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k1 => $v1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php echo e($v1); ?>

                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    </span></a>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>

        <div id="title"  style="margin-top:20px;margin-bottom:-20px">
            <?php echo e($name); ?> 最新成交
        </div>

                <div id="dealbody">
                    <div class="dealbody_line dealbody_title">
                        <div style="width:45%;">标题</div>
                        <div style="width:10%;">发布人</div>
                        <div style="width:15%;">交易人</div>
                        <div style="width:15%;">交易时间</div>
                        <div style="width:5%;">浏览</div>
                        <div style="width:10%;">状态</div>

                    </div>
                    <?php if(count($deals) == 0): ?> <div class="dealbody_line dealbody_line-detail">
                        <div style="width:100%;text-align:center;font-size:20px;">
                            暂无信息
                        </div>
                    </div>
                    <?php else: ?>
                        <?php $__currentLoopData = $deals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="dealbody_line dealbody_line-detail">
                                <div class="dealbody_line-detail_first">

                                    <?php if($v['check'] == '1'): ?>
                                        <div class="dealbody_line-icon_buy">
                                            买
                                        </div>
                                    <?php else: ?>
                                        <div class="dealbody_line-icon_sell">
                                            卖
                                        </div>
                                    <?php endif; ?>
                                    <a href="/deal/detail/<?php echo e($v['id']); ?>.html"><?php echo e($v->shopName); ?>(<?php echo e($v->productPhase); ?>)<?php echo e($v->num); ?><?php echo e($v->unit); ?>

                                        单价:<?php echo e($v->unitPrice); ?>元</a>
                                </div>
                                <div class="dealbody_line-text dealbody_line-text-name">
                                    <a href="/personal/<?php echo e($v['user_id']); ?>"><?php echo e($v->user->name); ?></a>
                                </div>
                                <div class="dealbody_line-text"  style="width:15%;">
                                    <a target="_blank" href="/personal/<?php echo e($v->confirm->user->id); ?>">
                                        <?php echo e($v->confirm->user->name); ?>

                                    </a>
                                </div>
                                <div class="dealbody_line-text" style="width:15%;">
                                    <?php echo e($v->confirm->created_at); ?>

                                </div>
                                <div class="dealbody_line-text" style="width:5%;">
                                    <?php echo e($v['views']); ?>

                                </div>
                                <div class="dealbody_line-text" style="width:10%;">

                                        <?php if($v['status'] == 0): ?>
                                            等待交易
                                        <?php elseif($v['status'] == 1): ?>
                                            确认交易
                                        <?php elseif($v['status'] == 2): ?>
                                            对方确认交割
                                        <?php elseif($v['status'] == 3): ?>
                                            交易失败
                                        <?php elseif($v['status'] == 4): ?>
                                            交割成功，已评分
                                        <?php endif; ?>

                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                    <?php echo e($deals->links()); ?>

                </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script type="text/javascript" src='/home/js/dealcate.js'></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.home', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>