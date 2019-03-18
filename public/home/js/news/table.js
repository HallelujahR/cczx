$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

function createTable(url,bigType,smallType,whichTable){//定义一个组件类
   // console.log(bigType);

   var page = null;
   this.url = url;
   this.bigType = bigType;
   this.smallType = smallType;
   //判断分页死循环的开关
   this.pageFlag = true;

   this.notificationsId = [];

   this.strTh = `<table id="news-table">
 		<tr id="title">
 			<td class="title-content"><input id="checked" type="checkbox" value="" /></td>
 			<td class="title-content">
 				
 			</td>
 			<td class="title-content">标题内容</td>
 			<td class="title-content">提交时间</td>
 			<td class="title-content">类型</td>
		</tr>`;



   if(bigType == 'read'){

      this.tableBtn = `<tr id="rw-btn">
            <td class="new-detail-line" style="padding:10px;width:4%"></td>
            <td></td>
            <td>
               <button disabled="disabled" id="deleteNew" class="rw-btn-a rw-btn-d">删除</button>
            </td>
            <td colspan="2">
               <div id="demo2"></div>
            </td>
         </tr>`;

   }else{

   	this.tableBtn = `                     
            <tr id="rw-btn">
               <td class="new-detail-line" style="padding:10px;width:4%"></td>
               <td></td>
               <td>
                  <button disabled="disabled" id="deleteNew" class="rw-btn-a rw-btn-d">删除</button>
                  <button disabled="disabled" id="markRead" class="rw-btn-a rw-btn-d">标记已读</button>
                  <button class="rw-btn-a allRead">全部已读</button>
               </td>
               <td colspan="2">
                  <div id="demo2"></div>
               </td>
            </tr>`;
            
   };

	this.tableEnd = '</table>';


   //使用获取的数据生成table



   this.createAjax = function(page){
      let url = this.url;
      let bigType = this.bigType;
      let smallType = this.smallType;
      // console.log(smallType);
      $.ajax({
         url:url,
         type:'post',
         data:{
            bigType:bigType,
            smallType:smallType,
            page:page,
            notificationsId:this.notificationsId,
         },
         success:(res) => {

            //更改tab显示的消息条数
            this.changeTotalNews(res.count);

            console.log(res);
            this.createTable(res);

         },
         error:(err) => {

         }
      })

   }

   //初始化创建表格ajax
   this.createAjax(1);

   this.createTable = function (res){


      $('#news-table').remove();

      var data = res.data;
      
      var isRead = '';
      var isRead1 = '';
      var type = '';
      var tableBody = '';

      //用户名
      var username = '';
      //评论了
      var content = '';
      //文章或帖子名
      var title = '';
      //链接
      var a = '';
      //判断是否有消息
      if(data.length != 0){

         $.each(data,function(index,value){

            //判断是否已读
            if(value.read_at == null) {

               isRead = 'style="opacity:1"';

               isRead1= 'new-detail-line-isNotRead';

            }else{

               isRead = '';

               isRead1 = '';

            }
            console.log(value.type);
            //判断类型
            switch(value.type)
            {

               case "App\\Notifications\\CommentArticleNotification":

                  type = "文章通知";
                  username = value.data.name;
                  content = value.data.title;
                  title = value.data.article;
                  a = `<a class="only" newsid="`+value.id+`" href="javascirpt:void(0)">`+username+`  `+content+`  `+title+`</a>`;
               break; 

               case "App\\Notifications\\ReplyPostNotification":

                  type = "帖子通知";
                  username = value.data.name;
                  content = value.data.title;
                  title = value.data.post;
                   a = `<a class="only" newsid="`+value.id+`" href="javascirpt:void(0)">`+username+`  `+content+`  `+title+`</a>`;
               break;

               case "App\\Notifications\\FollowUserNotification":
                   type = "关注通知";
                   username = value.data.name;
                   content = vzalue.data.title;
                   a = `<a newsid="`+value.id+`" href="/personal/`+value.data.id+`">`+username+`  `+content+`  `+title+`</a>`;
               break;
               case "App\\Notifications\\DealNotification":
                   type = "交易通知";
                   username = value.data.name;
                   content = value.data.title;
                   a = `<a newsid="`+value.id+`" href="/deal/detail/`+value.data.deal_id+`.html">`+username+`  `+content+`  `+title+`( `+value.data.deal_title+` )</a>`;
               break;

            }

            tableBody += `
            <tr class="new-detail">
               <td class="new-detail-line" style="padding:10px;width:4%">
                  <input class="checkedSon" newsid="`+value.id+`" name="Fruit" type="checkbox" value="" />
               </td>
               <td `+isRead+` class="new-isRead-not changeRead">
                  •
               </td>
               <td class="`+isRead1+` new-detail-line">
                  `+a+`
               </td>
               <td class="`+isRead1+` new-detail-line">`+value.created_at+`</td>
               <td class="`+isRead1+` new-detail-line">`+type+`</td>
            </tr>`;

         });

      }else{

         tableBody += `
            <tr class="new-detail">
               <td colspan="5" id="nonews">暂时没有消息</td>
            </tr>`;

      }

      //生成table表格字符串
      const table = this.strTh+tableBody+this.tableBtn+this.tableEnd;

      $('#'+whichTable+'').append(table);

      //初始化按钮
      this.clickBtn();
      // 初始化全选反选择
      this.checkedAll();

      //初始化分页
      this.pageFlag = false;

      page = res.page;

      if(!this.pageFlag) this.changePage(res.total,res.page);

      this.pageFlag = true;


      //调用函数是否加载完毕
      this.isLoad(smallType);

      //初始化notificationid数组
      this.notificationsId = [];

      this.only();

   }

   this.changeTotalNews = function(count){

      //tab
      if(count.all > 0) 
      {

         $('.total-news:eq(0)').html(' ('+count.all+')') 

      }else{

         $('.total-news:eq(0)').html('')

      };
      
      if(count.post > 0) 
      {

         $('.total-news:eq(1)').html(' ('+count.post+')')

      }else{

         $('.total-news:eq(1)').html('')

      };

      // console.log(count.article);
      if(count.article > 0)
      {

         $('.total-news:eq(2)').html(' ('+count.article+')')

      }else{

         $('.total-news:eq(2)').html('')

      };

       if(count.follow > 0)
       {

           $('.total-news:eq(3)').html(' ('+count.follow+')')

       }else{

           $('.total-news:eq(3)').html('')

       };

       if(this.bigType === 'read') {
           $('.total-news:eq(0)').html('');
           $('.total-news:eq(1)').html('');
           $('.total-news:eq(2)').html('');
           $('.total-news:eq(3)').html('');
           $('.total-news:eq(4)').html('');
       }

      var zongshu = count.all;

      if(zongshu > 0) {

         zongshu = ' ('+zongshu+')'

      }else{

         zongshu = '';

      };


      //左侧
      $('.news_t:eq(1)').html('未读消息'+zongshu+'');


   }
////////////////////

   //已读事件. 全选
   this.checkedAll = function() {

   		//按钮全选择
   		$('#checked').click(function(){	

   			var status = $(this).prop("checked");

   			$(".checkedSon").prop("checked",status);

            console.log($('.checkedSon:checkbox:checked'));

   			if(status){

   				$('.rw-btn-a').removeAttr("disabled");

   			}else{

   				$('.rw-btn-a').attr("disabled",true);

   			}

   		})
   		//按钮单个选中事件

  		$('.checkedSon').click(function(){

   			if($(".checkedSon:checkbox:checked").length > 0){

   				$('.rw-btn-a').removeAttr("disabled");

   			}else{

   				$('.rw-btn-a').attr("disabled",true);

   			}

   		})

   }


   //btn 按钮点击事件
   this.clickBtn = function() {

      var _this = this;

		$('.allRead').click(function(){
         //此处写发送全部已读ajax
			_this.isRead();
		})

      //标记已读
      $('#markRead').click(function(){
         _this.markRead();
      })

      //删除
      $('#deleteNew').click(function(){
         _this.deleteNew();
      })

   }

   //全部已读的样式切换
   this.isRead = function() {
      this.url = '/news/allRead';
		this.createAjax(page);

   }

   //标记已读
   this.markRead = function() {
      for(var i = 0 ;i < $('.checkedSon:checkbox:checked').length ; i++){
         this.notificationsId.push($('.checkedSon:checkbox:checked:eq('+i+')').attr('newsid'));
      }
      this.url = '/news/markedRead';
      this.createAjax(page);
   }

   //删除
   this.deleteNew = function() {

      for(var i = 0 ;i < $('.checkedSon:checkbox:checked').length ; i++){
         this.notificationsId.push($('.checkedSon:checkbox:checked:eq('+i+')').attr('newsid'));
      }
      this.url = '/news/deleteNf';
      this.createAjax(page);
   }

   //翻页 分页控制
   this.changePage  = function(page,page2){

      var _this = this;
      //引用了插件
      layui.use(['laypage', 'layer'], function(){
   	  var laypage = layui.laypage
   	  ,layer = layui.layer;
   	  	
   	  //自定义样式
   	  laypage.render({
   	    elem: 'demo2'
   	    ,count: page
          // ,count:100
   	    ,theme: '#1E9FFF'
   	    ,groups:'2'
          ,limit:11
          ,curr:page2
          ,jump: function(obj, first){
             //obj包含了当前分页的所有参数，比如：
             // console.log(obj.curr); //得到当前页，以便向服务端请求对应页的数据。
             // console.log(obj.limit); //得到每页显示的条数

             // console.log('page');
             
            if(_this.pageFlag) { 
               _this.url = '/news/getNews';
               _this.createAjax(obj.curr); 
                // _this.pageFLag = 

            };
            
            
           }

   	  });


   	});

   }


   //加载图片控制
   this.isLoad = function(smallType){
      switch(smallType)
      {
         case 'all':
            clearTime(0);
         break;
         case 'replyPost':
            clearTime(1);
         break;
         case 'commentArticle':
            clearTime(2);
         break;
         case 'follow':
            clearTime(3);
         break;
          case 'deal':
              clearTime(4);
              break;
      }
      
   }


   this.only = function(){
      var _this = this;
      $('.only').click(function(){
         $(this).parent().prev().prev().children().prop("checked",'true');

         _this.markRead();

         layer.open({
           type: 2,
           title: '消息',
           shadeClose: true,
           shade: 0.8,
           area: ['700px', '90%'],
           content: '/news/only?nid='+ $(this).attr('newsid') //iframe的url
         });

      })
   }

   



}