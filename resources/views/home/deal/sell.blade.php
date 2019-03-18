@extends('layouts.home')

@section('title')
    <title>我要出售_[传承网]</title>
@endsection

@section('css')
    <!-- 论坛首页样式 -->
    <link rel="stylesheet" type="text/css" href="/home/css/deal/sell.css">
@endsection

@section('content')
  <div class="sell" style="background-image:url('/home/images/dealsell.png');background-repeat:no-repeat;background-position:800px 400px">
      <form  class="sell" id="sellform" method="post" action="{{ action('DealController@store') }}" enctype="multipart/form-data">
          {{ csrf_field() }}
          <input type="hidden" name="check" value="2">
          <div class="sell-son" style="font-size:20px;color:red">
              我要出售
          </div>
          <div class="sell-son">
              <div class="sell-son-mp">
                  卖盘种类:
              </div>
              @foreach($cate as $k => $v)
              <div class="sell-son-right">
                  <input type="radio" value="{{$v['id']}}" name="deal_cate" class="sell-son-mpzl">
                  <span style="margin-left:5px">{{$v['name']}}</span>

              </div>
              @endforeach

          </div>

          <div class="sell-son">
              <div class="sell-son-jyfs">
                  <div  >
                      交易方式:
                  </div>
                  <div style="margin-left:15px;">
                      <input type="radio" value="直接确认" checked=""><span style="margin-left:5px">直接确认</span>
                  </div>
              </div>


              <div class="sell-son-jyfs-detail">
                  <div>1、直接确认：对方直接确认就有效，如果在多个网站挂帖，本站交易帖有优先成交权！</div>
                  <div>2、自2009年1月1日起，网上邮市取消其他确认方式，即确认交易后立即生效！</div>
              </div>
          </div>

          <div class="sell-son">
              <div class="sell-son-pztitle">
                  品种名称:
              </div>
              <div>
                  <input type="text" name="shopName" required id="sell-son-pz-input">
                  <button class="sell-son-pz-btn" id="select_1980cang_shop">查询商品</button>
                  <span id="sell-son-pz">【点击查询商品可替换当前显示的商品】只填名称，不要输入“求购”、“数量”、“好品”、“提价”等多余字眼；没有下拉选择可直接输入。</span>
              </div>
              <br>
              <div style="display: flex;flex-direction: column">
                  <div style="color:#A76B32;font-weight:bold;">
                      [点击查询商品可在商城中找到此商品并与其关联(只能选择一个)，方便买家或卖家浏览。若商城中没此商品可不关联，直接跳过！]
                  </div>
                  <div id="shop_img" style="display: flex;flex-direction: row">


                  </div>

              </div>
          </div>


          <div class="sell-son">
              <div class="sell-son-mp">
                  品相:
              </div>

              <div class="sell-son-right">
                  <input type="radio" value="好品"  checked name="productPhase" class="sell-son-mpzl">
                  <span style="margin-left:5px;margin-right:10px;">好品</span>

                  <input type="radio" value="中品" name="productPhase" class="sell-son-mpzl">
                  <span style="margin-left:5px;margin-right:10px;">中品</span>

                  <input type="radio" value="差品" name="productPhase" class="sell-son-mpzl">
                  <span style="margin-left:5px;margin-right:10px;">差品</span>

                  <input type="radio" value="有顿角" name="productPhase" class="sell-son-mpzl">
                  <span style="margin-left:5px;margin-right:10px;">有顿角</span>

                  <input type="radio" value="撕口" name="productPhase" class="sell-son-mpzl">
                  <span style="margin-left:5px;margin-right:10px;">撕口</span>

                  <input type="radio" value="原包" name="productPhase" class="sell-son-mpzl">
                  <span style="margin-left:5px;margin-right:10px;">原包</span>

                  <input type="radio" value="连号" name="productPhase" class="sell-son-mpzl">
                  <span style="margin-left:5px;margin-right:10px;">连号</span>

                  <input type="radio" value="原封"  name="productPhase" class="sell-son-mpzl">
                  <span style="margin-left:5px;margin-right:10px;">原封</span>

                  <input type="radio" value="原刀"  name="productPhase" class="sell-son-mpzl">
                  <span style="margin-left:5px;margin-right:10px;">原刀</span>

                  <input type="radio" value="原条" name="productPhase" class="sell-son-mpzl">
                  <span style="margin-left:5px;margin-right:10px;">原条</span>

                  <input type="radio" value="原箱"  name="productPhase" class="sell-son-mpzl">
                  <span style="margin-left:5px;margin-right:10px;">原箱</span>

                  <input type="radio" value="原捆" name="productPhase" class="sell-son-mpzl">
                  <span style="margin-left:5px;margin-right:10px;">原捆</span>

              </div>
              <div class="sell-son-pxdetail">
                  品相简单描述，具体可写在其他说明里
              </div>
          </div>


          <div class="sell-son">
              <div class="sell-son-mp">
                  单位:
              </div>

              <div class="sell-son-right">
                  <input type="radio" value="版"checked  name="unit" class="sell-son-mpzl">
                  <span style="margin-left:5px;margin-right:10px;">版</span>

                  <input type="radio" value="本"  name="unit" class="sell-son-mpzl">
                  <span style="margin-left:5px;margin-right:10px;">本</span>

                  <input type="radio" value="枚"  name="unit" class="sell-son-mpzl">
                  <span style="margin-left:5px;margin-right:10px;">枚</span>

                  <input type="radio" value="片" name="unit" class="sell-son-mpzl">
                  <span style="margin-left:5px;margin-right:10px;">片</span>
                  <input type="radio" value="包"  name="unit" class="sell-son-mpzl">
                  <span style="margin-left:5px;margin-right:10px;">包</span>

                  <input type="radio" value="条"  name="unit" class="sell-son-mpzl">
                  <span style="margin-left:5px;margin-right:10px;">条</span>

                  <input type="radio" value="套"  name="unit" class="sell-son-mpzl">
                  <span style="margin-left:5px;margin-right:10px;">套</span>

                  <input type="radio" value="封" name="unit" class="sell-son-mpzl">
                  <span style="margin-left:5px;margin-right:10px;">封</span>

                  <input type="radio" value="箱"  name="unit" class="sell-son-mpzl">
                  <span style="margin-left:5px;margin-right:10px;">箱</span>

                  <input type="radio" value="个"  name="unit" class="sell-son-mpzl">
                  <span style="margin-left:5px;margin-right:10px;">个</span>

                  <input type="radio" value="张" name="unit" class="sell-son-mpzl">
                  <span style="margin-left:5px;margin-right:10px;">张</span>

              </div>
              <div class="sell-son-pxdetail">
                  交易数量对应的单位
              </div>
          </div>

          <div class="sell-son" style="display:flex;flex-direction: column;">
              <div style="display: flex;flex-direction: row;">
                  <div style="margin-right:10px;">
                      数量:
                  </div>
                  <div>
                      <input type="number" name="num" required value="0" id="num">
                  </div>

                  <div>
                      <div class="sell-son-pxdetail">
                          注意和单位对应
                      </div>
                  </div>
              </div>

              <div style="display: flex;flex-direction: column;margin-top:10px;color:orangered">
                  <div>↑ 版票类每个原包按数量200版填，封片、纸币等交易暂不要求这样填写；</div>
                  <div>↓ 如品相要求为“原包”，请填写每版的单价，不要写一个原包的价格。</div>
              </div>
          </div>


          <div class="sell-son">
              <div style="margin-right:10px;">
                  单价:
              </div>
              <div>
                  <input type="number" name="unitPrice" id="price" value="0">
              </div>

              <div>
                  <div class="sell-son-pxdetail">
                      单位：人民币
                  </div>
              </div>
          </div>


          <div class="sell-son">
              <div style="margin-right:10px;">
                  其他费用:
              </div>
              <div>
                  <input type="number" name="otherExpenses" value="0" id="other">
              </div>

              <div>
                  <div class="sell-son-pxdetail">
                      例如邮费及其他费用
                  </div>
              </div>
          </div>

          <div class="sell-son">
              <span>这次交易总金额为：<span id="total" style="color:red">0</span>元</span>
              <input type="hidden" name="total" id="inputTotal" value="0">
              <div class="sell-son-pxdetail">
                  计算方法：单价×数量+其他费用
              </div>

          </div>

          <div class="sell-son">
              <div style="margin-right:10px;">
                  最小交易数量:
              </div>
              <div>
                  <input type="number" name="minQuantity" id="minQuantity">
              </div>
              <button class="sell-son-pz-btn yqz">一起走</button>
              <button class="sell-son-pz-btn bbq">百起版交易</button>
                  <div class="sell-son-pxdetail">
                      如果不允许分批卖出，这个数量应该和销售数量一致。
                  </div>
          </div>

          <div class="sell-son">
              <div >
                  交割方式:
              </div>
              <div class="sell-son-right">
                  <input type="checkbox" checked value="北京交割" name="deliveryMethods[]" class="sell-son-mpzl">
                  <span style="margin-left:5px">北京交割</span>

              </div>
              <div class="sell-son-right">
                  <input type="checkbox" value="上海交割" name="deliveryMethods[]" class="sell-son-mpzl">
                  <span style="margin-left:5px">上海交割</span>

              </div>

              <div class="sell-son-right">
                  <input type="checkbox" value="广州交割" name="deliveryMethods[]" class="sell-son-mpzl">
                  <span style="margin-left:5px">广州交割</span>

              </div>

              <div class="sell-son-right">
                  <input type="checkbox" value="其他"  name="deliveryMethods[]" class="sell-son-mpzl">
                  <span style="margin-left:5px">其他（说明栏里具体描述）</span>

              </div>
          </div>

          <div class="sell-son">
              <div style="margin-right:10px;">卖盘有效期</div>
              <div style="color:red">
                  系统默认30天，用户可在个人中心提前撤销帖子
              </div>
          </div>

          <div class="sell-son" style="display: flex;flex-direction: column">
              <div style="display: flex;flex-direction: row">
                  <div style="width:100px;">
                      注意事项
                  </div>
                  <div style="display: flex;flex-direction: column;color:orangered;font-size:12px;">
                      <div>
                          1、如品相要求为好品，无需在说明栏目再次强调要好品，不能在说明中掺杂“其中xx版为一般品”等字样；也不能品相选“好品”，却在说明栏目补充要“原包”、“绝品”，品相要求一律按上方品相选项为准！
                      </div>

                      <div>
                          2、若选择其他交割方式，请具体描述交割的地点及货款交割等事宜，如果不描述清楚造成的纠纷将不受理。
                      </div>
                      <div>
                          3、场外独立投资者用户，建议您注明指定的市场交割代理人或摊位号，以便提高交割效率。
                      </div>
                  </div>

              </div>

              <div style="display: flex;flex-direction: row;margin-top:10px;">
                  <div style="margin-right:30px;">
                      其他说明：
                  </div>
                  <div>
                      <textarea name="instructions" id="instructions" cols="100" rows="5"></textarea>
                  </div>

              </div>
          </div>

          <div class="sell-son">
              <input type="checkbox" name="sms" value="1" checked  style="margin-right:10px;"> <span>成交后短信通知我</span>
          </div>

          <div class="sell-son">
              <div style="margin-right:10px;">
                  图片说明:
              </div>
              <div style="margin-right:10px;">
                  <input type="text" name="caption" placeholder="没有产品图片可不上传">
              </div>
              <div style="margin-right:10px;">上传图片:</div>
              <div>
                  单张图片上传不能超过2M，最多可上传三张图片
              </div>

              <div style="width:100%;margin-top:10px;">
                  <div style="width:33%;float:left;">
                      <input type="file" name="pic1" onchange="validate_img(this)"/>
                  </div>
                  <div style="width:33%;float:left;">
                      <input type="file" name="pic2" onchange="validate_img(this)"/>
                  </div>
                  <div style="width:33%;float:left;">
                      <input type="file" name="pic3" onchange="validate_img(this)"/>
                  </div>
              </div>


          </div>
          <div class="sell-son">
            <div style="color:darkred"
            >重要提醒：发帖前务必认真核对各项内容！帖子发出后即具有《合同法》相关效力。如无故不履行交割，或有故意“对敲”获取信用积分的行为，一经发现必严肃处理！价格严重偏离，浪费网站资源的帖子也将视为违规处理。</div>
          </div>

          <div class="sell-son">
                <button class="sell-son-pz-btn" id="tj" type="submit">确定</button>
          </div>
      </form>
  </div>
@endsection


@section('js')
    <script src="/home/js/deal/sell.js"></script>
@endsection
