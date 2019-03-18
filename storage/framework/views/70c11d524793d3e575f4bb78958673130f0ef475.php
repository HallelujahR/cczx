<?php $__env->startSection('title'); ?>
    <title>交易区[传承网]</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" type="text/css" href="/home/css/deal/dealbar.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div id="dealbar_dk">

        <div id="dealbar">

            <?php $__currentLoopData = $dealCates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dealCate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="small_dealbar">
                <div class="small_dealbar_head">
                    <div class="small_dealbar_head_title">
                        <a href="<?php echo e(action('DealSonController@search',['check'=>0,'deal_cate'=>$dealCate->id,'searchType'=>'shopName','text'=>''])); ?>" target="_blank"><?php echo e($dealCate->name); ?></a>
                    </div>
                    <div class="small_dealbar_head_title2">

                        <span><a href="<?php echo e(action('DealSonController@search',['check'=>1,'deal_cate'=>$dealCate->id,
                        'searchType'=>'shopName','text'=>''])); ?>">买盘:<?php echo e($dealCate->countBuy); ?>条</a></span>
                        <span><a href="<?php echo e(action('DealSonController@search',['check'=>2,'deal_cate'=>$dealCate->id,
                        'searchType'=>'shopName','text'=>''])); ?>">卖盘:<?php echo e($dealCate->countSell); ?>条</a></span>
                        <a style="color: #888888;" href="<?php echo e(action('DealSonController@search',['check'=>0,
                        'deal_cate'=>$dealCate->id,
                        'searchType'=>'shopName','text'=>''])); ?>">更多</a>
                    </div>
                </div>

                <div class="small_dealbar_content">
                    <?php $__currentLoopData = $dealCate->deals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $deal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($deal['status'] == 0): ?>
                    <div class="small_dealbar_content_title">
                        <span <?php if($deal->check == 1): ?>class="dealbar_buy"<?php elseif($deal->check == 2): ?>class="dealbar_sell"<?php endif; ?>><?php if($deal->check == 1): ?>买<?php elseif($deal->check == 2): ?>卖<?php endif; ?></span>
                        <a target="_blank" href="<?php echo e(action('DealSonController@detail',$deal->id)); ?>" title="<?php if($deal->check == 1): ?>[收购]<?php elseif($deal->check == 2): ?>[出售]<?php endif; ?><?php echo e($deal->shopName); ?>(<?php echo e($deal->productPhase); ?>)<?php echo e($deal->num); ?><?php echo e($deal->unit); ?>单价:<?php echo e($deal->unitPrice); ?>元 <?php echo e($deal->deliveryMethods[0]); ?>">
                            <?php if($deal->check == 1): ?>[收购]<?php elseif($deal->check == 2): ?>[出售]<?php endif; ?>
                            <?php echo e($deal->shopName); ?>(<?php echo e($deal->productPhase); ?>)<?php echo e($deal->num); ?><?php echo e($deal->unit); ?>

                            单价:<?php echo e($deal->unitPrice); ?>元
                            <?php echo e($deal->deliveryMethods[0]); ?>

                        </a>
                    </div>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <div class="small_dealbar" style="width:49%">
                    <div class="small_dealbar_head" >
                        <div class="small_dealbar_head_title">
                            <a target="_blank">最近成交买卖盘</a>
                        </div>
                        <div class="small_dealbar_head_title2" style="width:418px;">
                            <a style="color:#888;" href="<?php echo e(action('DealSonController@confirmlist',['check'=>0,
                            'searchType'=>'shopName','text'=>'','deal_cate'=>0,'start'=>0,'end'=>0])); ?>"
                               target="_blank">更多</a>
                        </div>
                    </div>

                    <div class="small_dealbar_content" style="font-size:14px;">
                        <?php $__currentLoopData = $confirm; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="small_dealbar_content_title" style="border-bottom:1px solid #CCC;">
                                <span <?php if($deal->check == 1): ?>class="dealbar_buy"<?php elseif($deal->check == 2): ?>class="dealbar_sell"<?php endif; ?>><?php if($v->check == 1): ?>买<?php elseif($v->check == 2): ?>卖<?php endif; ?></span>
                                <span style="color:orangered">「<?php echo e($v->cate->name); ?>」</span>
                                <a target="_blank" href="<?php echo e(action('DealSonController@detail',$v->id)); ?>">
                                    <?php if($v->check == 1): ?>[收购]<?php elseif($v->check == 2): ?>[出售]<?php endif; ?>
                                    <?php echo e($v->shopName); ?>(<?php echo e($v->productPhase); ?>)<?php echo e($v->num); ?><?php echo e($v->unit); ?>

                                    单价:<?php echo e($v->unitPrice); ?>元
                                    <?php echo e($v->deliveryMethods[0]); ?>

                                </a>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>

                <div class="small_dealbar" style="width:49%">
                    <div class="small_dealbar_head" >
                        <div class="small_dealbar_head_title">
                            <a target="_blank">最近撤销买卖盘</a>
                        </div>
                        <div class="small_dealbar_head_title2" style="width:418px;">
                            <a style="color:#888;" href="<?php echo e(action('RevokeController@list',['check'=>0,
                            'searchType'=>'shopName','text'=>'','deal_cate'=>0,'start'=>0,'end'=>0])); ?>"
                               target="_blank">更多</a>
                        </div>
                    </div>

                    <div class="small_dealbar_content" style="font-size:14px;">
                        <?php $__currentLoopData = $revokes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="small_dealbar_content_title" style="border-bottom:1px solid #CCC;">
                                <span <?php if($v->check == 1): ?>class="dealbar_buy"<?php elseif($v->check == 2): ?>class="dealbar_sell"<?php endif; ?>><?php if($v->check == 1): ?>买<?php elseif($v->check == 2): ?>卖<?php endif; ?></span>
                                <span style="color:orangered">「<?php echo e($v->cate->name); ?>」</span>
                                <a target="_blank" href="<?php echo e(action('RevokeController@detail',$v->id)); ?>">
                                    <?php if($v->check == 1): ?>[收购]<?php elseif($v->check == 2): ?>[出售]<?php endif; ?>
                                    <?php echo e($v->shopName); ?>(<?php echo e($v->productPhase); ?>)<?php echo e($v->num); ?><?php echo e($v->unit); ?>

                                    单价:<?php echo e($v->unitPrice); ?>元
                                    <?php echo e($v->deliveryMethods[0]); ?>

                                </a>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>

                <?php $__currentLoopData = $topicCates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="small_dealbar">
                    <div class="small_dealbar_head">
                        <div class="small_dealbar_head_title">
                            <a href="<?php echo e(action('TopicController@index',$v->id)); ?>" target="_blank"><?php echo e($v->cate); ?></a>
                        </div>
                        <div class="small_dealbar_head_title2">
                            <a style="color:#888;" href="<?php echo e(action('TopicController@index',$v->id)); ?>"
                               target="_blank">更多</a>
                        </div>
                    </div>

                    <div class="small_dealbar_content">
                        <?php $__currentLoopData = $v->topics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $topic): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="small_dealbar_content_title" style="border-bottom:1px solid #CCC;">

                                <a target="_blank" href="<?php echo e(action('TopicController@detail',$topic->id)); ?>">
                                    <?php echo e($topic->title); ?>

                                </a>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>

    </div>

    <div id="dealbar_zxcj_dk">
        <div id="dealbar_zxcj">

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.home', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>