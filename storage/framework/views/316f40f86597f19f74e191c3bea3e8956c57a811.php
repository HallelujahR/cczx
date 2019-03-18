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
        <?php if($messages->currentPage() <= 1): ?>
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
                                    <img src="<?php echo e($post->user->avatar); ?>"  width="90" height="90"
                                         style="border-radius:45px;" class="owner_user_img">
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
                            <div class="owner_user_detail">信用积分 : <a href="<?php echo e(action('DealController@credit',$post->user->id)); ?>" target="_blank">点击查看</a></div>
                            <div class="owner_user_detail">交易次数 : <?php echo e($post->user->detail->transactionTimes); ?></div>
                            <div class="owner_user_detail">交易金额 : <?php echo e($post->user->detail->transactionAmount); ?></div>
                            <div class="owner_user_detail">好评率  : <?php echo e($post->user->mark->appreciation); ?> %</div>
                            <div class="owner_user_detail">
                                好评：<?php echo e($post->user->mark->good); ?>

                                中评：<?php echo e($post->user->mark->commonly); ?>

                                差评：<?php echo e($post->user->mark->bad); ?>

                            </div>
                        </div>
                        <div class="owner_content">
                            <div class="res" style="min-height:200px;font-size:9pt;line-height:normal;text-indent:24px;margin-top:10px;word-wrap : break-word ;word-break : break-all ;font-size:16px;" onload="this.style.overflowX='auto';">

                                <div style="width:100%;">
                                    <?php if($post->mallGoods != 0): ?>
                                    <a target="_blank" style="color:#ff6600;" href="https://www.1980cang.com/item-<?php echo e($post->mallGoods); ?>.html"> 点击查看相关商品</a>
                                    <?php endif; ?>

                                        <?php if($post->status == 1): ?>
                                            <div style="width:100%;text-align: center;font-size:30px;color:red">
                                                交割中
                                            </div>
                                        <?php elseif($post->status == 2): ?>
                                            <div style="width:100%;text-align: center;font-size:30px;color:red">
                                                交割完成
                                            </div>
                                        <?php elseif($post->status == 0): ?>
                                            <?php if($post->check == 1): ?>
                                                <div style="width:100%;text-align: center;font-size:30px;
                                            color:green;">
                                                    收购中
                                                </div>
                                            <?php else: ?>
                                                <div style="width:100%;text-align: center;font-size:30px;
                                            color:green;">
                                                    出售中
                                                </div>
                                            <?php endif; ?>
                                            <?php elseif($post->status == 10): ?>
                                            <div style="width:100%;text-align: center;font-size:30px;color:red">
                                                已撤贴！
                                            </div>
                                        <?php elseif($post->status == 4): ?>
                                            <div style="width:100%;text-align: center;font-size:30px;color:red">
                                                交割完成,双方已评分
                                            </div>
                                        <?php elseif($post->status == 3): ?>
                                            <div style="width:100%;text-align: center;font-size:30px;color:red">
                                                交割失败
                                            </div>
                                        <?php endif; ?>

                                    <?php if($post->dealstatus == 6): ?>
                                          <div style="width:100%;text-align: center;font-size:30px;color:red">
                                              交割失败
                                          </div>
                                    <?php endif; ?>
                                </div>

                                <div>
                                    交易类别：<span>
                                        <?php if($post->check == 2): ?>
                                            「出售」
                                        <?php else: ?>
                                            「收购」
                                        <?php endif; ?>
                                    </span>
                                </div>
                                <div>
                                    交易栏目: <span><?php echo e($post->cate->name); ?></span>
                                </div>
                                <div>
                                    交易ID号：<span style="color:red;"><?php echo e($post->id); ?></span>
                                </div>
                                <div>
                                    交易状态：<span>

                                            <?php if($post->status == 1): ?>
                                                <span>
                                                交割中
                                            </span>
                                            <?php elseif($post->status == 2): ?>
                                                <span>
                                                交割完成
                                            </span>
                                            <?php elseif($post->status == 0): ?>
                                                <?php if($post->check == 1): ?>
                                                    <span>
                                                    收购中
                                                </span>
                                                <?php else: ?>
                                                    <span >
                                                    出售中
                                                </span>
                                                <?php endif; ?>
                                            <?php elseif($post->status == 10): ?>
                                                <span style="color:red">
                                                已撤贴！
                                            </span>
                                            <?php elseif($post->status == 4): ?>
                                                <span style="color:red">
                                                交割完成,双方已评分
                                            </span>
                                            <?php elseif($post->status == 3): ?>
                                                <span style="color:red">
                                                交割失败
                                            </span>
                                            <?php endif; ?>

                                            <?php if($post->dealstatus == 6): ?>
                                                <span style="color:red">
                                              交割失败
                                          </span>
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
                                <div id="res-btn" style="width:100%">
                                    <?php if(Auth::id() != $post->user_id && Auth::check() && $post->status == 0 && $date
                                    != '已经过期'): ?>
                                        <a href="<?php echo e(action('DealSonController@confirm',$post->id)); ?>"><button
                                                    class="res-btn_son btn-y">确认交易</button></a>


                                    <?php elseif(!Auth::check()): ?>
                                        <div style="text-align: center;margin-top:40px;">
                                            请<a href="/login" style="color:red;">登录</a>再确认交易
                                        </div>
                                        <?php else: ?>
                                        <?php if($post->status == 1): ?>
                                        <div style="width:100%;text-align: center;font-size:30px;margin-top:10px;color:red">
                                            交割中
                                        </div>
                                            <?php elseif($post->status == 2): ?>
                                            <div style="width:100%;text-align: center;margin-top:40px;color:red">
                                                交割完成
                                            </div>
                                            <?php elseif($post->status == 0): ?>
                                            <?php if($post->check == 1): ?>
                                                <div style="width:100%;text-align: center;font-size:30px;
                                            color:green;">
                                                    收购中
                                                </div>
                                            <?php else: ?>
                                                <div style="width:100%;text-align: center;font-size:30px;
                                            color:green;">
                                                    出售中
                                                </div>
                                            <?php endif; ?>
                                            <?php elseif($post->status == 10): ?>
                                            <div style="width:100%;text-align: center;font-size:30px;margin-top:10px;color:red">
                                                已撤贴！
                                            </div>
                                            <?php endif; ?>
                                    <?php endif; ?>
                                        <?php if($post->dealstatus == 6): ?>
                                            <div style="width:100%;text-align: center;font-size:30px;color:red">
                                                交割失败
                                            </div>
                                        <?php endif; ?>
                                        <a href="<?php echo e(action('TopicController@publish',['type'=>2,'id'=>$post->id])); ?>"><button
                                                    class="res-btn_son
                                        btn-n">我要投诉</button></a>
                                </div>
                            </div>

                            <div>
                                <?php $__currentLoopData = $post->pic; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <a href="<?php echo e($v); ?>"><img src="<?php echo e($v); ?>" width="100%" alt=""></a>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <div>
                                <img src="/home/images/tag.png" style="width:20px;"> ---------------------------------------------------------------------------------<br>

                            </div>

                            <div class="user_detail_x">
                                <div class="user_detail_x_line">认证状态 :
                                    <?php if($post->user->card->status == 3): ?>
                                        <span><?php echo e($post->user->role->role); ?> <span class="rzzt">「此用户已通过实名认证，地址，银行，姓名均认证成功」</span></span>
                                    <?php else: ?>
                                        <span><?php echo e($post->user->role->role); ?> <span class="rzzt">「此用户还未实名认证」</span></span>
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

        <?php $__currentLoopData = $confirm; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="owner">

            <div class="owner_down">
                <div class="owner_detail">
                    <div class="owner_user_headpic">
                        <a href="/personal/<?php echo e($v->user->id); ?>">
                            <img src="<?php echo e($v->user->avatar); ?>"  width="90" height="90" style="border-radius:45px;" class="owner_user_img">
                        </a>
                        <div class="owner_user_name">
                            <a href="/personal/<?php echo e($v->user->id); ?>"><?php echo e($v->user->name); ?><span
                                        id="louzhu">[交易者]</span></a>
                            <br>
                            <?php if(Auth::id() != $v->user->id): ?>

                                <a <?php if(Auth::check()): ?> login="true" <?php else: ?> login="false" <?php endif; ?> href='javascript:;' class='gzuser gzuser<?php echo e($v->user->id); ?>' follow_id="<?php echo e($v->user->id); ?>"><?php echo Auth::check()&&Auth::user()->followed_user($v->user->id) ? "<span class='glyphicon glyphicon-minus'></span><span style='margin-left:5px'>已关注</span>" : "<span class='glyphicon glyphicon-plus'></span><span style='margin-left:5px'>关注他</span>"; ?></a>

                                <a href="/message/check/<?php echo e($v->user->id); ?>">
                                    <span class='glyphicon glyphicon-envelope' style="margin-left:2px;margin-right:5px;font-size:14px;"></span>私信
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="owner_user_detail">
                        身份：<?php echo e($v->user->role->role); ?>

                    </div>
                    <div class="owner_user_detail">性别 : <?php if($v->user->detail->sex == 0): ?>女 <?php else: ?> 男 <?php endif; ?></div>
                    <?php if($v->user->birthday != 0): ?>
                        <div class="owner_user_detail">生日 : <?php echo e($v->user->birthday); ?></div>
                    <?php endif; ?>

                    <?php if($v->user->email != '0'): ?>
                        <div class="owner_user_detail">邮箱 : <?php echo e($v->user->detail->email); ?></div>
                    <?php endif; ?>

                    <div class="owner_user_detail">发帖次数 : <?php echo e($v->user->posts->count()); ?></div>
                    <div class="owner_user_detail">回帖次数 : <?php echo e($v->user->replies->count()); ?></div>
                    <div class="owner_user_detail">注册日期 : <?php echo e($v->user->created_at); ?></div>
                    <div class="owner_user_detail">信用积分 : <a href="<?php echo e(action('DealController@credit',$v->user->id)); ?>" target="_blank">点击查看</a></div>
                    <div class="owner_user_detail">交易次数 : <?php echo e($v->user->detail->transactionTimes); ?></div>
                    <div class="owner_user_detail">交易金额 : <?php echo e($v->user->detail->transactionAmount); ?></div>
                    <div class="owner_user_detail">好评率  : <?php echo e($v->user->mark->appreciation); ?></div>
                    <div class="owner_user_detail">
                        好评：<?php echo e($v->user->mark->good); ?>

                        中评：<?php echo e($v->user->mark->commonly); ?>

                        差评：<?php echo e($v->user->mark->bad); ?>

                    </div>
                </div>
                <div class="owner_content">
                    <div class="res" style="min-height:200px;font-size:9pt;line-height:normal;text-indent:24px;margin-top:10px;word-wrap : break-word ;word-break : break-all ;font-size:16px;" onload="this.style.overflowX='auto';">
                        <?php echo e($v->message); ?>

                    </div>

                    <?php if($post->status == 1): ?>
                        <div style="width:100%;text-align: center;font-size:30px;color:red">
                            交割中
                        </div>
                    <?php elseif($post->status == 2): ?>
                        <div style="width:100%;text-align: center;font-size:30px;color:red">
                            交割完成
                        </div>
                    <?php elseif($post->status == 0): ?>
                        <div style="width:100%;text-align: center;font-size:30px;
                                            color:green;">
                            出售中
                        </div>
                    <?php endif; ?>
                    <div>
                        <img src="/home/images/tag.png" style="width:20px;"> ---------------------------------------------------------------------------------<br>

                    </div>

                    <div class="user_detail_x">
                        <div class="user_detail_x_line">认证状态 :
                            <?php if($v->user->card->status == 3): ?>
                                <span><?php echo e($v->user->role->role); ?> <span class="rzzt">「此用户已通过实名认证，地址，银行，姓名均认证成功」</span></span>
                            <?php else: ?>
                                <span><?php echo e($v->user->role->role); ?> <span class="rzzt">「此用户还未实名认证」</span></span>
                            <?php endif; ?>
                        </div>

                        <?php if($v->user->card->realName != '0'): ?>
                            <div class="user_detail_x_line">姓 名 : <span><?php echo e($v->user->card->realName); ?></span></div>
                        <?php endif; ?>

                        <?php $__currentLoopData = $v->user->addresses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="user_detail_x_line">地 址<?php echo e($k+1); ?> : <span> <?php echo e($v['province']); ?><?php echo e($v['city']); ?><?php echo e($v['county']); ?><?php echo e($v['street']); ?> </span></div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <div class="user_detail_x_line">手 机 : <span><?php echo e($v->user->phone); ?>


					</span></div>


                        <?php $__currentLoopData = $v->user->banks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k1 => $v1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="user_detail_x_line">银 行<?php echo e($k1+1); ?> : <span><?php echo e($v1['cateBank']); ?>&nbsp; &nbsp;
                                    <?php echo e($v1['bankId']); ?> &nbsp; &nbsp; <?php echo e($v1['bankName']); ?>  &nbsp; &nbsp;
                                    <?php echo e($v1['tel']); ?></span></div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <?php if($v->user->detail->alipay != '0'): ?>
                            <div class="user_detail_x_line">支付宝 : <span><?php echo e($v->user->detail->alipay); ?></span></div>
                        <?php endif; ?>

                        <?php if($v->user->detail->vx != '0'): ?>
                            <div class="user_detail_x_line">微 信 : <span><?php echo e($v->user->detail->vx); ?></span></div>
                        <?php endif; ?>

                        <?php if($v->user->detail->qq != '0'): ?>
                            <div class="user_detail_x_line"> Q Q : <span><?php echo e($v->user->detail->qq); ?></span></div>
                        <?php endif; ?>

                    </div>
                </div>
            </div>

            <div class="owner_tips">
                <span class="owner_time"><?php echo e($v->created_at); ?></span>
                <span class="owner_tip">免责声明及风险提示： 所有交易人员，凡未采用本站中介交易的，被骗后果自负。</span>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <?php if($post->myconfirm == 1): ?>
            <div class="owner">
                <div class="owner_down">
                    <div class="owner_detail">
                        <div class="owner_user_headpic">
                            <a href="/personal/<?php echo e($post->user->id); ?>">
                                <img src="<?php echo e($post->user->avatar); ?>"  width="90" height="90" style="border-radius:45px;" class="owner_user_img">
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
                        <div class="owner_user_detail">
                            好评：<?php echo e($post->user->mark->good); ?>

                            中评：<?php echo e($post->user->mark->commonly); ?>

                            差评：<?php echo e($post->user->mark->bad); ?>

                        </div>
                    </div>
                    <div class="owner_content">
                        <div class="res" style="min-height:200px;font-size:9pt;line-height:normal;text-indent:24px;margin-top:10px;word-wrap : break-word ;word-break : break-all ;font-size:16px;" onload="this.style.overflowX='auto';">
                            <?php echo e($post->user->name); ?> 已经确认交割
                        </div>

                        <div>
                            <?php $__currentLoopData = $post->pic; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a href="<?php echo e($v); ?>"><img src="<?php echo e($v); ?>" width="100%" alt=""></a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <div>
                            <img src="/home/images/tag.png" style="width:20px;"> ---------------------------------------------------------------------------------<br>

                        </div>

                        <div class="user_detail_x">
                            <div class="user_detail_x_line">认证状态 :
                                <?php if($post->user->card->status == 3): ?>
                                    <span><?php echo e($post->user->role->role); ?> <span class="rzzt">「此用户已通过实名认证，地址，银行，姓名均认证成功」</span></span>
                                <?php else: ?>
                                    <span><?php echo e($post->user->role->role); ?> <span class="rzzt">「此用户还未实名认证」</span></span>
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

        <?php if($post->youconfirm == 1): ?>
            <?php $__currentLoopData = $confirm; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="owner">

                    <div class="owner_down">
                        <div class="owner_detail">
                            <div class="owner_user_headpic">
                                <a href="/personal/<?php echo e($v->user->id); ?>">
                                    <img src="<?php echo e($v->user->avatar); ?>"  width="90" height="90" style="border-radius:45px;" class="owner_user_img">
                                </a>
                                <div class="owner_user_name">
                                    <a href="/personal/<?php echo e($v->user->id); ?>"><?php echo e($v->user->name); ?><span
                                                id="louzhu">[交易者]</span></a>
                                    <br>
                                    <?php if(Auth::id() != $v->user->id): ?>

                                        <a <?php if(Auth::check()): ?> login="true" <?php else: ?> login="false" <?php endif; ?> href='javascript:;' class='gzuser gzuser<?php echo e($v->user->id); ?>' follow_id="<?php echo e($v->user->id); ?>"><?php echo Auth::check()&&Auth::user()->followed_user($v->user->id) ? "<span class='glyphicon glyphicon-minus'></span><span style='margin-left:5px'>已关注</span>" : "<span class='glyphicon glyphicon-plus'></span><span style='margin-left:5px'>关注他</span>"; ?></a>

                                        <a href="/message/check/<?php echo e($v->user->id); ?>">
                                            <span class='glyphicon glyphicon-envelope' style="margin-left:2px;margin-right:5px;font-size:14px;"></span>私信
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="owner_user_detail">
                                身份：<?php echo e($v->user->role->role); ?>

                            </div>
                            <div class="owner_user_detail">性别 : <?php if($v->user->detail->sex == 0): ?>女 <?php else: ?> 男 <?php endif; ?></div>
                            <?php if($v->user->birthday != 0): ?>
                                <div class="owner_user_detail">生日 : <?php echo e($v->user->birthday); ?></div>
                            <?php endif; ?>

                            <?php if($v->user->email != '0'): ?>
                                <div class="owner_user_detail">邮箱 : <?php echo e($v->user->detail->email); ?></div>
                            <?php endif; ?>

                            <div class="owner_user_detail">发帖次数 : <?php echo e($v->user->posts->count()); ?></div>
                            <div class="owner_user_detail">回帖次数 : <?php echo e($v->user->replies->count()); ?></div>
                            <div class="owner_user_detail">注册日期 : <?php echo e($v->user->created_at); ?></div>
                            <div class="owner_user_detail">信用积分 : <?php echo e($v->user->detail->creditscore); ?></div>
                            <div class="owner_user_detail">交易次数 : <?php echo e($v->user->detail->transactionTimes); ?></div>
                            <div class="owner_user_detail">交易金额 : <?php echo e($v->user->detail->transactionAmount); ?></div>
                            <div class="owner_user_detail">好评率  : <?php echo e($v->user->mark->appreciation); ?></div>
                            <div class="owner_user_detail">
                                好评：<?php echo e($v->user->mark->good); ?>

                                中评：<?php echo e($v->user->mark->commonly); ?>

                                差评：<?php echo e($v->user->mark->bad); ?>

                            </div>
                        </div>
                        <div class="owner_content">
                            <div class="res" style="min-height:200px;font-size:9pt;line-height:normal;text-indent:24px;margin-top:10px;word-wrap : break-word ;word-break : break-all ;font-size:16px;" onload="this.style.overflowX='auto';">

                                <?php echo e($v->user->name); ?> 已经确认交割
                            </div>

                            <?php if($post->status == 1): ?>
                                <div style="width:100%;text-align: center;font-size:30px;color:red">
                                    交割中
                                </div>
                            <?php elseif($post->status == 2): ?>
                                <div style="width:100%;text-align: center;font-size:30px;color:red">
                                    交割完成
                                </div>
                            <?php elseif($post->status == 0): ?>
                                <div style="width:100%;text-align: center;font-size:30px;
                                            color:green;">
                                    出售中
                                </div>
                            <?php endif; ?>
                            <div>
                                <img src="/home/images/tag.png" style="width:20px;"> ---------------------------------------------------------------------------------<br>

                            </div>

                            <div class="user_detail_x">
                                <div class="user_detail_x_line">认证状态 :
                                    <?php if($v->user->card->status == 3): ?>
                                        <span><?php echo e($v->user->role->role); ?> <span class="rzzt">「此用户已通过实名认证，地址，银行，姓名均认证成功」</span></span>
                                    <?php else: ?>
                                        <span><?php echo e($v->user->role->role); ?> <span class="rzzt">「此用户还未实名认证」</span></span>
                                    <?php endif; ?>
                                </div>

                                <?php if($v->user->card->realName != '0'): ?>
                                    <div class="user_detail_x_line">姓 名 : <span><?php echo e($v->user->card->realName); ?></span></div>
                                <?php endif; ?>

                                <?php $__currentLoopData = $v->user->addresses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="user_detail_x_line">地 址<?php echo e($k+1); ?> : <span> <?php echo e($v['province']); ?><?php echo e($v['city']); ?><?php echo e($v['county']); ?><?php echo e($v['street']); ?> </span></div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                <div class="user_detail_x_line">手 机 : <span><?php echo e($v->user->phone); ?>


					</span></div>


                                <?php $__currentLoopData = $v->user->banks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k1 => $v1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="user_detail_x_line">银 行<?php echo e($k1+1); ?> : <span><?php echo e($v1['cateBank']); ?>&nbsp; &nbsp;
                                            <?php echo e($v1['bankId']); ?> &nbsp; &nbsp; <?php echo e($v1['bankName']); ?>  &nbsp; &nbsp;
                                            <?php echo e($v1['tel']); ?></span></div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                <?php if($v->user->detail->alipay != '0'): ?>
                                    <div class="user_detail_x_line">支付宝 : <span><?php echo e($v->user->detail->alipay); ?></span></div>
                                <?php endif; ?>

                                <?php if($v->user->detail->vx != '0'): ?>
                                    <div class="user_detail_x_line">微 信 : <span><?php echo e($v->user->detail->vx); ?></span></div>
                                <?php endif; ?>

                                <?php if($v->user->detail->qq != '0'): ?>
                                    <div class="user_detail_x_line"> Q Q : <span><?php echo e($v->user->detail->qq); ?></span></div>
                                <?php endif; ?>

                            </div>
                        </div>
                    </div>

                    <div class="owner_tips">
                        <span class="owner_time"><?php echo e($v->created_at); ?></span>
                        <span class="owner_tip">免责声明及风险提示： 所有交易人员，凡未采用本站中介交易的，被骗后果自负。</span>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>

        <?php $__currentLoopData = $mark; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="owner">

                <div class="owner_down">
                    <div class="owner_detail">
                        <div class="owner_user_headpic">
                            <a href="/personal/<?php echo e($v->fromuser->id); ?>">
                                <img src="<?php echo e($v->fromuser->avatar); ?>"  width="90" height="90" style="border-radius:45px;" class="owner_user_img">
                            </a>
                            <div class="owner_user_name">
                                <a href="/personal/<?php echo e($v->fromuser->id); ?>"><?php echo e($v->fromuser->name); ?><span
                                            id="louzhu">[交易者]</span></a>
                                <br>
                                <?php if(Auth::id() != $v->fromuser->id): ?>

                                    <a <?php if(Auth::check()): ?> login="true" <?php else: ?> login="false" <?php endif; ?> href='javascript:;'
                                       class='gzuser gzuser<?php echo e($v->fromuser->id); ?>' follow_id="<?php echo e($v->fromuser->id); ?>"><?php echo Auth::check()&&Auth::user()->followed_user($v->fromuser->id) ? "<span class='glyphicon glyphicon-minus'></span><span style='margin-left:5px'>已关注</span>" : "<span class='glyphicon glyphicon-plus'></span><span style='margin-left:5px'>关注他</span>"; ?></a>

                                    <a href="/message/check/<?php echo e($v->fromuser->id); ?>">
                                        <span class='glyphicon glyphicon-envelope' style="margin-left:2px;margin-right:5px;font-size:14px;"></span>私信
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="owner_user_detail">
                            身份：<?php echo e($v->fromuser->role->role); ?>

                        </div>
                        <div class="owner_user_detail">性别 : <?php if($v->fromuser->detail->sex == 0): ?>女 <?php else: ?> 男 <?php endif; ?></div>
                        <?php if($v->fromuser->birthday != 0): ?>
                            <div class="owner_user_detail">生日 : <?php echo e($v->fromuser->birthday); ?></div>
                        <?php endif; ?>

                        <?php if($v->fromuser->email != '0'): ?>
                            <div class="owner_user_detail">邮箱 : <?php echo e($v->fromuser->detail->email); ?></div>
                        <?php endif; ?>

                        <div class="owner_user_detail">发帖次数 : <?php echo e($v->fromuser->posts->count()); ?></div>
                        <div class="owner_user_detail">回帖次数 : <?php echo e($v->fromuser->replies->count()); ?></div>
                        <div class="owner_user_detail">注册日期 : <?php echo e($v->fromuser->created_at); ?></div>
                        <div class="owner_user_detail">信用积分 : <a href="<?php echo e(action('DealController@credit',$v->fromuser->id)); ?>" target="_blank">点击查看</a></div>
                        <div class="owner_user_detail">交易次数 : <?php echo e($v->fromuser->detail->transactionTimes); ?></div>
                        <div class="owner_user_detail">交易金额 : <?php echo e($v->fromuser->detail->transactionAmount); ?></div>
                        <div class="owner_user_detail">好评率  : <?php echo e($v->fromuser->mark->appreciation); ?></div>
                        <div class="owner_user_detail">
                            好评：<?php echo e($v->fromuser->mark->good); ?>

                            中评：<?php echo e($v->fromuser->mark->commonly); ?>

                            差评：<?php echo e($v->fromuser->mark->bad); ?>

                        </div>
                    </div>
                    <div class="owner_content">
                        <div class="res" style="min-height:200px;font-size:9pt;line-height:normal;text-indent:24px;margin-top:10px;word-wrap : break-word ;word-break : break-all ;font-size:16px;" onload="this.style.overflowX='auto';">
                            给对方评分 <?php echo e($v->mark); ?> 分
                            <br>
                            <?php echo e($v->message); ?>

                        </div>


                        <div>
                            <img src="/home/images/tag.png" style="width:20px;"> ---------------------------------------------------------------------------------<br>

                        </div>

                        <div class="user_detail_x">
                            <div class="user_detail_x_line">认证状态 :
                                <?php if($v->fromuser->card->status == 3): ?>
                                    <span><?php echo e($v->fromuser->role->role); ?> <span class="rzzt">「此用户已通过实名认证，地址，银行，姓名均认证成功」</span></span>
                                <?php else: ?>
                                    <span><?php echo e($v->fromuser->role->role); ?> <span class="rzzt">「此用户还未实名认证」</span></span>
                                <?php endif; ?>
                            </div>

                            <?php if($v->fromuser->card->realName != '0'): ?>
                                <div class="user_detail_x_line">姓 名 : <span><?php echo e($v->fromuser->card->realName); ?></span></div>
                            <?php endif; ?>

                            <?php $__currentLoopData = $v->fromuser->addresses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k2 => $v2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="user_detail_x_line">地 址<?php echo e($k2+1); ?> : <span>
                                        <?php echo e($v2['province']); ?><?php echo e($v2['city']); ?><?php echo e($v2['county']); ?><?php echo e($v2['street']); ?>

                                    </span></div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            <div class="user_detail_x_line">手 机 : <span><?php echo e($v->fromuser->phone); ?>


					</span></div>


                            <?php $__currentLoopData = $v->fromuser->banks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k1 => $v1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="user_detail_x_line">银 行<?php echo e($k1+1); ?> : <span><?php echo e($v1['cateBank']); ?>&nbsp; &nbsp;
                                        <?php echo e($v1['bankId']); ?> &nbsp; &nbsp; <?php echo e($v1['bankName']); ?>  &nbsp; &nbsp;
                                        <?php echo e($v1['tel']); ?></span></div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            <?php if($v->fromuser->detail->alipay != '0'): ?>
                                <div class="user_detail_x_line">支付宝 : <span><?php echo e($v->fromuser->detail->alipay); ?></span></div>
                            <?php endif; ?>

                            <?php if($v->fromuser->detail->vx != '0'): ?>
                                <div class="user_detail_x_line">微 信 : <span><?php echo e($v->fromuser->detail->vx); ?></span></div>
                            <?php endif; ?>

                            <?php if($v->fromuser->detail->qq != '0'): ?>
                                <div class="user_detail_x_line"> Q Q : <span><?php echo e($v->fromuser->detail->qq); ?></span></div>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>

                <div class="owner_tips">
                    <span class="owner_time"><?php echo e($v->created_at); ?></span>
                    <span class="owner_tip">免责声明及风险提示： 所有交易人员，凡未采用本站中介交易的，被骗后果自负。</span>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


        <?php if($gljy): ?>
        <div class="owner" >
            <div>关联交易 (同一个买卖盘拆分出来的相关交易)</div>

            <div style="margin-top:10px;">
                <?php $__currentLoopData = $gljy; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div style="margin-top:10px;">
                        <a target="_blank" href="<?php echo e(action('DealSonController@detail',$v->id)); ?>"><?php echo e($v->shopName); ?>(<?php echo e($v->productPhase); ?>)<?php echo e($v->num); ?><?php echo e($v->unit); ?>

                        单价:<?php echo e($v->unitPrice); ?>元 </a>
                        <a target="_blank" href="/personal/<?php echo e($v->confirm->user->id); ?>"><span
                                    style="color:red"><?php echo e($v->confirm->user->name); ?></span></a>
                        <span>于<?php echo e($v->confirm->created_at); ?>交易</span>

                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php $__currentLoopData = $sy; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div style="margin-top:10px;">
                    <a href="<?php echo e(action('DealSonController@detail',$v->id)); ?>">剩余：<?php echo e($v->num); ?> <?php echo e($v->unit); ?></a>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        <?php endif; ?>


        <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <div class="owner">

                <div class="owner_down">
                    <div class="owner_detail">
                        <div class="owner_user_headpic">
                            <a href="/personal/<?php echo e($v->user->id); ?>">
                                <img src="<?php echo e($v->user->avatar); ?>"  width="90" height="90" style="border-radius:45px;" class="owner_user_img">
                            </a>
                            <div class="owner_user_name">
                                <a href="/personal/<?php echo e($v->user->id); ?>"><?php echo e($v->user->name); ?><span
                                            id="louzhu">[留言]</span></a>
                                <br>
                                <?php if(Auth::id() != $v->user->id): ?>

                                    <a <?php if(Auth::check()): ?> login="true" <?php else: ?> login="false" <?php endif; ?> href='javascript:;' class='gzuser gzuser<?php echo e($v->user->id); ?>' follow_id="<?php echo e($v->user->id); ?>"><?php echo Auth::check()&&Auth::user()->followed_user($v->user->id) ? "<span class='glyphicon glyphicon-minus'></span><span style='margin-left:5px'>已关注</span>" : "<span class='glyphicon glyphicon-plus'></span><span style='margin-left:5px'>关注他</span>"; ?></a>

                                    <a href="/message/check/<?php echo e($v->user->id); ?>">
                                        <span class='glyphicon glyphicon-envelope' style="margin-left:2px;margin-right:5px;font-size:14px;"></span>私信
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="owner_user_detail">
                            身份：<?php echo e($v->user->role->role); ?>

                        </div>
                        <div class="owner_user_detail">性别 : <?php if($v->user->detail->sex == 0): ?>女 <?php else: ?> 男 <?php endif; ?></div>
                        <?php if($v->user->birthday != 0): ?>
                            <div class="owner_user_detail">生日 : <?php echo e($v->user->birthday); ?></div>
                        <?php endif; ?>

                        <?php if($v->user->email != '0'): ?>
                            <div class="owner_user_detail">邮箱 : <?php echo e($v->user->detail->email); ?></div>
                        <?php endif; ?>

                        <div class="owner_user_detail">发帖次数 : <?php echo e($v->user->posts->count()); ?></div>
                        <div class="owner_user_detail">回帖次数 : <?php echo e($v->user->replies->count()); ?></div>
                        <div class="owner_user_detail">注册日期 : <?php echo e($v->user->created_at); ?></div>
                        <div class="owner_user_detail">信用积分 : <?php echo e($v->user->detail->creditscore); ?></div>
                        <div class="owner_user_detail">交易次数 : <?php echo e($v->user->detail->transactionTimes); ?></div>
                        <div class="owner_user_detail">交易金额 : <?php echo e($v->user->detail->transactionAmount); ?></div>
                        <div class="owner_user_detail">好评率  : <?php echo e($v->user->mark->appreciation); ?></div>
                        <div class="owner_user_detail">
                            好评：<?php echo e($v->user->mark->good); ?>

                            中评：<?php echo e($v->user->mark->commonly); ?>

                            差评：<?php echo e($v->user->mark->bad); ?>

                        </div>
                    </div>
                    <div class="owner_content">
                        <div class="res" style="min-height:200px;font-size:9pt;line-height:normal;text-indent:24px;margin-top:10px;word-wrap : break-word ;word-break : break-all ;font-size:16px;" onload="this.style.overflowX='auto';">
                           <?php echo e($v->message); ?>

                        </div>


                        <div>
                            <img src="/home/images/tag.png" style="width:20px;"> ---------------------------------------------------------------------------------<br>

                        </div>

                        <div class="user_detail_x">
                            <div class="user_detail_x_line">认证状态 :
                                <?php if($v->user->card->status == 3): ?>
                                    <span><?php echo e($v->user->role->role); ?> <span class="rzzt">「此用户已通过实名认证，地址，银行，姓名均认证成功」</span></span>
                                <?php else: ?>
                                    <span><?php echo e($v->user->role->role); ?> <span class="rzzt">「此用户还未实名认证」</span></span>

                                <?php endif; ?>
                            </div>

                            <?php if($v->user->card->realName != '0'): ?>
                                <div class="user_detail_x_line">姓 名 : <span><?php echo e($v->user->card->realName); ?></span></div>
                            <?php endif; ?>

                            <?php $__currentLoopData = $v->user->addresses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="user_detail_x_line">地 址<?php echo e($k+1); ?> : <span> <?php echo e($v['province']); ?><?php echo e($v['city']); ?><?php echo e($v['county']); ?><?php echo e($v['street']); ?> </span></div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            <div class="user_detail_x_line">手 机 : <span><?php echo e($v->user->phone); ?>


					</span></div>


                            <?php $__currentLoopData = $v->user->banks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k1 => $v1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="user_detail_x_line">银 行<?php echo e($k1+1); ?> : <span><?php echo e($v1['cateBank']); ?>&nbsp; &nbsp;
                                        <?php echo e($v1['bankId']); ?> &nbsp; &nbsp; <?php echo e($v1['bankName']); ?>  &nbsp; &nbsp;
                                        <?php echo e($v1['tel']); ?></span></div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            <?php if($v->user->detail->alipay != '0'): ?>
                                <div class="user_detail_x_line">支付宝 : <span><?php echo e($v->user->detail->alipay); ?></span></div>
                            <?php endif; ?>

                            <?php if($v->user->detail->vx != '0'): ?>
                                <div class="user_detail_x_line">微 信 : <span><?php echo e($v->user->detail->vx); ?></span></div>
                            <?php endif; ?>

                            <?php if($v->user->detail->qq != '0'): ?>
                                <div class="user_detail_x_line"> Q Q : <span><?php echo e($v->user->detail->qq); ?></span></div>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>

                <div class="owner_tips">
                    <span class="owner_time"><?php echo e($v->created_at); ?></span>
                    <span class="owner_tip">免责声明及风险提示： 所有交易人员，凡未采用本站中介交易的，被骗后果自负。</span>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



        <?php echo e($messages->links()); ?>


        <div id="match" >
            <div class="other-title">
                <?php echo e($post->shopName); ?>买卖盘配对
            </div>
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
                    <div style="font-size:15px;padding-left:10px;">
                        <a style="color:#ff6600" href="<?php echo e(action('DealSonController@trade',
                        ['shopName'=>$post['shopName']])); ?>" target="_blank">更多买盘</a>
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
                    <div style="font-size:15px;padding-left:10px;">
                        <a style="color:#ff6600" href="<?php echo e(action('DealSonController@trade',
                        ['shopName'=>$post['shopName']])); ?>" target="_blank">更多卖盘</a>
                    </div>
                </div>
            </div>
        </div>


        <div id="match" style="margin-top:20px;">
            <div class="other-title">
                <?php echo e($post->shopName); ?>最新成交
            </div>
            <div class="other-body newDeal" style="display: flex;flex-direction: column;">
                <div style="display: flex;flex-direction: row;">
                    <div style="width: 50%;">
                        标题
                    </div>
                    <div style="width: 15%;">
                        发布人
                    </div>
                    <div style="width: 10%;">
                        交易人
                    </div>
                    <div style="width: 20%;">
                        成交时间
                    </div>
                    <div style="width: 15%;">
                        状态
                    </div>
                </div>
                <div style="display: flex;flex-direction: column;">
                    <?php $__currentLoopData = $newDeal; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div style="display: flex;flex-direction: row;font-size:14px;margin-top:10px;line-height:35px;">
                        <div style="width: 50%;  overflow: hidden;white-space: nowrap;text-overflow:ellipsis;">
                            <?php if($v->check == 1): ?>
                                <span  class="newDeal_buy">买</span>
                            <?php else: ?>
                                <span class="newDeal_sell">卖</span>
                            <?php endif; ?>
                           <a href="" style="color:#f4b43f;margin-left:10px;">
                               <?php echo e($v->shopName); ?>

                               <?php echo e($v->productPhase); ?>

                               <?php echo e($v->num); ?> <?php echo e($v->unit); ?>

                               单价：<?php echo e($v->unitPrice); ?>


                               <?php $__currentLoopData = $v['deliveryMethods']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k1 => $v1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                   <?php echo e($v1); ?>

                               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </a>
                        </div>
                        <div style="width: 15%;">
                            <a href="/personal/<?php echo e($v->user->id); ?>"><?php echo e($v->user->name); ?></a>

                        </div>
                        <div style="width: 10%;">
                            <a href="/personal/<?php echo e($v->confirm->user->id); ?>"><?php echo e($v->confirm->user->name); ?></a>
                        </div>
                        <div style="width: 20%;">
                            <?php echo e($v->confirm->created_at); ?>

                        </div>
                        <div style="width: 15%;">
                                <?php if($v->status == 0): ?>
                                    等待交易
                                <?php elseif($v->status == 1): ?>
                                    确认交易
                                <?php elseif($v->status == 2): ?>
                                    对方确认交割
                                <?php elseif($v->status == 3): ?>
                                    交易失败
                                <?php elseif($v->status == 4): ?>
                                    交割成功，已评分
                                <?php endif; ?>
                        </div>

                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div style="font-size:15px;padding-left:10px;margin-top:20px;">
                    <a href="<?php echo e(action('DealSonController@trade',['shopName'=>$post['shopName']])); ?>"
                       style="color:#ff6600" target="_blank">更多成交</a>
                </div>
            </div>
        </div>

        <div id="match" style="margin-top:20px;" >
            <div class="other-title">
                <?php echo e($post->cate->name); ?>相关
            </div>
            <div class="other-body">
                <div class="other-body_left other-body_son" style="border-right: 1px solid #F0F0F0;">
                    <div style="  text-align: center;"> <?php echo e($post->cate->name); ?>最新买卖盘 <a style="color:#ff6600;
                    font-size:14px" href="<?php echo e(action('DealSonController@trade',['id'=>$post->cate->id])); ?>" target="_blank">更多</a></div>
                    <div class="other-body_son_body">
                        <?php $__currentLoopData = $cateDeal['newDeal']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div style="line-height:30px;border-bottom:1px solid #F0F0F0">
                                <?php if($v->check == 1): ?>
                                    <span  class="newDeal_buy">买</span>
                                <?php else: ?>
                                    <span class="newDeal_sell">卖</span>
                                <?php endif; ?>
                                <a style="padding-left:10px;" href="<?php echo e(action('DealSonController@detail',$v->id)); ?>"><span><?php echo e($v->shopName); ?> 单价:
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
                    <div style="  text-align: center;"> <?php echo e($post->cate->name); ?>最新买成交   <a style="color:#ff6600;
                    font-size:14px" href="<?php echo e(action('DealSonController@trade',['id'=>$post->cate->id])); ?>" target="_blank">更多</a></div>
                    <div class="other-body_son_body">
                        <?php $__currentLoopData = $cateDeal['newConfirm']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div  style="line-height:30px;border-bottom:1px solid #F0F0F0">
                                <?php if($v->check == 1): ?>
                                    <span  class="newDeal_buy">买</span>
                                <?php else: ?>
                                    <span class="newDeal_sell">卖</span>
                                <?php endif; ?>
                                <a   style="padding-left:10px;"  href="<?php echo e(action('DealSonController@detail',$v->id)); ?>"><span><?php echo e($v->shopName); ?> 单价:
                                        <?php echo e($v->unitPrice); ?>

                                        <?php $__currentLoopData = $v['deliveryMethods']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k1 => $v1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php echo e($v1); ?>

                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    </span></a>

                                <span >（<a
                                            href="/personal/<?php echo e($v->id); ?>" style="color:red"><?php echo e($v->confirm->user->name); ?></a></span>
                                <span>于<?php echo e($v->confirm->created_at); ?>成交</span>）
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>

        <div style="float:left;width:100%;padding:0px;">
            <?php if(Auth::check() && Auth::user()): ?>
                <div id="plArticle">
                    <div>
                        <form id="form" class="form-horizontal" action="<?php echo e(action('DealSonController@message')); ?>"
                              method="post">
                            <?php echo e(csrf_field()); ?>

                            <input type="hidden" name="deal_id" value="<?php echo e($post->id); ?>">
                            <div id='detail'></div>
                            <textarea id="text1" name='message' style="width:100%; height:200px;"></textarea>
                            <button flag="1" style="background-color:#7FB4CB;margin-top:10px;" type="submit"
                                    class="btn btn-info btn-block" id="comment-commit">留言</button>
                        </form>
                    </div>
                </div>
                <?php else: ?>
                <div style="text-align:center;margin-top:10px;margin-bottom:20px;">
                    <a target="_blank" href="/login" style="color:red">登录</a>后才能进行留言
                </div>
            <?php endif; ?>
        </div>

    </div>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('js'); ?>
    <script type="text/javascript" src="/home/js/deal/details.js"></script>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.home', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>