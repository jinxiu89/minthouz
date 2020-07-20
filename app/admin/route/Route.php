<?php
/**
 * @Create by PhpStorm
 * @author:jinxiu89@163.com
 * @Create Date:2020/5/28 9:32
 * @User: admin
 * @Current File : route.php
 * @格言：溪涧岂能留得住，终归大海做波涛 --李忱
 * @格言： 我的内心因看见大海而波涛汹涌
 **/

namespace app\admin\route;
use think\facade\Route;

Route::rule('/$','dashboard.index/index'); //后台首页 欢迎页面
