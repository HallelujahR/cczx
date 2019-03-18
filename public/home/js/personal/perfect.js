$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
layui.use(['form', 'layedit', 'laydate'], function(){
  var form = layui.form
  ,layer = layui.layer
  ,layedit = layui.layedit
  ,laydate = layui.laydate;

  
  //创建一个编辑器
  var editIndex = layedit.build('LAY_demo_editor');
});

//添加银行

function bank_add(){
  $('#bank-submit').click(function(){

    //验证银行数据是否正确
    var bankusername = $("input[name='bankusername']").val();
    var bankid = $("input[name='bankid']").val();
    var bankphone = $("input[name='bankphone']").val();

    if(!checkBank(bankusername,bankid,bankphone,'bankusername','bankid','bankphone')){
      return false;
    };

  //添加银行
    var catebank = $('#bank-select').val();
    $.ajax({
      url:'/perfect/createBank',
      type:'post',
      data:{
        bankName:bankusername,
        cateBank:catebank,
        bankId:bankid,
        tel:bankphone,
      },
      success:function(res){
        if(res != '2' && res != '3' && res != '4'){
          $('#bank-line').append(`
             <tr id="bk`+res['id']+`">
                 <td>`+res['cateBank']+`</td>
                 <td>`+res['bankId']+`</td>
                 <td>`+res['bankName']+`</td>
                 <td>`+res['tel']+`</td>
                 <td>
                   <button bankid="`+res['id']+`" type="button" class="btn btn-primary bank-edit" data-toggle="modal" data-target="#myModal">
                     修改
                   </button>
                   <button bankid="`+res['id']+`"  type="button" class="btn btn-danger bank-del">删除</button>
                 </td>
              </tr>
            `);
          layer.msg('添加成功');
          //清空输入框
          $("input[name='bankusername']").val('');
          $("input[name='bankid']").val('');
          $("input[name='bankphone']").val('');

          bank_edit();
          del();

        }else{
          console.log(res);
          if(res == '4'){
            layer.msg('银行卡不准许超过三张。');
            return false;
          }else{
            layer.msg('添加失败，「请勿提交重复的银行卡号」')
          }
        }
      },
      error:function(error){
        console.log(error);
      }

    })

  return false;

  })

}

bank_add();
//删除银行
function del() {

  $('.bank-del').click(function(){

    var id = $(this).attr('bankid');
    var _this = $(this);
    layer.confirm('<span style="color:black">是否删除？</span>', {
      btn: ['确定','取消'] //按钮
    }, function(){
        $.ajax({
        url:'/perfect/delBank',
        type:'post',
        data:{
          id:id,
        },
        success:function(res){

          if(res == '1'){

            _this.parent().parent().css({
              'opacity':'0',
              'transition':'all 0.3',
            });

            setTimeout(() => {_this.parent().parent().remove();},300)
            
            layer.msg('删除成功');
          }  
        },
        error:function(err){

        },

      })

    });

  })

}

del();
//修改银行信息
function bank_edit(){

  $('.bank-edit').click(function(){
    var bk_catebank = $(this).parent().parent().children().eq(0);
    var bk_bankid = $(this).parent().parent().children().eq(1);
    var bk_bankname = $(this).parent().parent().children().eq(2);
    var bk_tel = $(this).parent().parent().children().eq(3);
    var bk_id = $(this).attr('bankid');

    $('#bkcardid').val(bk_bankid.text());
    $('#bkuname').val(bk_bankname.text());
    $('#bkphone').val(bk_tel.text());
    $('#bkid').val(bk_id);

    $('#bkname').next().children(':first').children(':first').val(bk_catebank.text());
    $("#bkname").find("option[value='"+bk_catebank.text()+"']").attr('selected','selected');
  })
};

bank_edit();
  //提交修改
  $('#bank-subedit').click( () => {
  
    var username = $('#bkuname').val();
    var bankcardid = $('#bkcardid').val();
    var bkphone = $('#bkphone').val();
    var cateBank = $('#bkname').val();
    var id = $('#bkid').val();

    if(!checkBank(username, bankcardid, bkphone,'bkuname','bkid','bkphone')){
      return false;
    };
      $.ajax({
        url:'/perfect/bankedit',
        type:'post',
        data:{
          bankName:username,
          cateBank:cateBank,
          bankId:bankcardid,
          tel:bkphone,
          id:id,
        },
        success: (res) => {

          if(res == '1'){

            $("#bk"+id+"").css({
              'opacity':'0',
              'transition':'all 0.3s',
            })

            $('#bankqx').trigger('click');

            layer.msg('修改成功');

            setTimeout(()=>{ 
              $("#bk"+id+"").replaceWith(

              `<tr id="bk`+id+`">
                     <td>`+cateBank+`</td>
                     <td>`+bankcardid+`</td>
                     <td>`+username+`</td>
                     <td>`+bkphone+`</td>
                     <td>
                       <button bankid="`+id+`" type="button" class="btn btn-primary bank-edit" data-toggle="modal" data-target="#myModal">
                         修改
                       </button>
                       <button bankid="`+id+`"  type="button" class="btn btn-danger bank-del">删除</button>
                     </td>
                </tr>`

              ); 
              del();
            },500)
   

          }else{

            layer.msg('修改失败,请重试「请勿提交重复的银行卡号」');

          }

        },
        error: (err) => {

        }

      })

  })


//银行js特效 选择
$('#bank-exist-a').click( () => {
  if($('#bank-exist').attr('flag') == '1'){
    $('#bank-exist').css({
      'height':'40px',
      'overflow':'hidden',
      'transition':'all 0.3s',
    })
    $('#bank-exist').attr('flag','2');
    $('#bank-exist-img').css({
      'transform':'rotate(0deg)',
      'transition':'all 0.3s',
    })


    $('#bank-c').text('「点击展开」');

  }else{
    $('#bank-exist').css({
      'height':'270px',
      'overflow':'visible',
      'transition':'all 0.3s',
    });
    $('#bank-exist').attr('flag','1');
    $('#bank-exist-img').css({
      'transform':'rotate(90deg)',
      'transition':'all 0.3s',
    });

    $('#bank-c').text('「点击收起」');

  }
});

$('#bank-tj-a').click( () => {
  if($('#bank-tj').attr('flag') == '1'){
    $('#bank-tj').css({
      'height':'40px',
      'overflow':'hidden',
      'transition':'all 0.3s',
    })
    $('#bank-tj').attr('flag','2');
    $('#bank-tj-img').css({
      'transform':'rotate(0deg)',
      'transition':'all 0.3s',
    })
    $('#bank-c1').text('「点击展开」');

  }else{
    $('#bank-tj').css({
      'height':'350px',
      'overflow':'visible',
      'transition':'all 0.3s',
    });
    $('#bank-tj').attr('flag','1');
    $('#bank-tj-img').css({
      'transform':'rotate(90deg)',
      'transition':'all 0.3s',
    })
    $('#bank-c1').text('「点击收起」');
  }
});

// 实名认证
$('.card_file').click(function(){
  var file = document.getElementById($(this).attr('number'));
  file.click();
});

$('#file1').bind('change',function(){
  base_img('#file1');
});

$('#file2').bind('change',function(){
  base_img('#file2');
});

$('#file3').bind('change',function(){
  base_img('#file3');
});

function base_img(obj){
  var selectImg = $(obj).prop('files')[0];
  var flag = validate_img(obj,selectImg);

  if(flag){
    var reader = new FileReader();
    reader.readAsDataURL(selectImg);

    reader.onload = function(){
      var imgBase64 = this.result;
      $(obj).next().attr('src',imgBase64);
    }
  }
}

var arrPic = ["image/jpeg","image/gif","image/png","image/bmp"];

function validate_img(a,b){
  if($.inArray(b.type,arrPic) == -1){
    $(a).val('');
    checkSfz(a);
    layer.confirm('<span style="color:black;">您的图片类型不符合，请重新上传！</span>', {
      btn: ['确定','取消'] //按钮
    });
    return false;
  }else{
    if(b.size > 2097152){
      $(a).val('');
      checkSfz(a);
      layer.confirm('<span style="color:black;">图片大小不能超过2M，请重新上传！</span>', {
        btn: ['确定','取消'] //按钮
      });
      return false;
    }
  }
  return true;
}

function checkSfz(obj){
  if(obj == '#file1' || obj == '#file3'){
    $(obj).next().attr('src','/home/images/sfzz.png');
  }else{
    $(obj).next().attr('src','/home/images/sfzf.png');
  }
}

$('#smrzsubmit').click(function(){
  var realName = $('#card_realName').val();
  var idCard = $('#card_idCard').val();

  if(realName.length < 1 || /^\s*$/.test(realName)){
    confirmInfo('真实姓名<span style="color:red;">不能为空</span>，请重新填写！');
    return false;
  }

  if(!/^[\u4e00-\u9fa5]{2,4}$/.test(realName)){
    confirmInfo('真实姓名<span style="color:red;">填写有误</span>，请重新填写！');
    return false;
  }

  if(idCard.length < 1 || /^\s*$/.test(idCard)){
    confirmInfo('身份证号码<span style="color:red;">不能为空</span>，请重新填写！');
    return false;
  }

  if(!/(^\d{15}$)|(^\d{18}$)|(^\d{17}(\d|X|x)$)/.test(idCard)){
    confirmInfo('身份证号码<span style="color:red;">有误</span>，请重新填写！');
    return false;
  }

  if(!$('#file1').val()){
    confirmInfo('请上传身份证<span style="color:red;">正面</span>照');
    return false;
  }

  if(!$('#file2').val()){
    confirmInfo('请上传身份证<span style="color:red;">反面</span>照！');
    return false;
  }

  if(!$('#file3').val()){
    confirmInfo('请上传<span style="color:red;">手持</span>身份证正面照');
    return false;
  }

});

function confirmInfo(info){
  layer.confirm('<span style="color:black;">'+info+'</span>', {
    btn: ['确定'] //按钮
  });
}

//判断银行input输入的信息是否正确 
function checkBank(user, bankid, bankphone,input1,input2,input3){
    if(!(/^([\u4e00-\u9fa5]{1,20}|[a-zA-Z\.\s]{1,20})$/.test(user))){
      layer.msg('姓名格式错误');

      Twinkle($("input[name='"+input1+"']"));
      return false;
    }

    var str = /^([1-9]{1})(\d{15}|\d{18})$/;
    if(!str.test(bankid)){
     layer.msg('银行卡号格式错误');
     Twinkle($("input[name='"+input2+"']"));
     return false;
    };

    if(!(/^1[34578]\d{9}$/.test(bankphone))){ 
      layer.msg('联系电话错误');
      Twinkle($("input[name='"+input3+"']"));
      return false;
    }

    return true;
}
//错误闪烁函数
function Twinkle(dom) {

  var times = 0;

  var time = null;

  time = setInterval(function(){

    times++;

    if(times == 3) clearInterval(time);


    dom.css({
      'border':'1px solid red',
      'transition':'all 0.3s',
    });

    setTimeout(function(){
      
      dom.css({
        'border':'1px solid #D2D2D2',
      });

    },300)

  },500)
}
