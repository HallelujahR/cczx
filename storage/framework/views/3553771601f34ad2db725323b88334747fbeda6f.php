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
        当前板块: <?php echo e($cate['name']); ?>

    </div>
    <form action="<?php echo e(action('DealSonController@search')); ?>" method="get">
        <div id="search">

            <div style="color:#966f3c">
                查询
            </div>
            <div>
                买卖盘：
                <select name="check" id="">
                    <option value="0">所有</option>
                    <option value="1">买盘</option>
                    <option value="2">卖盘</option>
                </select>
            </div>
            <div>
                买卖盘类别：
                <select name="deal_cate" id="">
                    <option value="0">所有</option>
                    <?php $__currentLoopData = $allcates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($v['id']); ?>"><?php echo e($v['name']); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div>
                查询方式：
                <select name="searchType" id="">
                    <option value="shopName" checked>标题</option>
                    <option value="user_id">发布人</option>
                    <option value="trader">交易人</option>
                    <option value="instructions">其他说明</option>
                    <option value="productPhase">品相</option>
                    <option value="deliveryMethods">交割方式</option>
                </select>
            </div>
            <div>
                <input type="text" name="text" id="searchInput"/>
            </div>
            <div>
                <button id="btn">查询</button>
            </div>
        </div>
    <form action="">



        <div id="dealbody">
        <div class="dealbody_line dealbody_title">
            <div style="width:45%;">标题</div>
            <div style="width:10%;">发布人</div>
            <div style="width:15%;">发布时间</div>
            <div style="width:15%;">有效期</div>
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
                <?php echo e($v['created_at']); ?>

            </div>
            <div class="dealbody_line-text" style="width:15%;">
                <?php echo e(date( "Y-m-d H : i : s", + $v['validity'])); ?>

            </div>
            <div class="dealbody_line-text" style="width:5%;">
                <?php echo e($v['views']); ?>

            </div>
            <div class="dealbody_line-text" style="width:10%;">

                <?php if($v['status'] == '0'): ?>
                    等待交易
                <?php elseif($v['status'] == '1'): ?>
                    确认交易
                <?php elseif($v['status'] == '2'): ?>
                    对方确认交割
                <?php elseif($v['status'] == '3'): ?>
                    交易失败
                <?php elseif($v['status'] == '4'): ?>
                    交割成功，已评分
                <?php endif; ?>

            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
<?php echo e($deals->appends(['check'=>$backR['check'],'deal_cate'=>$backR['deal_cate'],'searchType'=>$backR['searchType'],'text'=>$backR['text']])->links()); ?>

        </div>
<div>

</div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script type="text/javascript" src='/home/js/dealcate.js'></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.home', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>