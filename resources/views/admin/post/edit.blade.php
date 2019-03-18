@extends('layouts.admin')

@section('content')
<div class="">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>修改 <small>帖子</small></h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">

            <form action="{{ action('Admin\PostController@update') }}" method="POST" class="form-horizontal form-label-left" novalidate>
              {{ csrf_field() }}
              <input type="hidden" name="id" value="{{ $post->id }}">
              <p>请输入 <code>修改帖子</code> 的相关信息
              </p>
              <span class="section">Post Info</span>

              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">帖子标题 <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input id="title" class="form-control col-md-7 col-xs-12" name="title" value="{{ $post->title }}" required="required" type="text">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">所属分类</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <select class="form-control" name="bbs_cate_id">
                    @foreach($cates as $cate)
                        <option value="{{ $cate->id }}" @if($post->bbs_cate_id == $cate->id) selected @endif>{{ $cate->cate }}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-6 col-md-offset-3">
                  <!-- <button type="submit" class="btn btn-primary">Cancel</button> -->
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
<script type="text/javascript" src='/wangeditor/wangEditor.min.js'></script>
<script src="/admins/vendors/validator/validator.js"></script>

@endsection
