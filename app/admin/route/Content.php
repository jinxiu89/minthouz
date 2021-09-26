<?php

/**
 * @Create by PhpStorm
 * @author:jinxiu89@163.com
 * @Create Date:2020/5/29 14:15
 * @User: admin
 * @Current File : Content.php
 * @格言：溪涧岂能留得住，终归大海做波涛 --李忱
 * @格言： 我的内心因看见大海而波涛汹涌
 **/

use think\facade\Route;

Route::group('content', function () {
    Route::rule('/index', 'content.Index/index')->name('content_index');
    //    产品
    Route::rule('/product/index', 'content.Product/index')->name('content_product_index');
    Route::rule('/product/add', 'content.Product/add', 'GET|POST')->name('content_add_product');
    Route::rule('/product/edit', 'content.Product/edit', 'GET|POST')->name('content_edit_product');
    Route::rule('/product/change_status', 'content.Product/changeStatus', 'GET|POST')->name('content_change_product');
    Route::rule('/product/order', 'content.Product/order', 'POST')->name('content_order_product');

    //Prettiest 优质产品 首页霸屏，栏目推介位
    Route::rule('/prettiest/index', 'content.Prettiest/index', 'GET')->name('content_pretties_index');
    Route::rule('/prettiest/add', 'content.Prettiest/add', 'GET|POST')->name('content_add_pretties');
    Route::rule('/prettiest/edit', 'content.Prettiest/edit', 'GET|POST')->name('content_edit_pretties');
    Route::rule('/prettiest/change_status', 'content.Prettiest/changeStatus', 'GET')->name('content_change_pretties');
    Route::rule('/notice', 'content.Notice/notice', 'GET|POST')->name('content_notice');
});