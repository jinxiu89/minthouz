<?php
declare(strict_types=1);
/**
 * @Create by PhpStorm
 * @author:jinxiu89@163.com
 * @Create Date:2020/7/6 11:28
 * @User: admin
 * @Current File : BaseService.php
 * @格言：溪涧岂能留得住，终归大海做波涛 --李忱
 * @格言： 我的内心因看见大海而波涛汹涌
 **/

namespace app\frontend\service;

use think\facade\Env;
use think\facade\View;

/**
 * Class BaseService
 * @package app\frontend\service
 * 前台 的服务逻辑基类
 */
class BaseService
{
    protected $model;
    protected $debug;

    public function __construct()
    {
        //共用的 变量赋值在这里处理
        $this->debug = Env::get('APP_DEBUG', false);
    }

    /**
     * @param $code
     */
    public function init($code){

    }

}