@extends('layouts.admin')

@section('content')
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>浏览<small>所有话题种类</small></h2>
        <a href="{{ action('Admin\TopicController@add') }}" class="btn btn-primary" style="float:right;">添加种类</a>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <p class="text-muted font-13 m-b-30">
          展示话题分类
        </p>

        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th>ID</th>
              <th>种类名称</th>
              <th>操作</th>
            </tr>
          </thead>
          <tbody>
            @foreach($topicCates as $topic)
                <tr>
                    <td>{{ $topic->id }}</td>
                    <td>{{ $topic->cate }}</td>
                    <td>
                        <a href="{{ action('Admin\TopicController@topicPost',$topic->id) }}" class="btn btn-info btn-xs"><i class="fa fa-reply-all"> 查看帖子 </i></a>
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
