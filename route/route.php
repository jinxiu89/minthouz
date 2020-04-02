<?php
use think\facade\Route;
Route::group('customer', function () {
    //注册
    Route::rule('/register$', 'User/register','GET|POST')->name('customer_register');
    Route::rule('/verification$', 'Base/sendVerification','GET')->parent(['email'=>'[\w!#$%&\'*+/=?^_`{|}~-]+(?:\.[\w!#$%&\'*+/=?^_`{|}~-]+)*@(?:[\w](?:[\w-]*[\w])?\.)+[\w](?:[\w-]*[\w])?','phone'=>'\d+'])->name('verification');//验证码
    //登入登出
    Route::rule('/login$', 'User/login','GET|POST')->name('customer_login');
    Route::get('/logout$', 'User/logout')->name('customer_logout');
    //用户信息
    Route::rule('/info$','User/info','GET|POST')->name('customer_info');

    Route::post('/edit/password$','Info/editPassword')->name('customer_password');
    //产品注册
    Route::get('/warranty$','Warranty/index')->name('customer_warranty_list');
    Route::get('/warranty/register$','Warranty/register')->name('customer_warranty_register');
    Route::rule('/index$','Index/index','GET')->name('customer_index');
})->prefix('customer/');

Route::rule('/login$','customer/User/login','GET|POST');
Route::rule('/register$','customer/User/register','GET|POST');