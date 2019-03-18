@extends('layouts.admin')

@section('content')
<div class="">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>添加 <small>友情链接</small></h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">

            <form action="{{ action('Admin\LinkController@store') }}" method="POST" class="form-horizontal form-label-left" novalidate>
              {{ csrf_field() }}
              <p>请输入 <code>友情链接</code> 的 <a href="form.html">信息</a>
              </p>
              <span class="section">Friend Link</span>

              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">标题 <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input id="title" class="form-control col-md-7 col-xs-12" name="title" placeholder="请输入友情链接标题" required="required" type="text">
                </div>
              </div>

              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="url">链接 <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input id="url" class="form-control col-md-7 col-xs-12" name="url" placeholder="请输入友情链接url" required="required" type="text">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">显示位置</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <select class="form-control" name="status">
                    <option value="1">首页</option>
                    <option value="2">栏目</option>
                    <option value="3">详情</option>
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
