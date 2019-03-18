@extends('layouts.admin')

@section('content')
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>浏览<small>{{ $topic->cate }} 下的交流贴</small></h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <p class="text-muted font-13 m-b-30">
          展示 {{ $topic->cate }}下的所有帖子
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
            @foreach($posts as $post)
                <tr>
                  <td>{{ $post->id }}</td>
                  <td>{{ $post->user->name }}</td>
                  <td>{{ $post->cate->cate }}</td>
                  <td>{{ $post->title }}</td>
                  <td>{{ $post->access_count }}</td>
                  <td style="width:30%">
                    <button detail="{{ $post->content }}" class="btn btn-primary btn-xs ckdetail" data-toggle="modal" data-target="#myModal"><i class="fa fa-folder"></i> 查看详情 </button>

                    @if($post->replies->count('id') > 0)
                      <a href="{{ action('Admin\TopicController@reply',$post->id) }}" class="btn btn-warning btn-xs"><i class="fa fa-reply-all"> 查看回帖 </i></a>
                    @endif
                  </td>
                </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Modal title</h4>
        </div>
        <div class="modal-body">
          ...
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('js')
<script type="text/javascript">
    $('.ckdetail').click(function(){
        $('#myModalLabel').html($(this).parent().prev().prev().html());
        $('.modal-body').html($(this).attr('detail'));
    });
</script>
@endsection
