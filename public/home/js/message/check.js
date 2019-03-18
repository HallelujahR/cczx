$(function(){
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});


    $('.layui-btn').click(function(){
        event.preventDefault();
        var myDate = new Date();
        //发送出去消息
        let content = $('#content').val();
        let name = '我';
        let id = $('#user').attr('userid');
        let avatar = $('#user').attr('useravatar');
        let time = myDate.toLocaleString();
        let toid =  $('#user').attr('toid');

        let regu = "^[ ]+$";
        let re = new RegExp(regu);
        if(re.test(content) || content == ""){
            alert('不能回复空消息');
            return false;
        };

        $.ajax({
            type: "post",
            url: "/sx/message",
            data: {
                to_user_id:toid,
                body:content,
            },
            success: (data) => {

                if(data === 'ok'){
                    $('#dialogue').prepend(` <div class="dialogue-line">
                   <div class="dialogue-line-head">
                       <a href="">
                           <img src="`+avatar+`" width="60px;" style="border-radius:30px;" alt="">
                       </a>
                       <a href="/personal/`+id+`">`+name+`</a>
                       </span>
                   </div>
    
                   <div class="dialogue-line-body">
                       `+content+`
                   </div>
    
                   <div class="dialogue-line-foot">
                       <span class="dialogue-time">`+time+`</span>
                   </div>
               </div>`);
                }

                $('#content').val('');
            }
        });
        return false;

    })



});
