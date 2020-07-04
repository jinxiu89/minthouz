<?php
/**
 * @Create by PhpStorm
 * @author:jinxiu89@163.com
 * @Create Date:2020/7/2 15:06
 * @User: admin
 * @Current File : Product.php
 * @格言：溪涧岂能留得住，终归大海做波涛 --李忱
 * @格言： 我的内心因看见大海而波涛汹涌
 **/

namespace app\admin\service\content;


use app\admin\service\BaseService;
use app\common\model\mysql\content\Product as model;
use think\Exception;
use think\facade\Db;
use think\facade\Env;

/**
 * Class Product
 * @package app\admin\service\content
 *
 */
class Product extends BaseService
{
    public function __construct()
    {
        $this->model = new model();
    }

    /**
     * @param array $product
     * @param array $album
     * @param array $content
     * save 关联新增还是修改 产品数据
     * @return bool
     */
    public function save(array $product, array $album, array $content)
    {
        try {
            if (isset($product['id']) and !empty($product['id'])) {
                //保存
                Db::transaction(function () use ($product, $album, $content) {
                    Db::table('tb_product')->save($product);
                    Db::table('tb_product_content')->where(['product_id' => (int)$product['id']])->save($content);
                    Db::table('tb_product_image')->where(['product_id' => (int)$product['id']])->delete();
                    $albums = [];
                    foreach ($album as $item) {
                        $arr['type'] = 3;//事先规定好的 3 是相册 2是内容 1 是缩略图
                        $arr['path'] = $item;
                        $arr['product_id'] = intval($product['id']);
                        $albums[] = $arr;
                    }
                    Db::table('tb_product_image')->replace()->insertAll($albums);
                });
                return true;
            }else{
                //新增
                Db::transaction(function () use ($product, $album, $content) {
                    $id = Db::table('tb_product')->strict(false)->insertGetId($product);//主表添加
                    $albums = [];
                    foreach ($album as $item) {
                        $arr['type'] = 3;//事先规定好的 3 是相册 2是内容 1 是缩略图
                        $arr['path'] = $item;
                        $arr['product_id'] = intval($id);
                        $albums[] = $arr;
                    }
                    Db::table('tb_product_image')->replace()->insertAll($albums);
                    $content['product_id'] = intval($id);
                    Db::table('tb_product_content')->strict(false)->insert($content);
                });
                return true;
            }
        } catch (\Exception $exception) {
            if (!Env::get('app_debug')) abort(500, $exception->getMessage());
            abort(500, $exception->getMessage());
        }
    }

    /**
     * @param int $id
     * @return mixed|void
     */
    public function getDataByID(int $id)
    {
        try {
            return $this->model::getDataByID((int)$id);

        } catch (Exception $exception) {
            if (!Env::get('app_debug')) abort(500, $exception->getMessage());
            abort(500, $exception->getMessage());
        }
    }
}