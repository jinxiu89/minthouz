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

use Exception;
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

    /**
     * @param array $data
     * @return mixed
     */
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
     * @param array $data
     * @return mixed
     */
    public function saveData(array $data)
    {
        try {
            return $this->model->save($data);
        } catch (\Exception $exception) {
            if (true == Env::get('APP_DEBUG')) abort(500, $exception->getMessage());
            abort(500, '服务器内部错误');
        }
    }

    /**
     * @param int $id
     * @param int $status
     */
    public function changeStatus(int $id, int $status)
    {
        try {
            return $this->model::update((array)['id' => $id, 'status' => $status]);
        } catch (\Exception $exception) {
            if (true == Env::get('APP_DEBUG')) abort(500, $exception->getMessage());
            abort(500, '服务器内部错误');
        }
    }

    public function sortorder(array $data)
    {
        try {
            return $this->model::updateDataById((int) $data['id'], (array) $data);
        } catch (Exception $exception) {
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
     * 公用获取时速局
     *
     * @Author: kevin qiu
     * @DateTime: 2020-07-21
     * @param integer $language
     * @return void
     */
    public function getObj(int $language = 1)
    {
        try {
            $obj = $this->model::getObj((int) $language);
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