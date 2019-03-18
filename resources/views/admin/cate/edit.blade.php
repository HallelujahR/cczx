@extends('layouts.admin')

@section('content')
<div class="">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>分类表单 <small>修改分类名称</small></h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">

            <form action="{{ action('Admin\CateController@update') }}" method="POST" class="form-horizontal form-label-left" enctype="multipart/form-data" novalidate>
              {{ csrf_field() }}
              <p>修改 <code>分类</code> 表单 <a href="form.html">信息</a>
              </p>
              <span class="section">Cate Info</span>

              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">分类名称 <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="hidden" name="id" value="{{ $cate->id }}">
                  <input id="name" class="form-control col-md-7 col-xs-12" name="cate" value="{{ $cate->cate }}" required="required" type="text">
                </div>
                @if($errors->has('cate'))
                    <span class="help-block">
                        <strong>{{ $errors->first('cate') }}</strong>
                    </span>
                @endif
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">展示位置</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <select class="form-control" name="check">
                    <option value="0" @if($cate->check == 0) selected @endif>横条</option>
                    <option value="1" @if($cate->check == 1) selected @endif>竖条</option>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">选择图片</label>
                <div class="col-md-6 col-sm-6 col-xs-12" style="margin-top:8px">
                  <input type="file" name="file" />
                </div>
              </div>

              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-6 col-md-offset-3">
                  <!-- <button type="submit" class="btn btn-primary">Cancel</button> -->
                  <button id="send" type="submit" class="btn btn-success">Submit</button>
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
