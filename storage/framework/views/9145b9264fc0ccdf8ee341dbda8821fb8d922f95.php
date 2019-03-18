<?php $__env->startSection('title'); ?>
<title><?php echo e($article->title); ?>[传承网]</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<!-- 文章详情页样式 -->
<link rel="stylesheet" type="text/css" href="/home/css/detail.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div id="detail_con">
    <!-- 左栏 -->
    <div id="detail_left">

        <!-- 导航图 -->
        <div class="detail_dh">
            <span>您的当前位置:</span>
            <a href="/"> 传承资讯首页</a>
            <span>></span>
            <?php if($article->cate->pid == 0): ?>
            <a href="<?php echo e(action('CateController@index',$article->cate_id)); ?>"> <?php echo e($article->cate->cate); ?></a>
            <span>></span>
            <?php else: ?>
            <a href="<?php echo e(action('CateController@index',getCateName($article->cate->pid)->id)); ?>"> <?php echo e(getCateName($article->cate->pid)->cate); ?></a>
            <span>></span>
            <a href="<?php echo e(action('CateController@index',$article->cate_id)); ?>"> <?php echo e($article->cate->cate); ?></a>
            <span>></span>
            <?php endif; ?>
        </div>

        <!-- 文章标题 -->
        <h1 id="title"><?php echo e($article->title); ?></h1>

        <!-- 文章信息 -->
        <div class="detail_detail">
            <div></div>
            <span><?php echo e(date('Y-m-d',$article->time)); ?></span>
            <div></div>
            <span><a href="<?php echo e(action('PersonalController@index',$article->user->id)); ?>" style="color:#979797"><?php echo e($article->user->name); ?></a></span>
            <div></div>
            <span><?php echo e($article->access_count); ?>浏览</span>
            <span>
                <?php if(Auth::id() != $article->user->id): ?>

                <a <?php if(Auth::check()): ?>
                    login="true"
                   <?php else: ?>
                    login="false"
                   <?php endif; ?>
                   href='javascript:;' class='gzuser gzuser<?php echo e($article->user->id); ?>' follow_id="<?php echo e($article->user->id); ?>">

                    <?php echo Auth::check()&&Auth::user()->followed_user($article->user->id) ? "<span class='glyphicon glyphicon-minus'></span><span style='margin-left:5px'>已关注</span>" : "<span class='glyphicon glyphicon-plus'></span><span style='margin-left:5px'>关注他</span>"; ?>


                </a>

                <?php endif; ?>
            </span>
            <div>
                <span class="fl">分享到：</span>
                <span onclick="shareTo('qzone')">
                    <img data-original="/home/images/qqzoneshare.png" class="lazy shareLogo">
                </span>
                <span onclick="shareTo('qq')">
                    <img data-original="/home/images/qqshare.png" class="lazy shareLogo">
                </span>
                <span onclick="shareTo('sina')">
                    <img data-original="/home/images/sinaweiboshare.png" class="lazy shareLogo">
                </span>
                <span  data-toggle="modal" data-target=".bs-example-modal-sm">
                    <img data-original="/home/images/wechatshare.png" class="lazy shareLogo">
                </span>
            </div>
        </div>

        <!-- 文章内容 -->
        <div id="res " class="detail_content" style="border-bottom:1px dashed #CCC;padding-bottom:50px;margin-bottom:20px;">
            <?php echo $article->content->content; ?>

        </div>

        <div id="shareBtn">
            <span class="fl">分享到：</span>
            <span onclick="shareTo('qzone')">
                <img data-original="/home/images/qqzoneshare.png" class="lazy shareLogo">
            </span>
            <span onclick="shareTo('qq')">
                <img data-original="/home/images/qqshare.png" class="lazy shareLogo">
            </span>
            <span onclick="shareTo('sina')">
                <img data-original="/home/images/sinaweiboshare.png" class="lazy shareLogo">
            </span>
            <span  data-toggle="modal" data-target=".bs-example-modal-sm">
                <img data-original="/home/images/wechatshare.png" class="lazy shareLogo">
            </span>
<!-- Small modal -->


<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" style="z-index:999999;padding-top:200px">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
        <span class="modal-title" id="myModalLabel" style="height:50px;padding:20px;text-align:center;margin-top:30px;">扫描二维码后，点击手机右上方分享</span>
       <div id="qrcode" style="margin-left:30px;padding:20px;margin-top:0px"></div>
    </div>
  </div>
</div>

        </div>

        <?php if(Auth::check() && Auth::user()): ?>
        <div id="plArticle" style="padding-bottom:20px;">
            <div style="padding-left:20px;z-index:-1">
                <div id="articleTitle">
                    <b>评论 (大于2M的图片无法上传）</b>
                </div>
                <form id="form" class="form-horizontal" action="<?php echo e(action('CommentArticleController@store')); ?>" method="post">
                    <?php echo e(csrf_field()); ?>

                    <input type="hidden" name="article_id" id="article_id" value="<?php echo e($article->id); ?>">
                    <div id='detail'></div>
                    <textarea id="text1" name='detail' style="width:100%; height:200px;display:none;"></textarea>
                    <button flag="1" style="background-color:#7FB4CB;margin-top:10px;" type="submit" class="btn btn-info btn-block" id="comment-commit">确认提交</button>
                </form>
            </div>
        </div>
        <?php else: ?>
        <div id="loginNow" style="margin-bottom:40px;margin-top:40px;">
           登录后才能评论 <a href="/login">立即登录</a>
        </div>
        <?php endif; ?>

        <div id="comment-father">
            <?php $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="plcontent">
                <div class="userinfo">
                    <a href="/personal/<?php echo e($comment->user->id); ?>">
                        <img style="border-radius:10px" class="user-image" src="<?php echo e($comment->user->avatar); ?>">
                    </a>
                    <a href="/personal/<?php echo e($comment->user->id); ?>">
                        <b><?php echo e($comment->user->name); ?></b>
                    </a>

                    <span>
                        评论于 : <?php echo e($comment->created_at); ?>

                    </span>
                </div>
                <div class="usercontent">
                    <?php echo $comment->comment; ?>

                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>
        <?php if($comments->count() != 0): ?>
            <div id="more-comment">
                <span id="loaded">
                    <a href="javascript:void(0)" id="click-more">点击加载更多评论 </a>
                </span>
                <!-- 加载中 -->
                <span id="loading">
                    <img src="/home/images/loading.gif">
                </span>


            </div>
        <?php endif; ?>
    </div>

    <!-- 右栏 -->
    <div id="detail_right">
        <div class="detail_right_title">
            <div class="right_title_xg">相关文章</div>
            <div class="right_title_rm">热门文章</div>
        </div>

        <div class="detail_right_content">
            <div class="detail_right_content_xg content">
                <?php $__currentLoopData = $xgArticles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$xgArticle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(action('ArticleController@index',$xgArticle->id)); ?>" target="_blank">
                   <?php echo e(mb_substr($xgArticle->title,0,15,'utf-8').' · · ·'); ?>

                </a>
                <span class="content_time"><?php echo e($xgArticle->created_at); ?></span>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <div class="detail_right_content_rm content">
                <?php $__currentLoopData = $rmwz; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$rmwz): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(action('ArticleController@index',$rmwz->id)); ?>" target="_blank">
                   <?php echo e(mb_substr($rmwz->title,0,15,'utf-8').' · · ·'); ?>

                </a>
                <span class="content_time"><?php echo e($rmwz->created_at); ?></span>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

        </div>
    </div>

    <!-- 判断用户是否登录获取用户名 -->
    <?php if(Auth::user()): ?>
    <input type="hidden" avatar="<?php echo e(Auth::user()->avatar); ?>" name="username" id="username" username="<?php echo e(Auth::user()->name); ?>" userid="<?php echo e(Auth::user()->id); ?>" article_id="<?php echo e($article->id); ?>" />
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php if($xgCates->count() > 0): ?>
    <?php $__env->startSection('friendlink'); ?>
    <div class="foot_link con">
    	<div class="foot_link_con">
        	<span>友情链接</span><em>Friendly&nbsp;&nbsp;links</em>
            <?php $__currentLoopData = $xgCates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $xgCate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        	<a target="_blank" href="<?php echo e(action('CateController@index',$xgCate->id)); ?>"><?php echo e($xgCate->cate); ?></a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    	</div>
    </div>
    <?php $__env->stopSection(); ?>
<?php endif; ?>

<?php $__env->startSection('js'); ?>
<script type="text/javascript" src="/home/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src='/wangEditor/plarticlewangEditor.min.js'></script>
<script type="text/javascript" src="/home/js/articleScroll.js"></script>
<!-- 引入分享js -->
<script type="text/javascript" src="/home/js/share.js"></script>
<!-- 生成微信二维码 -->
<script type="text/javascript" src="/home/js/qrcode.min.js" ></script>

<script type="text/javascript" src="/home/js/article/article.js"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.home', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>