@extends('layouts.admin')
 
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-0">
            <div class="panel panel-default">
                <div class="panel-heading">网站概况</div>
                <div class="panel-body">
                   <div class="row tile_count">
                    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                      <span class="count_top"><i class="fa fa-user"></i>用户总数</span>
                      <div class="count">{{$userCount}}</div>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                      <span class="count_top"><i class="fa fa-clock-o"></i>文章总数</span>
                      <div class="count">{{$ArticleCount}}</div>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                      <span class="count_top"><i class="fa fa-user"></i>帖子总数</span>
                      <div class="count green">{{$PostCount}}</div>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                      <span class="count_top"><i class="fa fa-user"></i>文章评论总数</span>
                      <div class="count">{{$CommentArticleCount}}</div>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                      <span class="count_top"><i class="fa fa-user"></i>帖子回复总数</span>
                      <div class="count">{{$Reply}}</div>              
                    </div>
<!--                     <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                      <span class="count_top"><i class="fa fa-user"></i> Total Connections</span>
                      <div class="count">7,325</div>
                
                    </div> -->
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection