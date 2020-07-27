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
//done::首页
Route::get('/$', 'home.index/index');
Route::get('/index$', 'home.index/index');
//done::关于我们
Route::get('/about$', 'about.Index/index');
Route::get('/about/$', 'about.Index/index');
Route::get('/about/:url$', 'about.Index/detail')->parent(['url' => '[\w|\-]+']);
Route::get('/about/:url/$', 'about.Index/detail')->parent(['url' => '[\w|\-]+']);
//done::产品列表页
Route::get('/product/index$', 'product.Index/index');
Route::get('/product/index/$', 'product.Index/index');
Route::get('/product/:category$', 'product.Index/lists');
Route::get('/product/:category/$', 'product.Index/lists');
Route::get('/product/:url/detail$', 'product.Index/detail');
Route::get('/product/:url/detail/$', 'product.Index/detail');