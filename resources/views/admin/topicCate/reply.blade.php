@extends('layouts.admin')

@section('content')
<div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>{{ $topic->title }}<small>所有回帖</small></h2>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <p class="text-muted font-13 m-b-30">
                  展示该条交流帖子下的所有回帖
                </p>

                <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>所属用户</th>
                      <th>操作</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($replies as $reply)
                        <tr>
                          <td>{{ $reply->id }}</td>
                          <td>{{ $reply->user->name }}</td>
                          <td style="width:30%">
                              <button detail="{{ $reply->reply }}" class="btn btn-primary btn-xs ckdetail" data-toggle="modal" data-target="#myModal"><i class="fa fa-folder"></i> 查看内容 </button>
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
        $('#myModalLabel').html("{{ $topic->title }}");
        $('.modal-body').html($(this).attr('detail'));
    });
</script>
@endsection
