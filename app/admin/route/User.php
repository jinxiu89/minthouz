<?php
/**
 * @Create by PhpStorm
 * @author:jinxiu89@163.com
 * @Create Date:2020/5/28 9:59
 * @User: admin
 * @Current File : User.php
 * @格言：溪涧岂能留得住，终归大海做波涛 --李忱
 * @格言： 我的内心因看见大海而波涛汹涌
 **/
use think\facade\Route;
//后台登录、注册等操作manager
Route::group('user',function (){
    Route::rule('/login','user.User/login','GET|POST');
    Route::rule('/register','user.User/register','GET|POST');
    Route::rule('/logout','user.User/logout','GET');
//    Route::rule('/language/adsd$', 'system.Language/addLanguage');
});
