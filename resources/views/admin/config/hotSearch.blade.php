@extends('layouts.admin')

@section('css')
<style type="text/css">
  .info{
    height:35px;
    line-height:35px;
  }

</style>
<link rel="stylesheet" type="text/css" href="/home/css/hotsearch.css">
@endsection

@section('content')
<div class="x_panel">
  <div class="x_title">
    <h2>热搜管理 <small>热搜</small></h2>

    <div class="clearfix"></div>
  </div>
  <div class="x_content">
    <div>
      链接的格式如:https://www.baidu.com
    </div>
    <form class="form-horizontal form-label-left"novalidate="">
      <div  id="addForm" >

      @foreach($hot as $k => $v)
      <div class="item form-group">
        <div class="col-md-3 col-sm-3 col-xs-6">
          名字
          <input id="searchName" class="form-control col-md-3 col-xs-6" data-validate-words="2" name="searchName" placeholder="输入热搜名称"  value="{{$v->name}}" type="text">
        </div>
        <div class="col-md-3 col-sm-3 col-xs-6">
          链接
          <input id="searchLink" class="form-control col-md-3 col-xs-6" data-validate-length-range="6"  name="searchLink" placeholder="在此处输入热搜链接" value="{{$v->link}}" type="text">
        </div>

        <div class="caozuo">
          <i class="fa fa-i fa-close" sid="{{$v->id}}"></i>
          <i class="fa fa-i fa-arrow-down" ></i>
          <i class="fa fa-i fa-arrow-up"></i>
          <i class="fa fa-i fa-check"></i>
        </div>
      </div>
      @endforeach
</div>


    
      <div class="ln_solid"></div>
      <div class="form-group">
        <div class="col-md-3 col-md-offset-1">
          <button type="button" id="add" class="btn btn-primary">添加</button>
          <!-- <button id="send" type="reset" class="btn btn-success">重置</button> -->
        </div>
      </div>
    </form>
  </div>
</div>
@endsection

@section('js')
    <script src="/admins/vendors/validator/validator.js"></script>
    <script type="text/javascript">



      $('#add').click(function(){
        $('#addForm').append(`
             <div class="item form-group">
        <div class="col-md-3 col-sm-3 col-xs-6">
          名字
          <input id="searchName" class="form-control col-md-3 col-xs-6" data-validate-words="2" name="searchName" placeholder="输入热搜名称"  type="text">
        </div>
         <div class="col-md-3 col-sm-3 col-xs-6">
         链接
          <input id="searchLink" class="form-control col-md-3 col-xs-6" data-validate-length-range="6"  name="searchLink" placeholder="在此处输入热搜链接"  type="text">
        </div>

        <div class="caozuo"> 
          <i class="fa fa-i fa-close"></i>
          <i class="fa fa-i fa-arrow-down"></i>
          <i class="fa fa-i fa-arrow-up"></i>
          <i class="fa fa-i fa-check"></i>
        </div>
      </div>`);
        cl();
        cs();
        del();
        updown();
      });

      function cl(){
        $('.fa-check').click(function(){

          if(/^\s*$/.test($(this).parent().prev().children(":first").val()) || /^\s*$/.test($(this).parent().prev().prev().children(":first").val()) ){
            layer.msg('不能为空');
            return false;
          }
          var sid = $(this).prev().prev().prev().attr('sid');
          if(!sid){
              var link = $(this).parent().prev().children(":first").val();
              var name = $(this).parent().prev().prev().children(":first").val();
              var _this = $(this);
              $.ajax({
                type:'get',
                url:'changeHotSearch',
                data:{
                  link:link,
                  name:name,
                  type:1,
                },
                success:function(res){
                  if(res == '2'){
                    layer.msg('添加失败');
                  }else if(res == 'exit'){
                    layer.msg('已经存在');
                  }else{
                    layer.msg('添加成功');
                    _this.prev().prev().prev().attr('sid',res['id'])
                  }
                },

              })
          }else{
             if(/^\s*$/.test($(this).parent().prev().children(":first").val()) || /^\s*$/.test($(this).parent().prev().prev().children(":first").val()) ){
                layer.msg('不能为空');
                return false;
              }
              var link = $(this).parent().prev().children(":first").val();
              var name = $(this).parent().prev().prev().children(":first").val();
              var _this = $(this);
              $.ajax({
                type:'get',
                url:'changeHotSearch',
                data:{
                  link:link,
                  name:name,
                  type:3,
                  sid:sid,
                },
                success:function(res){
                  if(res == '2'){
                    layer.msg('修改失败');
                  }else if(res == 'exit'){
                    layer.msg('已经存在');
                  }else{
                    layer.msg('修改成功');
                    _this.prev().prev().prev().attr('sid',res['id'])
                  }
                },

              })


          }


        })
      };



      function del() {
        $('.fa-close').click(function(){
          var sid = $(this).attr('sid');
          var _this = $(this);

          if(!sid){
            _this.parent().parent().remove();
            return false;
          }
          
          $.ajax({
            type:'get',
            url:'changeHotSearch',
            data:{
              sid:sid,
              type:2,
            },
            success:function(res){
              if(res == '1'){
                _this.parent().parent().remove();
                layer.msg('删除成功');
              }else{
                layer.msg('删除失败');
              }
            }
          })
        })
      }

      function updown(){

          $('.fa-arrow-down').click(function(){
            if(!$(this).parent().parent().next().children(':last').children(':first').attr('sid')){
              layer.msg('没办法更往下了');
              return false;
            }
            var sid = $(this).prev().attr('sid');
            console.log(sid);
            var _this = $(this);
            $.ajax({
              type:'get',
              url:'changeHotSearch',
              data:{
                sid:sid,
                type:4,
                wz:1,
              },
              success:function(res){
                _this.parent().parent().insertAfter(_this.parent().parent().next());

                layer.msg('下移成功');
                window.location.reload()
              },
            })


          
          })

          $('.fa-arrow-up').click(function(){
              var _this = $(this);
              if($(this).parent().parent().prev().length == 0){
                layer.msg('没办法更往上了');
                return false;
              }

              var sid = $(this).prev().prev().attr('sid');
              console.log(sid);
              $.ajax({
                type:'get',
                url:'changeHotSearch',
                data:{
                  sid:sid,
                  type:4,
                  wz:2,
                },
                success:function(res){
                  _this.parent().parent().insertBefore(_this.parent().parent().prev());
                  layer.msg('上移成功');
                  window.location.reload()
                },
              })


          })

    }


      function cs(){
            $('.item').mouseover(function(){

              $(this).children('div:last-child').css({
                'display':'block',
              })

          }).mouseout(function(){
            $(this).children('div:last-child').css({
              'display':'none',
            })            
          })
      }

      cl();
      del();
      cs();
      updown();
    </script>
@endsection
