<?php
declare(strict_types=1);
/**
 * @Create by PhpStorm
 * @author:jinxiu89@163.com
 * @Create Date:2020/5/28 16:49
 * @User: admin
 * @Current File : BaseService.php
 * @格言：溪涧岂能留得住，终归大海做波涛 --李忱
 * @格言： 我的内心因看见大海而波涛汹涌
 **/

namespace app\admin\service;

use think\facade\Env;

/**
 * Class BaseService
 * @package app\admin\service
 */
class BaseService
{
    protected $model;

    /**
     * @param array $data
     */
    public function create(array $data)
    {
        try {
            $response = $this->model::create($data);
            return $response->id;
        } catch (\Exception $exception) {
            if (true == Env::get('APP_DEBUG')) abort(500, $exception->getMessage());
            abort(500, '服务器内部错误');
        }
    }

    public function update(array $data)
    {
        try {
            $result = $this->model::update($data);
            return $result->id;
        } catch (\Exception $exception) {
            if (true == Env::get('APP_DEBUG')) abort(500, $exception->getMessage());
            abort(500, '服务器内部错误');
        }
    }

    /**
     * @param int $status
     */
    public function getDataByStatus(int $status = 1)
    {
        try {
            $obj = $this->model::getDataByStatus((int)$status);
            return $obj->toArray();
        } catch (\Exception $exception) {
            if (true == Env::get('APP_DEBUG')) abort(500, $exception->getMessage());
            abort(500, '服务器内部错误');
        }
    }

    /**
     * @param int $id
     * @return mixed
     *
     */
    public function getDataById(int $id)
    {
        try {
            $obj = $this->model::getDataById((int)$id);
            return $obj->toArray();
        } catch (\Exception $exception) {
            if (true == Env::get('APP_DEBUG')) abort(500, $exception->getMessage());
            abort(500, '服务器内部错误');
        }
    }
}