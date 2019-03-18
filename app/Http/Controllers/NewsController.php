<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Illuminate\Http\Request;
use App\User;
use App\CommentArticle;
use App\Reply;

class NewsController extends Controller
{
    //
    public function index(Request $request) {
    	// dd($request->id);
    	$user = User::findOrFail($request->id);
    	return view('home.News.index',compact('user'));
    }

    public function notRead(Request $request) {
        // dd($request->id);
        $user = User::findOrFail($request->id);
        return view('home.News.notRead',compact('user'));
    }

    public function isRead(Request $request) {
        // dd($request->id);
        $user = User::findOrFail($request->id);
        return view('home.News.isRead',compact('user'));
    }


    public function getNews(Request $request){
        $bigType = $request->input('bigType');
        $smallType = $request->input('smallType');
        $page = ($request->input('page')-1)*10;

        //如果是全部消息
        if($bigType === 'all'){

            switch($smallType){//判断全部消息里的类型（全部消息，帖子，文章）
                case 'all':
                    return response()->json($this->allAll($page,$request->input('page')));
                break;
                case 'replyPost':
                    return response()->json($this->allReplyPost($page,$request->input('page')));
                break;
                case 'commentArticle' :
                    return response()->json($this->allCommentArticle($page,$request->input('page')));
                break;
                case 'follow':
                    return response()->json($this->allFollow($page,$request->input('page')));
                break;
                case 'deal':
                    return response()->json($this->allDeal($page,$request->input('page')));
                break;
            }

        }elseif($bigType === 'read'){//如果是已读消息

            switch($smallType){//判断已读消息里的类型（全部消息，帖子，文章）
                case 'all':
                    return response()->json($this->readAll($page,$request->input('page')));
                break;
                case 'replyPost':
                    return response()->json($this->readReplyPost($page,$request->input('page')));
                break;
                case 'commentArticle':
                    return response()->json($this->readCommentArticle($page,$request->input('page')));
                break;
                case 'follow':
                    return response()->json($this->readFollow($page,$request->input('page')));
                break;
                case 'deal':
                    return response()->json($this->readDeal($page,$request->input('page')));
                break;
            }

        }elseif($bigType === 'unread'){//如果是未读消息

            switch($smallType){//判断未读消息里的类型（全部消息，帖子，文章）
                case 'all':
                    return response()->json($this->unreadAll($page,$request->input('page')));
                break;
                case 'replyPost':
                    return response()->json($this->unreadReplyPost($page,$request->input('page')));
                break;
                case 'commentArticle':
                    return response()->json($this->unreadCommentArticle($page,$request->input('page')));
                break;
                case 'follow':
                    return response()->json($this->unreadFollow($page,$request->input('page')));
                break;
                case 'deal':
                    return response()->json($this->unreadDeal($page,$request->input('page')));
                break;
            }
        }

    }

    public function countAllSql(){

        $data = null;

        //统计全部未读消息的个数
        $data['all'] = DB::table('notifications')->where('notifiable_id',Auth::id())->where('notifiable_id','!=',null)->where('notifiable_type','App\User')->where('read_at',null)->count();

        //统计帖子未读消息的个数
        $data['post'] = DB::table('notifications')->where('notifiable_id',Auth::id())->where('notifiable_id','!=',null)->where('notifiable_type','App\User')->where('type','App\Notifications\ReplyPostNotification')->where('read_at',null)->count();

        //统计文章未读消息的个数
        $data['article'] = DB::table('notifications')->where('notifiable_id',Auth::id())->where('notifiable_id','!=',null)->where('notifiable_type','App\User')->where('type','App\Notifications\CommentArticleNotification')->where('read_at',null)->count();

        //统计关注未读消息的个数
        $data['follow'] = DB::table('notifications')->where('notifiable_id',Auth::id())->where('notifiable_id','!=',null)->where('notifiable_type','App\User')->where('type','App\Notifications\FollowUserNotification')->where('read_at',null)->count();

        //统计交易未读消息的个数
        $data['deal'] = DB::table('notifications')->where('notifiable_id',Auth::id())->where('notifiable_id','!=',null)->where('notifiable_type','App\User')->where('type','App\Notifications\DealNotification')->where('read_at',null)->count();

        return $data;
    }

    public function allAll($page,$currentPage){
        $array['count'] = $this->countAllSql();
        $array['page'] = $currentPage;

        //返回全部消息的数据
        $array['data'] = DB::table('notifications')->where('notifiable_id',Auth::id())->where('notifiable_id','!=',null)->where('notifiable_type','App\User')->orderBy('created_at','desc')->offset($page)->limit(10)->get();

        foreach($array['data'] as $k => $v){
            $v->data = json_decode($v->data,true);
        }

        //统计条数
        $array['total'] = DB::table('notifications')->where('notifiable_id',Auth::id())->where('notifiable_id','!=',null)->where('notifiable_type','App\User')->count();

        return $array;
    }

    public function allReplyPost($page,$currentPage){
        $array['count'] = $this->countAllSql();
        $array['page'] = $currentPage;

        //返回帖子消息的数据
        $array['data'] = DB::table('notifications')->where('notifiable_id',Auth::id())->where('notifiable_id','!=',null)->where('notifiable_type','App\User')->where('type','App\Notifications\ReplyPostNotification')->orderBy('created_at','desc')->offset($page)->limit(10)->get();

        foreach($array['data'] as $k => $v){
            $v->data = json_decode($v->data,true);
        }

        //统计条数
        $array['total'] = DB::table('notifications')->where('notifiable_id',Auth::id())->where('notifiable_id','!=',null)->where('notifiable_type','App\User')->where('type','App\Notifications\ReplyPostNotification')->count();

        return $array;
    }

    public function allCommentArticle($page,$currentPage){
        $array['count'] = $this->countAllSql();
        $array['page'] = $currentPage;

        //返回文章消息的数据
        $array['data'] = DB::table('notifications')->where('notifiable_id',Auth::id())->where('notifiable_id','!=',null)->where('notifiable_type','App\User')->where('type','App\Notifications\CommentArticleNotification')->orderBy('created_at','desc')->offset($page)->limit(10)->get();

        foreach($array['data'] as $k => $v){
            $v->data = json_decode($v->data,true);
        }

        //统计条数
        $array['total'] = DB::table('notifications')->where('notifiable_id',Auth::id())->where('notifiable_id','!=',null)->where('notifiable_type','App\User')->where('type','App\Notifications\CommentArticleNotification')->count();

        return $array;
    }

    public function allFollow($page,$currentPage){
        $array['count'] = $this->countAllSql();
        $array['page'] = $currentPage;

        //返回关注消息的数据
        $array['data'] = DB::table('notifications')->where('notifiable_id',Auth::id())->where('notifiable_id','!=',null)->where('notifiable_type','App\User')->where('type','App\Notifications\FollowUserNotification')->orderBy('created_at','desc')->offset($page)->limit(10)->get();

        foreach($array['data'] as $k => $v){
            $v->data = json_decode($v->data,true);
        }

        //统计条数
        $array['total'] = DB::table('notifications')->where('notifiable_id',Auth::id())->where('notifiable_id','!=',null)->where('notifiable_type','App\User')->where('type','App\Notifications\FollowUserNotification')->count();

        return $array;
    }

    public function allDeal($page,$currentPage){
        $array['count'] = $this->countAllSql();
        $array['page'] = $currentPage;

        //返回交易消息的数据
        $array['data'] = DB::table('notifications')->where('notifiable_id',Auth::id())->where('notifiable_id','!=',null)->where('notifiable_type','App\User')->where('type','App\Notifications\DealNotification')->orderBy('created_at','desc')->offset($page)->limit(10)->get();

        foreach($array['data'] as $k => $v){
            $v->data = json_decode($v->data,true);
        }

        //统计条数
        $array['total'] = DB::table('notifications')->where('notifiable_id',Auth::id())->where('notifiable_id','!=',null)->where('notifiable_type','App\User')->where('type','App\Notifications\DealNotification')->count();

        return $array;
    }

    public function readAll($page,$currentPage){
        $array['count'] = $this->countAllSql();
        $array['page'] = $currentPage;

        //返回全部已读消息的数据
        $array['data'] = DB::table('notifications')->where('notifiable_id',Auth::id())->where('notifiable_id','!=',null)->where('notifiable_type','App\User')->where('read_at','!=',null)->orderBy('created_at','desc')->offset($page)->limit(10)->get();

        foreach($array['data'] as $k => $v){
            $v->data = json_decode($v->data,true);
        }

        //统计条数
        $array['total'] = DB::table('notifications')->where('notifiable_id',Auth::id())->where('notifiable_id','!=',null)->where('notifiable_type','App\User')->where('read_at','!=',null)->count();

        return $array;
    }

    public function readReplyPost($page,$currentPage){
        $array['count'] = $this->countAllSql();
        $array['page'] = $currentPage;

        //返回帖子已读消息的数据
        $array['data'] = DB::table('notifications')->where('notifiable_id',Auth::id())->where('notifiable_id','!=',null)->where('notifiable_type','App\User')->where('type','App\Notifications\ReplyPostNotification')->where('read_at','!=',null)->orderBy('created_at','desc')->offset($page)->limit(10)->get();

        foreach($array['data'] as $k => $v){
            $v->data = json_decode($v->data,true);
        }

        //统计条数
        $array['total'] = DB::table('notifications')->where('notifiable_id',Auth::id())->where('notifiable_id','!=',null)->where('notifiable_type','App\User')->where('type','App\Notifications\ReplyPostNotification')->where('read_at','!=',null)->count();

        return $array;
    }

    public function readCommentArticle($page,$currentPage){
        $array['count'] = $this->countAllSql();
        $array['page'] = $currentPage;

        //返回文章已读消息的数据
        $array['data'] = DB::table('notifications')->where('notifiable_id',Auth::id())->where('notifiable_id','!=',null)->where('notifiable_type','App\User')->where('type','App\Notifications\CommentArticleNotification')->where('read_at','!=',null)->orderBy('created_at','desc')->offset($page)->limit(10)->get();

        foreach($array['data'] as $k => $v){
            $v->data = json_decode($v->data,true);
        }

        //统计条数
        $array['total'] = DB::table('notifications')->where('notifiable_id',Auth::id())->where('notifiable_id','!=',null)->where('notifiable_type','App\User')->where('type','App\Notifications\CommentArticleNotification')->where('read_at','!=',null)->count();

        return $array;
    }

    public function readFollow($page,$currentPage){
        $array['count'] = $this->countAllSql();
        $array['page'] = $currentPage;

        //返回关注已读消息的数据
        $array['data'] = DB::table('notifications')->where('notifiable_id',Auth::id())->where('notifiable_id','!=',null)->where('notifiable_type','App\User')->where('type','App\Notifications\FollowUserNotification')->where('read_at','!=',null)->orderBy('created_at','desc')->offset($page)->limit(10)->get();

        foreach($array['data'] as $k => $v){
            $v->data = json_decode($v->data,true);
        }

        //统计条数
        $array['total'] = DB::table('notifications')->where('notifiable_id',Auth::id())->where('notifiable_id','!=',null)->where('notifiable_type','App\User')->where('type','App\Notifications\FollowUserNotification')->where('read_at','!=',null)->count();

        return $array;
    }

    public function readDeal($page,$currentPage){
        $array['count'] = $this->countAllSql();
        $array['page'] = $currentPage;

        //返回关注已读消息的数据
        $array['data'] = DB::table('notifications')->where('notifiable_id',Auth::id())->where('notifiable_id','!=',null)->where('notifiable_type','App\User')->where('type','App\Notifications\DealNotification')->where('read_at','!=',null)->orderBy('created_at','desc')->offset($page)->limit(10)->get();

        foreach($array['data'] as $k => $v){
            $v->data = json_decode($v->data,true);
        }

        //统计条数
        $array['total'] = DB::table('notifications')->where('notifiable_id',Auth::id())->where('notifiable_id','!=',null)->where('notifiable_type','App\User')->where('type','App\Notifications\DealNotification')->where('read_at','!=',null)->count();

        return $array;
    }

    public function unreadAll($page,$currentPage){
        $array['count'] = $this->countAllSql();
        $array['page'] = $currentPage;

        //返回全部未读消息的数据
        $array['data'] = DB::table('notifications')->where('notifiable_id',Auth::id())->where('notifiable_id','!=',null)->where('notifiable_type','App\User')->where('read_at',null)->orderBy('created_at','desc')->offset($page)->limit(10)->get();

        foreach($array['data'] as $k => $v){
            $v->data = json_decode($v->data,true);
        }

        //统计条数
        $array['total'] = DB::table('notifications')->where('notifiable_id',Auth::id())->where('notifiable_id','!=',null)->where('notifiable_type','App\User')->where('read_at',null)->count();

        return $array;
    }

    public function unreadReplyPost($page,$currentPage){
        $array['count'] = $this->countAllSql();
        $array['page'] = $currentPage;

        //返回帖子未读消息的数据
        $array['data'] = DB::table('notifications')->where('notifiable_id',Auth::id())->where('notifiable_id','!=',null)->where('notifiable_type','App\User')->where('type','App\Notifications\ReplyPostNotification')->where('read_at',null)->orderBy('created_at','desc')->offset($page)->limit(10)->get();

        foreach($array['data'] as $k => $v){
            $v->data = json_decode($v->data,true);
        }

        //统计条数
        $array['total'] = DB::table('notifications')->where('notifiable_id',Auth::id())->where('notifiable_id','!=',null)->where('notifiable_type','App\User')->where('type','App\Notifications\ReplyPostNotification')->where('read_at',null)->count();

        return $array;
    }

    public function unreadCommentArticle($page,$currentPage){
        $array['count'] = $this->countAllSql();
        $array['page'] = $currentPage;

        //返回文章未读消息的数据
        $array['data'] = DB::table('notifications')->where('notifiable_id',Auth::id())->where('notifiable_id','!=',null)->where('notifiable_type','App\User')->where('type','App\Notifications\CommentArticleNotification')->where('read_at',null)->orderBy('created_at','desc')->offset($page)->limit(10)->get();

        foreach($array['data'] as $k => $v){
            $v->data = json_decode($v->data,true);
        }

        //统计条数
        $array['total'] = DB::table('notifications')->where('notifiable_id',Auth::id())->where('notifiable_id','!=',null)->where('notifiable_type','App\User')->where('type','App\Notifications\CommentArticleNotificationn')->where('read_at',null)->count();

        return $array;
    }

    public function unreadFollow($page,$currentPage){
        $array['count'] = $this->countAllSql();
        $array['page'] = $currentPage;

        //返回关注未读消息的数据
        $array['data'] = DB::table('notifications')->where('notifiable_id',Auth::id())->where('notifiable_id','!=',null)->where('notifiable_type','App\User')->where('type','App\Notifications\FollowUserNotification')->where('read_at',null)->orderBy('created_at','desc')->offset($page)->limit(10)->get();

        foreach($array['data'] as $k => $v){
            $v->data = json_decode($v->data,true);
        }

        //统计条数
        $array['total'] = DB::table('notifications')->where('notifiable_id',Auth::id())->where('notifiable_id','!=',null)->where('notifiable_type','App\User')->where('type','App\Notifications\FollowUserNotification')->where('read_at',null)->count();

        return $array;
    }

    public function unreadDeal($page,$currentPage){
        $array['count'] = $this->countAllSql();
        $array['page'] = $currentPage;

        //返回关注未读消息的数据
        $array['data'] = DB::table('notifications')->where('notifiable_id',Auth::id())->where('notifiable_id','!=',null)->where('notifiable_type','App\User')->where('type','App\Notifications\DealNotification')->where('read_at',null)->orderBy('created_at','desc')->offset($page)->limit(10)->get();

        foreach($array['data'] as $k => $v){
            $v->data = json_decode($v->data,true);
        }

        //统计条数
        $array['total'] = DB::table('notifications')->where('notifiable_id',Auth::id())->where('notifiable_id','!=',null)->where('notifiable_type','App\User')->where('type','App\Notifications\DealNotification')->where('read_at',null)->count();

        return $array;
    }

    public function blNews($notificationsId){
        foreach($notificationsId as $v){
            DB::table('notifications')->where('id',$v)->update(['read_at'=>now()]);
        }
    }

    public function scNews($notificationsId){
        foreach($notificationsId as $v){
            DB::table('notifications')->where('id',$v)->delete();
        }
    }

    //设置全部已读
    public function allRead(Request $request){
        $bigType = $request->input('bigType');
        $smallType = $request->input('smallType');
        $page = ($request->input('page')-1)*10;

        if($bigType === 'all'){

            switch($smallType){
                case 'all':
                    Auth::user()->unreadNotifications->markAsRead();
                    return response()->json($this->allAll($page,$request->input('page')));
                break;
                case 'replyPost':
                    foreach(Auth::user()->unreadNotifications as $v){
                        if($v->type == 'App\Notifications\ReplyPostNotification'){
                            $v->markAsRead();
                        }
                    }
                    return response()->json($this->allReplyPost($page,$request->input('page')));
                break;
                case 'commentArticle':
                    foreach(Auth::user()->unreadNotifications as $v){
                        if($v->type == 'App\Notifications\CommentArticleNotification'){
                            $v->markAsRead();
                        }
                    }
                    return response()->json($this->allCommentArticle($page,$request->input('page')));
                break;
                case 'follow':
                    foreach(Auth::user()->unreadNotifications as $v){
                        if($v->type == 'App\Notifications\FollowUserNotification'){
                            $v->markAsRead();
                        }
                    }
                    return response()->json($this->allFollow($page,$request->input('page')));
                break;
                case 'deal':
                    foreach(Auth::user()->unreadNotifications as $v){
                        if($v->type == 'App\Notifications\DealNotification'){
                            $v->markAsRead();
                        }
                    }
                    return response()->json($this->allDeal($page,$request->input('page')));
                break;
            }

        }elseif($bigType === 'unread'){

            switch($smallType){
                case 'all':
                    Auth::user()->unreadNotifications->markAsRead();
                    return response()->json($this->unreadAll($page,$request->input('page')));
                break;
                case 'replyPost':
                    foreach(Auth::user()->unreadNotifications as $v){
                        if($v->type == 'App\Notifications\ReplyPostNotification'){
                            $v->markAsRead();
                        }
                    }
                    return response()->json($this->unreadReplyPost($page,$request->input('page')));
                break;
                case 'commentArticle':
                    foreach(Auth::user()->unreadNotifications as $v){
                        if($v->type == 'App\Notifications\CommentArticleNotification'){
                            $v->markAsRead();
                        }
                    }
                    return response()->json($this->unreadCommentArticle($page,$request->input('page')));
                break;
                case 'follow':
                    foreach(Auth::user()->unreadNotifications as $v){
                        if($v->type == 'App\Notifications\FollowUserNotification'){
                            $v->markAsRead();
                        }
                    }
                    return response()->json($this->unreadFollow($page,$request->input('page')));
                break;
                case 'deal':
                    foreach(Auth::user()->unreadNotifications as $v){
                        if($v->type == 'App\Notifications\DealNotification'){
                            $v->markAsRead();
                        }
                    }
                    return response()->json($this->unreadDeal($page,$request->input('page')));
                break;
            }
        }

    }

    //设置标记已读
    public function markedRead(Request $request){
        $bigType = $request->input('bigType');
        $smallType = $request->input('smallType');
        $page = ($request->input('page')-1)*10;
        $notificationsId = $request->input('notificationsId');

        if($bigType === 'all'){

            switch($smallType){
                case 'all':
                    $this->blNews($notificationsId);
                    return response()->json($this->allAll($page,$request->input('page')));
                break;
                case 'replyPost':
                    $this->blNews($notificationsId);
                    return response()->json($this->allReplyPost($page,$request->input('page')));
                break;
                case 'commentArticle':
                    $this->blNews($notificationsId);
                    return response()->json($this->allCommentArticle($page,$request->input('page')));
                break;
                case 'follow':
                    $this->blNews($notificationsId);
                    return response()->json($this->allFollow($page,$request->input('page')));
                break;
                case 'deal':
                    $this->blNews($notificationsId);
                    return response()->json($this->allDeal($page,$request->input('page')));
                break;
            }

        }elseif($bigType === 'unread'){

            switch($smallType){
                case 'all':
                    $this->blNews($notificationsId);
                    return response()->json($this->unreadAll($page,$request->input('page')));
                break;
                case 'replyPost':
                    $this->blNews($notificationsId);
                    return response()->json($this->unreadReplyPost($page,$request->input('page')));
                break;
                case 'all':
                    $this->blNews($notificationsId);
                    return response()->json($this->unreadCommentArticle($page,$request->input('page')));
                break;
                case 'follow':
                    $this->blNews($notificationsId);
                    return response()->json($this->unreadFollow($page,$request->input('page')));
                break;
                case 'deal':
                    $this->blNews($notificationsId);
                    return response()->json($this->unreadDeal($page,$request->input('page')));
                break;
            }

        }
    }

    //根据id删除
    public function deleteNf(Request $request){
        $bigType = $request->input('bigType');
        $smallType = $request->input('smallType');
        $page = ($request->input('page')-1)*10;
        $notificationsId = $request->input('notificationsId');

        if($bigType === 'all'){

            switch($smallType){
                case 'all':
                    $this->scNews($notificationsId);
                    return response()->json($this->allAll($page,$request->input('page')));
                break;
                case 'replyPost':
                    $this->scNews($notificationsId);
                    return response()->json($this->allReplyPost($page,$request->input('page')));
                break;
                case 'commentArticle':
                    $this->scNews($notificationsId);
                    return response()->json($this->allCommentArticle($page,$request->input('page')));
                break;
                case 'follow':
                    $this->scNews($notificationsId);
                    return response()->json($this->allFollow($page,$request->input('page')));
                break;
                case 'deal':
                    $this->scNews($notificationsId);
                    return response()->json($this->allDeal($page,$request->input('page')));
                break;
            }

        }elseif($bigType === 'unread'){

            switch($smallType){
                case 'all':
                    $this->scNews($notificationsId);
                    return response()->json($this->unreadAll($page,$request->input('page')));
                break;
                case 'replyPost':
                    $this->scNews($notificationsId);
                    return response()->json($this->unreadReplyPost($page,$request->input('page')));
                break;
                case 'commentArticle':
                    $this->scNews($notificationsId);
                    return response()->json($this->unreadCommentArticle($page,$request->input('page')));
                break;
                case 'follow':
                    $this->scNews($notificationsId);
                    return response()->json($this->unreadFollow($page,$request->input('page')));
                break;
                case 'deal':
                    $this->scNews($notificationsId);
                    return response()->json($this->unreadDeal($page,$request->input('page')));
                break;
            }

        }elseif($bigType === 'read'){

            switch($smallType){
                case 'all':
                    $this->scNews($notificationsId);
                    return response()->json($this->readAll($page,$request->input('page')));
                break;
                case 'replyPost':
                    $this->scNews($notificationsId);
                    return response()->json($this->readReplyPost($page,$request->input('page')));
                break;
                case 'commentArticle':
                    $this->scNews($notificationsId);
                    return response()->json($this->readCommentArticle($page,$request->input('page')));
                break;
                case 'follow':
                    $this->scNews($notificationsId);
                    return response()->json($this->readFollow($page,$request->input('page')));
                break;
                case 'deal':
                    $this->scNews($notificationsId);
                    return response()->json($this->readDeal($page,$request->input('page')));
                break;
            }

        }
    }

    //消息通知的单个页面
    public function only(Request $request){
        $nid = $request->input('nid');
        $data = null;

        $nf = DB::table('notifications')->where('id',$nid)->first();

        $data['nf'] = $nf;
        $data['data'] = json_decode($nf->data,true);

        if($nf->type === 'App\Notifications\CommentArticleNotification'){

            $data['content'] = CommentArticle::findOrFail($data['data']['commentId']);

            return view('home.News.onlyArticle',compact('data'));

        }elseif($nf->type === 'App\Notifications\ReplyPostNotification'){

            $data['content'] = Reply::findOrFail($data['data']['replyId'])->content;

            return view('home.News.onlyPost',compact('data'));
        }

    }
}
