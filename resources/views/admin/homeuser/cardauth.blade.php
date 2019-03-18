@extends('layouts.admin')

@section('css')
<link rel="stylesheet" href="/admins/css/boxImg.css">
<style>
.checkbox-inline{

}
</style>
@endsection

@section('content')
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>浏览<small>实名认证用户<span style="color:red">（点击图片可放大旋转）</span></small></h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <p class="text-muted font-13 m-b-30">
          展示前台提交实名认证的用户
        </p>

        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th>ID</th>
              <th>用户名</th>
              <th>真实姓名</th>
              <th>身份证号</th>
              <th>身份证正面照</th>
              <th>身份证反面照</th>
              <th>手持身份证正面照</th>
              <th>操作</th>
            </tr>
          </thead>
          <tbody>
            @foreach($cards as $card)
                <tr id="card_message_{{ $card->id }}">
                    <td>{{ $card->id }}</td>
                    <td>{{ $card->user->name }}</td>
                    <td>{{ $card->realName }}</td>
                    <td>{{ $card->idCard }}</td>
                    <td>
                        <img modal="zoomImg" index="0" src="{{ $card->positive }}" style="width:200px;height:100px;">
                    </td>
                    <td>
                        <img modal="zoomImg" index="1" src="{{ $card->opposite }}" style="width:200px;height:100px;">
                    </td>
                    <td>
                        <img modal="zoomImg" index="2" src="{{ $card->hold }}" style="width:200px;height:100px;">
                    </td>
                    <td style="width:30%;">
                        <a class="btn btn-primary btn-xs ty"><i class="fa fa-check"></i> 同意</a>
                        <a class="btn btn-danger btn-xs" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo"><i class="fa fa-close"></i> 拒绝</a>
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
        <h4 class="modal-title" id="exampleModalLabel">New message</h4>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label class="checkbox-inline">
              <input type="checkbox" name="reason" value="实名认证姓名与证件照不符"> 实名认证姓名与证件照不符
            </label>
            <label class="checkbox-inline">
              <input type="checkbox" name="reason" value="身份证号与证件照不符"> 身份证号与证件照不符
            </label>
            <label class="checkbox-inline">
              <input type="checkbox" name="reason" value="身份证正面照不清晰"> 身份证正面照不清晰
            </label>
            <label class="checkbox-inline">
              <input type="checkbox" name="reason" value="身份证反面照不清晰"> 身份证反面照不清晰
            </label>
            <label class="checkbox-inline">
              <input type="checkbox" name="reason" value="手持身份证照不清晰"> 手持身份证照不清晰
            </label>
          </div>

          <div class="form-group">
              <label for="">自定义理由：</label>
              <textarea class="form-control" id="custom" rows="3"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
        <button type="button" class="btn btn-primary" id="jj" data-dismiss="modal">发送</button>
      </div>
    </div>
  </div>
</div>
@endsection

@section('js')
<script src="/admins/js/boxImg.js"></script>
<script type="text/javascript">
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    $('.ty').click(function(){
        var id = parseInt($(this).parents('tr').children('td:eq(0)').html());
        $.ajax({
            url:"/admin/homeuser/agreeCard",
            type:"post",
            data:{id:id},
            success:function(mes){
                if(mes == 1){
                    $(this).parents('tr').remove();
                    layer.msg('已同意审核');
                }else{
                    layer.msg('已拒绝审核');
                }
            }.bind(this)
        });
    });

    $('#exampleModal').on('show.bs.modal', function (e) {
        clear();
        var name = $(e.relatedTarget).parents('tr').children('td:eq(2)').html();
        $('#jj').attr('card_id',parseInt($(e.relatedTarget).parents('tr').children('td:eq(0)').html()));
        $('#exampleModalLabel').html('拒绝<span style="color:red">'+name+'</span>认证的理由（选择和自定义可一起使用）');
    });

    $('#jj').click(function(){
        var id = $(this).attr('card_id');
        var custom = $('#custom').val();

        if(show() == '' && custom == ''){
            layer.msg('请填写用户审核失败的原因');
            return false;
        }

        $.ajax({
            url:'/admin/homeuser/refuseCard',
            type:'post',
            data:{id:id,info:show(),custom:custom},
            success:function(mes){
                if(mes == 1){
                    $('#card_message_'+id).remove();
                    layer.msg('已把用户审核失败的信息发送给他');
                }else{
                    layer.msg('拒绝失败');
                }
            }
        });


    });

    function show(){
        var obj = document.getElementsByName("reason");
        var check_val = [];
        for(k in obj){
            if(obj[k].checked)
                check_val.push(obj[k].value);
        }
        return check_val;
    }

    function clear(){
        var obj = document.getElementsByName("reason");
        for(k in obj){
            if(obj[k].checked){
                $(obj[k]).removeAttr('checked');
            }
        }

        $('#custom').val('');
    }
</script>
@endsection
