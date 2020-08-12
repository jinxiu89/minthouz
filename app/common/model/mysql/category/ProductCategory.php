<?php

/**
 * @Create by PhpStorm
 * @author:jinxiu89@163.com
 * @Create Date:2020/6/4 10:37
 * @User: admin
 * @Current File : ProductCategory.php
 * @格言：溪涧岂能留得住，终归大海做波涛 --李忱
 * @格言： 我的内心因看见大海而波涛汹涌
 **/

namespace app\common\model\mysql\category;


use app\common\model\mysql\BaseModel;
use think\Collection;
use think\db\exception\DataNotFoundException;
use think\db\exception\DbException;
use think\db\exception\ModelNotFoundException;

/**
 * Class ProductCategory
 * @package app\common\model\mysql\category
 */
class ProductCategory extends BaseModel
{
    protected $table = 'tb_product_category';

    /**
     * @param int $language
     * @return Collection
     * @throws DataNotFoundException
     * @throws DbException
     * @throws ModelNotFoundException
     */
    public static function getDataByLanguage(int $status, int $language)
    {
        return self::where(['status' => $status, 'language_id' => $language])->field('id,parent_id,path,is_parent,level,name,title,url_title')->order('listorder desc')->select();
    }
}