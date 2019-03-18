@extends('layouts.admin')

@section('content')
<div class="">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>修改 <small>友情链接</small></h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">

            <form action="{{ action('Admin\LinkController@update') }}" method="POST" class="form-horizontal form-label-left" novalidate>
              {{ csrf_field() }}
              <p>请输入 <code>修改友情链接</code> 的 <a href="form.html">信息</a>
              </p>
              <span class="section">Update Friend Link</span>
              <input type="hidden" name="id" value="{{ $link->id }}">
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">标题 <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input id="title" class="form-control col-md-7 col-xs-12" name="title" value="{{ $link->title }}" required="required" type="text">
                </div>
              </div>

              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="url">链接 <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input id="url" class="form-control col-md-7 col-xs-12" name="url" value="{{ $link->url }}" required="required" type="text">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">显示位置</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <select class="form-control" name="status">
                    <option value="1" @if($link->status == 1) selected @endif>首页</option>
                    <option value="2" @if($link->status == 2) selected @endif>栏目</option>
                    <option value="3" @if($link->status == 3) selected @endif>详情</option>
                  </select>
                </div>
              </div>

              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-6 col-md-offset-3">
                  <button id="send" type="submit" class="btn btn-success">提交</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection

@section('js')
    <script src="/admins/vendors/validator/validator.js"></script>
@endsection
