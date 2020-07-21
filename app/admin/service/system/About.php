<?php

declare(strict_types=1);

namespace app\admin\service\system;

use app\admin\service\BaseService;
use app\common\model\mysql\system\About as model;
use think\facade\Env;

/**
 * @Create by vscode,
 * @author:jinxiu89@163.com
 * @Create Date:2020年07月20日 17:20:30 Monday
 * @User: admin
 * @Current File : About.php
 * @格言：溪涧岂能留得住，终归大海做波涛 --李忱
 * @格言： 我的内心因看见大海而波涛汹涌
 **/

class About extends BaseService
{
    public function __construct()
    {
        $this->model = new model();
    }
    /**
     * 获取
     *
     * @Author: kevin qiu
     * @DateTime: 2020-07-21
     * @param integer $language
     * @return void
     */
    public function getObj(int $language = 1)
    {
        try {
            $obj = $this->model::getObj((int) $language);
            return $obj->toArray();
        } catch (\Exception $exception) {
            if (true == Env::get('APP_DEBUG')) abort(500, $exception->getMessage());
            abort(500, '服务器内部错误');
        }
    }
}