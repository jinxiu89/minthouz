<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\facade\Route;
use think\facade\Session;
use think\facade\Request;

Route::get('/$', function () {
//    $code = (Session::get('lang_var')) ? (Session::get('lang_var')) : get_lang(Request::instance()->header()); // 后期开通中文 后走这个
    $code = 'en_us';
    return redirect('/' . $code.'/', 200);
});
