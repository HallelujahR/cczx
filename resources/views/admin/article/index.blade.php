@extends('layouts.admin')

@section('content')
<div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>浏览<small>所有文章</small></h2>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <p class="text-muted font-13 m-b-30">
                  展示分类下的所有文章
                </p>

                <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>所属作者</th>
                      <th>所属分类</th>
                      <th>标题</th>
                      <th>浏览量</th>
                      <th>操作</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($articles as $article)
                        <tr>
                            <td>{{ $article->id }}</td>
                            <td>{{ $article->user->name }}</td>
                            <td>{{ $article->cate->cate }}</td>
                            <td>{{ $article->title }}</td>
                            <td>{{ $article->access_count }}</td>
                            <td style="width:30%">
                              <a href="{{ action('Admin\ArticleController@editDetail',$article->id) }}" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> 查看详情 </a>
                              <a href="{{ action('Admin\ArticleController@edit',$article->id) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> 修改 </a>
                              <a href="{{ action('Admin\ArticleController@delete',$article->id) }}" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> 删除 </a>
                              @if($article->comments->count('id') > 0)
                              <a href="{{ action('Admin\ArticleController@comments',$article->id) }}" class="btn btn-warning btn-xs"><i class="fa fa-reply-all"> 查看评论 </i></a>
                              @endif
                            </td>
                        </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
@endsection

@section('js')

@endsection
