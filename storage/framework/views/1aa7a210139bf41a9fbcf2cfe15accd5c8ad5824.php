<?php $__env->startSection('title'); ?>
<title><?php echo e($config->title); ?></title>
<meta name='keywords' content="<?php echo e($config->keywords); ?>">
<meta name='description' content='<?php echo e($config->description); ?>'>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<!-- 首页样式 -->
<link rel="stylesheet" type="text/css" href="/home/css/index.css">

<!-- 轮播图 -->
<link rel="stylesheet" href="/home/slider/css/shutter.css">

<!-- 左侧导航条 -->
<link rel="stylesheet" type="text/css" href="/home/css/dh.css">

<style type="text/css">
#topheadimg{
  margin-top:8px;
}
table,tbody,tfoot,thead,tr,th,td {
margin:0;
padding:0;
outline:0;
font-size:100%;
vertical-align:baseline;
background:transparent;
border-collapse:collapse;
border-spacing:0;
border:0px;
}
.tablebox {
width:300px;
height:400px;
overflow:hidden;
margin:0px auto;
}
.tablebox table {
width:100%;
}
.tablebox table th,.tablebox table td {
font-size:12px;
text-align:center;
line-height:36px;
}
.tablebox table th {
color:#2584e3;
background-color:#f6f6f6;
}
.tablebox table td img {
display:inline-block;
vertical-align:middle;
}
.tablebox table tbody tr:nth-child(even) {
background-color:#f6f6f6;
}
.tablebox.table_md table td,.tablebox.table_md table th {
line-height:40px;
}
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<!-- 左侧导航条 -->
<div id="left_dh">
  <div id="left_center">
    <div id="left_nav">
<!--
      <a href="javascript:void(0)" class="left_nav_d box_i" pd="gg" flag="0">
        公告
      </a> -->
      <a href="javascript:void(0)" class="left_nav_d box_i" pd="index_zxcj" flag="0">最新成交</a>

      <?php $__currentLoopData = $catehs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cateh): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <a href="javascript:void(0)" class="left_nav_d box_i" pd="<?php echo e($cateh->id); ?><?php echo e($cateh->cate); ?>" flag="0">
            <?php echo e($cateh->cate); ?>

      </a>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

      <a href="javascript:void(0)" class="left_nav_d box_i" pd="jy" flag="0">
        论坛区
       </a>

    </div>
  </div>
</div>

<!-- 最新成交 -->
<div style="width:1200px;margin:0 auto;">
    <div id="index_zxcj">
        <img class="lazy" data-original="/home/images/zxcj.png" width="24px;" style="margin-top:10px;">
        <span><a href="<?php echo e(action('DealSonController@confirmlist',['check'=>0,
        'searchType'=>'shopName','text'=>'','deal_cate'=>0,'start'=>0,'end'=>0])); ?>" target="_blank">最新成交</a></span>
    </div>
</div>
<div class="tablebox" style="box-shadow:0px 0px 5px #ccc;width: 1200px;z-index:0;">
    <table id="tableId" border="0" cellspacing="0" cellpadding="0"  style="table-layout:fixed">
        <thead>
            <tr>
                <th width="30%" align="center">标题</th>
                <th width="10%" align="center">发布人</th>
                <th width="10%" align="center">交易人</th>
                <th width="10%" align="center">发布时间</th>
                <th width="10%" align="center">成交时间</th>
                <th width="10%" align="center">浏览</th>
                <th width="15%" align="center">状态</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $confirm; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr style="border-bottom:1px dashed #99CCFF;">
                <td style="font-size:16px;text-align:left;padding-left:5px;"><a target="_blank" href="<?php echo e(action('DealSonController@detail',$v->id)); ?>" <?php if($v->check == 1): ?>style="font-weight:bold;color:red;" <?php elseif($v->check == 2): ?>style="font-weight:bold;color:#0033FF;" <?php endif; ?> class="oldzxcj" oldtitle="<?php if($v->check == 1): ?>[收购]<?php elseif($v->check == 2): ?>[出售]<?php endif; ?><?php echo e($v->shopName); ?>(<?php echo e($v->productPhase); ?>)<?php echo e($v->num); ?><?php echo e($v->unit); ?>单价:<?php echo e($v->unitPrice); ?>元<?php echo e($v->deliveryMethods[0]); ?>"></a></td>
                <td style="font-size:14px;"><a target="_blank" href="<?php echo e(action('PersonalController@index',$v->user_id)); ?>"><?php echo e($v->user->name); ?></a></td>
                <td style="font-size:14px;"><a target="_blank" href="<?php echo e(action('PersonalController@index',$v->trader)); ?>"><?php echo e($v->traderUser->name); ?></a></td>
                <td><?php echo e($v->created_at); ?></td>
                <td><?php echo e($v->updated_at); ?></td>
                <td style="font-size:14px;"><?php echo e($v->views); ?></td>
                <td style="color:#8f4b2e;font-size:14px;"><?php if($v->status==3): ?>交个失败<?php elseif($v->status==4): ?>交割成功，已互相评分<?php endif; ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<!-- 横条 -->
<?php $__currentLoopData = $catehs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cateh): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<!-- <?php echo e($cateh->cate); ?> -->
<div class="box box_n" style="margin-bottom:20px;" id="<?php echo e($cateh->id); ?><?php echo e($cateh->cate); ?>">
    <!--左侧-->
   	<div class="box-l">
       	<!--头-->
       	<div class="box-l-t">
			<h2 style="width:200px;height:61px;border-top: 3px solid red;text-align:center;line-height:60px;font-size:25px;display:inline-block;position: relative;float: left;margin-top:0px">
				<a href="<?php echo e(action('CateController@index',$cateh->id)); ?>" target="_blank"><?php echo e($cateh->cate); ?></a>
			</h2>
			<ul>
				<?php $__currentLoopData = $cateh->sub; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $zicate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<li><a style="color:#989898;font-size:15px" href="<?php echo e(action('CateController@index',$zicate->id)); ?>" target="_blank"><?php echo e($zicate->cate); ?></a></li>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</ul>
       	</div>
       	<!--内容-->
       	<div class="box-l-b">
        	<!--图-->
	        <div class="box-l-bl">
	        	<div>
	        		<span class="ttt" style="margin-top:5px"></span>
	        		<b class="rw">最热资讯</b>
	        	</div>
	        	<!-- 最热资讯 -->
	        	<?php $__currentLoopData = $cateh->hotArticles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $hotArticleh): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	        	<div style="float:left;margin-top:10px;">
	        		<div>
	        			<span class="<?php if($k==0): ?> one <?php else: ?> fone <?php endif; ?>"><?php echo e($k+1); ?></span>
	        			<a target="_blank" href="<?php echo e(action('ArticleController@index',$hotArticleh->id)); ?>" class="rwnr"><?php echo e($hotArticleh->title); ?></a>
	        		</div>
	        	</div>
	        	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	        </div>
           	<!--文字部分-->
           	<div class="box-l-br">
               	<div class="box-l-brt">
                   	<ul>
                       	<li><b>最新资讯</b></li>
                      	<?php $__currentLoopData = $cateh->newArticles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $newArticleh): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                       	<li>
                       		<div>
	                        	<a target="_blank" href="<?php echo e(action('ArticleController@index',$newArticleh->id)); ?>" class="cateDate"><?php echo e($newArticleh->title); ?></a>
                        	</div>
                       	</li>
                       	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                   	</ul>
               	</div>
           	</div>
       	</div>
   	</div>
   	<!--右侧-->
   	<div class="box-r">
       	<div style="width: 100%; height: 100%;">
           	<a target="_blank" href="<?php echo e(action('CateController@index',$cateh->id)); ?>"><img class="lazy" data-original="<?php echo e($cateh->catePic); ?>" width="300" height="490" ></a>
       	</div>
   	</div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<!-- 交易论坛 -->

<?php if(count($indexBbsCates) != 0): ?>
<div style="margin: auto;width: 1200px;margin-top:20px">
    <div id="jy" class="box_n">
        <div id="jy_title">
            <img class="lazy" data-original="/home/images/jy.png" width="24px;" style="margin-top:10px;">
            <span>论坛区</span>
        </div>
        <?php $__currentLoopData = $indexBbsCates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$indexBbsCate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="jylt_small <?php if($k%3 == 0): ?> jylt_small2 <?php endif; ?>">
            <div class="title-cut">
    			<strong class="tt">
    				<a href="<?php echo e(action('BbsController@fucate',$indexBbsCate->id)); ?>" target="_blank"><?php echo e($indexBbsCate->cate); ?></a>
    			</strong>

                <span class="link">
    				<?php $__currentLoopData = $indexBbsCate->sub; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$zicate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    				<?php if($k < 2): ?>
    				<a href="<?php echo e(action('BbsController@zicate',$zicate->id)); ?>" target="_blank"><?php echo e($zicate->cate); ?></a>
    				<?php endif; ?>
    				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    			</span>

                <a class="gd" href="<?php echo e(action('BbsController@fucate',$indexBbsCate->id)); ?>" target="_blank">更多</a>
            </div>
            <div class="list16">
                <ul>
    	            <li><b>热帖展示</b></li>
                    <?php $__currentLoopData = $indexBbsCate->hotPosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hotPost): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    	            <li><a href="<?php echo e(action('BbsController@post',$hotPost->id)); ?>" target="_blank"><?php echo e($hotPost->title); ?></a></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    	        </ul>
            </div>
    		<div class="list16">
    	        <ul>
    	            <li><b>最新帖子</b></li>
                    <?php $__currentLoopData = $indexBbsCate->newPosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $newPost): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    	            <li><a href="<?php echo e(action('BbsController@post',$newPost->id)); ?>" target="_blank"><?php echo e($newPost->title); ?></a></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    			</ul>
        	</div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>



<?php if($links->count() > 0): ?>
    <?php $__env->startSection('friendlink'); ?>
    <div class="foot_link con">
    	<div class="foot_link_con">
        	<span>友情链接</span><em>Friendly&nbsp;&nbsp;links</em>
        	<?php $__currentLoopData = $links; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        	<a target="_blank" href="<?php echo e($link->url); ?>"><?php echo e($link->title); ?></a>
        	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    	</div>
    </div>
    <?php $__env->stopSection(); ?>
<?php endif; ?>

<?php $__env->startSection('js'); ?>
<!-- <script src="/home/slider/js/velocity.js"></script> -->
<!-- <script src="/home/slider/js/shutter.js"></script> -->
<script type="text/javascript" src="/home/js/dh.js"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.home', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>