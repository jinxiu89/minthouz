<?php

declare(strict_types=1);

namespace app\frontend\service;

/**
 * @Create by vscode,
 * @author:jinxiu89@163.com
 * @Create Date:2020年07月24日 11:03:32 Friday
 * @User: admin
 * @Current File : About.php
 * @格言：溪涧岂能留得住，终归大海做波涛 --李忱
 * @格言： 我的内心因看见大海而波涛汹涌
 **/

use app\common\model\mysql\system\About as model;
use Exception;

class About extends BaseService
{
    /**
     * Category constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->model = new model();
    }

    public function getAboutList(int $language)
    {
        try {
            return $this->model::where(['language_id' => $language, 'status' => 1])->field('url,title')->select()->toArray();
        } catch (Exception $exception) {
            return []; //todo:: 异常系统出来后细化
        }
    }
}