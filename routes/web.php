<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

//前台首页
Route::get('/', 'IndexController@index');

Route::get('/deal', 'DealController@index');

//关注用户
Route::get('/follow/{user_id}', 'FollowUserController@store');
//关注页面
Route::get('/follow/follow/{user_id}','FollowUserController@follow');
Route::get('/concern/{user_id}','FollowUserController@concern');
//私信中心

//私信中心
Route::get('/message/all','MessageController@index');
Route::get('/message/check/{id}','MessageController@check');
//发私信
Route::post('/sx/message','MessageController@sx');

//交易模块
Route::get('/sell','DealController@sell');
Route::post('/deal/store','DealController@store');
Route::get('/buy','DealController@buy');
Route::post('/deal/confirmDeal/{id}','DealController@confirmDeal');


Route::get('/dealbar', 'DealSonController@dealbar');
Route::get('/dealcate/{id}.html','DealSonController@dealcate');
Route::get('/deal/detail/{id}.html','DealSonController@detail');
Route::get('/deal/search','DealSonController@search');
Route::post('/deal/message','DealSonController@message');
Route::get('/deal/confirm/{id}.html','DealSonController@confirm');
Route::get('/deal/trade','DealSonController@trade');

Route::get('/deal/revoke/{id}','RevokeController@detail');
Route::get('/revokelist','RevokeController@list');
Route::get('/confirmlist','DealSonController@confirmlist');
//用户信用
Route::get('/deal/credit/{id}','DealController@credit');
//话题
Route::get('/publish/Topic','TopicController@publish');
Route::get('/topic/detail/{id}','TopicController@detail');
Route::post('/store/Topic','TopicController@store');
Route::post('/topic/storeReply','TopicController@storeReply');
Route::get('/topic/{id}','TopicController@index');

//搜索商城中相关商品/
Route::post('/deal/searchShop', 'DealController@searchShop');

//撤销模块
Route::post('/personal/revoke', 'RevokeController@revoke');
Route::get('/revoke/release/{id}', 'RevokeController@release');
Route::post('/revoke/store', 'RevokeController@store');
Route::get('/revoke/revokeRelease/{id}', 'RevokeController@revokeRelease');

//确认交割模块
Route::post('/confirm', 'ConfirmController@confirm');
//交割失败
Route::post('/failConfirm', 'ConfirmController@failConfirm');

//评分
Route::post('/mark','ConfirmController@mark');

//个人中心
Route::get('/personal/{id}', 'PersonalController@index');
    //修改密码
    Route::get('/personal/password/{id}', 'PersonalController@password');
    Route::post('/personal/updatePassword', 'PersonalController@updatePassword');
    //验证旧密码
    Route::post('/personal/changePassword', 'PersonalController@changePassword');
    //我的文章
    Route::get('/personal/article/{id}', 'PersonalController@article');
    //我的帖子
    Route::get('/personal/post/{id}', 'PersonalController@post');
    //修改用户昵称
    Route::post('/personal/updateUser', 'PersonalController@updateUser');
    //修改用户详情
    Route::post('/personal/updateDetail', 'PersonalController@updateDetail');
    //忘记密码
    Route::post('/personal/findPwd','PersonalController@findPwd');
    Route::post('/personal/foundPwd','PersonalController@foundPwd');
    //修改头像
    Route::post('/personal/updateAvatar','PersonalController@updateAvatar');
    //文章的评论
    Route::get('/personal/commentArticles/{id}', 'PersonalController@commentArticles');
    //帖子的回复
    Route::get('/personal/replyPosts/{id}', 'PersonalController@replyPosts');
    //完善信息
    Route::get('/personal/perfect/{id}', 'PersonalController@perfect');
    //我的地址
    Route::get('/personal/address/{id}', 'PersonalController@address');
    //个人信息 消息通知
    Route::get('/news/index/{id}','NewsController@index');
    Route::get('/news/notRead/{id}','NewsController@notRead');
    Route::get('/news/isRead/{id}','NewsController@isRead');

    //消息通知的单个页面
    Route::get('/news/only','NewsController@only');

    //我的交易
    Route::get('/personal/waitdeal/{id}','DealController@personalWait'); //等待交易
    Route::get('/personal/nowdeal/{id}','DealController@personalNow');  //正在交易
    Route::get('/personal/waitingscore/{id}','DealController@personalScore'); //等待评分
    Route::get('/personal/compoletedeal/{id}','DealController@personalComplete'); //已完成交
    Route::get('/personal/myRevoke/{id}','DealController@personalRevoke'); //我的撤帖

    //获取全部消息
    Route::post('/news/getNews','NewsController@getNews');
    //全部已读
    Route::post('/news/allRead','NewsController@allRead');
    //标记已读
    Route::post('/news/markedRead','NewsController@markedRead');
    //删除消息
    Route::post('/news/deleteNf','NewsController@deleteNf');
//公告
    //公告创建页面
    Route::get('/notice/create','NoticeController@create');
    //公告创建过程
    Route::post('/notice/store','NoticeController@store');
    //单个公告展示页面
    Route::get('/notice/{id}','NoticeController@notice');
    //创建公告回复
    Route::post('/notice/storeReply','NoticeController@storeReply');
    //公告展示页面
    Route::get('/notice','NoticeController@index');


    //个人信息详细资料路由
    Route::post('/perfect/createBank','PerfectController@createBank');
    Route::post('/perfect/delBank','PerfectController@delBank');
    Route::post('/perfect/bankedit','PerfectController@bankedit');
    Route::post('/perfect/createCard','PerfectController@createCard');

    //个人信息地址模块
    Route::post('/address/create','AddressController@create');
    Route::post('/address/del','AddressController@del');
    Route::post('/address/update','AddressController@update');

//分类页
Route::get('/cate/{id}.html', 'CateController@index');
//详情页
Route::get('/article/{id}.html', 'ArticleController@index');

//文章评论点击加载更多
Route::get('/article/comment','ArticleController@comment');

//用户发布模块
Route::get('/publish/article', 'PublishController@article');
Route::post('publish/storeArticle', 'PublishController@storeArticle');
// Route::get('/publish/article/edit/{id}', 'PublishController@editArticle');
// Route::post('/publish/updateArticle', 'PublishController@updateArticle');
// Route::get('/publish/delArticle/{id}', 'PublishController@delArticle');

//评论文章
Route::post('/commentArticle/uploadpic', 'CommentArticleController@uploadpic');
Route::post('/commentArticle/store', 'CommentArticleController@store');

//论坛模块
    //进入论坛首页
    Route::get('/bbs', 'BbsController@index');
    //查看顶级分类版块
    Route::get('/bbs/fucate/{id}.html', 'BbsController@fucate');
    //查看二级分类板块
    Route::get('/bbs/zicate/{id}.html', 'BbsController@zicate');
    //查看单个帖子
    Route::get('/bbs/post/{id}.html', 'BbsController@post');

    //用户发布帖子
    Route::get('/publish/post', 'PublishController@post');
    Route::post('/publish/storePost', 'PublishController@storePost');
    Route::post('/publish/uploadpic', 'PublishController@uploadPic');
    //用户回复帖子
    Route::get('/publish/reply/{id}', 'PublishController@reply');
    Route::post('/publish/storeReply', 'PublishController@storeReply');

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

//搜索路由
 //搜索框智能下拉联想
 Route::post('/search/input','SearchController@search');

 //点击搜索后跳转到的页面
 Route::get('/search','SearchController@index');


//后台路由
Route::group(['prefix' => 'admin'], function () {
    Route::group(['middleware' => 'auth.admin'], function () {
        Route::get('/', 'Admin\IndexController@index');

        Route::get('/clearCache', 'Admin\IndexController@clearCache');

        //后台用户管理模块
        Route::get('adminuser', 'Admin\AdminUserController@index');
        Route::get('adminuser/add', 'Admin\AdminUserController@add');
        Route::post('adminuser/store', 'Admin\AdminUserController@store');
        //修改后台用户个人密码
        Route::get('adminuser/changePwd','Admin\AdminUserController@changePwd');
        Route::post('adminuser/cgPwd','Admin\AdminUserController@cgPwd');
        //前台用户管理模块
        Route::get('homeuser', 'Admin\HomeUserController@index');
        Route::get('homeuser/add', 'Admin\HomeUserController@add');
        Route::post('homeuser/store', 'Admin\HomeUserController@store');
        //更改前台用户状态
        Route::get('homeuser/changeStatus','Admin\HomeUserController@changeStatus');
        //更改用户角色状态
        Route::get('homeuser/changeRole','Admin\HomeUserController@changeRole');
        //审核认证会员
        Route::get('homeuser/cardAuth','Admin\HomeUserController@cardAuth');
        //同意认证
        Route::post('homeuser/agreeCard','Admin\HomeUserController@agreeCard');
        //拒绝认证
        Route::post('homeuser/refuseCard','Admin\HomeUserController@refuseCard');

            //查看前台用户发布的文章
            Route::get('homeuser/article/{id}', 'Admin\HomeUserController@article');

            //查看前台用户发布的帖子
            Route::get('homeuser/post/{id}', 'Admin\HomeUserController@post');

        //公告模块
        Route::get('notice', 'Admin\NoticeController@index');

        //分类模块
        Route::get('cate', 'Admin\CateController@index');
        Route::get('cate/add', 'Admin\CateController@add');
        Route::post('cate/store', 'Admin\CateController@store');
        Route::get('cate/edit', 'Admin\CateController@edit');
        Route::post('cate/update', 'Admin\CateController@update');
        Route::get('cate/chaxun', 'Admin\CateController@chaxun');
        Route::get('cate/delete', 'Admin\CateController@delete');
        Route::get('cate/articles/{id}', 'Admin\CateController@articles');

        //文章模块
        Route::get('article', 'Admin\ArticleController@index');
        // Route::get('article/add', 'Admin\ArticleController@add');
        // Route::post('article/store', 'Admin\ArticleController@store');
        Route::get('article/edit/{id}', 'Admin\ArticleController@edit');
        Route::post('article/updateTitle', 'Admin\ArticleController@updateTitle');
        Route::get('article/editDetail/{id}', 'Admin\ArticleController@editDetail');
        Route::post('article/updateDetail', 'Admin\ArticleController@updateDetail');
        Route::get('article/delete/{id}', 'Admin\ArticleController@delete');
        Route::get('article/comments/{id}', 'Admin\ArticleController@comments');
        Route::get('article/comments/detail/{id}', 'Admin\ArticleController@commentDetail');
        Route::post('article/comments/updateCommentDetail', 'Admin\ArticleController@updateCommentDetail');
        Route::get('article/comments/commentDelete/{id}', 'Admin\ArticleController@commentDelete');

        //友情链接模块
        Route::get('link', 'Admin\LinkController@index');
        Route::get('link/add', 'Admin\LinkController@add');
        Route::post('link/store', 'Admin\LinkController@store');
        Route::get('link/edit/{id}', 'Admin\LinkController@edit');
        Route::post('link/update', 'Admin\LinkController@update');
        Route::get('link/delete/{id}', 'Admin\LinkController@delete');

        //网站配置管理
        Route::get('config', 'Admin\ConfigController@index');
        Route::post('config/store', 'Admin\ConfigController@store');
        Route::get('config/hotSearch','Admin\ConfigController@hotSearch');
        Route::get('config/changeHotSearch','Admin\ConfigController@changeHotSearch');

        //轮播图管理
        Route::get('slider','Admin\SliderController@index');
        Route::post('slider/store','Admin\SliderController@store');
        Route::get('slider/delete/{id}','Admin\SliderController@delete');
        Route::get('slider/orderPic','Admin\SliderController@orderPic');
        Route::get('slider/edit/{id}','Admin\SliderController@edit');
        Route::post('slider/update','Admin\SliderController@update');

        //后台论坛管理模块
            //分类模块
            Route::get('bbs/cate', 'Admin\BbsCateController@index');
            Route::get('bbs/cate/create', 'Admin\BbsCateController@create');
            Route::post('bbs/cate/store', 'Admin\BbsCateController@store');
            Route::get('bbs/cate/edit', 'Admin\BbsCateController@edit');
            Route::post('bbs/cate/update', 'Admin\BbsCateController@update');
            Route::get('bbs/cate/chaxun', 'Admin\BbsCateController@chaxun');
            Route::get('bbs/cate/delete', 'Admin\BbsCateController@delete');
            Route::get('bbs/cate/post/{id}', 'Admin\BbsCateController@posts');

            //帖子模块
            Route::get('bbs/post', 'Admin\PostController@index');
            Route::get('bbs/post/detail/{id}', 'Admin\PostController@detail');
            Route::post('bbs/post/updateDetail', 'Admin\PostController@updateDetail');
            Route::get('bbs/post/edit/{id}', 'Admin\PostController@edit');
            Route::post('bbs/post/update', 'Admin\PostController@update');
            Route::get('bbs/post/delete/{id}', 'Admin\PostController@delete');
            //查看回帖
            Route::get('bbs/post/reply/{id}', 'Admin\PostController@reply');
            Route::get('bbs/post/reply/detail/{id}', 'Admin\PostController@replyDetail');
            Route::post('bbs/post/reply/updateDetail', 'Admin\PostController@updateReplyDetail');
            Route::get('bbs/post/reply/delete/{id}', 'Admin\PostController@replyDelete');

        //买卖盘种类
        Route::get('deal/cate', 'Admin\DealCateController@index');
        Route::get('deal/cate/add', 'Admin\DealCateController@add');
        Route::post('deal/cate/store', 'Admin\DealCateController@store');
        Route::get('deal/cate/edit/{id}', 'Admin\DealCateController@edit');
        Route::post('deal/cate/update', 'Admin\DealCateController@update');
        Route::post('/deal/cate/updateSort', 'Admin\DealCateController@updateSort');

        //话题种类
        Route::get('topic', 'Admin\TopicController@index');
        Route::get('topic/add', 'Admin\TopicController@add');
        Route::post('topic/store', 'Admin\TopicController@store');
        Route::get('topic/post', 'Admin\TopicController@post');
        Route::get('topic/reply/{id}', 'Admin\TopicController@reply');
        Route::get('topic/topicPost/{id}', 'Admin\TopicController@topicPost');

    });

    Route::get('login', 'Admin\LoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'Admin\LoginController@login');
    Route::post('logout', 'Admin\LoginController@logout');
    Route::post('article/uploadpic', 'Admin\ArticleController@uploadpic');

});
