<?php
/**
 * @Create by PhpStorm
 * @author:jinxiu89@163.com
 * @Create Date:2020/7/2 15:08
 * @User: admin
 * @Current File : Product.php
 * @格言：溪涧岂能留得住，终归大海做波涛 --李忱
 * @格言： 我的内心因看见大海而波涛汹涌
 **/

namespace app\common\model\mysql\content;


use app\common\model\mysql\BaseModel;
use think\model\relation\HasMany;
use think\model\relation\HasOne;

/**
 * Class Product
 * @package app\common\model\mysql\content
 */
class Product extends BaseModel
{
    protected $table = 'tb_product';

    /**
     * @return HasOne
     * 产品内容 一对一的关系
     */
    public function content()
    {
        return $this->hasOne(ProductContent::class);
    }

    /**
     * @return HasMany
     * 产品相册：一对多的关系
     */
    public function albums()
    {
        return $this->hasMany(ProductImage::class);
    }

    /**
     * @param int $id
     * @return mixed|void
     */
    public static function getDataByID(int $id)
    {
        return self::where(['id' => $id])->with(['content', 'albums'])->find()->toArray();
    }
}