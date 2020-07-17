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
    Route::rule('/product$', 'category.ProductCategory/index');
    Route::rule('/add_product$', 'category.ProductCategory/add');
    Route::rule('/edit_product$', 'category.ProductCategory/edit');
    Route::rule('/product_list$', 'category.ProductCategory/lists');
    Route::rule('/change_status$', 'category.ProductCategory/changeStatus','GET');

//    Route::rule('/add_setting$', 'system.Setting/add','GET|POST');
//    Route::rule('/language/add$', 'system.Language/addLanguage','GET|POST');
});