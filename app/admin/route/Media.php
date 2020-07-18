<?php
/**
 * @Create by PhpStorm
 * @author:jinxiu89@163.com
 * @Create Date:2020/7/18 14:59
 * @User: kevin
 * @Current File : Media.php
 * @格言：溪涧岂能留得住，终归大海做波涛 --李忱
 * @格言： 我的内心因看见大海而波涛汹涌
 **/
use think\facade\Route;

Route::group('media',function (){
    Route::rule('/image/list','media.Image/index');
    Route::rule('/image/upload','media.Image/upload');
    Route::rule('/image/create_folder','media.Image/createFolder');
    Route::rule('/image/del','media.Image/delImage');
});