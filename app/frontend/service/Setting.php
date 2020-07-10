<?php
/**
 * @Create by PhpStorm
 * @author:jinxiu89@163.com
 * @Create Date:2020/7/10 9:36
 * @User: admin
 * @Current File : Setting.php
 * @格言：溪涧岂能留得住，终归大海做波涛 --李忱
 * @格言： 我的内心因看见大海而波涛汹涌
 **/

namespace app\frontend\service;

use app\common\model\mysql\system\Setting as model;

/**
 * Class Setting
 * @package app\frontend\service
 */
class Setting extends BaseService
{
    public function __construct()
    {
        parent::__construct();
        $this->model = new model();
    }

    public function getDataByLanguage(int $language)
    {

        try {
            return $this->model::getDtaByLanguage((int)$language)->toArray();
        } catch (\Exception $exception) {
            return [];
        }

    }
}