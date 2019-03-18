function shareTo(stype){

    var ftit = '';

    var flink = '';

    var lk = '';

    //获取文章标题
    ftit = $('#title').text();

    //获取网页中内容的第一张图片
    flink = $('.detail_content').find('img').eq(0).attr('src');


    if(typeof flink == 'undefined'){

        flink='';

    }

    //当内容中没有图片时，设置分享图片为网站logo
    if(flink == ''){

        lk = 'http://'+window.location.host+'/admins/images/20181105101230648.png';

    }else{

        lk = 'http://'+window.location.host+flink;

    }

    //qq空间接口的传参
    if(stype=='qzone'){

        window.open('https://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url='+document.location.href+'?sharesource=qzone&title='+ftit+'&pics='+lk);

    }

    //新浪微博接口的传参
    if(stype=='sina'){

        window.open('http://service.weibo.com/share/share.php?url='+document.location.href+'?sharesource=weibo&title='+ftit+'&pic='+lk);

    }

    //qq好友接口的传参
    if(stype == 'qq'){

        window.open('http://connect.qq.com/widget/shareqq/index.html?url='+document.location.href+'?sharesource=qzone&title='+ftit+'&pics='+lk+'&desc=传承网，专业的收藏资讯平台。');

    }

    // // //生成二维码给微信扫描分享，php生成，也可以用jquery.qrcode.js插件实现二维码生成
    // if(stype == 'wechat'){

    //     window.open('http://zixuephp.net/inc/qrcode_img.php?url='+document.location.href+'');

    // }

// 参数说明：
// 1.新浪微博：
// http://service.weibo.com/share/share.php?url=

// count=表示是否显示当前页面被分享数量(1显示)(可选，允许为空)
// &url=将页面地址转成短域名，并显示在内容文字后面。(可选，允许为空)
// &appkey=用于发布微博的来源显示，为空则分享的内容来源会显示来自互联网。(可选，允许为空)
// &title=分享时所示的文字内容，为空则自动抓取分享页面的title值(可选，允许为空)
// &pic=自定义图片地址，作为微博配图(可选，允许为空)
// &ralateUid=转发时会@相关的微博账号(可选，允许为空)
// &language=语言设置(zh_cn|zh_tw)(可选)


// 2.QQ空间：
// http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?

// url=分享的网址
// &desc=默认分享理由(可选)
// &summary=分享摘要(可选)
// &title=分享标题(可选)
// &site=分享来源 如：腾讯网(可选)
// &pics=分享图片的路径(可选)

}


