@extends('layouts.admin')

@section('content')
<div class="">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>修改 <small>买卖盘种类</small></h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">

            <form action="{{ action('Admin\DealCateController@update') }}" method="POST" class="form-horizontal form-label-left" novalidate>
              {{ csrf_field() }}
              <p>修改 <code>买卖盘</code> 种类名称
              </p>
              <span class="section">Edit DealCate</span>

              <input type="hidden" name="id" value="{{ $dealCate->id }}">
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">种类名称 <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input id="name" class="form-control col-md-7 col-xs-12" value="{{ $dealCate->name }}" name="name" required="required" type="text">
                </div>
              </div>

              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-6 col-md-offset-3">
                  <!-- <button type="submit" class="btn btn-primary">Cancel</button> -->
                  <button id="send" type="submit" class="btn btn-success">确认修改</button>
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
