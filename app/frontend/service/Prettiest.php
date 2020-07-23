<?php

/**
 * @Create by PhpStorm
 * @author:jinxiu89@163.com
 * @Create Date:2020/7/9 14:56
 * @User: admin
 * @Current File : Prettiest.php
 * @格言：溪涧岂能留得住，终归大海做波涛 --李忱
 * @格言： 我的内心因看见大海而波涛汹涌
 **/

namespace app\frontend\service;

use app\common\model\mysql\content\Prettiest as model;

class Prettiest extends BaseService
{
    public function __construct()
    {
        $this->model = new model();
    }

    /**
     * @param int $language
     * @param int $type
     */
    public function getPrettiest(int $type, int $language, int $status)
    {
        try {
            $obj = $this->model::getDataByType((int)$type, (int)$language, (int) $status);
            return $obj->toArray()['data'];
        } catch (\Exception $exception) {
            //todo:
        }
    }
}