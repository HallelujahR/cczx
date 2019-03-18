function xiangjia(){
    if(isNaN(parseInt($('#price').val()))){
        var price = 0;
    }else{
        var price = parseInt($('#price').val());
    };

    if(isNaN(parseInt($('#num').val()))){
        var num = 0;
    }else{
        var num = parseInt($('#num').val())
    }

    if(isNaN(parseInt($('#other').val()))){
        var other = 0;
    }else{
        var other = parseInt($('#other').val());
    }
    return price * num + other;
}
$('#num').on('input',function(){
    $('#total').html(xiangjia());
    $('#inputTotal').val(xiangjia());
});

$('#price').on('input',function(){
    $('#total').html(xiangjia());
    $('#inputTotal').val(xiangjia());
});

$('#other').on('input',function(){

    $('#total').html(xiangjia());
    $('#inputTotal').val(xiangjia());

});

$('.sell-son-pz-btn').click(function(){
    return false;
})

$('#minQuantity').on('input',function(){
   if(parseInt($(this).val()) > parseInt($('#num').val())){
       $(this).val($('#num').val());
   }
});

$('.yqz').click(function(){
    $('#minQuantity').val(parseInt($('#num').val()));
});

$('.bbq').click(function(){
    if( parseInt($('#num').val()) < 100){
        $('#minQuantity').val($('#num').val());
        return false;
    }
    $('#minQuantity').val(100);
});


$('#tj').click(function(){


    if( $("input[name='deal_cate']:checked").val()== null){
        alert('请选择卖盘种类');
        return false;
    }



    if($('#sell-son-pz-input').val() == ''){
        alert('请输入商品名称');
        return false;
    }

    if($('#num').val() == 0 || $('#num').val() == '' ){
        alert('数量不能为0');
        return false;
    }

    if($('#price').val() == 0 || $('#price').val() == ''){
        alert('单价不能为0');
        return false;
    }

    if($('#other').val() == 0 || $('#other').val() == ''){
        $('#other').val(0);
    }

    if($('#minQuantity').val() == 0 || $('#minQuantity').val() == ''){
        alert('最小交易数量不能为0');
        return false;
    }

    if($("input:checkbox[name='deliveryMethods[]']:checked").length == 0){
        alert('请选择交割方式');
        return false;
    };

    if($('#instructions').val() == ''){
        alert('其他说明不能为空');
        return false;
    }

    $('#sellform').submit();
});
var num = 0;

$('#select_1980cang_shop').click(function(){
    console.log(num);
    var data = $('#sell-son-pz-input').val();
    if(data == '' || data == null){
        alert('品种名称不能为空');
        return false;
    }
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    $.ajax({
        url:'/deal/searchShop',
        type:'post',
        data:{
            data:data,
            num:num,
        },
        success:(data) => {
            if(data.length == 0){
                alert('暂时没有此商品');
            }
            var img = ``;

            for(var i = 0;i < data.length ; i++){
                img += ` <div style="margin-right:10px;margin-top:10px;">

                            <div>
                                `+data[i]['name']+`
                            </div>
                            <div>
                                价 格：`+data[i]['sell_price']+` <input class="choseGoods" type="radio" value="`+data[i]['id']+`" name="shopid">
                            </div>
                           

                            <img width="200" src="https://www.1980cang.com/`+data[i]['img']+`" alt="">

                        </div>`;
            }
            $('#shop_img').html(img);
            console.log(data);
            addGoods();
        },
        err:() => {},
    });
    num++;
});
function addGoods(){

    $('.choseGoods').click(function(){
        $('#sell-son-pz-input').val($.trim($(this).parent().prev().text()));
    })
}
addGoods();
function validate_img(obj){
    var arrPic = ["image/jpeg","image/gif","image/png","image/bmp"];

    var selectImg = $(obj).prop('files')[0];
    console.log(selectImg);
    // var flag = validate_img(obj,selectImg);

    if($.inArray(selectImg.type,arrPic) == -1){

        $(obj).val('');
        layer.confirm('<span style="color:black;">您的图片类型不符合，请重新上传！</span>', {
          btn: ['确定','取消'] //按钮
        });
        return false;

    }else{

        if(selectImg.size > 2097152){
          $(obj).val('');
          layer.confirm('<span style="color:black;">图片大小不能超过2M，请重新上传！</span>', {
            btn: ['确定','取消'] //按钮
          });
          return false;
        }

    }
}