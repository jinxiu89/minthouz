<?php

declare(strict_types=1);

namespace app\admin\controller\system;

use app\admin\controller\BaseAdmin;
use Exception;
use think\App;
use think\facade\View;

/**
 * @Create by vscode,
 * @author:jinxiu89@163.com
 * @Create Date:2020年07月20日 17:57:00 Monday
 * @User: admin
 * @Current File : About.php
 * @格言：溪涧岂能留得住，终归大海做波涛 --李忱
 * @格言： 我的内心因看见大海而波涛汹涌
 **/
class About extends BaseAdmin
{
    public function __construct(App $app)
    {
        parent::__construct($app);

        //todo:: add construct
    }
    public function index()
    {
        if ($this->request->isGet()) {
            try {
                return View::fetch();
            } catch (Exception $exception) {
                //todo:: exception
            }
        }
    }

    public function add()
    {
        if ($this->request->isGet()) {
            return View::fetch();
        }
    }
}