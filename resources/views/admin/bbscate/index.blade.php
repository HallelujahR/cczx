@extends('layouts.admin')

@section('css')
<link rel="stylesheet" href="/x-admin/css/xadmin.css">
@endsection

@section('content')
<div class="col-md-12 col-sm-12 col-xs-12">
	<div class="x_panel">
      <div class="x_title">
        <h2>浏览<small>分类</small></h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <p class="text-muted font-13 m-b-30">
          展示所有分类列表
        </p>
		<table class="layui-table layui-form">
		    <thead>
		      <tr>
		        <th width="70">ID</th>
		        <th>栏目名</th>
		        <th>操作</th>
		      </tr>
		    </thead>
		    <tbody class="x-cate">

		    @foreach($cates as $cate)
			    <tr cate-id='{{ $cate->id }}' fid='{{ $cate->pid }}' >
			        <td>{{ $cate->id }}</td>
			        <td>
			          <i class="layui-icon x-show" status='true'>&#xe623;</i>
			          {{ $cate->cate }}
			        </td>
			        <td class="td-manage">
		            	<a href="{{ action('Admin\BbsCateController@edit',['id'=>$cate->id]) }}" class="layui-btn layui-btn layui-btn-xs"><i class="layui-icon">&#xe642;</i>编辑</a>
		            	<a href="{{ action('Admin\BbsCateController@create',['id'=>$cate->id]) }}" class="layui-btn layui-btn-warm layui-btn-xs" ><i class="layui-icon">&#xe642;</i>添加子分类</a>
		            	<button cate_id="{{ $cate->id }}" class="layui-btn-danger layui-btn layui-btn-xs shanchu"><i class="layui-icon">&#xe640;</i>删除</button>
		            	@if($cate->posts->count('id') > 0)
		            	<a class="layui-btn-normal layui-btn layui-btn-xs" href="{{ action('Admin\BbsCateController@posts',$cate->id) }}">查看帖子</a>
		            	@endif
		            </td>
			    </tr>
			    @foreach($cate->sub as $sub1)
				    <tr cate-id='{{ $sub1->id }}' fid='{{ $sub1->pid }}' >
				        <td>{{ $sub1->id }}</td>
				        <td>
				          &nbsp;&nbsp;&nbsp;&nbsp;
				          {{ $sub1->cate }}
				        </td>
				        <td class="td-manage">
			            	<a href="{{ action('Admin\BbsCateController@edit',['id'=>$sub1->id]) }}" class="layui-btn layui-btn layui-btn-xs"><i class="layui-icon">&#xe642;</i>编辑</a>
			            	<button cate_id="{{ $sub1->id }}" class="layui-btn-danger layui-btn layui-btn-xs shanchu" href="javascript:;" ><i class="layui-icon">&#xe640;</i>删除</button>
			            	@if($sub1->posts->count('id') > 0)
			            	<a class="layui-btn-normal layui-btn layui-btn-xs" href="{{ action('Admin\BbsCateController@posts',$sub1->id) }}">查看帖子</a>
			            	@endif
			            </td>
				    </tr>
			    @endforeach
		    @endforeach
		    </tbody>
		</table>
	  </div>
	</div>
</div>
@endsection

@section('js')
<script type="text/javascript" src="/x-admin/lib/layui/layui.js" charset="utf-8"></script>
<script type="text/javascript" src="/x-admin/js/xadmin.js"></script>
<script type="text/javascript">
//删除分类
$('.shanchu').click(function(){
    var id = $(this).attr('cate_id');
    var _this = $(this);
    layer.confirm('您确认删除该分类并且删除该分类下的所有帖子？', {
        btn: ['确定','取消'] //按钮
    }, function(){

        $.ajax({
            url:"{{ action('Admin\BbsCateController@chaxun')}}",
            data:{id:id},
            type:'get',
            success:function(mes){
                if(mes=='ok'){
                    $.ajax({
                        url:"{{ action('Admin\BbsCateController@delete')}}",
                        data:{id:id},
                        type:'get'
                    });
                    _this.parents('tr').remove();
                    layer.msg('删除成功', {icon: 1});
                }else{
                    layer.msg('由于该分类下存在子类故不能删除', {icon: 2});
                }
            }
        });
    });
});
</script>
@endsection