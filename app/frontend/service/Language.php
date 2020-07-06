<?php
/**
 * @Create by PhpStorm
 * @author:jinxiu89@163.com
 * @Create Date:2020/7/6 11:28
 * @User: admin
 * @Current File : Language.php
 * @格言：溪涧岂能留得住，终归大海做波涛 --李忱
 * @格言： 我的内心因看见大海而波涛汹涌
 **/

namespace app\frontend\service;

use app\common\model\mysql\system\Language as model;
use think\db\exception\DataNotFoundException;
use think\db\exception\DbException;
use think\db\exception\ModelNotFoundException;
use think\Exception;
use think\facade\Cache;
use think\facade\Log;

/**
 * Class Language
 * @package app\frontend\service
 */
class Language extends BaseService
{
    public function __construct()
    {
        parent::__construct();
        $this->model = new model();
    }

    /**
     * @param string $code
     * @throws DataNotFoundException
     * @throws DbException
     * @throws ModelNotFoundException
     */
    public function getDataByCode(string $code)
    {
        try {
            if ($this->debug == false) {
                $data = Cache::get($code);
                if ($data) return $data;
                $obj = $this->model::getDataByCode((string)$code);
                Cache::set($code, $obj);
                return $obj;
            }
            return $this->model::getDataByCode((string)$code);
        } catch (Exception $exception) {
            if ($this->debug == true) Log::error($exception->getMessage());
            return [];
        }
    }
}