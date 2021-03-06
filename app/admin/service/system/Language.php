<?php

/**
 * @Create by PhpStorm
 * @author:jinxiu89@163.com
 * @Create Date:2020/6/1 13:51
 * @User: admin
 * @Current File : Language.php
 * @格言：溪涧岂能留得住，终归大海做波涛 --李忱
 * @格言： 我的内心因看见大海而波涛汹涌
 **/

namespace app\admin\service\system;


use app\admin\service\BaseService;
use app\common\model\mysql\system\Language as Model;
use Exception;

/**
 * Class Language
 * @package app\admin\service\system
 */
class Language extends BaseService
{
    public function __construct()
    {
        $this->model = new Model();
    }

    /**
     * @param string $code
     */
    public function getLanguageByCode(string $code)
    {
        try {
            return $this->model::getDataByCode($code);
        } catch (\Exception $exception) {
            return [];
        }
    }
    public function getLanguage()
    {
        try {
            $obj = $this->model::getLanguage();
            return $obj->toArray();
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }
}