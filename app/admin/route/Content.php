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

Route::group('content',function (){
    Route::rule('/index','content.Index/index');
//    产品
    Route::rule('/product_index','content.Product/index');
    Route::rule('/add_product','content.Product/add','GET|POST');
    Route::rule('/edit_product','content.Product/edit','GET|POST');
    //Prettiest 优质产品 首页霸屏，栏目推介位
    Route::rule('/prettiest_index','content.Prettiest/index','GET');
    Route::rule('/add_prettiest','content.Prettiest/add','GET|POST');
    Route::rule('/edit_prettiest','content.Prettiest/edit','GET|POST');
});