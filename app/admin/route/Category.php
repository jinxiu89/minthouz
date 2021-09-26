<?php

/**
 * @Create by PhpStorm
 * @author:jinxiu89@163.com
 * @Create Date:2020/6/3 10:23
 * @User: admin
 * @Current File : Category.php
 * @格言：溪涧岂能留得住，终归大海做波涛 --李忱
 * @格言： 我的内心因看见大海而波涛汹涌
 **/

use think\facade\Route;

Route::group('category', function () {
    // 路径逻辑：为了能够清晰看到路径的逻辑，将路由的路径做层级优化，但这样有个问题，就是没办法用路由映射
    Route::rule('/product/index$', 'category.ProductCategory/index')->name('category_product');
    Route::rule('/product/add$', 'category.ProductCategory/add')->name('category_add_product');
    Route::rule('/product/edit$', 'category.ProductCategory/edit')->name('category_edit_product');
    Route::rule('/product/list$', 'category.ProductCategory/lists')->name('category_product_lists');
    Route::rule('/product/change_status$', 'category.ProductCategory/changeStatus', 'GET')->name('category_change_product');
    Route::rule('/order$', 'category.ProductCategory/sortorder', 'POST')->name('category_order_product');
});