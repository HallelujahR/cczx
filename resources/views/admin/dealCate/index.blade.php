@extends('layouts.admin')

@section('content')
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>浏览<small>所有买卖盘种类</small></h2>
        <a href="{{ action('Admin\DealCateController@add') }}" class="btn btn-primary" style="float:right;">添加种类</a>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <p class="text-muted font-13 m-b-30">
          展示买卖盘分类
        </p>

        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th>ID</th>
              <th>种类名称</th>
              <th>排序</th>
              <th>操作</th>
            </tr>
          </thead>
          <tbody>
            @foreach($dealCates as $dealCate)
                <tr>
                    <td>{{ $dealCate->id }}</td>
                    <td>{{ $dealCate->name }}</td>
                    <td>{{ $dealCate->sort }}</td>
                    <td style="width:30%">
                        <a href="{{ action('Admin\DealCateController@edit',$dealCate->id) }}" class="btn btn-info btn-xs">编辑</a>
                        <button class="btn btn-danger btn-xs clickSort" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo" info="{{ $dealCate->id }}">更改排序</button>
                    </td>
                </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
   <div class="modal-dialog" role="document">
     <div class="modal-content">
       <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         <h4 class="modal-title" id="exampleModalLabel">排序</h4>
       </div>
       <div class="modal-body">
         <form action="{{ action('Admin\DealCateController@updateSort') }}" method="post">
             {{ csrf_field() }}
           <div class="form-group">
             <label for="sort" class="control-label">排序编号:</label>
             <input type="number" class="form-control" id="sort" name="sort">
             <input type="hidden" name="id" id="cateid" value="">
           </div>

           <div class="modal-footer">
             <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
             <button type="submit" class="btn btn-primary">确认修改</button>
           </div>
         </form>
       </div>
     </div>
   </div>
 </div>
@endsection

@section('js')
<script type="text/javascript">
    $('.clickSort').click(function(){
        $('#cateid').val(parseInt($(this).attr('info')));
        $('#sort').val(parseInt($(this).parent().prev().html()));
        $('#exampleModalLabel').html($(this).parent().prev().prev().html()+'排序编号');
    });
</script>
@endsection
