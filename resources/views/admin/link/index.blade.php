@extends('layouts.admin')

@section('content')
<div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>浏览<small>管理员</small></h2>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <p class="text-muted font-13 m-b-30">
                  展示后台管理员所有信息
                </p>

                <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>标题</th>
                      <th>链接</th>
                      <th>显示位置</th>
                      <th>操作</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($links as $link)
                        <tr>
                            <td>{{ $link->id }}</td>
                            <td>{{ $link->title }}</td>
                            <td><a href="{{ $link->url }}" target="_blank">{{ $link->url }}</a></td>
                            <td>@if($link->status == 1) 首页 @elseif($link->status == 2) 栏目 @elseif($link->status ==3 ) 详情 @endif</td>
                            <td>
                              <a href="{{ action('Admin\LinkController@edit',$link->id) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> 修改 </a>
                              <a href="{{ action('Admin\LinkController@delete',$link->id) }}" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> 删除 </a>
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
