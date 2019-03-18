<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />


    <title>传承资讯后台管理系统!</title>

    <!-- Bootstrap -->
    <link href="/admins/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="/admins/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <!-- <link href="/admins/vendors/nprogress/nprogress.css" rel="stylesheet"> -->

    <!-- bootstrap-progressbar -->
    <!-- <link href="/admins/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet"> -->
    <!-- JQVMap -->
    <!-- <link href="/admins/vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/> -->
    <!-- bootstrap-daterangepicker -->
    <!-- <link href="/admins/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet"> -->
    <!-- Datatables -->
    <link href="/admins/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <!-- <link href="/admins/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet"> -->
    <!-- <link href="/admins/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet"> -->
    <!-- <link href="/admins/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet"> -->
    <!-- <link href="/admins/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet"> -->
    <!-- Switchery -->
    <link href="/admins/vendors/switchery/dist/switchery.min.css" rel="stylesheet">
    <!-- layer -->
    <link rel="stylesheet" href='<?php echo e(asset("layer/theme/default/layer.css")); ?>'>

    <!-- Custom Theme Style -->
    <link href="/admins/build/css/custom.min.css" rel="stylesheet">
    <?php $__env->startSection('css'); ?>

    <?php echo $__env->yieldSection(); ?>
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="<?php echo e(url('/admin')); ?>" class="site_title"><i class="fa fa-smile-o"></i> <span>传承资讯后台</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="/admins/images/img.jpg" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>欢迎管理员,</span>
                <h2><?php echo e(auth()->guard('admin')->user()->name); ?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>传承资讯管理系统</h3>
                <ul class="nav side-menu">
                  <li><a href="<?php echo e(url('/admin')); ?>"><i class="fa fa-home"></i>主页</a>
                  </li>
                  <li><a><i class="fa fa-users"></i> 后台用户管理<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo e(action('Admin\AdminUserController@index')); ?>">浏览后台用户</a></li>
                      <li><a href="<?php echo e(action('Admin\AdminUserController@add')); ?>">添加后台用户</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-user"></i> 前台用户管理 <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo e(action('Admin\HomeUserController@index')); ?>">浏览前台用户</a></li>
                      <li><a href="<?php echo e(action('Admin\HomeUserController@add')); ?>">添加前台用户</a></li>
                      <li><a href="<?php echo e(action('Admin\HomeUserController@cardAuth')); ?>">审核认证会员</a></li>
                    </ul>
                  </li>

                  <li><a><i class="fa fa-align-left"></i> 公告模块管理 <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo e(action('Admin\NoticeController@index')); ?>">浏览公告列表</a></li>
                    </ul>
                  </li>

                  <li><a><i class="fa fa-sort-numeric-asc"></i> 分类模块管理 <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo e(action('Admin\CateController@index')); ?>">浏览分类</a></li>
                      <li><a href="<?php echo e(action('Admin\CateController@add')); ?>">添加分类</a></li>
                    </ul>
                  </li>

                  <li><a><i class="fa fa-edit"></i> 文章模块管理 <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo e(action('Admin\ArticleController@index')); ?>">浏览文章</a></li>
                    </ul>
                  </li>

                </ul>
              </div>

              <div class="menu_section">
                <h3>论坛模块</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-sort-numeric-desc"></i> 分类模块管理 <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo e(action('Admin\BbsCateController@index')); ?>">浏览分类</a></li>
                      <li><a href="<?php echo e(action('Admin\BbsCateController@create')); ?>">添加分类</a></li>
                    </ul>
                  </li>

                  <li><a><i class="fa fa-file"></i> 帖子模块管理 <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo e(action('Admin\PostController@index')); ?>">浏览帖子</a></li>
                    </ul>
                  </li>

                  <li><a><i class="fa fa-rmb"></i> 买卖盘种类管理 <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo e(action('Admin\DealCateController@index')); ?>">浏览买卖盘种类</a></li>
                    </ul>
                  </li>
                </ul>
              </div>

              <div class="menu_section">
                <h3>话题模块</h3>
                <ul class="nav side-menu">

                  <li><a><i class="fa fa-pie-chart"></i> 话题分类模块管理 <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo e(action('Admin\TopicController@index')); ?>">浏览添加话题分类</a></li>
                    </ul>
                  </li>

                  <li><a><i class="fa fa-male"></i> 话题交流模块管理 <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo e(action('Admin\TopicController@post')); ?>">浏览话题交流帖子</a></li>
                    </ul>
                  </li>

                </ul>
              </div>

              <div class="menu_section">
                <h3>网站配置</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-link"></i> 友情链接管理 <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo e(action('Admin\LinkController@index')); ?>">浏览友情链接</a></li>
                      <li><a href="<?php echo e(action('Admin\LinkController@add')); ?>">添加友情链接</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-cog"></i> 网站管理 <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo e(action('Admin\ConfigController@index')); ?>">网站配置</a></li>
                      <li><a href="<?php echo e(action('Admin\ConfigController@hotSearch')); ?>">热搜管理</a></li>
                      <li><a href="<?php echo e(action('Admin\SliderController@index')); ?>">轮播图管理</a></li>
                    </ul>
                  </li>
                  <!-- <li><a><i class="fa fa-shield"></i>权限管理<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="e_commerce.html">E-commerce</a></li>
                      <li><a href="projects.html">Projects</a></li>
                      <li><a href="project_detail.html">Project Detail</a></li>
                      <li><a href="contacts.html">Contacts</a></li>
                      <li><a href="profile.html">Profile</a></li>
                    </ul>
                  </li> -->
                </ul>
              </div>
            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="<?php echo e(url('/admin/logout')); ?>"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                    <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                </a>

                <form id="logout-form" action="<?php echo e(url('/admin/logout')); ?>" method="POST"
                      style="display: none;">
                    <?php echo e(csrf_field()); ?>

                </form>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <button class="btn btn-primary" style="margin-top:10px;"><a href="<?php echo e(action('Admin\IndexController@clearCache')); ?>" style="color:white;">清除网站缓存</a></button>

              <ul class="nav navbar-nav navbar-right">
                <li class="" id="tanchutou">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="/admins/images/img.jpg" alt=""><?php echo e(auth()->guard('admin')->user()->name); ?>

                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="<?php echo e(action('Admin\AdminUserController@changePwd')); ?>"> 修改密码</a></li>
                    <li><a href="<?php echo e(url('/admin/logout')); ?>" onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();"><i class="fa fa-sign-out pull-right"></i> 退出</a></li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
        <?php echo $__env->yieldContent('content'); ?>
        </div>

      </div>
    </div>

    <script src="<?php echo e(asset('js/app.js')); ?>"></script>
    <!-- jQuery -->
    <script src="/admins/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="/admins/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <!-- <script src="/admins/vendors/fastclick/lib/fastclick.js"></script> -->
    <!-- NProgress -->
    <!-- <script src="/admins/vendors/nprogress/nprogress.js"></script> -->
    <!-- Chart.js -->
    <!-- <script src="/admins/vendors/Chart.js/dist/Chart.min.js"></script> -->
    <!-- gauge.js -->
    <!-- <script src="/admins/vendors/gauge.js/dist/gauge.min.js"></script> -->
    <!-- bootstrap-progressbar -->
    <!-- <script src="/admins/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script> -->
    <!-- iCheck -->
    <!-- <script src="/admins/vendors/iCheck/icheck.min.js"></script> -->
    <!-- Skycons -->
    <!-- <script src="/admins/vendors/skycons/skycons.js"></script> -->
    <!-- Flot -->
    <!-- <script src="/admins/vendors/Flot/jquery.flot.js"></script>
    <script src="/admins/vendors/Flot/jquery.flot.pie.js"></script>
    <script src="/admins/vendors/Flot/jquery.flot.time.js"></script>
    <script src="/admins/vendors/Flot/jquery.flot.stack.js"></script>
    <script src="/admins/vendors/Flot/jquery.flot.resize.js"></script> -->
    <!-- Flot plugins -->
    <!-- <script src="/admins/vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script> -->
    <!-- <script src="/admins/vendors/flot-spline/js/jquery.flot.spline.min.js"></script> -->
    <!-- <script src="/admins/vendors/flot.curvedlines/curvedLines.js"></script> -->
    <!-- DateJS -->
    <!-- <script src="/admins/vendors/DateJS/build/date.js"></script> -->
    <!-- JQVMap -->
    <!-- <script src="/admins/vendors/jqvmap/dist/jquery.vmap.js"></script>
    <script src="/admins/vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="/admins/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script> -->
    <!-- bootstrap-daterangepicker -->
    <!-- <script src="/admins/vendors/moment/min/moment.min.js"></script> -->
    <!-- <script src="/admins/vendors/bootstrap-daterangepicker/daterangepicker.js"></script> -->
    <!-- Datatables -->
    <script src="/admins/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="/admins/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <!-- <script src="/admins/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script> -->
    <!-- <script src="/admins/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script> -->
    <!-- <script src="/admins/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script> -->
    <!-- <script src="/admins/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script> -->
    <!-- <script src="/admins/vendors/datatables.net-buttons/js/buttons.print.min.js"></script> -->
    <!-- <script src="/admins/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script> -->
    <!-- <script src="/admins/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script> -->
    <!-- <script src="/admins/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script> -->
    <!-- <script src="/admins/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script> -->
    <!-- <script src="/admins/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script> -->
    <!-- <script src="/admins/vendors/jszip/dist/jszip.min.js"></script> -->
    <!-- <script src="/admins/vendors/pdfmake/build/pdfmake.min.js"></script> -->
    <!-- <script src="/admins/vendors/pdfmake/build/vfs_fonts.js"></script> -->

    <!-- jQuery Tags Input -->
    <!-- <script src="/admins/vendors/jquery.tagsinput/src/jquery.tagsinput.js"></script> -->
    <!-- validator -->
    <script src="/admins/vendors/validator/validator.js"></script>
    <!-- layer -->
    <script src="<?php echo e(asset('/layer/layer.js')); ?>"></script>

    <!-- Custom Theme Scripts -->
    <script src="/admins/build/js/custom.min.js"></script>
    <script type="text/javascript">
      $('#tanchutou').click(function(){
        if($(this).attr('class') == 'open'){
          $(this).removeClass();
        }else{
          $(this).addClass('open');
        }

      })
    </script>
    <?php $__env->startSection('js'); ?>

    <?php echo $__env->yieldSection(); ?>
  </body>
</html>
