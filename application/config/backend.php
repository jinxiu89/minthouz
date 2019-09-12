<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2019/9/11
 * Time: 10:16
 */

use think\Route;
//get请求组
Route::group('wavlink', function () {
    //登录登出
    Route::get('/login/index', 'wavlink/login/index');
    Route::get('/login/logout', 'wavlink/login/logout');
    Route::get('/login', 'wavlink/login/index');
    //几个首页
    Route::get('/index', 'wavlink/index/index');
    Route::get('/content/index','wavlink/content/index');
    //分类url
    Route::get('/category/index','wavlink/Category/index');
    Route::get('/category/add','wavlink/Category/add');
    Route::post('/category/save','wavlink/Category/save');
    Route::get('/Category/byStatus','wavlink/Category/byStatus');
    Route::post('/Category/byStatus','wavlink/Category/byStatus');
    Route::get('/Category/edit','wavlink/Category/edit');

    
});

//post请求组
Route::group('wavlink',function (){
    Route::post('/login/index', 'wavlink/login/index');
});
