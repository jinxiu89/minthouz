<?php

/**
 * @Create by PhpStorm
 * @author:jinxiu89@163.com
 * @Create Date:2020/5/29 15:33
 * @User: admin
 * @Current File : System.php
 * @格言：溪涧岂能留得住，终归大海做波涛 --李忱
 * @格言： 我的内心因看见大海而波涛汹涌
 **/

use think\facade\Route;

Route::group('system', function () {
    Route::rule('/index$', 'system.Index/index')->name('system_index');
    Route::rule('/language/index$', 'system.Language/index', 'GET')->name('system_language_index');
    Route::rule('/language/add$', 'system.Language/addLanguage', 'GET|POST')->name('add_language');
    Route::rule('/language/edit$', 'system.Language/editLanguage', 'GET|POST')->name('edit_language');
    Route::rule('/language/change_status$', 'system.Language/changeStatus', 'GET')->name('change_language_status');
    Route::rule('/setting$', 'system.Setting/setting', 'GET|POST')->name('system_setting');
    Route::rule('/about/index$', 'system.About/index', 'GET')->name('system_about');
    Route::rule('/about/add$', 'system.About/add', 'GET|POST')->name('system_add_about');
    Route::rule('/about/edit$', 'system.About/edit', 'GET|POST')->name('system_edit_about');
    Route::rule('/about/change_status$', 'system.About/changeStatus', 'GET')->name('system_about_change');
    Route::rule('/changeLanguage$', 'Common/changeLanguage', 'GET')->name('system_change_langeuage');
});