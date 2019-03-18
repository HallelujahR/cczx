@extends('layouts.admin')

@section('content')
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>浏览<small>所有公告</small></h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <p class="text-muted font-13 m-b-30">
          展示传承网下的所有公告
        </p>

        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th>ID</th>
              <th>所属作者</th>
              <th>标题</th>
              <th>操作</th>
            </tr>
          </thead>
          <tbody>
            @foreach($notices as $notice)
                <tr>
                    <td>{{ $notice->id }}</td>
                    <td>{{ $notice->user->name }}</td>
                    <td>{{ $notice->title }}</td>
                    <td style="width:30%">
                        <button type="button" name="button" class="btn btn-default ck" data-toggle="modal" data-target="#myModal" content="{{ $notice->content }}">查看内容</button>
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

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">关闭</button>
      </div>
    </div>
  </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
    $('.ck').click(function(){
        var title = $(this).parent().prev().html();
        $('#myModalLabel').html($(this).parent().prev().html());
        $('.modal-body').html($(this).attr('content'));
    });
</script>
@endsection
