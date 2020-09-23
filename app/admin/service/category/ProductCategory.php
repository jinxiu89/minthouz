<?php

/**
 * @Create by PhpStorm
 * @author:jinxiu89@163.com
 * @Create Date:2020/6/3 10:21
 * @User: admin
 * @Current File : ProductCategory.php
 * @格言：溪涧岂能留得住，终归大海做波涛 --李忱
 * @格言： 我的内心因看见大海而波涛汹涌
 **/

namespace app\admin\service\category;


use app\admin\service\BaseService;
use app\common\model\mysql\category\ProductCategory as model;
use app\libs\utils\Category;
use think\facade\Db;
use think\facade\Env;

/**
 * Class ProductCategory
 * @package app\admin\service\category
 */
class ProductCategory extends BaseService
{
    public function __construct()
    {
        $this->model = new model();
    }

    /**
     * getTree 获取分类树
     *
     * @param int $language
     * @param int $status
     */
    public function getTree(int $language = 1, int $status = 1)
    {
        try {
            //todo:: 缓存
            $data = $this->model->field('id,name,is_parent,parent_id,level,path')->where(['language_id' => $language, 'status' => $status])->select()->toArray();
            return Category::toLevel($data, '&nbsp;');
        } catch (\Exception $exception) {
            if (!Env::get('app_debug')) abort(500, $exception->getMessage());
            abort(500, '服务器内部错误');
        }
    }


    /**
     * @param int $parent_id
     * @return array|\think\Model
     */
    public function getParent(int $parent_id)
    {
        try {
            return $this->model->field('id,parent_id,level,path')->where(['id' => $parent_id])->findOrEmpty();
        } catch (\Exception $exception) {
            if (!Env::get('app_debug')) abort(500, $exception->getMessage());
            abort(500, '服务器内部错误');
        }
    }

    /**
     * @param int $language
     * @return array
     */

    public function getDataByLanguage(int $status, int $language): array
    {
        try {
            $obj = $this->model::getDataByLanguage((int) $status, (int)$language);
            return $obj->toArray();
        } catch (\Exception $exception) {
            if (!Env::get('app_debug')) abort(500, $exception->getMessage());
            abort(500, '服务器内部错误');
        }
    }
}