<?php
/**
 * @Create by PhpStorm
 * @author:jinxiu89@163.com
 * @Create Date:2020/5/29 15:33
 * @User: admin
 * @Current File : System.php
 * @格言：溪涧岂能留得住，终归大海做波涛 --李忱
 * @格言： 我的内心因看见大海而波涛汹涌
 **/

use think\facade\Route;

Route::group('system', function () {
    Route::rule('/index', 'system.Index/index');
    Route::rule('/language', 'system.Language/index');
});