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


use think\db\exception\DbException;
use think\facade\Env;
use think\Model;
use think\Paginator;

/**
 * Class BaseModel
 * @package app\common\model\mysql
 */
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

    /**
     * @param int $language
     * @return array|Model
     */
    public static function getDtaByLanguage(int $language)
    {
        return self::where(['language_id' => $language])->findOrEmpty();
    }

    /**
     * @param int $status
     * @return Paginator
     */
    public static function getDataByStatus(int $status)
    {
        try {
            return self::where(['status' => $status])->order('id', 'desc')->paginate();
        } catch (DbException $exception) {
            if (true == Env::get('APP_DEBUG')) abort(500, $exception->getMessage());
            abort(500, '服务器内部错误');
        }
    }

    /**
     * 获取指定语言的数据
     *
     * @Author: kevin qiu
     * @DateTime: 2020-07-21
     * @param integer $language
     * @return void
     */
    public static function getObj(int $language)
    {
        return self::where(['language_id' => $language])->order(['id' => 'desc'])->paginate();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public static function getDataById(int $id)
    {
        return self::findOrEmpty($id);
    }

    public static function getDataByUrl(string $url, int $language)
    {
        return self::where(['url' => $url, 'language_id' => $language])->findOrEmpty();
    }
}