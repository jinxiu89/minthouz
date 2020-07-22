<?php

declare(strict_types=1);
/**
 * @Create by PhpStorm
 * @author:jinxiu89@163.com
 * @Create Date:2020/7/7 15:25
 * @User: admin
 * @Current File : Prettiest.php
 * @格言：溪涧岂能留得住，终归大海做波涛 --李忱
 * @格言： 我的内心因看见大海而波涛汹涌
 **/

namespace app\admin\service\content;


use app\admin\service\BaseService;
use app\common\model\mysql\content\Prettiest as model;
use think\facade\Env;

/**
 * Class Prettiest
 * @package app\admin\service\content
 */
class Prettiest extends BaseService
{
    public function __construct()
    {
        $this->model = new model();
    }

    /**
     * @param int $type
     * @param int $language
     * @return array
     */
    public function getDataByType(int $type, int $language)
    {
        try {
            $obj = $this->model::getDataByType((int)$type, (int)$language);
            return $obj->toArray();
        } catch (\Exception $exception) {
            if (!Env::get('app_debug')) abort(500, $exception->getMessage());
            abort(500, $exception->getMessage());
        }
    }
}