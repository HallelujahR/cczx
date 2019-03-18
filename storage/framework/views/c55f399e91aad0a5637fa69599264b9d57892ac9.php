<div id="personal_left">
    <div id="personal_left_new">

    </div>

    <div id="personal_left_detail">
        <!-- 头像框 -->
        <div class="personal_left_photo">
            <div>
                <div <?php if($user->id == Auth::id()): ?> id="up-img-touch" <?php endif; ?> class="up-img-cover">
                    <img src="<?php echo e($user->avatar); ?>">
                    <div id="hoverphoto">
                        点击修改头像
                    </div>
                </div>
                <span id="username">
                    <?php echo e($user->name); ?>

                    <span style="font-size:12px;color:#8CC3F9;font-weight:bold;">「<?php echo e($user->role->role); ?>」</span>
                </span>
                <span id="follow_message">
                    <?php if($user->id != Auth::id()): ?>
                        <?php if(Auth::check()&&Auth::user()->followed_user($user->id)): ?>

                            <a class="follow" follow_id="<?php echo e($user->id); ?>"   login="<?php echo e(Auth::check()); ?>"
                            href="javascript:void(0)">
                                <span class='glyphicon glyphicon-minus'></span>
                                取消关注
                            </a>
                        <?php else: ?>

                            <a class="follow" follow_id="<?php echo e($user->id); ?>"  login="<?php echo e(Auth::check()); ?>" href="javascript:void(0)">
                                <span class='glyphicon glyphicon-plus'></span>
                                关注他
                            </a>
                        <?php endif; ?>
                        <a href="/message/check/<?php echo e($user->id); ?>">
                             <span class='glyphicon glyphicon-envelope' style="margin-right:3px;"></span>私信
                        </a>
                    <?php endif; ?>
                </span>


            </div>
        </div>

        <!-- 信息 -->
        <div>
            <div class="left_xk">
                <span class="left-none"><?php if(Auth::id() == $user->id): ?>我的信息<?php else: ?> 他的信息 <?php endif; ?></span>
                <a class="left_xk_a" href="<?php echo e(action('PersonalController@index',$user->id)); ?>">
                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true" style="margin-right:5px;"></span>
                    基本信息
                </a>
                <?php if(Auth::id() == $user->id): ?>
                <a class="left_xk_a" href="<?php echo e(action('PersonalController@perfect',$user->id)); ?>">
                    <span class="glyphicon glyphicon-th-list" aria-hidden="true" style="margin-right:5px;"></span>
                    实名认证
                </a>
                <a class="left_xk_a" href="<?php echo e(action('PersonalController@address',$user->id)); ?>">
                    <span class="glyphicon glyphicon-home" aria-hidden="true" style="margin-right:5px;"></span>
                    我的地址
                </a>
                <a class="left_xk_a" href="<?php echo e(action('DealController@personalWait',$user->id)); ?>">
                    <span class="glyphicon glyphicon-yen" aria-hidden="true" style="margin-right:5px;"></span>
                    我的交易
                </a>

                <a class="left_xk_a" href="<?php echo e(action('NewsController@index',$user->id)); ?>">
                    <span class="glyphicon glyphicon-volume-up" aria-hidden="true" style="margin-right:5px;"></span>
                    我的消息
                </a>
                <a class="left_xk_a" href="<?php echo e(action('PersonalController@password',Auth::id())); ?>">
                    <span class="glyphicon glyphicon-wrench" aria-hidden="true" style="margin-right:5px;"></span>
                    修改密码
                </a>
                <?php endif; ?>


            </div>
            <div class="left_xk">
                <span class="left-none"><?php if(Auth::id() == $user->id): ?>我的动态<?php else: ?> 他的动态 <?php endif; ?></span>

                <a class="left_xk_a" href="<?php echo e(action('FollowUserController@follow',$user->id)); ?>">
                    <span class="glyphicon glyphicon-eye-open" aria-hidden="true" style="margin-right:5px;"></span>
                    关注了
                </a>

                <a class="left_xk_a" href="<?php echo e(action('FollowUserController@concern',$user->id)); ?>">
                    <span class="glyphicon glyphicon-eye-open" aria-hidden="true" style="margin-right:5px;"></span>
                    关注者
                </a>

                <a class="left_xk_a" href="<?php echo e(action('PersonalController@article',$user->id)); ?>">
                    <span class="glyphicon glyphicon-edit" aria-hidden="true" style="margin-right:5px;"></span>
                    <?php if(Auth::id() == $user->id): ?>我的文章<?php else: ?> 他的文章 <?php endif; ?>
                </a>
                <a class="left_xk_a" href="<?php echo e(action('PersonalController@post',$user->id)); ?>">
                    <span class="glyphicon glyphicon-pencil" aria-hidden="true" style="margin-right:5px;"></span>
                    <?php if(Auth::id() == $user->id): ?>我的帖子<?php else: ?> 他的帖子 <?php endif; ?>
                </a>
                <a class="left_xk_a" href="<?php echo e(action('PersonalController@commentArticles',$user->id)); ?>">
                    <span class="glyphicon glyphicon-comment" aria-hidden="true" style="margin-right:5px;"></span>
                    文章的评论
                </a>
                <a class="left_xk_a" href="<?php echo e(action('PersonalController@replyPosts',$user->id)); ?>">
                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true" style="margin-right:5px;"></span>
                    帖子的回复
                </a>
            </div>
        </div>
    </div>
</div>

<!-- 修改头像 -->

        <!--图片上传框-->
        <div class="am-modal am-modal-no-btn up-modal-frame" tabindex="-1" id="up-modal-frame">
          <div class="am-modal-dialog up-frame-parent up-frame-radius">
            <div class="am-modal-hd up-frame-header">
               <label>修改头像</label>
              <a href="javascript: void(0)" class="am-close am-close-spin" data-am-modal-close>&times;</a>
            </div>
            <div class="am-modal-bd  up-frame-body">
              <div class="am-g am-fl">

                <div class="am-form-group am-form-file">
                  <div class="am-fl">
                    <button type="button" class="am-btn am-btn-default am-btn-sm">
                      <i class="am-icon-cloud-upload"></i> 选择要上传的文件</button>
                  </div>
                  <input type="file" class="up-img-file">
                </div>
              </div>
              <div class="am-g am-fl">
                <div class="up-pre-before up-frame-radius">
                    <img alt="" src="<?php echo e($user->avatar); ?>" class="up-img-show" id="up-img-show" >
                </div>
                <div class="up-pre-after up-frame-radius">
                </div>
              </div>
              <div class="am-g am-fl">
                <div class="up-control-btns">
                    <span class="am-icon-rotate-left"   id="up-btn-left"></span>
                    <span class="am-icon-rotate-right"  id="up-btn-right"></span>
                    <span class="am-icon-check up-btn-ok" url="/personal/updateAvatar"
                        parameter="{width:'170',height:'170'}">
                    </span>
                </div>
              </div>

            </div>
          </div>
        </div>

        <!--加载框-->
        <div class="am-modal am-modal-loading am-modal-no-btn" tabindex="-1" id="up-modal-loading">
          <div class="am-modal-dialog">
            <div class="am-modal-hd">正在上传...</div>
            <div class="am-modal-bd">
              <span class="am-icon-spinner am-icon-spin"></span>
            </div>
          </div>
        </div>

        <!--警告框-->
        <div class="am-modal am-modal-alert" tabindex="-1" id="up-modal-alert">
          <div class="am-modal-dialog">
            <div class="am-modal-hd">信息</div>
            <div class="am-modal-bd"  id="alert_content">
                成功了
            </div>
            <div class="am-modal-footer">
              <span class="am-modal-btn">确定</span>
            </div>
          </div>
        </div>
<!-- 结束修改头像 -->
