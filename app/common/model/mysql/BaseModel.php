<?php
/**
 * @Create by PhpStorm
 * @author:jinxiu89@163.com
 * @Create Date:2020/5/28 16:33
 * @User: admin
 * @Current File : BaseModel.php
 * @格言：溪涧岂能留得住，终归大海做波涛 --李忱
 * @格言： 我的内心因看见大海而波涛汹涌
 **/

namespace app\common\model\mysql;


use think\Model;

class BaseModel extends Model
{
    protected $autoWriteTimestamp = true;
    protected $model;

    /**
     * @param int $id
     * @param array $data
     * @return BaseModel
     * 共用更新方法
     */
    public static function updateDataById(int $id, array $data)
    {
        return self::update($data, ['id' => $id]);
    }
}