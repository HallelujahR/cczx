<?php
use Illuminate\Support\Facades\Redis;

/**
 * @return array
 * 获取控制器和方法名
 */
function getCurrentAction()
{
    $action = \Route::current()->getActionName();
    list($class, $method) = explode('@', $action);

    return ['controller' => $class, 'method' => $method];
}

/**
 * [getCateByPid 通过pid查询所有cate]
 * @param  [array]  $allcates [数据库数据]
 * @param  int $pid      [父类id]
 * @return [array]            [分层返回数组]
 */
function getCateByPid($allcates,$pid=0){
    $data = [];
    foreach($allcates as $k=>$v){
        if($v['pid'] == $pid){
            $v['sub'] = getCateByPid($allcates,$v['id']);//根据自己的ID查询该类的子类
            $data[] = $v;
        }
    }
    return $data;
}

/**
 * @param [int] $id [分类的id]
 * @return [string] [分类名称]
 */
function getCateName($id){
    return \App\Cate::findOrFail($id);
}

//查询帖子分类
function getBbsCate($id){
    return \App\BbsCate::findOrFail($id);
}

//判断回帖楼层
function getLou($num){

    switch($num){
        case 1:
            return '沙发';
        break;
        case 2:
            return '板凳';
        break;
        case 3:
            return '地板';
        break;
        default:
            return '第'.$num.'楼';
        break;

    }

}

//短信验证
function msg ($phonenum,$content = 0) {

    header("Content-type: text/html; charset=utf-8"); //GBK模式 请讲此处utf-8变更为GB2312
    //帐户名
    $username="937268400";

    //帐户名密码,取MD5大写取32位 密码,网址：http://md5jiami.51240.com/
    $password="391C47D538761C18F2541BE122398FE0";

    //网关ID
    $gwid="06310c0";

    //手机号  可以多个手机号
    $mobile = $phonenum;

    //短信内容
    if($content == 0){
        $message='【传承资讯】您的验证码是:'.yzm($mobile).',有效时间3分钟请尽快输入';
    }else{
        $message='【传承资讯】您的帖子有人点击了确认交易，请尽快登录 传承资讯 查看';
    }

    //如果是GBK模式请放开注释此句 (不存储数据库的情况下)
    //$message = iconv("GBK","UTF-8",$message);

    $postData = array
        (
        'type'=>'send',
        'username'=>$username,
        'password'=>$password,
        'gwid'=>$gwid,
        'mobile'=>$mobile,
        'message'=>$message
        );

    $url="http://jk.106api.cn/smsUTF8.aspx";

    //发送并把结果赋给$result,返回一个XML信息,解析xml 信息判断
    $result= postSMS($url,$postData);

    return $result;

}

//发送验证码
function postSMS($url,$postData)
{
    $row = parse_url($url);
    $host = $row['host'];
    $port = isset($row['port']) ? $row['port']:80;
    $file = $row['path'];
    $post = "";
    foreach($postData as $k => $v) {
        $post .= rawurlencode($k)."=".rawurlencode($v)."&";
    }

    $post = substr( $post , 0 , -1 );
    $len = strlen($post);
    $fp = @fsockopen( $host ,$port, $errno, $errstr, 10);
    if (!$fp) {
        return "$errstr ($errno)\n";
    } else {
        $receive = '';
        $out = "POST $file HTTP/1.1\r\n";
        $out .= "Host: $host\r\n";
        $out .= "Content-type: application/x-www-form-urlencoded\r\n";
        $out .= "Connection: Close\r\n";
        $out .= "Content-Length: $len\r\n\r\n";
        $out .= $post;
        fwrite($fp, $out);
        while (!feof($fp)) {
            $receive .= fgets($fp, 128);
        }
        fclose($fp);
        $receive = explode("\r\n\r\n",$receive);
        unset($receive[0]);
        return implode("",$receive);
    }
}

//生成验证码
function yzm ($pd){

    $chars = str_repeat('0123456789', 3);
    // 位数过长重复字符串一定次数
    $chars = str_repeat($chars, 4);
    $chars = str_shuffle($chars);
    $str = substr($chars, 0, 4);
    Redis::setex($pd.'yzm',180,$str);
    return $str;

}

//删除文件
function removePic($file){
	if(file_exists(public_path().$file)){
		unlink(public_path().$file);
	}
}

?>
