@extends('layouts.home')

@section('title')
<title>{{ $user->name}}的个人中心_我的地址[传承网]</title>
@endsection

@section('css')
<!-- 个人中心样式 -->
<link rel="stylesheet" href="/home/css/personal/amazeui.cropper.css">
<link rel="stylesheet" href="/home/css/personal/custom_up_img.css">
<link rel="stylesheet" type="text/css" href="/home/css/personal/personal.css">
<link rel="stylesheet" type="text/css" href="/home/css/personal/address.css">
@endsection

@section('content')

<div style="padding:0px;" class="container-fluid">
    <div id="personal_con">
        <!-- 左栏 -->
        @include("layouts.personleft")
        <!-- 右栏 -->
        <div id="personal_right">
            <h2 style="text-align:center;margin-top:20px;">我的地址 <small>Address</small></h2>
            <div class="address_info"><b>温馨提示</b><span>地址信息必须真实有效。</span></div>
            <div id="bank-exist" flag="1">

               <div id="bank-exist-a">
                  <span>查看地址信息 <span class="bank-click" id="bank-c">「点击收起」</span> </span>
                  <img src="/home/images/more.png" id="bank-exist-img" flag="1" style="transform: rotate(90deg); transition: all 0.3s ease 0s;width:20px;float:right">
               </div>
               <div class="table-responsive">
                   <table class="table">
                        <tbody id="bank-line">
                            <tr>
                                <th>所在省</th>
                                <th>所在市</th>
                                <th>所在县</th>
                                <th>详细街道</th>
                                <th>操作</th>
                            </tr>

                             @foreach($addresses as $address)
                              <tr id="bk{{ $address->id }}">
                                 <td>{{ $address->province }}</td>
                                 <td>{{ $address->city }}</td>
                                 <td>{{ $address->county }}</td>
                                 <td>{{ $address->street }}</td>
                                 <td>
                                   <button addressid="{{ $address->id }}" type="button" class="btn btn-primary bank-edit" data-toggle="modal" data-target="#myModal">
                                     修改
                                   </button>
                                   <button addressid="{{ $address->id }}"  type="button" class="btn btn-danger bank-del">删除</button>
                                 </td>
                              </tr>
                              @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div id="bank-tj" flag="2">
               <div id="bank-tj-a">
                  <span>添加地址信息 <span class="bank-click" id="bank-c1">「点击展开」</span> </span>
                  <img src="/home/images/more.png" id="bank-tj-img" flag="1" style="transform: rotate(0deg); transition: all 0.3s ease 0s;width:20px;float:right">
               </div>

               <form class="form-horizontal">
                   <div class='form-group'>
    					<label for="address" class="col-sm-2 control-label">所在地区</label>
    					<div class="col-sm-10" style='padding:0px;'>
    						<div class="col-md-4">
    							<select name="province" id="province" class="form-control"></select>
    						</div>
    						<div class="col-md-4">
    							<select name="city" id="city" class="form-control"></select>
    						</div>
    						<div class="col-md-4">
    							<select name="county" id="area" class="form-control"></select>
    						</div>
    					</div>
    				</div>

                    <div class="form-group">
                        <label for="street" class="col-sm-2 control-label">详细街道</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="street" placeholder="请您输入具体的地址">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="street" class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                            <input id="tjAddress" type="submit" value="立即添加" class="btn btn-primary">
                        </div>
                    </div>
                </form>
            </div>


            <!-- 修改银行的弹出层 -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="margin-top:100px;">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">修改地址信息</h4>
                  </div>
                  <div class="modal-body">
                  <form class="layui-form">
                      <div class="form-group">
                        <label for="exampleInputEmail1">所在省</label>
                        <select name="sheng" id="sheng" class="form-control"></select>
                      </div>

                      <div class="form-group">
                        <label for="exampleInputEmail1">所在市</label>
                        <select name="shi" id="shi" class="form-control"></select>
                      </div>

                      <div class="form-group">
                        <label for="exampleInputEmail1">所在县</label>
                        <select name="xian" id="xian" class="form-control"></select>
                      </div>

                      <div class="form-group">
                          <label for="jiedao">详细街道</label>
                          <input type="text" class="form-control" id="jiedao" placeholder="请您输入具体的地址">
                      </div>

                     <input type="hidden" id="addressid" value="" name="addressid">
                  </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" id="bankqx" class="btn btn-default" data-dismiss="modal">取消修改</button>
                    <button type="button" id="bank-subedit" class="btn btn-primary">提交修改</button>
                  </div>
                </div>
              </div>
            </div>

        </div>
    </div>
</div>


@endsection

@section('js')
<script type="text/javascript" src="/home/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/home/js/personal/custom_up_img.js"></script>
<script type="text/javascript" src="/home/js/personal/amazeui.min.js"></script>
<script type="text/javascript" src="/home/js/personal/cropper.min.js"></script>
<script type="text/javascript" src="/home/js/sel/pcasunzip.js" charset="gb2312"></script>
<script type="text/javascript" src="/home/js/personal/address.js"></script>
@endsection
