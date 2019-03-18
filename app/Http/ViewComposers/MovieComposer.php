<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;//**记得引入这个啊（因为在composer函数参数里使用了View类）**
use App\Config;
use App\HotSearch;
use App\Message;
use Auth;
class MovieComposer
{
    public $movieList = [];

    public function __construct()
    {
        $this->movieList = [
            'Shawshank redemption',
            'Forrest Gump',
        ];
    }

    public function compose(View $view)
    {
        //查询出网站配置信息
        $config = Config::first();
        //查询出热搜
        $hotsearch = HotSearch::orderBy('order')->get();
        if(Message::where('to_user_id','=',Auth::id())->where('has_read','=','F')->get()->count() > 0){
            $flag = 1;
        }else{
            $flag = 0;
        }
        $view->with(['config'=>$config,'hotsearch'=>$hotsearch,'flag'=>$flag]);
    }
    
}