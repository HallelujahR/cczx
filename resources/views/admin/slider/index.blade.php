@extends('layouts.admin')

@section('content')
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>浏览<small>所有轮播图</small></h2>
        <button style="float:right;" type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal">添加</button>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <p class="text-muted font-13 m-b-30">
          展示传承网下的首页轮播图
        </p>

        <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th>ID</th>
              <th>描述</th>
              <th>图片</th>
              <th>路径</th>
              <th>操作</th>
            </tr>
          </thead>
          <tbody>
            @foreach($sliders as $slider)
                <tr>
                    <td>{{ $slider->id }}</td>
                    <td>{{ $slider->name }}</td>
                    <td style="text-align:center;"><img src="{{ $slider->path }}" width="400px"></td>
                    <td>{{ $slider->link }}</td>
                    <td style="width:30%">
                        <a href="{{ action('Admin\SliderController@delete',$slider->id) }}" class="btn btn-primary btn-xs"><i class="fa fa-trash-o"> 删除</i></a>
                        <a href="{{ action('Admin\SliderController@edit',$slider->id) }}" class="btn btn-success btn-xs"><i class="fa fa-trash-o"> 修改</i></a>
                        <button type="button" class="btn btn-default btn-xs up"><span class="glyphicon glyphicon-arrow-up"></span></button>
                        <button type="button" class="btn btn-default btn-xs down"><span class="glyphicon glyphicon-arrow-down"></span></button>
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
        <h4 class="modal-title" id="myModalLabel">添加轮播图</h4>
      </div>
      <div class="modal-body">
          <form method="post" action="{{ action('Admin\SliderController@store') }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group">
              <label for="name" class="control-label">描述:</label>
              <input type="text" class="form-control" name="name" id="name" placeholder="请填写轮播图的描述" required>
            </div>
            <div class="form-group">
              <label for="link" class="control-label">链接:</label>
              <input type="text" class="form-control" name="link" id="link" placeholder="请填写轮播图的链接" required>
            </div>
            <div class="form-group">
              <label for="pic" class="control-label">上传图片:</label>
              <input type="file" class="form-control" name="pic" id="pic">
            </div>
            <div class="modal-footer" style="margin-top:30px;">
              <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
              <button type="submit" class="btn btn-primary">保存</button>
            </div>
          </form>
      </div>
    </div>
  </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
    $('.up').click(function(){
        // 获取当前ID
        var id = $(this).parent().parent().children(':first').text();

        $.ajax({
            url:"slider/orderPic",
            type:'get',
            dataType:'json',
            data:{id:id,action:'up'},
            success:function(e){
                if(e['status'] == 'ok'){
                    var nowTr = $(this).parent().parent();
                    var prevId = $(nowTr).prev().find('td:eq(0)').text();
                    var nId = $(nowTr).find('td:eq(0)').text();
                    $(nowTr).after($(nowTr).prev());
                    $(nowTr).find('td:eq(0)').text(nId);
                    $(nowTr).next().find('td:eq(0)').text(prevId);
                }else{
                    layer.msg(e['error']);
                }
            }.bind(this)
        });

        return false;
    });

    $('.down').click(function(){
         // 获取当前ID
        var id = $(this).parent().parent().children(':first').text();

        $.ajax({
            url:'slider/orderPic',
            type:'get',
            dataType:'json',
            data:{id:id,action:'down'},
            success:function(e){
                if(e['status'] == 'ok'){
                    //获取当前tr
                    var nowTr = $(this).parent().parent();
                    var nextTr = $(this).parent().parent().next();

                    var nextId = $(nextTr).find('td:eq(0)').text();
                    var nId = $(nowTr).find('td:eq(0)').text();

                    $(nowTr).before($(nextTr)).find('td:eq(0)').text(nId);
                    $(nextTr).find('td:eq(0)').text(nextId);

                }else{
                    layer.msg(e['error']);
                }
            }.bind(this)
        });
         return false;
    });
</script>
@endsection
