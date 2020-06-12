<?php
/**
 * @Create by PhpStorm
 * @author:jinxiu89@163.com
 * @Create Date:2020/6/9 15:23
 * @User: admin
 * @Current File : Route.php
 * @格言：溪涧岂能留得住，终归大海做波涛 --李忱
 * @格言： 我的内心因看见大海而波涛汹涌
 **/
use think\facade\Route;

Route::group('media',function (){
    Route::rule('/image_list','media.Image/index','GET');
    Route::rule('/image_upload','media.Image/upload','GET|POST');
    Route::rule('/create_image_folder','media.Image/createFolder','GET|POST');
    Route::rule('/del_image','media.Image/delImage','GET|POST');
});
