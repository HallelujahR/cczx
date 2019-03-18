$(function(){
  var time2 = null;

  //搜索框js特效
  $('#bdcs-search-form-input').focus(function(){
    $('#bdcs-search-form-submit').css({
      'width':'80px',
      'transition':'0.4s',
    })
  }).blur(function(){

    time2 = setTimeout(function(){
        $('#bdcs-search-form-submit').css({
          'width':'0px',
          'transition':'0.4s',
        })

        //失去焦点的时候收回搜索的下拉框
        $('#searchview').css({
            'position':'absolute',
            'top':'-10px',
            'left':'0px',
            'padding':'10px',
            /*z-index:10;*/
            'height':'0px',
            'overflow': 'hidden',
            'opacity': '0',
            'transition':'0.5s',
        })

        $(".search:eq(0)").children("div").remove();
        $('.search:eq(0)').append(`<div>很抱歉没有找到相关文章</div>`);
    },300)

  })

  var time = null;

  //input输入时自动搜索联想的ajax
  $('#bdcs-search-form-input').on('input',function(){

    // console.log($(this).val());


    //判断input中是否有值
    if($(this).val().length <= 0){

      //清空定时器
      clearTimeout(time);

      //使下拉框消失
      $('#searchview').css({
        'position':'absolute',
        'top':'-10px',
        'left':'0px',
        'padding':'10px',
        /*z-index:10;*/
        'height':'0px',
        'overflow': 'hidden',
        'opacity': '0',
        'transition':'0.5s',
      })

      $(".search").children("div").remove();
      $(".search").append(`<div>很抱歉没有找到相关内容</div>`);

      return false;

    }

    if(/^\s*$/.test($(this).val())){
      return false;
    }

    var thiss = $(this);

    clearTimeout(time);

    //设置倒计时防止不停刷新
    time = setTimeout(function(){
      
      //ajax传递数据获取用户，文章，帖子信息然后在搜索框下面显示      
      $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
      $.ajax({  
            type : "POST",  //提交方式
            url : "/search/input",//路径
            data : {  
                "content" : thiss.val(),  
            },//数据，这里使用的是Json格式进行传输  
            success : function(result) {//返回数据根据结果进行相应的处理  
              // console.log(result);
              //联想出的下拉框的特效
              $('#searchview').css({
                'height':'auto',
                'transition':'0.5s',
                'opacity':'1',
                'z-index':'10',
                'top':'40px',
              });

              //js添加DOM元素
                //遍历每一项

                //文章
                // console.log(result['article'].length);
                if(result['article'].length > 0){
                  
                  if(result['article'].length > 4) {
                      var num = 4;
                  }else{
                      var num = result['article'].length;
                  }

                  var arstr = '';            
                
                  for(var i = 0;i<num;i++) {
                      arstr += `<div class="str">
                        <a href="/article/`+result['article'][i]['id']+`.html">`+result['article'][i]['title']+`</a>
                      </div>`
                  }

                  $(".search:eq(0)").children("div").remove();
                  $('.search:eq(0)').append(arstr);  //span元素替换p元素
                  

                  // console.log(arstr);

                }

                //帖子

                if(result['post'].length > 0){
                  
                  if(result['post'].length > 4) {
                      var num = 4;
                  }else{
                      var num = result['post'].length;
                  }

                  var postr = '';            
                
                  for(var i = 0;i<num;i++) {
                      postr += `<div  class="str">
                        <a href="/bbs/post/`+result['post'][i]['id']+`.html">`+result['post'][i]['title']+`</a>
                      </div>`
                  }

                  $(".search:eq(1)").children("div").remove();
                  $('.search:eq(1)').append(postr);  //span元素替换p元素

                  // console.log(postr);

                }

                //用户
                if(result['user'].length > 0){
                  
                  if(result['user'].length > 4) {
                      var num = 4;
                  }else{
                      var num = result['user'].length;
                  }

                  var userstr = '';            
                
                  for(var i = 0;i<num;i++) {
                      userstr += `<div  class="strHead" >
                        <img style="border-radius:5px" src="`+result['user'][i]['avatar']+`" >
                        <a class="search-name" href="/personal/`+result['user'][i]['id']+`">`+result['user'][i]['name']+`</a>
                        <a class="search-message" href="/message/check/`+result['user'][i]['id']+`">「发送私信」</a>
                        <div style="float:right;font-size:14px;margin-top:5px;">
                          <span style="color:#5F5F5F">注册日期 :`+result['user'][i]['created_at']+`</span>
                        </div>
                      </div>`
                  }


                  $(".search:eq(2)").children("div").remove();
                  $('.search:eq(2)').append(userstr);  //span元素替换p元素

                  // console.log(userstr);

                }

            } 

        });  
      },500);

    
    })
        

  //搜索下拉框显示
  function search() {

  }

  //搜索按钮点击提交事件
  $('#bdcs-search-form-submit').click(function(){
    //判断搜索内容是否为空
    if($('#bdcs-search-form-input').val().length == 0 || $('#bdcs-search-form-input').val().match(/^\s*$/)){
      layer.msg('搜索不能为空哦');
      return false;
    }
  })
})