@extends('layouts.admin')

@section('css')
<style type="text/css">
	.info{
		height:35px;
		line-height:35px;
	}
</style>
@endsection

@section('content')
<div class="">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>网站配置 <small>管理</small></h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">

            <form action="{{ action('Admin\ConfigController@store') }}" method="POST" class="form-horizontal form-label-left" enctype="multipart/form-data" novalidate>
              {{ csrf_field() }}
              <p>请输入 <code>网站配置</code> 信息
              </p>
              <span class="section">Web Site Info</span>

              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="siteName">网站名称
                </label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <input id="siteName" class="form-control col-md-7 col-xs-12" name="siteName" type="text" value="{{ $config->siteName }}">
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12 info">
                	* 网站名称
               	</div>
              </div>

              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="website">网站地址
                </label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <input id="website" class="form-control col-md-7 col-xs-12" name="website" type="text" value="{{ $config->website }}">
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12 info">
                	* 网站完整的URL访问地址
               	</div>
              </div>

              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="logo">
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                	<img src="{{ $config->logo }}" style="width:200px;"/>
                </div>
              </div>

              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="logo">网站logo
                </label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <input id="logo" class="form-control col-md-7 col-xs-12" name="logo" type="file">
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12 info">
                	  直接从本地上传图片覆盖原有的网站logo
               	</div>
              </div>

              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="contacts">联系人
                </label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <input id="contacts" class="form-control col-md-7 col-xs-12" name="contacts" type="text" value="{{ $config->contacts }}">
                </div>
              </div>

              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="qq">QQ
                </label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <input id="qq" class="form-control col-md-7 col-xs-12" name="qq" type="text" value="{{ $config->qq }}">
                </div>
              </div>

              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email
                </label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <input id="email" class="form-control col-md-7 col-xs-12" name="email" type="text" value="{{ $config->email }}">
                </div>
              </div>

              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="phone">手机
                </label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <input id="phone" class="form-control col-md-7 col-xs-12" name="phone" type="text" value="{{ $config->phone }}">
                </div>
              </div>

              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="telephone">固定电话
                </label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <input id="telephone" class="form-control col-md-7 col-xs-12" name="telephone" type="text" value="{{ $config->telephone }}">
                </div>
              </div>

              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="address">具体地址
                </label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <input id="address" class="form-control col-md-7 col-xs-12" name="address" type="text" value="{{ $config->address }}">
                </div>
              </div>

              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">首页title
                </label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <input id="title" class="form-control col-md-7 col-xs-12" name="title" type="text" value="{{ $config->title }}">
                </div>
              </div>

              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="keywords">首页keywords
                </label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <input id="keywords" class="form-control col-md-7 col-xs-12" name="keywords" type="text" value="{{ $config->keywords }}">
                </div>
              </div>

              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">首页description
                </label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <input id="description" class="form-control col-md-7 col-xs-12" name="description" type="text" value="{{ $config->description }}">
                </div>
              </div>

              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="longPic">
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <img src="{{ $config->longPic }}" style="width:400px;"/>
                </div>
              </div>

              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="longPic">网站中上方的长图片
                </label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <input id="longPic" class="form-control col-md-7 col-xs-12" name="longPic" type="file">
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12 info">
                    直接从本地上传图片覆盖原有的图片
                    建议图片尺寸 1200*90
                </div>
              </div>

              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-6 col-md-offset-3">
                  <button id="send" type="submit" class="btn btn-success">保存基本设置</button>
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
