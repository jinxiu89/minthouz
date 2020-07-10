<?php
declare(strict_types=1);
/**
 * @Create by PhpStorm
 * @author:jinxiu89@163.com
 * @Create Date:2020/7/10 10:15
 * @User: admin
 * @Current File : Category.php
 * @格言：溪涧岂能留得住，终归大海做波涛 --李忱
 * @格言： 我的内心因看见大海而波涛汹涌
 **/

namespace app\frontend\service;

use app\common\model\mysql\category\ProductCategory as model;
use app\libs\utils\Category as Helper;

/**
 * Class Category
 * @package app\frontend\service
 */
class Category extends BaseService
{
    /**
     * Category constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->model = new model();
    }

    /**
     * @param int $language
     */
    public function getDataByLanguage(int $language)
    {
        try {
            $obj = $this->model::getDataByLanguage((int)$status = 1, (int)$language)->toArray();
            return Helper::toLayer((array)$obj, (string)'child', (int)0);

        } catch (\Exception $exception) {
            return [];
        }
    }


}