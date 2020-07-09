<?php
/**
 * @Create by PhpStorm
 * @author:jinxiu89@163.com
 * @Create Date:2020/7/4 16:48
 * @User: admin
 * @Current File : route.php
 * @格言：溪涧岂能留得住，终归大海做波涛 --李忱
 * @格言： 我的内心因看见大海而波涛汹涌
 **/
use think\facade\Route;

Route::get('/$','home.index/index');
Route::get('/index$','home.index/index');

