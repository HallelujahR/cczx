$(function(){
  new PCAS("province","city","county","请选择省份","请选择城市","请选择地区");
  new PCAS("sheng","shi","xian","请选择省份","请选择城市","请选择地区");

  $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

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
        'overflow':'hidden',
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
        'height':'193px',
        'overflow':'hidden',
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

  $('#tjAddress').click( () => {

    const province = $('#province').val();
    const city = $('#city').val();
    const county = $('#area').val();
    const street = $('#street').val();

    if(/^\s*$/.test(province)){
      layer.msg('请选择所在省');
      return false;
    }

    if(/^\s*$/.test(city)){
      layer.msg('请选择所在市');
      return false;
    }

    if(/^\s*$/.test(county)){
      layer.msg('请选择所在地区');
      return false;
    }

    if(/^\s*$/.test(street)){
      layer.msg('请填写详细街道');
      return false;
    }

     $.ajax({
      url:'/address/create',
      type:'post',
      data:{
        province:province,
        city:city,
        county:county,
        street:street,
      },
      success:function(res){
        if(res != '2' && res != '3'){
          $('#bank-line').append(`
             <tr id="bk`+res['id']+`">
                 <td>`+res['province']+`</td>
                 <td>`+res['city']+`</td>
                 <td>`+res['county']+`</td>
                 <td>`+res['street']+`</td>
                 <td>
                   <button addressid="`+res['id']+`" type="button" class="btn btn-primary bank-edit" data-toggle="modal" data-target="#myModal">
                     修改
                   </button>
                   <button addressid="`+res['id']+`"  type="button" class="btn btn-danger bank-del">删除</button>
                 </td>
              </tr>
            `);
          layer.msg('添加成功');

          //清空输入框
          $("#province").find("option[value='']").attr('selected','selected').trigger('change');
          $('#street').val('');

          edit_address();
          del();

        }else{
          // console.log(res);
          if(res == '3'){
            layer.msg('地址不准许超过三条。');
            return false;
          }else{
            layer.msg('添加失败')
          }
        }
      },
      error:function(error){
        console.log(error);
      }
    });

    return false;
  });

  //删除地址
  function del() {

    $('.bank-del').click(function(){

      var id = $(this).attr('addressid');
      var _this = $(this);

      layer.confirm('<span style="color:black">是否删除该条地址？</span>', {
        btn: ['确定','取消'] //按钮
      }, function(){
        $.ajax({
          url:'/address/del',
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

        });

      });

    })

  }

  del();

  function edit_address() {
    $('.bank-edit').click(function(){
      $('#myModal').find('option').removeAttr('selected');
      const province = $(this).parent().parent().children('td:eq(0)');
      const city = $(this).parent().parent().children('td:eq(1)');
      const county = $(this).parent().parent().children('td:eq(2)');
      const street = $(this).parent().parent().children('td:eq(3)');
      const address_id = $(this).attr('addressid');

      $("#sheng").find("option[value='"+province.text()+"']").attr('selected','selected').trigger('change');
      $("#shi").find("option[value='"+city.text()+"']").attr('selected','selected').trigger('change');
      $("#xian").find("option[value='"+county.text()+"']").attr('selected','selected').trigger('change');
      $('#jiedao').val(street.text());
      $('#addressid').val(address_id);

    });
  }

  edit_address();

  $('#bank-subedit').click( () => {
    const province = $('#sheng').val();
    const city = $('#shi').val();
    const county = $('#xian').val();
    const street = $('#jiedao').val();
    const id = $('#addressid').val();

    if(/^\s*$/.test(province)){
      layer.msg('请选择所在省');
      return false;
    }

    if(/^\s*$/.test(city)){
      layer.msg('请选择所在市');
      return false;
    }

    if(/^\s*$/.test(county)){
      layer.msg('请选择所在地区');
      return false;
    }

    if(/^\s*$/.test(street)){
      layer.msg('请填写详细街道');
      return false;
    }

    $.ajax({
      url:'/address/update',
      type:'post',
      data:{
        province:province,
        city:city,
        county:county,
        street:street,
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
                   <td>`+province+`</td>
                   <td>`+city+`</td>
                   <td>`+county+`</td>
                   <td>`+street+`</td>
                   <td>
                     <button addressid="`+id+`" type="button" class="btn btn-primary bank-edit" data-toggle="modal" data-target="#myModal">
                       修改
                     </button>
                     <button addressid="`+id+`"  type="button" class="btn btn-danger bank-del">删除</button>
                   </td>
              </tr>`

            ); 
            del();
          },500)
 

        }else{

          layer.msg('修改失败,请重试');

        }
      },
      error: (res) => {

      }

    });

  });

});