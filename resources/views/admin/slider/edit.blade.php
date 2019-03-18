@extends('layouts.admin')

@section('content')
<div class="">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>轮播图表单 <small>修改轮播图</small></h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">

            <form action="{{ action('Admin\SliderController@update') }}" method="POST" class="form-horizontal form-label-left" enctype="multipart/form-data" novalidate>
              {{ csrf_field() }}
              <p>修改 <code>轮播图</code> 表单 <a href="form.html">信息</a>
              </p>
              <span class="section">Slider Info</span>

              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">描述 <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="hidden" name="id" value="{{ $slider->id }}">
                  <input id="name" class="form-control col-md-7 col-xs-12" name="name" value="{{ $slider->name }}" required="required" type="text">
                </div>
              </div>

              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">链接 <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input id="link" class="form-control col-md-7 col-xs-12" name="link" value="{{ $slider->link }}" required="required" type="text">
                </div>
              </div>

              <div class="item form-group">
                <div class="col-md-9 col-md-offset-3">
                    <img src="{{ $slider->path }}" alt="" width="200px" height="100px">
                </div>
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">图片 <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input id="path" class="form-control col-md-7 col-xs-12" name="path" value="{{ $slider->path }}" type="file">
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
