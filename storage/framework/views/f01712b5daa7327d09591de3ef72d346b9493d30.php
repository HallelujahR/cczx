<!DOCTYPE html>
<html>
<head>
<?php $__env->startSection('title'); ?>

<?php echo $__env->yieldSection(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
<link rel="icon" href="/favicon.ico" type="image/x-icon" />

<link rel="stylesheet" href="/home/css/personal/amazeui.min.css">

<!-- message -->
<link rel="stylesheet" href="/message/demo/demo.css"/>
<link rel="stylesheet" type="text/css" href="/message/css/default.css">
<link rel="stylesheet" href="/message/dist/css/Lobibox.min.css"/>

<!-- bootstrap -->
<link rel="stylesheet" type="text/css" href="/home/bootstrap/css/bootstrap.min.css">

<!-- 公共样式 -->
<link rel="stylesheet" type="text/css" href="/home/css/css.css">

<!-- 搜索下拉显示样式 -->
<link rel="stylesheet" type="text/css" href="/home/css/searchview.css">

<link rel="stylesheet" type="text/css" href="/layer/theme/default/layer.css">

</head>

<?php $__env->startSection('css'); ?>

<?php echo $__env->yieldSection(); ?>

<body>
<!--搜索条-->
  <div class="head" id="head">
    <div class="head_center">
      <a href="<?php echo e($config->website); ?>" class="head_logo fl"><img src="<?php echo e($config->logo); ?>" style="width:100%;height:100%;" /></a>
      <div style="width:610px;height:90px;margin-left:60px;" class="head_search_c fl">
        <div class="head_search fl">
           <div id="bdcs" style="position:relative">
             <div class="bdcs-container">
                 <div class="bdcs-main bdcs-clearfix" id="default-searchbox">
                   <div class="bdcs-search bdcs-clearfix" id="bdcs-search-inline">
                     <form action="/search" method="get" class="bdcs-search-form" id="bdcs-search-form">
                       <input type="text" name="q" class="bdcs-search-form-input" id="bdcs-search-form-input" placeholder="请输入关键词搜索" autocomplete="off" style="height: 38px; line-height: 38px;border-right:1px solid red">
                       <input type="submit" class="bdcs-search-form-submit " id="bdcs-search-form-submit" style="width:0px;" value="搜索">
                    </form>
                   </div>
                </div>
             </div>
            <!-- 搜索下拉显示部分 -->
            <div id="searchview">
                <!-- 文章 -->
                <div>
                    <div class="search-son">
                      <span class="searchTitle">文章</span>
                    </div>

                    <div class="search">
                      <div>很抱歉没有找到相关文章</div>
                    </div>
                </div>
                <!-- 帖子 -->
                <div>
                  <div class="search-son">
                    <span class="searchTitle">帖子</span>
                  </div>

                  <div class="search">
                    <div>很抱歉没有找到相关帖子</div>
                  </div>

                </div>
                <!-- 用户 -->
                <div>

                  <div class="search-son">
                    <span class="searchTitle">用户</span>
                  </div>

                  <div class="search">
                    <div>很抱歉没有找到相关用户</div>
                  </div>

                </div>
            </div>

          </div>
        </div>
 <div class="head_hot fl">
  <span>热门搜索：</span>

  <?php $__currentLoopData = $hotsearch; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <a href="<?php echo e($v->link); ?>"><?php echo e($v->name); ?></a>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

 </div>
</div>
 <div id="A1" class="fr" style="width:250px;height:80px;"></div>

 </div>
</div>

<!--项目栏-->
<div id="nav" class="nav">
  <div class="nav_center">
    <a class="nav_a" href="/" class="ooff">首页</a>
    <a class="nav_a" href="<?php echo e(action('BbsController@index')); ?>" target="_blank">论坛区</a>
    <a class="nav_a" href="<?php echo e(action('DealSonController@dealbar')); ?>" target="_blank">交易区</a>
    <?php if(Auth::check() && Auth::id()): ?>
          <a class="nav_a" href="<?php echo e(action('DealController@sell')); ?>">我要出售</a>
          <a class="nav_a" href="<?php echo e(action('DealController@buy')); ?>">我要收购</a>
    <a class="nav_a" href="<?php echo e(action('PersonalController@index',Auth::id())); ?>">个人中心</a>
    <a class="nav_a" id="index_sx_message" style="position:relative;z-index:0" login="true" phone="<?php echo e(Auth::user()
    ->phone); ?>" href="<?php echo e(action('MessageController@index')); ?>" target="_blank">私信中心
        <?php if($flag == 1): ?>
        <div id="message-noRead"></div>
            <?php endif; ?>
    </a>

    <?php endif; ?>




 <?php if(auth()->guard()->guest()): ?>
    <!-- // 用户未认证 -->
   <div style="margin-right:5px;" class="fr login" id="unlogin">
      <a href="/login">
        <span class="toolbar_no">
          <i></i>
          登录
        </span>
      </a>

      <a href="/register">
        <span class="toolbar_no">
          <i id="img-lo"></i>
          注册
        </span>
      </a>
   </div>
    <?php else: ?>
  <!-- // 用户已认证 -->
   <div style="margin-right:5px;position:relative" class="fr login" id="login">

    <div style="float:left;margin-right:20px;line-height:50px">

      <div id="tz-num" style="z-index:0;">

      </div>

      <img src="/home/images/tz.png" id="more2">
      <img src="/home/images/more.png" id="more" flag="1">

      <a href="/personal/<?php echo e(Auth::id()); ?>">
        <img src="<?php echo e(Auth::user()->avatar); ?>" id="topheadimg"/>
      </a>
    </div>
      <a id="logout" href="<?php echo e(route('logout')); ?>"
          onclick="event.preventDefault();
                   document.getElementById('logout-form').submit();">
                   <i></i>
          退出登录
      </a>

      <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
          <?php echo e(csrf_field()); ?>

      </form>

      <div id="more-menu" >
        <div class="menu-t">
          <a href="/personal/<?php echo e(Auth::id()); ?>">个人中心</a>
        </div>
        <div class="menu-t">
          <a href="<?php echo e(action('PersonalController@perfect',Auth::id())); ?>">实名认证</a>
        </div>
        <div class="menu-t">
          <a href="<?php echo e(action('DealController@personalWait',Auth::id())); ?>">我的交易</a>
        </div>
        <div class="menu-t">
          <a href="<?php echo e(action('PersonalController@password',Auth::id())); ?>">修改密码</a>
        </div>
        <div class="menu-t">
          <a href="<?php echo e(action('PublishController@article')); ?>">发布文章</a>
        </div>
      </div>

      <div id="notification-list">
        <div id="notification-title">
          消息通知
        </div>

        <?php if(Auth::user()->unreadNotifications->count() > 0): ?>
            <div style="padding:0px 10px 0px 10px" id="notification-body">
              <?php $__currentLoopData = Auth::user()->unreadNotifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <div class="notification-line">
                      <a href="<?php echo e(action('PersonalController@index',$notification->data['id'])); ?>" class="notification-name"><?php echo e($notification->data['name']); ?></a>
                      <?php echo e($notification->data['title']); ?>

                      <?php if(snake_case(class_basename($notification->type)) == 'comment_article_notification'): ?>
                        <a href="<?php echo e(action('ArticleController@index',$notification->data['article_id'])); ?>" class="notification-name" target="_blank"><?php echo e($notification->data['article']); ?></a>
                      <?php elseif(snake_case(class_basename($notification->type)) == 'reply_post_notification'): ?>
                        <a href="<?php echo e(action('BbsController@post',$notification->data['post_id'])); ?>" class="notification-name" target="_blank"><?php echo e($notification->data['post']); ?></a>
                      <?php elseif(snake_case(class_basename($notification->type)) == 'follow_user_notification'): ?>

                      <?php elseif(snake_case(class_basename($notification->type)) == 'deal_notification'): ?>
                        <a href="<?php echo e(action('DealSonController@detail',$notification->data['deal_id'])); ?>" class="notification-name" target="_blank"><?php echo e($notification->data['deal_title']); ?></a>
                      <?php endif; ?>
                      <div style="float:right;">
                        <img width="20px" class="close-img" src="/home/images/close.png" style="margin-top:5px;" user="<?php echo e(Auth::id()); ?>" nid="<?php echo e($notification->id); ?>">
                      </div>
                      <span style="margin-top:0px;margin-right:10px;"><?php echo e($notification->created_at->diffForHumans()); ?>

                      </span>
                  </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php else: ?>
        <div style="height:340px;opacity:0.2;text-align:center">
           <img class="lazy" data-original="/home/images/tz.png" width="300px;">
           <div>暂时没有新消息</div>
        </div>
        <?php endif; ?>

        <div  id="notification-look">
          <a href="<?php echo e(action('NewsController@index',Auth::id())); ?>">查看全部通知</a>
        </div>

      </div>


   </div>
<?php endif; ?>
  </div>
</div>

<div style="width:1200px;margin:0 auto;">
    <?php echo $__env->make('flash::message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</div>
<?php echo $__env->yieldContent('content'); ?>


<?php $__env->startSection('friendlink'); ?>

<?php echo $__env->yieldSection(); ?>

   <!--底部-->
<div class="foot con">
  <div id="backtop">
    <a href="javascript:void(0)">
      <img id="backtopimg" src="/home/images/backtop.png">
    </a>
  </div>
  <div class="foot_instr">

    <dl style="margin-top:20px;">
        <img style="float:left;margin-top:10px;margin-left:0px;width:200px;" class="lazy" data-original="<?php echo e($config->logo); ?>" alt="">
    </dl>
    <dl style="margin-left:50px;">
        <div style="float:left;width:100%;margin-top:70px;">
            <img  style="float:left;" class="lazy" data-original="/home/images/tell.png" alt="" width="30px">
            <span style="float:left;margin-left:10px;margin-top:5px;color:white">400-869-1980</span>
        </div>
    </dl>
    <dl style="margin-left:150px;">
        <div>
            <img class="lazy" data-original="/home/images/ewm.png" alt="" style="width:75%;height:75%;">
        </div>
        <div style="color:white;margin-top:5px;">传承网</div>
    </dl>
    <dl>
        <div>
            <img class="lazy" data-original="/home/images/ewm.png" alt="" style="width:75%;height:75%;">
        </div>
        <div style="color:white;margin-top:5px;">传承网</div>
    </dl>
    <dl>
        <div style="float:left;width:100%;margin-top:70px;">
            <img style="float:left;margin-top:5px;" class="lazy" data-original="/home/images/tell.png" alt="" width="30px">
            <div style="float:left;color:white;margin-left:10px;">
                售后及投诉热线
                <br>
                <span style="color:white;font-size:14px;">010-56261833</span>
            </div>
        </div>
    </dl>
  </div>
  <div class="foot_about">
    北京传承辉煌文化发展有限公司  <a class="sba" href="http://www.miitbeian.gov.cn" rel="nofollow" style="font-size:15px;">陕ICP备18022271号</a>
    <div class="foot_about_b">
      <img src="/home/images/footer1.jpg" id="test" alt="" height="40">
      <img src="/home/images/foot_zfb.jpg" alt="" height="40">
      <img src="/home/images/footer3.jpg" alt="" height="40">
      <a href="http://www.miitbeian.gov.cn" rel="nofollow"><img src="/home/images/ggt38.jpg" alt="" height="40"></a>
      <img src="/home/images/ggt39.jpg" alt="" height="40">
      <img src="/home/images/364176588753289160.jpg" alt="" height="40">
    </div>
  </div>
</div>

<script type="text/javascript" src="/home/js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="/home/js/search.js"></script>
<script type="text/javascript" src="/home/js/js.js"></script>
<script type="text/javascript" src="/layer/layer.js"></script>
<script type="text/javascript" src="/home/js/more.js"></script>
<script type="text/javascript" src="/home/js/lazyload.js"></script>
<script src="/message/dist/js/lobibox.min.js"></script>
<script src="https://cdn.bootcss.com/socket.io/2.0.4/socket.io.js"></script>
<?php $__env->startSection('js'); ?>

<?php echo $__env->yieldSection(); ?>
</body>
</html>
