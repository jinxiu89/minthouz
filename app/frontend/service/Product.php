<?php

declare(strict_types=1);
/**
 * @Create by vscode,
 * @author:jinxiu89@163.com
 * @Create Date:2020年09月24日 10:35:32 Thursday
 * @User: admin
 * @Current File : Product.php
 * @格言：溪涧岂能留得住，终归大海做波涛 --李忱
 * @格言： 我的内心因看见大海而波涛汹涌
 **/

namespace app\frontend\service;

use app\common\model\mysql\content\Product as model;
use Exception;

class Product extends BaseService
{
    /**
     * Category constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->model = new model();
    }

    public function getDataByUrlTitle(string $url, int $language)
    {
        try {
            return $this->model::getDataByUrlTitle((string) $url, (int)$language);
        } catch (Exception $exction) {
            return $exction->getMessage();
        }
    }
}