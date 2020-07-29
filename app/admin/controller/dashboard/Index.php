<?php

/**
 * @Create by PhpStorm
 * @author:jinxiu89@163.com
 * @Create Date:2020/7/18 17:32
 * @User: kevin
 * @Current File : Index.php
 * @格言：溪涧岂能留得住，终归大海做波涛 --李忱
 * @格言： 我的内心因看见大海而波涛汹涌
 **/

namespace app\admin\controller\dashboard;

use app\admin\controller\BaseAdmin;
use think\App;
use think\facade\View;

class Index extends BaseAdmin
{
    /**
     * Index constructor.
     * @param App $app
     */
    public function __construct(App $app)
    {
        parent::__construct($app);
    }

    /**
     * @return string
     */
    public function index()
    {
        return View::fetch();
    }

    /**
     * Undocumented function
     *
     * @Author: kevin qiu
     * @DateTime: 2020-07-20
     * @return void
     */
    public function info()
    {
        $data = [
            '操作系统' => PHP_OS,
            '运行环境' => $_SERVER["SERVER_SOFTWARE"],
            '主机名' => $_SERVER['SERVER_NAME'],
            'WEB服务端口' => $_SERVER['SERVER_PORT'],
            '网站文档目录' => $_SERVER["DOCUMENT_ROOT"],
            '浏览器信息' => substr($_SERVER['HTTP_USER_AGENT'], 0, 40),
            '通信协议' => $_SERVER['SERVER_PROTOCOL'],
            '请求方法' => $_SERVER['REQUEST_METHOD'],
            '核心版本' => App::VERSION,
            '上传附件限制' => ini_get('upload_max_filesize'),
            '执行时间限制' => ini_get('max_execution_time') . '秒',
            '服务器时间' => date("Y年n月j日 H:i:s"),
            '北京时间' => gmdate("Y年n月j日 H:i:s", time() + 8 * 3600),
            '服务器域名/IP' => $_SERVER['SERVER_NAME'] . ' [ ' . gethostbyname($_SERVER['SERVER_NAME']) . ' ]',
            // '用户的IP地址' => $_SERVER['REMOTE_ADDR'],
            '剩余空间' => round((disk_free_space(".") / (1024 * 1024)), 2) . 'M',
        ];
        $time = time();
        View::assign('time', $time);
        View::assign('info', $data);
        return View::fetch();
    }
}