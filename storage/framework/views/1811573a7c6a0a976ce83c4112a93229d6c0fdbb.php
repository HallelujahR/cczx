<?php $__env->startSection('title'); ?>
    <title><?php echo e($post->shopName); ?>[传承网]</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    <!-- 论坛帖子页面样式 -->
    <link rel="stylesheet" type="text/css" href="/home/css/ht.css">
    <link rel="stylesheet" type="text/css" href="/home/css/newHt.css">
    <link rel="stylesheet" type="text/css" href="/home/css/deal/detail.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="htbox">
        <!--内容部分-->
        <div class="navigation">
            <div style="margin:8px 0 0 3px;float: left;width:1%;text-align: center; line-height:5px;margin-right:10px;">
                
            </div>
            <div style="float: left;font-size: 14px;line-height: 25px ;height: 25px;">

            </div>
        </div>
        <!--楼主-->

            <div class="owner">
                <div class="owner_title">
                    <div style="word-break:break-all;">
                        <span style="color:red">
                        <?php if($post->check == 2): ?>
                                「出售」
                            <?php else: ?>
                                「收购」
                            <?php endif; ?>
                        </span>
                        <?php echo e($post->shopName); ?>(<?php echo e($post->productPhase); ?>)<?php echo e($post->num); ?><?php echo e($post->unit); ?>

                        单价:<?php echo e($post->unitPrice); ?>元

                        <?php $__currentLoopData = $post->deliveryMethods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo e($v); ?>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <span style="color:#A66C33;font-size:16px;">本帖交易ID 「<?php echo e($post['id']); ?>」</span>
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
                        <div class="owner_user_detail">性别 : <?php if($post->user->detail->sex == 0): ?>女 <?php else: ?> 男 <?php endif; ?></div>
                        <?php if($post->user->birthday != 0): ?>
                            <div class="owner_user_detail">生日 : <?php echo e($post->user->birthday); ?></div>
                        <?php endif; ?>

                        <?php if($post->user->email != '0'): ?>
                            <div class="owner_user_detail">邮箱 : <?php echo e($post->user->detail->email); ?></div>
                        <?php endif; ?>

                        <div class="owner_user_detail">发帖次数 : <?php echo e($post->user->posts->count()); ?></div>
                        <div class="owner_user_detail">回帖次数 : <?php echo e($post->user->replies->count()); ?></div>
                        <div class="owner_user_detail">注册日期 : <?php echo e($post->user->created_at); ?></div>
                        <div class="owner_user_detail">信用积分 : <?php echo e($post->user->detail->creditscore); ?></div>
                        <div class="owner_user_detail">交易次数 : <?php echo e($post->user->detail->transactionTimes); ?></div>
                        <div class="owner_user_detail">交易金额 : <?php echo e($post->user->detail->transactionAmount); ?></div>
                        <div class="owner_user_detail">好评率  : <?php echo e($post->user->mark->appreciation); ?></div>
                    </div>
                    <div class="owner_content">
                        <div class="res" style="min-height:200px;font-size:9pt;line-height:normal;text-indent:24px;margin-top:10px;word-wrap : break-word ;word-break : break-all ;font-size:16px;" onload="this.style.overflowX='auto';">
                            <?php if($post->mallGoods != 0): ?>
                                <div style="width:100%;">
                                    <a target="_blank" style="color:#ff6600;" href="https://www.1980cang.com/item-<?php echo e($post->mallGoods); ?>.html"> 点击查看相关商品</a>
                                </div>
                            <?php endif; ?>
                            <div>
                                交易类别：<span>  <?php if($post->check == 2): ?>
                                        「出售」
                                    <?php else: ?>
                                        「收购」
                                    <?php endif; ?></span>
                            </div>
                            <div>
                                交易栏目: <span><?php echo e($post->cate->name); ?></span>
                            </div>
                            <div>
                                交易ID号：<span style="color:red;"><?php echo e($post->id); ?></span>
                            </div>
                            <div>
                                交易状态：<span>

                                    <?php if($post->status == 0): ?>
                                        等待交易
                                    <?php elseif($post->status == 1): ?>
                                        确认交易
                                    <?php elseif($post->status == 2): ?>
                                        卖家确认交割
                                    <?php endif; ?>
                                </span>
                            </div>

                            <div>
                                品种名称：<span><?php echo e($post->shopName); ?></span>
                            </div>

                            <div>
                                品相：<span><?php echo e($post->productPhase); ?></span>
                            </div>
                            <div>
                                单价：<span><?php echo e($post->unitPrice); ?> 元</span>
                            </div>

                            <div>
                                其他费用: <span><?php echo e($post->otherExpenses); ?>元</span>
                            </div>

                            <div>
                                数量： <span><?php echo e($post->num); ?><?php echo e($post->unit); ?></span>
                            </div>
                            <div>
                                最小购买数量 <span><?php echo e($post->minQuantity); ?><?php echo e($post->unit); ?></span>
                            </div>
                            <div>
                                合计金额: <span  style="color:red;"><?php echo e($post->total); ?>元</span>
                            </div>

                            <div>
                                确认方式：<span style="color:red;">直接确认</span>
                            </div>
                            <div>
                                交割方式: <?php $__currentLoopData = $post->deliveryMethods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <span><?php echo e($v); ?></span>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <div>
                                发布时间: <span><?php echo e($post->created_at); ?></span>
                            </div>
                            <div>
                                信息有效时间: <span><?php echo e(date( "Y-m-d H : i : s", + $post->validity)); ?></span>
                            </div>
                            <div>
                                剩余时间 : <span style="color:red"><?php echo e($date); ?></span>
                            </div>
                            <div style="width:100%">
                                其他说明: <span><?php echo e($post->instructions); ?></span>
                            </div>

                            <div>
                                浏览次数 : <span><?php echo e($post->views); ?></span>
                            </div>
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
                        <div>
                            <img src="/home/images/tag.png" style="width:20px;"> ---------------------------------------------------------------------------------<br>

                        </div>
                        <div style="font-size:14px;color:red;padding-left:20px;">
                            <div style="margin-bottom:5px;">
                            注意事项：
                            </div>

                            <div style="margin-bottom:5px;">1、确认或打款前请检查发布人的真实姓名和帐户开户名是否一致；</div>
                            <div style="margin-bottom:5px;">2、检查发布人活动城市和信息发布地址是否一致；</div>
                            <div style="margin-bottom:5px;">3、交易价格偏差太大请注意信息的真实性和有效性；</div>
                            <div style="margin-bottom:5px;">4、凡是要求先款或先货的，请认真核实交易方信息，并参考对方过往信用记录；</div>
                            <div style="margin-bottom:5px;">5、点击下方“确认交易”按钮后，您即与对方签订电子合同，如无故不履行交割责任则构成违规。</div>
                        </div>
                        <div>
                            <img src="/home/images/tag.png" style="width:20px;"> ---------------------------------------------------------------------------------<br>

                        </div>

                        <form method="post" action="<?php echo e(action('DealController@confirmDeal',$post->id)); ?>">
                            <?php echo e(csrf_field()); ?>

                            <div style="padding-left:23px;font-size:14px;">
                                <input type="hidden" name="deal_id" value="<?php echo e($post->id); ?>" >
                            <?php if($post->minQuantity == $post->num): ?>
                                <input type="hidden" name="num" value="<?php echo e($post->num); ?>">
                                <input type="hidden" name="check" value="<?php echo e($post->check); ?>">
                                <div style="">

                                    <input type="hidden" id="confirm-total" name="total" value="<?php echo e($post->total); ?>" />
                                    这次交易的总金额为: <span style="color:red"><?php echo e($post->total); ?></span> 元<span
                                            style="color:#B2B2B2;font-size:13px;">计算方法：单价×数量+其他费用</span>
                                </div>
                                <?php else: ?>
                                <div style="margin-bottom:20px;">
                                    请输入交易的数量 <input type="number" id="confirm-num" name="num"
                                                    value="<?php echo e($post->minQuantity); ?>"  dj="<?php echo e($post->unitPrice); ?>"/>
                                    <span>最小确认数量为:(<?php echo e($post->minQuantity); ?>)</span>
                                    <button type="button" style="border-radius:10px;" id="confirm-all"
                                            num="<?php echo e($post->num); ?>"
                                            minNum="<?php echo e($post->minQuantity); ?>"
                                    >全部确认</button>
                                </div>
                                <div>
                                    <input type="hidden" id="confirm-total" name="total" value="0" />
                                    这次交易的总金额为: <span style="color:red" id="confirm-money">0</span> 元<span
                                            style="color:#B2B2B2;font-size:13px;">计算方法：单价×数量+其他费用</span>
                                </div>


                            <?php endif; ?>
                            </div>

                            <div style="margin-top:30px;padding-left:23px;font-size:14px;">
                                确认交易留言:
                                <textarea name="message" id="message" cols="100" rows="10"  style="resize:none"
                                >确认交易，合作愉快！</textarea>
                            </div>
                            <?php if(Auth::id() != $post->user_id && Auth::check() && $post->status == 0): ?>
                            <div id="res-btn" style="width:100%;margin-top:30px;">
                                <button class="res-btn_son btn-y" type="submit">确认交易</button>

                            </div>
                                <?php elseif(!Auth::check()): ?>
                                <div style="text-align: center;margin-top:40px;">
                                    请<a href="/login" style="color:red;">登录</a>再确认交易
                                </div>
                                <?php endif; ?>
                        </form>

                    </div>
                </div>

                <div class="owner_tips">
                    <span class="owner_time"><?php echo e($post->created_at); ?></span>
                    <span class="owner_tip">免责声明及风险提示： 所有交易人员，凡未采用本站中介交易的，被骗后果自负。</span>
                </div>
            </div>


    </div>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('js'); ?>
    <script type="text/javascript" src="/home/js/deal/details.js"></script>
    <script>
        $('#confirm-total').val(parseInt($('#confirm-num').val()) * parseInt($('#confirm-num').attr('dj')));

        $('#confirm-all').click(function(){
            $('#confirm-num').val($(this).attr('num'));
            return false;
        });

        $('#confirm-num').on('input',function(){

            if(parseInt($(this).val()) >= parseInt($('#confirm-all').attr('num'))){
                $(this).val(parseInt($('#confirm-all').attr('num')));
                layer.msg('无法再多了');
            }else if(parseInt($(this).val()) < parseInt($('#confirm-all').attr('minNum'))){

                $(this).val(parseInt($('#confirm-all').attr('minNum')));
                layer.msg('无法小于最少确认数量');
            };

            $('#confirm-money').html(parseInt($(this).val()) * parseInt($(this).attr('dj')));
            $('#confirm-total').val(parseInt($(this).val()) * parseInt($(this).attr('dj')));

        });

        $('#confirm-money').html(parseInt($('#confirm-num').val()) * parseInt($('#confirm-num').attr('dj')));

        if(parseInt($('#confirm-num').val()) == NaN){
            $('#confirm-total').val(parseInt($('#confirm-num').val()) * parseInt($('#confirm-num').attr('dj')));
        }

        $('.btn-y').click(function(){
            if($("#message").val().length <= 0){
                layer.msg('留言不能为空');
                return false;
            }
        })
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.home', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>